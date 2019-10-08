<?php
/**
 * @var \App\View\AppView $this
 * @var bool $error
 * @var string $message
 * @var array $recaptcha
 * @var \App\Model\Entity\Vendor $vendor
 * @var \App\Model\Entity\Listing $listing
 */
?>
<div class="vendors contact columns content">
	<h1><?= __( 'Contact' ) ?> <?php echo $vendor->name; ?> about <?php echo $listing->title; ?></h1>
	<?php
	if(!empty($message) || !empty($error)) {
		if(empty($message)) {
			$message = __('We were unable to process your request. Please try again later');
		}
		?>
		<div class="contact-response<?php if($error) { ?> error<?php } ?>"><?php echo $message; ?></div>
		<?php
	}
	?>
	<div class="row">
		<?php
		echo $this->Form->create( null, [
			'url'    => false,
			'method' => 'post',
			'action-xhr' => $this->Url->build([ 'controller' => 'Vendors', 'action' => 'contact', $vendor->peerID, $listing->slugPeerId ])
		]);
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
				<?=__('We were unable to process your request. Please try again later')?>
				</div>
			</template>
		</div>
		<?php
		echo $this->Form->label('email', __( "Your email address" ));
		echo $this->Form->email( 'email', [
			'id' => 'email',
			'label'       => false,
			'required'    => true
		] );
		echo $this->Form->label('message', __( "Message" ));
		echo $this->Form->textarea( 'message', [
			'id' => 'message',
			'label'       => false,
			'required'    => true
		] );

		echo $this->Form->button( '<i class="far fa-paper-plane"></i> ' . __( 'Send' ), [
			'type' => 'submit',
			'escape' => false,
			'class' => 'contact-vendor-input'
		] );
		echo $this->Form->end();
		?>
	</div>
</div>
