<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

/**
 * @var \App\View\AppView $this
 */

$cakeDescription = 'The BlockStamp OpenBazaar Explorer is a viewer of products listed on the distributed OpenBazzaar platform. The search ranking on the Explorer can be influenced by burning BlockStamps (BST). BlockStamp is a cryptocurrency available on many exchanges.';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('base.css') ?>
	<?= $this->Html->css('debug.css') ?>
    <?= $this->Html->css('style.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <nav class="top-bar expanded" data-topbar role="navigation">
	<span class="home">
		<?=$this->Html->link( __( 'Home' ),['controller'=>'Pages','action'=>'display','home']); ?>
	</span>
	<span class="search">
		<?php if($this->request->getParam('controller') == 'Vendors'){ ?>
			<form action="<?=$this->Url->build([ 'controller' => 'Vendors', 'action' => 'index' ])?>" method="get">
		<?php } else { ?>
			<form action="<?=$this->Url->build([ 'controller' => 'Listings', 'action' => 'index' ])?>" method="get">
		<?php } ?>
			<input type="text" id="s" name="s" placeholder="<?=($this->request->getParam('controller') == 'Vendors'?__('Search Vendors'):__('Search Products')); ?>" value="<?=$this->request->getQuery( 's' )?>">
			<button type="submit"><?=__('Go'); ?></button>
		</form>
        </span>
	<span class="links">
		<?=$this->Html->link( __( 'Products' ), [ 'controller' => 'Listings', 'action'     => 'index' ], ['class' => ($this->request->getParam('controller') == 'Listings'?'now':'')]); ?>
	</span>
	<span class="links">
		<?=$this->Html->link( __( 'Vendors' ), [ 'controller' => 'Vendors', 'action'     => 'index' ], ['class' => ($this->request->getParam('controller') == 'Vendors'?'now':'')]); ?>
	</span>
    </nav>
    <?= $this->Flash->render() ?>
    <div class="container clearfix">
        <?= $this->fetch('content') ?>
    </div>
    <footer>
    </footer>
</body>
</html>
