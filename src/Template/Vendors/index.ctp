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
			<?php $this->Listing->printimages($vendor->avatarHashes, 'medium', array('class' => 'vendor-avatar')); ?>
		</div>
		<div class="title">
			<?= $this->Html->link($vendor->name, ['controller' => 'Vendors', 'action' => 'view', $vendor->peerId]) ?>
		</div>
		<div class="shortdescription">
		        <?= $this->Listing->html($vendor->shortDescription); ?>
		</div>
	</span>
<?php endforeach; ?>
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
</div>
