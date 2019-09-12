<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Listing[]|\Cake\Collection\CollectionInterface $listings
 * @var string $vendor_id
 */
?>
<div class="listings">
<?php foreach ($listings as $listing): ?>
	<span class="listing">
		<div class="image">
			<?php $this->Listing->printimages($listing->thumbnail, 'medium'); ?>
		</div>
		<div class="title">
			<?= $this->Html->link( html_entity_decode($listing->title), [ 'controller' => 'Listings', 'action'     => 'view', $listing->slugPeerId ]) ?>
		</div>
		<div class="price">
			<?php $this->Listing->price($listing->price, $listing->contractType, $listing->coinDivisibility, $listing->pricingCurrency); ?>
			<?php if($listing->moderators != '{}'){ ?>
				<div class="moderated">
					moderated
				</div>
			<?php } else { ?>
				<div class="unmoderated">
					unmoderated
				</div>
			<?php } ?>
		</div>
		<div class="fee">
			<?php if($listing->fee>0){ ?>
                <?= $this->Html->link("fee: {$this->Number->format($listing->fee)}", "https://wallet.blockstamp.info/app#/messages?message=BAZAAR--{$listing->slugPeerId}" ) ?>
            <?php } else { ?>
                <?= $this->Html->link("promote", "https://wallet.blockstamp.info/app#/messages?message=BAZAAR--{$listing->slugPeerId}" ) ?>
            <?php } ?>
		</div>
		<div class="vendor">
			<br>
			<?= $listing->has('vendor') ? $this->Html->link(html_entity_decode($listing->vendor->name), ['controller' => 'Vendors', 'action' => 'view', $listing->vendor->peerId]) : '' ?>
		</div>
	</span>
<?php endforeach; ?>
</div>

<div class="paginator">
	<ul class="pagination">
		<?= str_replace('onclick="return false;"', '', $this->Paginator->first('<<')) ?>
		<?= str_replace('onclick="return false;"', '', $this->Paginator->prev('<')) ?>
		<?= str_replace('onclick="return false;"', '', $this->Paginator->numbers()) ?>
		<?= str_replace('onclick="return false;"', '', $this->Paginator->next('>')) ?>
		<?= str_replace('onclick="return false;"', '', $this->Paginator->last('>>')) ?>
	</ul>
	<p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, {{current}} record(s) out of {{count}}')]) ?></p>
</div>
