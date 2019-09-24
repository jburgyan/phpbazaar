<?php
$this->assign( 'title', 'Home' );
?>
<div class="row">
	<div class="columns large-12">
		<div class="aboutPageContainer">
			<h1>BlockStamp OpenBazaar Explorer</h1>
			<p>The BlockStamp OpenBazaar Explorer is a viewer of products listed on the distributed OpenBazaar marketplace.</p>
			<h3>Can I use this explorer in the OpenBazaar application?</h3>
			<p>You can add this explorer to your openbazaaar application using this URL:</p>
			<pre><a href="https://bazaar.blockstamp.market/api/search" target="_blank">https://bazaar.blockstamp.market/api/search</a></pre>
			<h3>What is OpenBazaar?</h3>
			<p>OpenBazaar is a new peer-to-peer decentralized e-commerce marketplace. It is the first marketplace of its kind. It is controlled by no one and people can transact in any cryptocurrency and with anyone. OpenBazaar has no fees and no restrictions. There isn’t an organization, company, or individual managing OpenBazaar so there’s nobody to pay. The system works by allowing individuals to connect to each other to buy and sell goods without a middleman. The terms and conditions of each individual listing is up to the vendor, they will vary from one person to the next. Learn more here.</p>
			<a id="buy"></a>
			<h3>How do I buy something through OpenBazaar?</h3>
			<p>Right now, you will have to download the OpenBazaar desktop application to buy goods on OpenBazaar.
				<a class="clickableLink" href="https://openbazaar.zendesk.com/hc/en-us/articles/202587109-How-do-I-install-and-use-OpenBazaar-" target="_blank">Check this guide out to get setup.</a>
			</p>
			<h3>How can I promote my products here?</h3>
			<p>The search ranking on the Explorer can be influenced by burning BlockStamps (BST). BlockStamp is a cryptocurrency available on many exchanges. There are two ways to promote the the products:</p>
			<ol>
				<li>
					Create a wallet at https://blockstamp.info and add funds to it. It can be done by buying BST at crypto exchange (like Digifinex, Stex, CoinTiger, or PicoStocks) and sending it to wallet or by using PayPal directly in the BlockStamp wallet.<br>
					Afterwards follow the steps in the article:<br>
					<a class="clickableLink" href="https://medium.com/blockstamp/selling-on-openbazaar-boost-your-products-search-rankings-1047e2f6d012" target="_blank">https://medium.com/blockstamp/selling-on-openbazaar-boost-your-products-search-rankings-1047e2f6d012</a>
				</li>
				OR
				<li>
					To promote a product create a file ("bazaar.txt") with the content starting with 'BAZAAR--' followed by the slugPeerId. Example:<br>
					BAZAAR--QmTF2NJ3p1WWj1SGQhGeMdyJ6D9TRcES4tV6i3bg5WUn5r-blockstamp<br>
					Install the blockstamp node (add "prune=550" in the config file "~.bst/bst.conf" to reduce the size of the stored database) and use the storedata command of the blockstamp client to burn BST:
					./bst-cli storedata bazaar.txt<br>
					To change the amount of burned BST (fee of the transaction) use the settxfee command before issuing the storedata command, example:<br>
					./bst-cli settxfee 0.1<br>
					The fee will be multiplied by the size of the file (in kilobytes, example) The Blockstamp OpenBazaar Explorer monitors the transactions and updates the promotion budget for the product. The promotion fee is respected on search queries for the period of 30 days.
				</li>
			</ol>
			<h3>I'm offended by a listing/want a listing taken down!</h3>
			<p>Due to the nature of OpenBazaar, listings cannot be taken down from the network. In order to hide a listing on this site you will have to reach out to the webmaster of this site and it will be their decision on whether or not to remove a listing.</p>
		</div>
	</div>
</div>

