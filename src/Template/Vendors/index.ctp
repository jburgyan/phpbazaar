<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Vendor[]|\Cake\Collection\CollectionInterface $vendors
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Products'), ['controller' => 'Listings', 'action' => 'index']) ?></li>
    </ul>
</nav>
<div class="vendors index large-9 medium-8 columns content">
    <h3><?= __('Vendors') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('peerId') ?></th>
                <th scope="col"><?= $this->Paginator->sort('peerID') ?></th>
                <th scope="col"><?= $this->Paginator->sort('hash') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nsfw') ?></th>
                <th scope="col"><?= $this->Paginator->sort('vendor') ?></th>
                <th scope="col"><?= $this->Paginator->sort('contactInfo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('colors') ?></th>
                <th scope="col"><?= $this->Paginator->sort('avatarHashes') ?></th>
                <th scope="col"><?= $this->Paginator->sort('headerHashes') ?></th>
                <th scope="col"><?= $this->Paginator->sort('stats') ?></th>
                <th scope="col"><?= $this->Paginator->sort('bitcoinPubkey') ?></th>
                <th scope="col"><?= $this->Paginator->sort('currencies') ?></th>
                <th scope="col"><?= $this->Paginator->sort('vendorCurrencies') ?></th>
                <th scope="col"><?= $this->Paginator->sort('raw') ?></th>
                <th scope="col"><?= $this->Paginator->sort('misc') ?></th>
                <th scope="col"><?= $this->Paginator->sort('createdAt') ?></th>
                <th scope="col"><?= $this->Paginator->sort('updatedAt') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fee') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($vendors as $vendor): ?>
            <tr>
                <td><?= h($vendor->peerId) ?></td>
                <td><?= h($vendor->peerID) ?></td>
                <td><?= h($vendor->hash) ?></td>
                <td><?= h($vendor->name) ?></td>
                <td><?= h($vendor->nsfw) ?></td>
                <td><?= h($vendor->vendor) ?></td>
                <td><?= h($vendor->contactInfo) ?></td>
                <td><?= h($vendor->colors) ?></td>
                <td><?= h($vendor->avatarHashes) ?></td>
                <td><?= h($vendor->headerHashes) ?></td>
                <td><?= h($vendor->stats) ?></td>
                <td><?= h($vendor->bitcoinPubkey) ?></td>
                <td><?= h($vendor->currencies) ?></td>
                <td><?= h($vendor->vendorCurrencies) ?></td>
                <td><?= h($vendor->raw) ?></td>
                <td><?= h($vendor->misc) ?></td>
                <td><?= h($vendor->createdAt) ?></td>
                <td><?= h($vendor->updatedAt) ?></td>
                <td><?= $this->Number->format($vendor->fee) ?></td>
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
