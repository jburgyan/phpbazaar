<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Listing[]|\Cake\Collection\CollectionInterface $listings
 * @var string $vendor_id
 */
if(empty($vendor)) {
	$options = [];
} else {
	// $options = [ 'url'=> [ '#' => 'related' ] ];
	$options = [];
}
?>
<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
		<th scope="col"><?= $this->Paginator->sort('Listings.title', __('Product'), $options); ?></th>
		<?php if(empty($vendor)) { ?>
		<th scope="col"><?= $this->Paginator->sort('Listings.vendorPeerId', __('Vendor'), $options) ?></th>
		<?php } ?>
		<th scope="col"><?= $this->Paginator->sort('Listings.price', __('Price'), $options) ?></th>
		<th scope="col"><?= $this->Paginator->sort('Listings.categories', __('Categories'), $options) ?></th>
		<th scope="col"><?= $this->Paginator->sort('Listings.tags', __('Tags'), $options) ?></th>
		<th scope="col"><?= $this->Paginator->sort('Listings.averageRating', __('Rating'), $options) ?></th>
		<th scope="col"><?= $this->Paginator->sort('Listings.updatedAt', __('Updated'), $options) ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($listings as $listing): ?>
		<tr>
			<td><?= $this->Html->link(
					$listing->title,
					[
						'controller' => 'Listings',
						'action'     => 'view',
						$listing->slugPeerId
					]
				) ?></td>
			<?php
			if(empty($vendor)) {
				?>
				<td><?= $listing->has('vendor') ? $this->Html->link($listing->vendor->name, ['controller' => 'Vendors', 'action' => 'view', $listing->vendor->peerId]) : '' ?></td>
				<?php
			}
			?>
			<td><?php $this->Listing->price($listing->price, $listing->contractType, $listing->coinDivisibility); ?></td>
			<?php
			if(empty($vendor)) {
				?>
				<td><?php $this->Listing->arrtolinks($listing->categories); ?></td>
				<td><?php $this->Listing->arrtolinks($listing->tags, 't'); ?></td>
			<?php } else {
				?>
				<td><?php $this->Listing->arrtolinks($listing->categories, 'c','Vendors', 'view', $vendor_id); ?></td>
				<td><?php $this->Listing->arrtolinks($listing->tags, 't', 'Vendors', 'view', $vendor_id); ?></td>
				<?php
			}
			?>
			<td><?= $this->Number->format($listing->averageRating) ?></td>
			<td><?= h($listing->updatedAt) ?></td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>
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
