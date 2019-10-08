<?php

namespace App\Controller;

use Cake\Datasource\ConnectionManager;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Http\Client;
use Cake\ORM\Locator\TableLocator;
use Cake\Routing\Router;
use Cake\I18n\FrozenTime;

/**
 * Vendors Controller
 *
 * @property \App\Model\Table\VendorsTable $Vendors
 * @property \App\Model\Table\ListingsTable $Listings
 *
 * @method \App\Model\Entity\Vendor[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class VendorsController extends AppController
{

	public function initialize() {
		parent::initialize();
		$this->loadComponent( 'Security' );
		$this->Security->setConfig( 'unlockedActions', [
			'contact',
			'update'
		] );
	}

    /**
     * Index method
     */
    public function index()
    {

        $this->paginate = [
            'order' => ['Vendors.fee' => 'desc'],
            'conditions' => [],
            'limit' => 60
        ];
        $currency = $this->request->getQuery('cu');
        $search = $this->request->getQuery('s');
        $connection = ConnectionManager::get('default');
        if ($currency) {
            $this->paginate['conditions'][] =
                $connection->quote($currency) . " = ANY(currencies)";
        }
        if ($search) {
            $this->paginate['conditions'][] =
                "\"Vendors\".\"_search\" @@ plainto_tsquery('english', " . $connection->quote($search) . ")";
        }
        $vendors = $this->paginate($this->Vendors);

        $this->set(compact('vendors'));
    }

    /**
     * View method
     *
     * @param string|null $id Vendor id.
     *
     * @throws RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->loadModel('Listings');
        try {
            $vendor = $this->Vendors->get($id, [
                'contain' => []
            ]);
        } catch (RecordNotFoundException $e) {
            $this->render('not_found');
            return;
        }
        $this->set('vendor', $vendor);

        $this->paginate = [
            'contain' => [],
            'conditions' => [
                'vendorPeerId' => $id
            ],
            'limit' => 60
        ];
        $category = $this->request->getQuery('c');
        $tag = $this->request->getQuery('t');
        $connection = ConnectionManager::get('default');
        if ($category) {
            $this->paginate['conditions'][] =
                $connection->quote($category) . " = ANY(categories)";
        }
        if ($tag) {
            $this->paginate['conditions'][] =
                $connection->quote($tag) . " = ANY(tags)";
        }
        $listings = $this->paginate($this->Listings);

        $this->set(compact('listings'));
    }

	public function update() {
		$peerId = $this->request->getQuery( 'peerId' );
		if ( $peerId ) {
			$error   = false;
			$http    = new Client();
			try {
				$response = $http->put( Router::url( '/', true ) . 'api/scrapePassedInPeer/' . $peerId );
				$result   = @json_decode($response->getStringBody());
				$message  = @$result->message;
				if(empty($message)) {
					$message = __('We were unable to process your request. Please try again later');
				}
				if($message != 'Added to scrape queue') {
					$error = true;
				}
				if(!$error) {
					$table_locator = new TableLocator();
					$peers_table         = $table_locator->get( 'Peers' );
					try {
						$peers_table->get( $peerId, [
							'contain' => []
						] );
					}
					catch ( \Cake\Datasource\Exception\RecordNotFoundException $e ) {
						$peer = $peers_table->newEntity( [ 'updatedat' => new FrozenTime() ] );
						$peer->peerid = $peerId;
						$peers_table->save( $peer );
					}
				}
			}
			catch ( \Exception $e ) {
				$error   = true;
				$message = $e->getMessage();
			}
			$this->set( compact( 'error', 'message' ) );
		}
	}

	private function sendJsonResponse( $data = [] ) {
		$this->set( $data );
		$this->set( '_serialize', array_keys( $data ) );
		$this->viewBuilder()->setClassName( 'Json' );
	}

	/**
	 * Contact method
	 *
	 * @param string $id         Vendor id.
	 * @param string $listing_id Listing id.
	 *
	 * @throws RecordNotFoundException When record not found.
	 */
	public function contact( $id, $listing_id ) {
		$table_locator  = new TableLocator();
		$listings_table = $table_locator->get( 'Listings' );
		$error          = '';
		$message        = '';
		try {
			$vendor  = $this->Vendors->get( $id, [
				'contain' => []
			] );
			$listing = $listings_table->get( $listing_id, [
				'contain' => []
			] );
		}
		catch ( RecordNotFoundException $e ) {
			$this->render( 'not_found' );

			return;
		}
		if ( $this->request->is( 'post' ) ) {
			$ip = $this->request->clientIp();
			$messages_table                  = $table_locator->get( 'Messages' );
			$day_ago = new FrozenTime( null, 'UTC' );
			$day_ago = $day_ago->addHours(-24);
			$old_messages = $messages_table->find('all')
				->where([
					'Messages.ip' => $ip,
				    'Messages.createdat > ' => $day_ago->toIso8601String()
				])
			->limit(1)->all();
			$old_messages = $old_messages->toArray();
			if(count($old_messages) < 1) {
				$post_data                       = $this->request->getData();
				$post_data['peerid']             = $id;
				$post_data['listing_slugpeerid'] = $listing_id;
				$post_data['createdat']          = new FrozenTime( null, 'UTC' );
				$post_data['ip']                 = $ip;
				$vendormessage                   = $messages_table->newEntity($post_data);
				try {
					$messages_table->save( $vendormessage );
				}
				catch ( \Exception $e ) {
					$error   = 'error';
					$message = $e->getMessage();
				}
			} else {
				$error = 'error';
				$message = __('You can only send one message from the same ip address within 24 hours');
			}
			if(empty($message)) {
				$message = __('Your message has been queued for sending successfully!');
			}
			if ( $this->request->accepts( 'application/json' ) ) {
				$this->sendJsonResponse( [ 'error' => $error, 'message' => $message ] );
			}
		}

		$this->set( compact( 'vendor', 'listing', 'error', 'message' ) );
	}
}
