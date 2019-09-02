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
			<?php $this->Listing->printimages($listing->thumbnail, 'small'); ?>
		</div>
		<div class="title">
			<?= $this->Html->link( $listing->title, [ 'controller' => 'Listings', 'action'     => 'view', $listing->slugPeerId ]) ?>
		</div>
		<div class="price">
			<?php $this->Listing->price($listing->price, $listing->contractType); ?>
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
				<?= $this->Html->link("fee: {$this->Number->format($listing->fee)}", "https://wallet.blockstamp.info/app#/messages?message={$listing->slugPeerId}" ) ?>
			<?php } else { ?>
				<?= $this->Html->link("promote", "https://wallet.blockstamp.info/app#/messages?message={$listing->slugPeerId}" ) ?>
			<?php } ?>
		</div>
		<div class="vendor">
			<br>
			<?= $listing->has('vendor') ? $this->Html->link($listing->vendor->name, ['controller' => 'Vendors', 'action' => 'view', $listing->vendor->peerId]) : '' ?>
		</div>
	</span>
<?php endforeach; ?>
<div class="listings">

<div class="paginator">
	<ul class="pagination">
		<?= $this->Paginator->first('<< ' . __('first')) ?>
		<?= $this->Paginator->prev('< ' . __('previous')) ?>
		<?= $this->Paginator->numbers() ?>
		<?= $this->Paginator->next(__('next') . ' >') ?>
		<?= $this->Paginator->last(__('last') . ' >>') ?>
	</ul>
	<p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
</div>
