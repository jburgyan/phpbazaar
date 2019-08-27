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
		$html = '';
		if($pricejson['amount'] || $contractType != 'CRYPTOCURRENCY') {
			$html .= $pricejson['amount'];
		}
		$html .=  ' '.$pricejson['currencyCode'];
		if($contractType == 'CRYPTOCURRENCY') {
			$html .= $pricejson['modifier'].'%';
		}
		echo trim($html);
	}

	public function arrtolinks($categories, $what = 'c', $controller = 'Listings', $action = 'index', $id = null) {
		$categories = trim($categories, "{}");
		$categories = explode(",", $categories);
		if(!empty($categories)) {
			$links = [];
			foreach ($categories as $category) {
				$category = trim($category, '"');
				$links[] = $this->link(
					html_entity_decode($category),
					[
						'controller' => $controller,
						'action'     => $action,
						$what => $category,
						$id
					]
				);
			}
			echo implode(', ', $links);
		}
	}
}
