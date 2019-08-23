<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Vendor $vendor
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Vendors'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('List Listings'), ['controller' => 'Listings', 'action' => 'index']) ?> </li>
    </ul>
</nav>
<div class="vendors view large-9 medium-8 columns content">
    <h3><?= h($vendor->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('PeerId') ?></th>
            <td><?= h($vendor->peerId) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('PeerID') ?></th>
            <td><?= h($vendor->peerID) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Hash') ?></th>
            <td><?= h($vendor->hash) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($vendor->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ContactInfo') ?></th>
            <td><?php print_r($vendor->contactInfo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Colors') ?></th>
	        <td><?php print_r($vendor->colors) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('AvatarHashes') ?></th>
            <td><?= h($vendor->avatarHashes) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('HeaderHashes') ?></th>
            <td><?= h($vendor->headerHashes) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Stats') ?></th>
	        <td><?php print_r($vendor->stats) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('BitcoinPubkey') ?></th>
            <td><?= h($vendor->bitcoinPubkey) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Currencies') ?></th>
            <td><?= h($vendor->currencies) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('VendorCurrencies') ?></th>
            <td><?= h($vendor->vendorCurrencies) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Raw') ?></th>
            <td><?= h($vendor->raw) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Misc') ?></th>
            <td><?= h($vendor->misc) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fee') ?></th>
            <td><?= $this->Number->format($vendor->fee) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('CreatedAt') ?></th>
            <td><?= h($vendor->createdAt) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('UpdatedAt') ?></th>
            <td><?= h($vendor->updatedAt) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nsfw') ?></th>
            <td><?= $vendor->nsfw ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Vendor') ?></th>
            <td><?= $vendor->vendor ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Location') ?></h4>
        <?= $this->Text->autoParagraph(h($vendor->location)); ?>
    </div>
    <div class="row">
        <h4><?= __('About') ?></h4>
        <?= $this->Text->autoParagraph(h($vendor->about)); ?>
    </div>
    <div class="row">
        <h4><?= __('ShortDescription') ?></h4>
        <?= $this->Text->autoParagraph(h($vendor->shortDescription)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Listings') ?></h4>
        <?php if (!empty($vendor->listings)): ?>
	        <table cellpadding="0" cellspacing="0">
		        <thead>
		        <tr>
			        <th scope="col"><?= h('title') ?></th>
			        <th scope="col"><?= h('vendorPeerId') ?></th>
			        <th scope="col"><?= h('price') ?></th>
			        <th scope="col"><?= h('categories') ?></th>
			        <th scope="col"><?= h('tags') ?></th>
			        <th scope="col"><?= h('averageRating') ?></th>
			        <th scope="col"><?= h('updatedAt') ?></th>
		        </tr>
		        </thead>
		        <tbody>
		        <?php foreach ($vendor->listings as $listing): ?>
			        <tr>
				        <td><?= h($listing->title) ?></td>
				        <td><?= $listing->has('vendor') ? $this->Html->link($listing->vendor->name, ['controller' => 'Vendors', 'action' => 'view', $listing->vendor->peerId]) : '' ?></td>
				        <td><?= $listing->price['amount'].' '.$listing->price['currencyCode']; ?></td>
				        <td><?= h($listing->categories) ?></td>
				        <td><?= h($listing->tags) ?></td>
				        <td><?= $this->Number->format($listing->averageRating) ?></td>
				        <td><?= h($listing->updatedAt) ?></td>
			        </tr>
		        <?php endforeach; ?>
		        </tbody>
	        </table>
        <?php endif; ?>
    </div>
</div>
