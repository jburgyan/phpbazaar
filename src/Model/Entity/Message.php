<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Message Entity
 *
 * @property int $id
 * @property string $peerid
 * @property string $listing_slugpeerid
 * @property string $email
 * @property string $message
 * @property string $ip
 * @property \Cake\I18n\FrozenTime $createdat
 */
class Message extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'peerid' => true,
        'listing_slugpeerid' => true,
        'email' => true,
        'message' => true,
        'ip' => true,
        'createdat' => true
    ];
}
