<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Listing[]|\Cake\Collection\CollectionInterface $listings
 * @var string $vendor_id
 */
?>
<div class="listings">
	<?php foreach ( $listings as $listing ): ?>
		<span class="listing">
		<div class="image">
			<a href="<?= $this->Url->build( [
				'controller' => 'Listings',
				'action'     => 'view',
				$listing->slugPeerId
			] ) ?>"><?php $this->Listing->printimages( $listing->thumbnail, 'medium' ); ?></a>
		</div>
		<?php if ( $listing->fee <= 0 ) { ?>
			<div class="fee">
			<a href="https://wallet.blockstamp.info/app#/messages?message=BAZAAR--<?= $listing->slugPeerId ?>" target="_blank"><i class="fas fa-angle-double-up" title="<?= __( 'promote' ) ?>"></i></a>
		</div>
		<?php } ?>
		<div class="title">
			<?= $this->Html->link( html_entity_decode( $listing->title ), [
				'controller' => 'Listings',
				'action'     => 'view',
				$listing->slugPeerId
			] ) ?>
		</div>
		<div class="price">
			<?php $this->Listing->price( $listing->price, $listing->contractType, $listing->coinDivisibility, $listing->pricingCurrency ); ?>
			<?php if ( $listing->moderators != '{}' ) { ?>
				<div class="moderated">
					moderated
				</div>
			<?php } else { ?>
				<div class="unmoderated">
					unmoderated
				</div>
			<?php } ?>
		</div>
		<?php if ( $listing->fee > 0 ) { ?>
			<div class="fee">
			<?= $this->Html->link( "fee: {$this->Number->format($listing->fee)}", "https://wallet.blockstamp.info/app#/messages?message=BAZAAR--{$listing->slugPeerId}" ) ?>
		</div>
		<?php } ?>
		<div class="vendor">
			<br>
			<?= $listing->has( 'vendor' ) ? $this->Html->link( html_entity_decode( $listing->vendor->name ), [
				'controller' => 'Vendors',
				'action'     => 'view',
				$listing->vendor->peerId
			] ) : '' ?>
		</div>
	</span>
	<?php endforeach; ?>
</div>
<div class="paginator">
	<ul class="pagination">
		<?= str_replace( 'onclick="return false;"', '', $this->Paginator->first( '<<' ) ) ?>
		<?= str_replace( 'onclick="return false;"', '', $this->Paginator->prev( '<' ) ) ?>
		<?= str_replace( 'onclick="return false;"', '', $this->Paginator->numbers() ) ?>
		<?= str_replace( 'onclick="return false;"', '', $this->Paginator->next( '>' ) ) ?>
		<?= str_replace( 'onclick="return false;"', '', $this->Paginator->last( '>>' ) ) ?>
	</ul>
	<p><?= $this->Paginator->counter( [ 'format' => __( 'Page {{page}} of {{pages}}, {{current}} record(s) out of {{count}}' ) ] ) ?></p>
</div>
