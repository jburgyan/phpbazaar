<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Listings Controller
 *
 * @property \App\Model\Table\ListingsTable $Listings
 *
 * @method \App\Model\Entity\Listing[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ListingsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Vendors']
        ];
        $listings = $this->paginate($this->Listings);

        $this->set(compact('listings'));
    }

    /**
     * View method
     *
     * @param string|null $id Listing id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $listing = $this->Listings->get($id, [
            'contain' => ['Vendors', 'Ratings']
        ]);

        $this->set('listing', $listing);
    }
}
