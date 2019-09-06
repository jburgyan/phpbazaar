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
	    <?= $this->Html->link(__('BUY'), "/pages/buy",['class'=>'buy']) ?>
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
        <?php $this->Listing->arrtovendors($listing->moderators); ?>
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
        <h4><?= __('Ratings[0-5]: C=Customer Service S=Delivery Speed D=Description O=Overall ') ?></h4>
        <?php if (!empty($listing->ratings)): ?>
        <table class="rating" cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Date') ?></th>
                <th scope="col"><?= __('C') ?></th>
                <th scope="col"><?= __('D') ?></th>
                <th scope="col"><?= __('D') ?></th>
                <th scope="col"><?= __('O') ?></th>
                <th scope="col"><?= __('Review') ?></th>
            </tr>
            <?php foreach ($listing->ratings as $ratings): ?>
            <tr>
                <td class="nowrap" ><?= h($ratings->updatedAt) ?></td>
                <td class="nowrap" ><?= h($ratings->customerServiceScore) ?></td>
                <td class="nowrap" ><?= h($ratings->deliverySpeedScore) ?></td>
                <td class="nowrap" ><?= h($ratings->descriptionScore) ?></td>
                <td class="nowrap" ><?= h($ratings->overallScore) ?></td>
                <td><?= $ratings->review ?>
                <?= $this->Html->link($ratings->buyerPeerID, ['controller' => 'Vendors', 'action' => 'view', $ratings->buyerPeerID]); ?></td>
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
		<h4><?= __('SlugPeerID (OpenBazaar link)') ?></h4>
		<?= $this->Listing->buylink($listing->slugPeerId); ?>
	</div>
</div>
