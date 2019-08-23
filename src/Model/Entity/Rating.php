<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Rating Entity
 *
 * @property string $ratingKey
 * @property string|null $buyerBitcoinSig
 * @property string|null $buyerPeerID
 * @property string|null $buyerBitcoinPubKey
 * @property string|null $buyerIdentityPubKey
 * @property string|null $buyerSig
 * @property int|null $customerServiceScore
 * @property int|null $deliverySpeedScore
 * @property int|null $descriptionScore
 * @property int|null $overallScore
 * @property string|null $review
 * @property array|null $timestamp
 * @property string|null $vendorBitcoinSig
 * @property string|null $vendorPeerID
 * @property string|null $vendorBitcoinPubKey
 * @property string|null $vendorIdentityKey
 * @property array|null $vendorSigMetadata
 * @property string|null $signature
 * @property array|null $raw
 * @property array|null $misc
 * @property \Cake\I18n\FrozenTime $createdAt
 * @property \Cake\I18n\FrozenTime $updatedAt
 * @property string|null $listingSlugPeerId
 */
class Rating extends Entity
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
        'buyerBitcoinSig' => true,
        'buyerPeerID' => true,
        'buyerBitcoinPubKey' => true,
        'buyerIdentityPubKey' => true,
        'buyerSig' => true,
        'customerServiceScore' => true,
        'deliverySpeedScore' => true,
        'descriptionScore' => true,
        'overallScore' => true,
        'review' => true,
        'timestamp' => true,
        'vendorBitcoinSig' => true,
        'vendorPeerID' => true,
        'vendorBitcoinPubKey' => true,
        'vendorIdentityKey' => true,
        'vendorSigMetadata' => true,
        'signature' => true,
        'raw' => true,
        'misc' => true,
        'createdAt' => true,
        'updatedAt' => true,
        'listingSlugPeerId' => true
    ];
}
