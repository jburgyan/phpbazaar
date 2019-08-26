<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Listing $listing
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Products'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('List Vendors'), ['controller' => 'Vendors', 'action' => 'index']) ?> </li>
    </ul>
</nav>
<div class="listings view large-9 medium-8 columns content">
    <h3><?= h($listing->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Hash') ?></th>
            <td><?= h($listing->hash) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Handle') ?></th>
            <td><?= h($listing->handle) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('IdentityPubKey') ?></th>
            <td><?= h($listing->identityPubKey) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('IdentityBitcoinPubKey') ?></th>
            <td><?= h($listing->identityBitcoinPubKey) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('IdentityBitcoinSig') ?></th>
            <td><?= h($listing->identityBitcoinSig) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ContractType') ?></th>
            <td><?= h($listing->contractType) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Format') ?></th>
            <td><?= h($listing->format) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Expiry') ?></th>
            <td><?= h($listing->expiry) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('AcceptedCurrencies') ?></th>
            <td><?= h($listing->acceptedCurrencies) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('PricingCurrency') ?></th>
            <td><?= h($listing->pricingCurrency) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Language') ?></th>
            <td><?= h($listing->language) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('CoinType') ?></th>
            <td><?= h($listing->coinType) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Price') ?></th>
            <td><?= h($listing->price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tags') ?></th>
            <td><?= h($listing->tags) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Images') ?></th>
            <td><?= h($listing->images) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Thumbnail') ?></th>
            <td><?= h($listing->thumbnail) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Categories') ?></th>
            <td><?= h($listing->categories) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Condition') ?></th>
            <td><?= h($listing->condition) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Options') ?></th>
            <td><?= h($listing->options) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Skus') ?></th>
            <td><?= h($listing->skus) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ShippingOptions') ?></th>
            <td><?= h($listing->shippingOptions) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Coupons') ?></th>
            <td><?= h($listing->coupons) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Moderators') ?></th>
            <td><?= h($listing->moderators) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Signature') ?></th>
            <td><?= h($listing->signature) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Raw') ?></th>
            <td><?= h($listing->raw) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Misc') ?></th>
            <td><?= h($listing->misc) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Vendor') ?></th>
            <td><?= $listing->has('vendor') ? $this->Html->link($listing->vendor->name, ['controller' => 'Vendors', 'action' => 'view', $listing->vendor->peerId]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __(' Search') ?></th>
            <td><?= h($listing->_search) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Version') ?></th>
            <td><?= $this->Number->format($listing->version) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('EscrowTimeoutHours') ?></th>
            <td><?= $this->Number->format($listing->escrowTimeoutHours) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('CoinDivisibility') ?></th>
            <td><?= $this->Number->format($listing->coinDivisibility) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('PriceModifier') ?></th>
            <td><?= $this->Number->format($listing->priceModifier) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Grams') ?></th>
            <td><?= $this->Number->format($listing->grams) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('AverageRating') ?></th>
            <td><?= $this->Number->format($listing->averageRating) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('RatingCount') ?></th>
            <td><?= $this->Number->format($listing->ratingCount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fee') ?></th>
            <td><?= $this->Number->format($listing->fee) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('CreatedAt') ?></th>
            <td><?= h($listing->createdAt) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('UpdatedAt') ?></th>
            <td><?= h($listing->updatedAt) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nsfw') ?></th>
            <td><?= $listing->nsfw ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('SlugPeerId') ?></h4>
        <?= $this->Text->autoParagraph(h($listing->slugPeerId)); ?>
    </div>
    <div class="row">
        <h4><?= __('Title') ?></h4>
        <?= $this->Text->autoParagraph(h($listing->title)); ?>
    </div>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph($listing->description); ?>
    </div>
    <div class="row">
        <h4><?= __('TermsAndConditions') ?></h4>
        <?= $this->Text->autoParagraph($listing->termsAndConditions); ?>
    </div>
    <div class="row">
        <h4><?= __('RefundPolicy') ?></h4>
        <?= $this->Text->autoParagraph($listing->refundPolicy); ?>
    </div>
    <div class="related">
        <h4><?= __('Ratings') ?></h4>
        <?php if (!empty($listing->ratings)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('RatingKey') ?></th>
                <th scope="col"><?= __('BuyerBitcoinSig') ?></th>
                <th scope="col"><?= __('BuyerPeerID') ?></th>
                <th scope="col"><?= __('BuyerBitcoinPubKey') ?></th>
                <th scope="col"><?= __('BuyerIdentityPubKey') ?></th>
                <th scope="col"><?= __('BuyerSig') ?></th>
                <th scope="col"><?= __('CustomerServiceScore') ?></th>
                <th scope="col"><?= __('DeliverySpeedScore') ?></th>
                <th scope="col"><?= __('DescriptionScore') ?></th>
                <th scope="col"><?= __('OverallScore') ?></th>
                <th scope="col"><?= __('Review') ?></th>
                <th scope="col"><?= __('Timestamp') ?></th>
                <th scope="col"><?= __('VendorBitcoinSig') ?></th>
                <th scope="col"><?= __('VendorPeerID') ?></th>
                <th scope="col"><?= __('VendorBitcoinPubKey') ?></th>
                <th scope="col"><?= __('VendorIdentityKey') ?></th>
                <th scope="col"><?= __('VendorSigMetadata') ?></th>
                <th scope="col"><?= __('Signature') ?></th>
                <th scope="col"><?= __('Raw') ?></th>
                <th scope="col"><?= __('Misc') ?></th>
                <th scope="col"><?= __('CreatedAt') ?></th>
                <th scope="col"><?= __('UpdatedAt') ?></th>
                <th scope="col"><?= __('ListingSlugPeerId') ?></th>
            </tr>
            <?php foreach ($listing->ratings as $ratings): ?>
            <tr>
                <td><?= h($ratings->ratingKey) ?></td>
                <td><?= h($ratings->buyerBitcoinSig) ?></td>
                <td><?= h($ratings->buyerPeerID) ?></td>
                <td><?= h($ratings->buyerBitcoinPubKey) ?></td>
                <td><?= h($ratings->buyerIdentityPubKey) ?></td>
                <td><?= h($ratings->buyerSig) ?></td>
                <td><?= h($ratings->customerServiceScore) ?></td>
                <td><?= h($ratings->deliverySpeedScore) ?></td>
                <td><?= h($ratings->descriptionScore) ?></td>
                <td><?= h($ratings->overallScore) ?></td>
                <td><?= h($ratings->review) ?></td>
                <td><?= h($ratings->timestamp) ?></td>
                <td><?= h($ratings->vendorBitcoinSig) ?></td>
                <td><?= h($ratings->vendorPeerID) ?></td>
                <td><?= h($ratings->vendorBitcoinPubKey) ?></td>
                <td><?= h($ratings->vendorIdentityKey) ?></td>
                <td><?= h($ratings->vendorSigMetadata) ?></td>
                <td><?= h($ratings->signature) ?></td>
                <td><?= h($ratings->raw) ?></td>
                <td><?= h($ratings->misc) ?></td>
                <td><?= h($ratings->createdAt) ?></td>
                <td><?= h($ratings->updatedAt) ?></td>
                <td><?= h($ratings->listingSlugPeerId) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
