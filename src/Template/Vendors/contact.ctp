<?php
/**
 * @var \App\View\AppView         $this
 * @var bool                      $error
 * @var string                    $message
 * @var array                     $recaptcha
 * @var \App\Model\Entity\Vendor  $vendor
 * @var \App\Model\Entity\Listing $listing
 */
?>
<div class="vendors contact columns content">
	<h1><?= __( 'Contact' ) ?> <?= $this->Html->link(
			$vendor->name, [
			'controller' => 'Vendors',
			'action'     => 'view',
			$vendor->peerId
		], [ 'escape' => false ] ) ?> about <?= $this->Html->link(
			$listing->title, [
			'controller' => 'Listings',
			'action'     => 'view',
			$listing->slugPeerId
		], [ 'escape' => false ] ) ?></h1>
	<?php
	if ( ! empty( $message ) || ! empty( $error ) ) {
		if ( empty( $message ) ) {
			$message = __( 'We were unable to process your request. Please try again later' );
		}
		?>
		<div class="contact-response<?php if ( $error ) { ?> error<?php } ?>"><?php echo $message; ?></div>
		<?php
	}
	?>
	<div class="row">
		<?php
		echo $this->Form->create( null, [
			'url'        => false,
			'method'     => 'post',
			'action-xhr' => $this->Url->build( [
				'controller' => 'Vendors',
				'action'     => 'contact',
				$vendor->peerID,
				$listing->slugPeerId
			] )
		] );
		?>
		<div submit-success>
			<template type="amp-mustache">
				<div class="contact-response {{error}}">
					{{message}}
				</div>
			</template>
		</div>
		<div submit-error>
			<template type="amp-mustache">
				<div class="contact-response error">
					<?= __( 'We were unable to process your request. Please try again later' ) ?>
				</div>
			</template>
		</div>
		<?php
		echo $this->Form->label( 'email', __( "Your email address" ) );
		echo $this->Form->email( 'email', [
			'id'       => 'email',
			'label'    => false,
			'required' => true
		] );
		echo $this->Form->label( 'message', __( "Message" ) );
		echo $this->Form->textarea( 'message', [
			'id'       => 'message',
			'label'    => false,
			'required' => true
		] );

		echo $this->Form->button( '<i class="far fa-paper-plane"></i> ' . __( 'Send' ), [
			'type'   => 'submit',
			'escape' => false,
			'class'  => 'contact-vendor-input'
		] );
		echo $this->Form->end();
		?>
	</div>
	<div class="row">
		<div class="columns large-12">
			<div class="aboutPageContainer">
				<h2>How do I buy something on BlockStamp OpenBazaar Explorer?</h2>
				<p>
					You can not buy products through this www Explorer. This is just a viewer of products listed on the distributed OpenBazzaar marketplace. You have to download the OpenBazaar desktop application to buy goods on OpenBazaar.
					<a class="clickableLink" href="https://openbazaar.zendesk.com/hc/en-us/articles/202587109-How-do-I-install-and-use-OpenBazaar-" target="_blank"> Check this guide out to get setup.</a>
				</p>
				<h3> What is OpenBazaar? </h3>
				<p>
					OpenBazaar is a new peer-to-peer decentralized e-commerce marketplace. It is the first marketplace of its kind. It is controlled by no one and people can transact in any cryptocurrency and with anyone. OpenBazaar has no fees and no restrictions.
					There isn’t an organization, company, or individual managing OpenBazaar so there’s nobody to pay. The system works by allowing individuals to connect to each other to buy and sell goods without a middleman. The terms and conditions of each individual listing is up to the vendor, they will vary from one person to the next.
					<a class="clickableLink" href="https://openbazaar.zendesk.com/hc/en-us/articles/208020193-What-is-OpenBazaar-" target="_blank"> Learn more here.</a>
				</p>
				<h3> Can I use this explorer in the OpenBazaar application? </h3>
				<p>
					You can add this explorer to your openbazaaar application using this URL:
				</p>
				<pre>https://bazaar.blockstamp.market/api/search</pre>
				<h3> How can I promote my products here? </h3>
				The search ranking on the Explorer can be influenced by burning BlockStamps (BST).
				<a class="clickableLink" href="https://blockstamp.info" target="_blank">BlockStamp</a> is a cryptocurrency available on many exchanges.
				</p>
				<p>
					To promote a product create a file ("bazaar.txt") with the content starting with
					'BAZAAR--' followed by the slugPeerId. Example:
				</p>
				<pre>BAZAAR--QmTF2NJ3p1WWj1SGQhGeMdyJ6D9TRcES4tV6i3bg5WUn5r-blockstamp</pre>
				<p>
					Install the blockstamp node (add "prune=550" in the config file "~.bst/bst.conf" to reduce the size of the stored database) and use the storedata command of the blockstamp client to burn BST:
				</p>
				<pre>./bst-cli storedata bazaar.txt</pre>
				<p>
					To change the amount of burned BST (fee of the transaction) use the settxfee command before issuing the storedata command, example:
				</p>
				<pre>./bst-cli settxfee 0.1</pre>
				<p>
					The fee will be multiplied by the size of the file (in kilobytes,
					<a class="clickableLink" href="https://explorer.blockstamp.info/tx/ee6381b05cd9a9f8df06a96d00b528df23621f8ae44bf321b9190ef18d12e426" target="_blank">example</a>)
					The Blockstamp OpenBazaar Explorer monitors the transactions and updates the promotion budget for the product. The promotion fee is respected on search queries for the period of 30 days.
				</p>
				<h3> I'm offended by a listing/want a listing taken down! </h3>
				<p>
					Due to the nature of OpenBazaar, listings cannot be taken down from the network. In order to hide a listing on this site you will have to reach out to the webmaster of this site and it will be their decision on whether or not to remove a listing.
				</p>
			</div>
		</div>
	</div>
</div>
