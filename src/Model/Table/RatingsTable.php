<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Ratings Model
 *
 * @method \App\Model\Entity\Rating get($primaryKey, $options = [])
 * @method \App\Model\Entity\Rating newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Rating[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Rating|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Rating saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Rating patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Rating[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Rating findOrCreate($search, callable $callback = null, $options = [])
 */
class RatingsTable extends Table
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

        $this->setTable('ratings');
        $this->setDisplayField('ratingKey');
        $this->setPrimaryKey('ratingKey');
	    $this->belongsTo('Listings', [
		    'foreignKey' => 'listingSlugPeerId'
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
            ->scalar('ratingKey')
            ->maxLength('ratingKey', 255)
            ->allowEmptyString('ratingKey', null, 'create');

        $validator
            ->scalar('buyerBitcoinSig')
            ->maxLength('buyerBitcoinSig', 255)
            ->allowEmptyString('buyerBitcoinSig');

        $validator
            ->scalar('buyerPeerID')
            ->maxLength('buyerPeerID', 255)
            ->allowEmptyString('buyerPeerID');

        $validator
            ->scalar('buyerBitcoinPubKey')
            ->maxLength('buyerBitcoinPubKey', 255)
            ->allowEmptyString('buyerBitcoinPubKey');

        $validator
            ->scalar('buyerIdentityPubKey')
            ->maxLength('buyerIdentityPubKey', 255)
            ->allowEmptyString('buyerIdentityPubKey');

        $validator
            ->scalar('buyerSig')
            ->maxLength('buyerSig', 255)
            ->allowEmptyString('buyerSig');

        $validator
            ->integer('customerServiceScore')
            ->allowEmptyString('customerServiceScore');

        $validator
            ->integer('deliverySpeedScore')
            ->allowEmptyString('deliverySpeedScore');

        $validator
            ->integer('descriptionScore')
            ->allowEmptyString('descriptionScore');

        $validator
            ->integer('overallScore')
            ->allowEmptyString('overallScore');

        $validator
            ->scalar('review')
            ->allowEmptyString('review');

        $validator
            ->allowEmptyString('timestamp');

        $validator
            ->scalar('vendorBitcoinSig')
            ->maxLength('vendorBitcoinSig', 255)
            ->allowEmptyString('vendorBitcoinSig');

        $validator
            ->scalar('vendorPeerID')
            ->maxLength('vendorPeerID', 255)
            ->allowEmptyString('vendorPeerID');

        $validator
            ->scalar('vendorBitcoinPubKey')
            ->maxLength('vendorBitcoinPubKey', 255)
            ->allowEmptyString('vendorBitcoinPubKey');

        $validator
            ->scalar('vendorIdentityKey')
            ->maxLength('vendorIdentityKey', 255)
            ->allowEmptyString('vendorIdentityKey');

        $validator
            ->allowEmptyString('vendorSigMetadata');

        $validator
            ->scalar('signature')
            ->maxLength('signature', 255)
            ->allowEmptyString('signature');

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
            ->scalar('listingSlugPeerId')
            ->allowEmptyString('listingSlugPeerId');

        return $validator;
    }
}
