<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;

/**
 * Listings Controller
 *
 * @property \App\Model\Table\ListingsTable $Listings
 *
 * @method \App\Model\Entity\Listing[]|\Cake\Datasource\ResultSetInterface paginate( $object = null, array $settings = [] )
 */
class ListingsController extends AppController {

	public $helpers = ['Listing'];
	/**
	 * Index method
	 *
	 * @return \Cake\Http\Response|null
	 */
	public function index() {
		$this->paginate = [
			'contain' => [ 'Vendors' ]
		];
		$category = $this->request->getQuery('c');
		$tag = $this->request->getQuery('t');
		$connection = ConnectionManager::get( 'default' );
		if($category) {
			$this->paginate['conditions'] = [
				$connection->quote($category)." = ANY(categories)"
			];
		}
		if($tag) {
			$this->paginate['conditions'] = [
				$connection->quote($tag)." = ANY(tags)"
			];
		}
		$listings       = $this->paginate( $this->Listings );

		$this->set( compact( 'listings' ) );
	}

	/**
	 * View method
	 *
	 * @param string|null $id Listing id.
	 *
	 * @return \Cake\Http\Response|null
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function view( $id = null ) {
		$listing = $this->Listings->get( $id, [
			'contain' => [
				'Vendors',
				'Ratings' => function ( $q ) {
					return $q
						->order( [ 'updatedAt' => 'DESC' ] )
						->limit( 10 );
				}
			]
		] );

		$this->set( 'listing', $listing );
	}
}
