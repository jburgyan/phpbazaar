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

use Cake\Routing\Router;
use Cake\Core\Configure;
use MatthiasMullie\Minify;

/**
 * @var \App\View\AppView $this
 */

$minifier = new Minify\CSS();

$cakeTitle = 'OpenBazaar by BlockStamp';
$cakeDescription = 'The BlockStamp OpenBazaar Explorer is a viewer of products listed on the distributed OpenBazzaar platform. The search ranking on the Explorer can be influenced by burning BlockStamps (BST). BlockStamp is a cryptocurrency available on many exchanges.';
?><!doctype html>
<html amp lang="en">
<head>
	<?= $this->Html->charset() ?>
	<meta name="viewport" content="width=device-width,minimum-scale=1">
	<link rel="preload" as="script" href="https://cdn.ampproject.org/v0.js">
	<script async src="https://cdn.ampproject.org/v0.js"></script>
	<script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>
	<?php
	if(in_array($this->request->getParam('controller'), array('Listings', 'Vendors'))) {
		?>
		<script async custom-element="amp-carousel" src="https://cdn.ampproject.org/v0/amp-carousel-0.1.js"></script>
		<script async custom-element="amp-image-lightbox" src="https://cdn.ampproject.org/v0/amp-image-lightbox-0.1.js"></script>
		<?php
	}
	?>
	<title><?= $cakeTitle ?> :: <?= $this->fetch('title') ?></title>
    <?= $this->Html->meta('icon') ?>
    <?php
    $minifier->add(WWW_ROOT.'css/base.css');
    if(Configure::read('debug')) {
	    $minifier->add(WWW_ROOT.'css/debug.css');
    }
    $minifier->add(WWW_ROOT.'css/style.css');
    ?>
    <?= $this->fetch('meta') ?>
    <?php //echo $this->fetch('script') ?>
	<style amp-custom><?php
		$regex = array(
			"`^([\t\s]+)`ism"=>'',
			"`^\/\*(.+?)\*\/`ism"=>"",
			"`([\n\A;]+)\/\*(.+?)\*\/`ism"=>"$1",
			"`([\n\A;\s]+)//(.+?)[\n\r]`ism"=>"$1\n",
			"`(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+`ism"=>"\n"
		);
		echo trim(preg_replace(array_keys($regex),$regex, $minifier->minify()));
	?></style>
	<style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
	<link rel="canonical" href="<?php echo Router::url(null, true); ?>">
</head>
<body>
    <nav class="top-bar expanded" data-topbar role="navigation">
    <table class="nav"><tr>
	<td class="home"><?=$this->Html->link( __( 'Home' ),['controller'=>'Pages','action'=>'display','home']); ?></td>
	<td class="search">
		<?php if($this->request->getParam('controller') == 'Vendors'){ ?>
			<form action="<?=$this->Url->build([ 'controller' => 'Vendors', 'action' => 'index' ])?>" method="get" target="_top">
		<?php } else { ?>
			<form action="<?=$this->Url->build([ 'controller' => 'Listings', 'action' => 'index' ])?>" method="get" target="_top">
		<?php } ?>
			<table class="search"><tr><td class="text">
			<input type="text" id="s" name="s" placeholder="<?=($this->request->getParam('controller') == 'Vendors'?__('Search Vendors'):__('Search Products')); ?>" value="<?=$this->request->getQuery( 's' )?>"></td><td>
			<button type="submit"><?=__('Find'); ?></button>
			</tr></table>
		</form>
        </td>
	<td class="links <?=($this->request->getParam('controller') == 'Listings'?'now':'') ?>"><?=$this->Html->link( __( 'Products' ), [ 'controller' => 'Listings', 'action'     => 'index' ]); ?></td>
	<td class="links <?=($this->request->getParam('controller') == 'Vendors'?'now':'') ?>"><?=$this->Html->link( __( 'Vendors' ), [ 'controller' => 'Vendors', 'action'     => 'index' ]); ?></td>
    </tr></table>
    </nav>
    <?= $this->Flash->render() ?>
    <div class="container clearfix">
        <?= $this->fetch('content') ?>
    </div>
    <footer>
    </footer>
</body>
</html>
