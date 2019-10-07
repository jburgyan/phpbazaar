<?php
/**
 * @var bool $error
 * @var string $message
 */
?>
<div class="vendors update columns content">
	<h1><?= __( 'Update store' ) ?></h1>
	<?php
	if(!empty($message) || !empty($error)) {
		if(empty($message)) {
			$message = __('We were unable to process your request. Please try again later');
		}
		?>
		<div class="update-response<?php if($error) { ?> error<?php } ?>"><?php echo $message; ?></div>
		<?php
	}
	?>
	<div class="row">
		<?php
		echo $this->Form->create( null, [
			'url'    => [ 'controller' => 'Vendors', 'action' => 'update' ],
			'method' => 'get',
			'target' => '_top'
		] );

		echo $this->Form->control( 'peerId', [
			'type'        => 'text',
			'placeholder' => __( 'Example: QmbjKjCPcRD27CmzaPb5qMw2v5fveWWUTKthk6hgJfCYiD' ),
			'label'       => __( "Enter your store's PeerID and we will update your store's listings" ),
			'required'    => true
		] );

		echo $this->Form->button( '<i class="fas fa-sync-alt"></i> ' . __( 'Update' ), [
			'type' => 'submit',
			'escape' => false,
			'class' => 'update-store-input'
		] );
		echo $this->Form->end();
		?>
	</div>
</div>
