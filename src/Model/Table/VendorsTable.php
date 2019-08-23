<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Vendors Model
 *
 * @method \App\Model\Entity\Vendor get($primaryKey, $options = [])
 * @method \App\Model\Entity\Vendor newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Vendor[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Vendor|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Vendor saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Vendor patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Vendor[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Vendor findOrCreate($search, callable $callback = null, $options = [])
 */
class VendorsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('vendors');
        $this->setDisplayField('name');
        $this->setPrimaryKey('peerId');
	    $this->hasMany('Listings', [
		    'foreignKey' => 'vendorPeerId',
	    ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->scalar('peerId')
            ->maxLength('peerId', 255)
            ->allowEmptyString('peerId', null, 'create');

        $validator
            ->scalar('peerID')
            ->maxLength('peerID', 255)
            ->allowEmptyString('peerID');

        $validator
            ->scalar('hash')
            ->maxLength('hash', 255)
            ->allowEmptyString('hash');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->allowEmptyString('name');

        $validator
            ->scalar('location')
            ->allowEmptyString('location');

        $validator
            ->scalar('about')
            ->allowEmptyString('about');

        $validator
            ->scalar('shortDescription')
            ->allowEmptyString('shortDescription');

        $validator
            ->boolean('nsfw')
            ->allowEmptyString('nsfw');

        $validator
            ->boolean('vendor')
            ->allowEmptyString('vendor');

        $validator
            ->allowEmptyString('contactInfo');

        $validator
            ->allowEmptyString('colors');

        $validator
            ->allowEmptyString('avatarHashes');

        $validator
            ->allowEmptyString('headerHashes');

        $validator
            ->allowEmptyString('stats');

        $validator
            ->scalar('bitcoinPubkey')
            ->maxLength('bitcoinPubkey', 255)
            ->allowEmptyString('bitcoinPubkey');

        $validator
            ->scalar('currencies')
            ->allowEmptyString('currencies');

        $validator
            ->scalar('vendorCurrencies')
            ->allowEmptyString('vendorCurrencies');

        $validator
            ->allowEmptyString('raw');

        $validator
            ->allowEmptyString('misc');

        $validator
            ->dateTime('createdAt')
            ->requirePresence('createdAt', 'create')
            ->notEmptyDateTime('createdAt');

        $validator
            ->dateTime('updatedAt')
            ->requirePresence('updatedAt', 'create')
            ->notEmptyDateTime('updatedAt');

        $validator
            ->numeric('fee')
            ->notEmptyString('fee');

        return $validator;
    }
}
