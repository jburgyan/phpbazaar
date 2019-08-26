<?php
/**
 * @var \App\View\AppView $this
 */
namespace App\View\Helper;

use Cake\View\Helper;

class ListingHelper extends Helper\HtmlHelper
{
	public function price(array $pricejson, $contractType)
	{
		$html =  $pricejson['amount'].' '.$pricejson['currencyCode'];
		if($contractType == 'CRYPTOCURRENCY') {
			$html .= $pricejson['modifier'].'%';
		}
		echo $html;
	}

	public function catortag($categories, $what = 'c') {
		$categories = trim($categories, "{}");
		$categories = explode(",", $categories);
		if(!empty($categories)) {
			$links = [];
			foreach ($categories as $category) {
				$category = trim($category, '"');
				$links[] = $this->link(
					$category,
					[
						'controller' => 'Listings',
						'action'     => 'index',
						$what => $category
					]
				);
			}
			echo implode(', ', $links);
		}
	}
}
