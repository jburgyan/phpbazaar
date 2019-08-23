<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Vendor Entity
 *
 * @property string $peerId
 * @property string|null $peerID
 * @property string|null $hash
 * @property string|null $name
 * @property string|null $location
 * @property string|null $about
 * @property string|null $shortDescription
 * @property bool|null $nsfw
 * @property bool|null $vendor
 * @property array|null $contactInfo
 * @property array|null $colors
 * @property array|null $avatarHashes
 * @property array|null $headerHashes
 * @property array|null $stats
 * @property string|null $bitcoinPubkey
 * @property string|null $currencies
 * @property string|null $vendorCurrencies
 * @property array|null $raw
 * @property array|null $misc
 * @property \Cake\I18n\FrozenTime $createdAt
 * @property \Cake\I18n\FrozenTime $updatedAt
 * @property float $fee
 */
class Vendor extends Entity
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
        'peerID' => true,
        'hash' => true,
        'name' => true,
        'location' => true,
        'about' => true,
        'shortDescription' => true,
        'nsfw' => true,
        'vendor' => true,
        'contactInfo' => true,
        'colors' => true,
        'avatarHashes' => true,
        'headerHashes' => true,
        'stats' => true,
        'bitcoinPubkey' => true,
        'currencies' => true,
        'vendorCurrencies' => true,
        'raw' => true,
        'misc' => true,
        'createdAt' => true,
        'updatedAt' => true,
        'fee' => true
    ];
}
