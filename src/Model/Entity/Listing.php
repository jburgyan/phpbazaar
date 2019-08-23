<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Listing Entity
 *
 * @property string $slugPeerId
 * @property string $hash
 * @property string $handle
 * @property string $identityPubKey
 * @property string $identityBitcoinPubKey
 * @property string $identityBitcoinSig
 * @property string $slug
 * @property int|null $version
 * @property string|null $contractType
 * @property string|null $format
 * @property string|null $expiry
 * @property string|null $acceptedCurrencies
 * @property string|null $pricingCurrency
 * @property string|null $language
 * @property int|null $escrowTimeoutHours
 * @property string|null $coinType
 * @property int|null $coinDivisibility
 * @property int|null $priceModifier
 * @property string|null $title
 * @property string|null $description
 * @property array|null $price
 * @property bool|null $nsfw
 * @property string|null $tags
 * @property string|null $images
 * @property array|null $thumbnail
 * @property string|null $categories
 * @property int|null $grams
 * @property string|null $condition
 * @property string|null $options
 * @property string|null $skus
 * @property string|null $shippingOptions
 * @property string|null $coupons
 * @property string|null $moderators
 * @property string|null $termsAndConditions
 * @property string|null $refundPolicy
 * @property string|null $signature
 * @property float|null $averageRating
 * @property int|null $ratingCount
 * @property array|null $raw
 * @property array|null $misc
 * @property \Cake\I18n\FrozenTime $createdAt
 * @property \Cake\I18n\FrozenTime $updatedAt
 * @property string|null $vendorPeerId
 * @property string|null $_search
 * @property float $fee
 */
class Listing extends Entity
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
        'hash' => true,
        'handle' => true,
        'identityPubKey' => true,
        'identityBitcoinPubKey' => true,
        'identityBitcoinSig' => true,
        'slug' => true,
        'version' => true,
        'contractType' => true,
        'format' => true,
        'expiry' => true,
        'acceptedCurrencies' => true,
        'pricingCurrency' => true,
        'language' => true,
        'escrowTimeoutHours' => true,
        'coinType' => true,
        'coinDivisibility' => true,
        'priceModifier' => true,
        'title' => true,
        'description' => true,
        'price' => true,
        'nsfw' => true,
        'tags' => true,
        'images' => true,
        'thumbnail' => true,
        'categories' => true,
        'grams' => true,
        'condition' => true,
        'options' => true,
        'skus' => true,
        'shippingOptions' => true,
        'coupons' => true,
        'moderators' => true,
        'termsAndConditions' => true,
        'refundPolicy' => true,
        'signature' => true,
        'averageRating' => true,
        'ratingCount' => true,
        'raw' => true,
        'misc' => true,
        'createdAt' => true,
        'updatedAt' => true,
        'vendorPeerId' => true,
        '_search' => true,
        'fee' => true
    ];
}
