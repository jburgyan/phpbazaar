<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Listing[]|\Cake\Collection\CollectionInterface $listings
 */
?>
<div class="listings index columns content">
    <!--h3><?= __('Products') ?></h3-->
    <?php
    echo $this->element('products', [
	    "listings" => $listings
    ]);
    ?>
</div>
