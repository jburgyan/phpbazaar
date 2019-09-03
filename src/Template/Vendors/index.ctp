<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Vendor[]|\Cake\Collection\CollectionInterface $vendors
 */
?>
<div class="vendors index columns content">
	<!--h3><?= __('Vendors') ?></h3-->

<?php foreach ($vendors as $vendor): ?>
	<span class="vendor">
		<div class="image">
			<?php $this->Listing->printimages($vendor->avatarHashes, 'small', array('class' => 'vendor-avatar')); ?>
		</div>
		<div class="title">
			<?= $this->Html->link($vendor->name, ['controller' => 'Vendors', 'action' => 'view', $vendor->peerId]) ?>
		</div>
		<div class="shortdescription">
		        <?= $this->Text->autoParagraph($vendor->shortDescription); ?>
		</div>
	</span>
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
</div>
