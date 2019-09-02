<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Listing[]|\Cake\Collection\CollectionInterface $listings
 * @var string $vendor_id
 */
?>
<?php foreach ($listings as $listing): ?>
	<div class="listing">
		<div class="image">
			<?php $this->Listing->printimages($listing->thumbnail, 'small'); ?>
		</div>
		<div class="title">
			<?= $this->Html->link( $listing->title, [ 'controller' => 'Listings', 'action'     => 'view', $listing->slugPeerId ]) ?>
		</div>
		<div class="price">
			<?php $this->Listing->price($listing->price, $listing->contractType); ?>
		</div>
		<div class="vendor">
			<?= $listing->has('vendor') ? $this->Html->link($listing->vendor->name, ['controller' => 'Vendors', 'action' => 'view', $listing->vendor->peerId]) : '' ?>
		</div>
		<div class="fee">
			<?= $this->Number->format($listing->fee) ?>
		</div>
		<div class="moderators">
			<?php if($listing->moderators != '{}'){ ?>
				moderated
			<?php }else{ ?>
			<?php } ?>
		</div>
	</div>
<?php endforeach; ?>

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
