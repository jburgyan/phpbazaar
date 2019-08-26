<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Listing[]|\Cake\Collection\CollectionInterface $listings
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Vendors'), ['controller' => 'Vendors', 'action' => 'index']) ?></li>
    </ul>
</nav>
<div class="listings index large-9 medium-8 columns content">
    <h3><?= __('Products') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
	            <th scope="col"><?= $this->Paginator->sort('vendorPeerId') ?></th>
                <th scope="col"><?= $this->Paginator->sort('price') ?></th>
                <th scope="col"><?= $this->Paginator->sort('categories') ?></th>
                <th scope="col"><?= $this->Paginator->sort('tags') ?></th>
                <th scope="col"><?= $this->Paginator->sort('averageRating') ?></th>
                <th scope="col"><?= $this->Paginator->sort('updatedAt') ?></th>
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
</div>
