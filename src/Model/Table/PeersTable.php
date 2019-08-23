<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Peers Model
 *
 * @method \App\Model\Entity\Peer get($primaryKey, $options = [])
 * @method \App\Model\Entity\Peer newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Peer[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Peer|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Peer saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Peer patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Peer[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Peer findOrCreate($search, callable $callback = null, $options = [])
 */
class PeersTable extends Table
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

        $this->setTable('peers');
        $this->setDisplayField('peerid');
        $this->setPrimaryKey('peerid');
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
            ->scalar('peerid')
            ->maxLength('peerid', 255)
            ->allowEmptyString('peerid', null, 'create');

        $validator
            ->dateTime('updatedat')
            ->requirePresence('updatedat', 'create')
            ->notEmptyDateTime('updatedat');

        return $validator;
    }
}
