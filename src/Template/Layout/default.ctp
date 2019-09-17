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
use ScssPhp\ScssPhp\Compiler;

/**
 * @var \App\View\AppView $this
 */

$cakeTitle = 'OpenBazaar by BlockStamp';
$cakeDescription = 'The BlockStamp OpenBazaar Explorer is a viewer of products listed on the distributed OpenBazzaar platform. The search ranking on the Explorer can be influenced by burning BlockStamps (BST). BlockStamp is a cryptocurrency available on many exchanges.';
?><!doctype html>
<html amp lang="en">
<head>
	<?= $this->Html->charset() ?>
	<meta name="viewport" content="width=device-width,minimum-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Muli:400,700&display=swap" rel="stylesheet">
	<link rel="preload" as="script" href="https://cdn.ampproject.org/v0.js">
	<script async src="https://cdn.ampproject.org/v0.js"></script>
	<script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>
    <script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>
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
    if(!is_file(WWW_ROOT.'css/amp.css') || filemtime(WWW_ROOT.'css/amp.css') < filemtime(WWW_ROOT.'css/style.scss')) {
	    $minifier = new Minify\CSS();
	    $minifier->add(WWW_ROOT.'css/base.css');
	    if(Configure::read('debug')) {
		    $minifier->add(WWW_ROOT.'css/debug.css');
	    }
	    $scss = new Compiler();
	    $minifier->add($scss->compile(file_get_contents(WWW_ROOT.'css/style.scss')));
	    $regex = array(
		    "`^([\t\s]+)`ism"=>'',
		    "`^\/\*(.+?)\*\/`ism"=>"",
		    "`([\n\A;]+)\/\*(.+?)\*\/`ism"=>"$1",
		    "`([\n\A;\s]+)//(.+?)[\n\r]`ism"=>"$1\n",
		    "`(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+`ism"=>"\n"
	    );
	    file_put_contents(
	    	WWW_ROOT.'css/amp.css',
		    trim(preg_replace(array_keys($regex),$regex, $minifier->minify(WWW_ROOT.'css/amp.css')))
	    );
    }
    ?>
    <?= $this->fetch('meta') ?>
    <?php //echo $this->fetch('script') ?>
	<style amp-custom><?php echo file_get_contents(WWW_ROOT.'css/amp.css'); ?></style>
	<style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
	<link rel="canonical" href="<?php echo Router::url(null, true); ?>"/>
</head>
<body>
    <amp-analytics type="gtag" data-credentials="include">
        <script type="application/json">
            {
                "vars" : {
                    "gtag_id": "UA-145701962-1",
                    "config" : {
                        "UA-145701962-1": { "groups": "default" }
                    }
                }
            }
        </script>
    </amp-analytics>
    <nav class="top-bar expanded" data-topbar role="navigation">
	    <?php if($this->request->getParam('controller') == 'Vendors'){ ?>
			<form action="<?=$this->Url->build([ 'controller' => 'Vendors', 'action' => 'index' ])?>" method="get" target="_top">
	    <?php } else { ?>
			<form action="<?=$this->Url->build([ 'controller' => 'Listings', 'action' => 'index' ])?>" method="get" target="_top">
	    <?php } ?>
	        <div class="nav">
	            <div class="home">
		            <a href="<?php echo $this->Url->build(['controller' => 'Pages', 'action' => 'display', 'home']); ?>">
	                    <amp-img width="241" height="43" layout="responsive" src="<?= $this->Url->image('logo.svg?v=2') ?>" alt="Home"></amp-img>
	                </a>
	            </div>
	            <div class="search">
		            <input type="text" id="s" name="s" placeholder="<?= ($this->request->getParam('controller') == 'Vendors' ? __('Search Vendor...') : __('Search Product...')); ?>" value="<?= $this->request->getQuery('s') ?>">
		            <button type="submit"><?= __('Find'); ?></button>
	            </div>
	            <div class="links">
	                <span class="<?= ($this->request->getParam('controller') == 'Vendors' ? 'now' : '') ?>"><?= $this->Html->link(__('Vendors'), ['controller' => 'Vendors', 'action' => 'index']); ?></span>
	                <span class="<?= ($this->request->getParam('controller') == 'Listings' ? 'now' : '') ?>"><?= $this->Html->link(__('Products'), ['controller' => 'Listings', 'action' => 'index']); ?></span>
	            </div>
	        </div>
	    </form>
    </nav>
    <div class="clear"></div>
    <?= $this->Flash->render() ?>
    <div class="container clearfix">
        <?= $this->fetch('content') ?>
    </div>
    <footer>
    </footer>
    <amp-pixel src="https://www.facebook.com/tr?id=751147255305734&ev=PageView&noscript=1" layout="nodisplay"></amp-pixel>
</body>
</html>
