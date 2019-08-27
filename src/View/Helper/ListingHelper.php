<?php
/**
 * @var \App\View\AppView $this
 */

namespace App\View\Helper;

use Cake\View\Helper;

class ListingHelper extends Helper\HtmlHelper {
	public function price( array $pricejson, $contractType ) {
		$html = '';
		if ( $pricejson['amount'] || $contractType != 'CRYPTOCURRENCY' ) {
			$html .= $pricejson['amount'];
		}
		$html .= ' ' . $pricejson['currencyCode'];
		if ( $contractType == 'CRYPTOCURRENCY' ) {
			$html .= $pricejson['modifier'] . '%';
		}
		echo trim( $html );
	}

	public function arrtolinks( $categories, $what = 'c', $controller = 'Listings', $action = 'index', $id = null ) {
		$categories = trim( $categories, "{}" );
		$categories = explode( ",", $categories );
		if ( ! empty( $categories ) ) {
			$links = [];
			foreach ( $categories as $category ) {
				$category = trim( $category, '"' );
				$links[]  = $this->link(
					html_entity_decode( $category ),
					[
						'controller' => $controller,
						'action'     => $action,
						$what        => $category,
						$id
					]
				);
			}
			echo implode( ', ', $links );
		}
	}

	public function printimages($images, $size = 'large', $options = array()) {
		if(!is_array($images)) {
			$images = $this->pg_array_parse($images);
		}
		if(!empty($images) && !isset($images[0])) {
			$images = array($images);
		}
		foreach ($images as $image) {
			if(!empty($image[$size])) {
				$path = WWW_ROOT.DS.'img'.DS.$image['filename'].'_'.$size.'.png';
				if(!is_file($path)) {
					$imagedata = @file_get_contents("https://bazaar.blockstamp.market/api/returnSingleImage/".$image[$size]);
					if(!empty($imagedata)) {
						file_put_contents($path, $imagedata);
					}
				}
				if(is_file($path)) {
					echo $this->image($image['filename'].'_'.$size.'.png', $options);
				}
			}
		}
	}

	public function pg_array_parse( $literal ) {
		if ( $literal == '' ) {
			return;
		}
		preg_match_all( '/(?<=^\{|,)(([^,"{]*)|\s*"((?:[^"\\\\]|\\\\(?:.|[0-9]+|x[0-9a-f]+))*)"\s*)(,|(?<!^\{)(?=\}$))/i', $literal, $matches, PREG_SET_ORDER );
		$values = [];
		foreach ( $matches as $match ) {
			$value = $match[3] != '' ? stripcslashes( $match[3] ) : ( strtolower( $match[2] ) == 'null' ? null : $match[2] );
			$arrvalue = @json_decode($value, true);
			if(empty($arrvalue) && !empty($value)) {
				$values[] = $value;
			} else {
				$values[] = $arrvalue;
			}
		}

		return $values;
	}
}
