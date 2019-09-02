<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Listing $listing
 */
?>
<div class="listings view columns content">
    <h3><?= $listing->title ?></h3>
    <div class="row">
        <h4><?= __('Price') ?></h4>
        <?php $this->Listing->price($listing->price, $listing->contractType); ?>
    </div>
    <div class="row">
        <h4><?= __('Images') ?></h4>
        <?php $this->Listing->printimages($listing->images, 'large'); ?>
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
    <div class="row">
        <h4><?= __('Moderators') ?></h4>
        <?php $this->Listing->arrtolinks($listing->moderators); ?>
    </div>
    <div class="row">
        <h4><?= __('Tags') ?></h4>
        <?php $this->Listing->arrtolinks($listing->tags, 't'); ?>
    </div>
    <div class="row">
        <h4><?= __('Categories') ?></h4>
        <?php $this->Listing->arrtolinks($listing->categories); ?>
    </div>
    <div class="row">
        <h4><?= __('Vendor') ?></h4>
        <?= $listing->has('vendor') ? $this->Html->link($listing->vendor->name, ['controller' => 'Vendors', 'action' => 'view', $listing->vendor->peerId]) : '' ?>
    </div>
    <div class="row">
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
    <div class="row">
        <h4><?= __('Promotion Fee') ?></h4>
        <?= $this->Number->format($listing->fee) ?>
    </div>
    <div class="row">
        <h4><?= __('Updated At') ?></h4>
        <?= h($listing->updatedAt) ?>
    </div>
</div>
