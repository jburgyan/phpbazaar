<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Vendor $vendor
 * @var \App\Model\Entity\Listing[]|\Cake\Collection\CollectionInterface $listings
 */

?>
<div class="vendors view columns content">
	<?php $this->Listing->printimages($vendor->headerHashes, 'large', array('class' => 'vendor-header')); ?>
    <h3><?= h($vendor->name) ?></h3>
    <div class="row">
        <h4><?= __('Location') ?></h4>
        <?= $this->Text->autoParagraph(h($vendor->location)); ?>
    </div>
    <div class="row">
        <h4><?= __('Short Description') ?></h4>
        <?= $this->Text->autoParagraph($vendor->shortDescription); ?>
    </div>
    <div class="row">
        <h4><?= __('About') ?></h4>
        <?= $this->Text->autoParagraph($vendor->about); ?>
    </div>
    <div class="row">
        <h4><?= __('Contact Info') ?></h4>
	<?php
	//$this->Listing->printimages($vendor->avatarHashes, 'small', array('class' => 'vendor-avatar'));
	$this->Listing->arrtolist($vendor->contactInfo);
        ?>
    </div>
    <div class="row">
        <h4><?= __('Statistics') ?></h4>
	<?php
	$stats = $this->Listing->arrtolist($vendor->stats, false);
	if(!empty($stats)) {
		?>
		<h5>Stats:</h5>
		<?php
		echo $stats;
	}
	?>
    </div>
    <div class="row">
        <h4><?= __('Total Promotion Fee') ?></h4>
        <?= $this->Number->format($vendor->fee) ?> BST
    </div>
    <div class="row">
        <h4><?= __('Updated At') ?></h4>
        <?= h($vendor->updatedAt) ?>
    </div>
    <div id="related" class="row">
        <h4><?= __('Products') ?></h4>
	    <?php
	    echo $this->element('products', [
		    "listings" => $listings,
		    "vendor_id" => $vendor->peerId
	    ]);
	    ?>
    </div>
</div>
