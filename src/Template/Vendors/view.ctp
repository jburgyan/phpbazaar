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
	<?php $this->Listing->printimages($vendor->avatarHashes, 'small', array('class' => 'vendor-avatar')); ?>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('PeerId') ?></th>
            <td><?= h($vendor->peerId) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ContactInfo') ?></th>
            <td><?php print_r($vendor->contactInfo) ?></td>
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
            <td><?php $this->Listing->arrtolinks($vendor->currencies, 'cu', 'Vendors'); ?></td>
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
    </table>
    <div class="row">
        <h4><?= __('Location') ?></h4>
        <?= $this->Text->autoParagraph(h($vendor->location)); ?>
    </div>
    <div class="row">
        <h4><?= __('About') ?></h4>
        <?= $this->Text->autoParagraph($vendor->about); ?>
    </div>
    <div class="row">
        <h4><?= __('ShortDescription') ?></h4>
        <?= $this->Text->autoParagraph($vendor->shortDescription); ?>
    </div>
    <div id="related" class="related">
        <h4><?= __('Products') ?></h4>
	    <?php
	    echo $this->element('products', [
		    "listings" => $listings,
		    "vendor_id" => $vendor->peerId
	    ]);
	    ?>
    </div>
</div>
