<?php

namespace App\Controller;

use Cake\Datasource\ConnectionManager;
use Cake\Datasource\Exception\RecordNotFoundException;

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
}
