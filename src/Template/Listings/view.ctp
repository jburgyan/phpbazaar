<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Listing $listing
 */
?>
<div class="listings view columns content">
    <div class="product-image">
        <?php $this->Listing->printimages($listing->images, 'large'); ?>
    </div>
    <h3><?= $listing->title ?></h3>
    <div class="row">
        <h4><?= __('Price') ?></h4>
        <?php $this->Listing->price($listing->price, $listing->contractType); ?>
    </div>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Listing->html($listing->description); ?>
    </div>
    <div class="row">
        <h4><?= __('TermsAndConditions') ?></h4>
        <?= $this->Listing->html($listing->termsAndConditions); ?>
    </div>
    <div class="row">
        <h4><?= __('RefundPolicy') ?></h4>
        <?= $this->Listing->html($listing->refundPolicy); ?>
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
                <th scope="col"><?= __('Buyer') ?></th>
                <th scope="col"><?= __('Customer Service Score') ?></th>
                <th scope="col"><?= __('Delivery SpeedS core') ?></th>
                <th scope="col"><?= __('Description Score') ?></th>
                <th scope="col"><?= __('Overall Score') ?></th>
                <th scope="col"><?= __('Review') ?></th>
                <th scope="col"><?= __('Date') ?></th>
            </tr>
            <?php foreach ($listing->ratings as $ratings): ?>
            <tr>
                <td><?= $this->Html->link($ratings->buyerPeerID, ['controller' => 'Vendors', 'action' => 'view', $ratings->buyerPeerID]); ?></td>
                <td><?= h($ratings->customerServiceScore) ?></td>
                <td><?= h($ratings->deliverySpeedScore) ?></td>
                <td><?= h($ratings->descriptionScore) ?></td>
                <td><?= h($ratings->overallScore) ?></td>
                <td><?= $ratings->review ?></td>
                <td><?= h($ratings->updatedAt) ?></td>
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
	<div class="row">
		<h4><?= __('Buy this product') ?></h4>
		<?= $this->Listing->buylink($listing->slugPeerId); ?>
	</div>
</div>
