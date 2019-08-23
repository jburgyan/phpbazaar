<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Listings Model
 *
 * @method \App\Model\Entity\Listing get($primaryKey, $options = [])
 * @method \App\Model\Entity\Listing newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Listing[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Listing|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Listing saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Listing patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Listing[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Listing findOrCreate($search, callable $callback = null, $options = [])
 */
class ListingsTable extends Table
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

        $this->setTable('listings');
        $this->setDisplayField('title');
        $this->setPrimaryKey('slugPeerId');
	    $this->belongsTo('Vendors', [
		    'foreignKey' => 'vendorPeerId',
	    ]);
	    $this->hasMany('Ratings', [
		    'foreignKey' => 'listingSlugPeerId',
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
            ->scalar('slugPeerId')
            ->allowEmptyString('slugPeerId', null, 'create');

        $validator
            ->scalar('hash')
            ->maxLength('hash', 255)
            ->requirePresence('hash', 'create')
            ->notEmptyString('hash');

        $validator
            ->scalar('handle')
            ->maxLength('handle', 255)
            ->requirePresence('handle', 'create')
            ->notEmptyString('handle');

        $validator
            ->scalar('identityPubKey')
            ->maxLength('identityPubKey', 255)
            ->requirePresence('identityPubKey', 'create')
            ->notEmptyString('identityPubKey');

        $validator
            ->scalar('identityBitcoinPubKey')
            ->maxLength('identityBitcoinPubKey', 255)
            ->requirePresence('identityBitcoinPubKey', 'create')
            ->notEmptyString('identityBitcoinPubKey');

        $validator
            ->scalar('identityBitcoinSig')
            ->maxLength('identityBitcoinSig', 255)
            ->requirePresence('identityBitcoinSig', 'create')
            ->notEmptyString('identityBitcoinSig');

        $validator
            ->scalar('slug')
            ->requirePresence('slug', 'create')
            ->notEmptyString('slug');

        $validator
            ->integer('version')
            ->allowEmptyString('version');

        $validator
            ->scalar('contractType')
            ->maxLength('contractType', 255)
            ->allowEmptyString('contractType');

        $validator
            ->scalar('format')
            ->maxLength('format', 255)
            ->allowEmptyString('format');

        $validator
            ->scalar('expiry')
            ->maxLength('expiry', 255)
            ->allowEmptyString('expiry');

        $validator
            ->scalar('acceptedCurrencies')
            ->allowEmptyString('acceptedCurrencies');

        $validator
            ->scalar('pricingCurrency')
            ->maxLength('pricingCurrency', 255)
            ->allowEmptyString('pricingCurrency');

        $validator
            ->scalar('language')
            ->maxLength('language', 255)
            ->allowEmptyString('language');

        $validator
            ->allowEmptyString('escrowTimeoutHours');

        $validator
            ->scalar('coinType')
            ->maxLength('coinType', 255)
            ->allowEmptyString('coinType');

        $validator
            ->allowEmptyString('coinDivisibility');

        $validator
            ->allowEmptyString('priceModifier');

        $validator
            ->scalar('title')
            ->allowEmptyString('title');

        $validator
            ->scalar('description')
            ->allowEmptyString('description');

        $validator
            ->allowEmptyString('price');

        $validator
            ->boolean('nsfw')
            ->allowEmptyString('nsfw');

        $validator
            ->scalar('tags')
            ->allowEmptyString('tags');

        $validator
            ->scalar('images')
            ->allowEmptyFile('images');

        $validator
            ->allowEmptyString('thumbnail');

        $validator
            ->scalar('categories')
            ->allowEmptyString('categories');

        $validator
            ->integer('grams')
            ->allowEmptyString('grams');

        $validator
            ->scalar('condition')
            ->maxLength('condition', 255)
            ->allowEmptyString('condition');

        $validator
            ->scalar('options')
            ->allowEmptyString('options');

        $validator
            ->scalar('skus')
            ->allowEmptyString('skus');

        $validator
            ->scalar('shippingOptions')
            ->allowEmptyString('shippingOptions');

        $validator
            ->scalar('coupons')
            ->allowEmptyString('coupons');

        $validator
            ->scalar('moderators')
            ->allowEmptyString('moderators');

        $validator
            ->scalar('termsAndConditions')
            ->allowEmptyString('termsAndConditions');

        $validator
            ->scalar('refundPolicy')
            ->allowEmptyString('refundPolicy');

        $validator
            ->scalar('signature')
            ->maxLength('signature', 255)
            ->allowEmptyString('signature');

        $validator
            ->numeric('averageRating')
            ->allowEmptyString('averageRating');

        $validator
            ->integer('ratingCount')
            ->allowEmptyString('ratingCount');

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
            ->scalar('vendorPeerId')
            ->maxLength('vendorPeerId', 255)
            ->allowEmptyString('vendorPeerId');

        $validator
            ->scalar('_search')
            ->allowEmptyString('_search');

        $validator
            ->numeric('fee')
            ->notEmptyString('fee');

        return $validator;
    }
}
