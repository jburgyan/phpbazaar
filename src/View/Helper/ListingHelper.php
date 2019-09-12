<?php
/**
 * @var \App\View\AppView $this
 */

namespace App\View\Helper;

use Cake\Routing\Router;
use Cake\View\Helper;
use Cake\Utility\Inflector;
use Cake\View\Helper\TextHelper;
use Cake\View\View;

/**
 * Class ListingHelper
 * @package App\View\Helper
 */
class ListingHelper extends Helper\HtmlHelper {

	private $Text;

	public function __construct( View $View, array $config = [] ) {
		parent::__construct( $View, $config );
		$this->Text = new TextHelper( $View, $config );
	}

	public function html( $html ) {
		$html = preg_replace( '#<script(.*?)>(.*?)</script>#is', '', $html );
		//$html = preg_replace('/(<img[^>]+>(?:<\/img>)?)/i', '$1</amp-img>', $html);
		//$html = str_replace('<img', '<amp-img layout="fixed" ', $html);

		return $this->Text->autoParagraph( $html );
	}

	/**
	 * @param array  $pricejson
	 * @param string $contractType
     * @param int $coinDivisibility
     * @param string $currency
	 */
	public function price( array $pricejson, $contractType, $coinDivisibility = 0, $currency = '' ) {
		$html = '';
		if ( $pricejson['amount'] || $contractType != 'CRYPTOCURRENCY' ) {
		    if($coinDivisibility && in_array($currency, array("BTC", "BCH", "ZEC", "LTC"))) {
                $price = $pricejson['amount'] / $coinDivisibility;
            } else {
                $price = $pricejson['amount'] / 100;
            }
		    $price = rtrim(rtrim(number_format($price, 8), '0'), '.');
		    $html .= $price;
		}
		$html .= ' ' . $pricejson['currencyCode'];
		if ( $contractType == 'CRYPTOCURRENCY' ) {
			$html .= $pricejson['modifier'] . '%';
		}
		echo trim( $html );
	}

	/**
	 * @param string     $categories
	 * @param string     $what
	 * @param string     $controller
	 * @param string     $action
	 * @param int|string $id
	 */
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

	public function arrtovendors( $vendors ) {
		$vendors = trim( $vendors, "{}" );
		$vendors = explode( ",", $vendors );
		if ( ! empty( $vendors ) ) {
			$links = [];
			foreach ( $vendors as $vendor ) {
				$vendor = trim( $vendor, '"' );
				$links[]  = $this->link(
					html_entity_decode( $vendor),
					[
						'controller' => 'Vendors',
						'action'     => 'view',
						$vendor
					]
				);
			}
			echo implode( ', ', $links );
		}
	}

	/**
	 * @param array | null $elements
	 * @param bool         $print
	 *
	 * @return string|void
	 */
	public function arrtolist( $elements, $print = true ) {
		$list = '';
		if ( empty( $elements ) ) {
			if ( $print ) {
				echo $list;

				return;
			} else {
				return $list;
			}
		}
		foreach ( $elements as $label => $element ) {
			$label = Inflector::humanize( preg_replace( '/(?<!\ )[A-Z]/', ' $0', $label ) );
			if ( is_array( $element ) && ! empty( $element ) ) {
				if ( is_numeric( $label ) ) {
					$list .= '<li>' . $this->arrtolist( $element, false ) . '</li>';
				} else {
					$list .= '<li><strong>' . $label . '</strong>: ' . $this->arrtolist( $element, false ) . '</li>';
				}
			} elseif ( ! empty( $element ) ) {
				if ( filter_var( $element, FILTER_VALIDATE_URL ) ) {
					if ( ! strstr( $element, 'http' ) ) {
						$element = 'http://' . $element;
					}
					$element = '<a href="' . $element . '" target="_blank">' . $element . '</a>';
				} elseif ( filter_var( $element, FILTER_VALIDATE_EMAIL ) ) {
					$element = '<a href="mailto:' . $element . '">' . $element . '</a>';
				} else {
					$element = ucwords( $element );
				}
				$list .= '<li><strong>' . $label . '</strong>: ' . $element . '</li>';
			}
		}
		if ( ! empty( $list ) ) {
			$list = '<ul>' . $list . '</ul>';
			if ( $print ) {
				echo $list;
			} else {
				return $list;
			}
		}

		return '';
	}

	private function getImageUrl( $hash, $size ) {
		$filename = $hash . '_' . $size;
		$subdir   = 'img' . DS . 'ob' . DS . substr( $hash, - 2 );
		$obdir    = WWW_ROOT . $subdir;
		if ( ! is_dir( $obdir ) ) {
			mkdir( $obdir );
		}
		$path = $obdir . DS . $filename;
		if ( is_file( $path ) ) {
			return Router::url( DS.$subdir . DS . $filename, true );
		} else {
			return Router::url( [
				'controller' => 'Images',
				'action'     => 'index',
				$hash,
				$size
			], true);
		}
	}

	/**
	 * @param array|string $images
	 * @param string       $size
	 */
	public function printimages( $images, $size = 'large' ) {
		if ( ! is_array( $images ) ) {
			$images = $this->pg_array_parse( $images );
		}
		if ( ! empty( $images ) && ! isset( $images[0] ) ) {
			$images = array( $images );
		}
		if ( ! empty( $images ) ) {
			$filtered_images = [];
			foreach ( $images as $image ) {
				if(!empty($image) && empty($image[ $size ])) {
					$image[ $size ] = array_shift($image);
				}
				if ( ! empty( $image[ $size ] ) ) {
					$filtered_images[] = $image;
				}
			}
			$images = $filtered_images;
			unset( $filtered_images );
			if ( $size == 'large' ) {
				?>
				<amp-image-lightbox id="lightbox1" layout="nodisplay"></amp-image-lightbox>
				<?php
			}
			if ( $size == 'large' && count( $images ) > 1 ) {
				?>
				<amp-carousel height="480" layout="fixed-height" type="slides" loop autoplay delay="5000" media="(min-width: 481px)">
					<?php
					foreach ( $images as $image ) {
						if ( ! empty( $image[ $size ] ) ) {
							?>
							<amp-img on="tap:lightbox1" role="button" tabindex="0" src="<?php echo $this->getImageUrl( $image[ $size ], $size ); ?>" height="480" layout="fixed-height" alt=""></amp-img>
							<?php
						}
					}
					?>
				</amp-carousel>
				<?php
			}
			if ( count( $images ) > 1 ) {
				?>
				<amp-carousel height="480" width="480" layout="responsive" type="slides" loop
				autoplay
				delay="5000"<?php if ( $size == 'large' ) { ?> media="(max-width: 480px)"<?php } ?>>
				<?php
			}
			foreach ( $images as $image ) {
				if ( ! empty( $image[ $size ] ) ) {
					if ( $size == 'large' ) {
						$filename = $image[ $size ] . '_' . $size;
						$subdir   = 'img' . DS . 'ob' . DS . substr( $image[ $size ], - 2 );
						$obdir    = WWW_ROOT . $subdir;
						if ( ! is_dir( $obdir ) ) {
							mkdir( $obdir );
						}
						$path = $obdir . DS . $filename;
						if ( ! is_file( $path ) ) {
                            $default_socket_timeout = ini_get('default_socket_timeout');
                            ini_set('default_socket_timeout', 1);
							$imagedata = @file_get_contents(
								"http://localhost:4002/ipfs/" . $image[ $size ] . "?usecache=false"
							);
                            ini_set('default_socket_timeout', $default_socket_timeout);
							if ( ! empty( $imagedata ) ) {
								file_put_contents( $path, $imagedata );
							}
						}
						$imageinfo = getimagesize( $path );
						if(count( $images ) < 2) {
							?>
							<div class="image-max-height" style="max-width:<?php echo( 480 / $imageinfo[1] * $imageinfo[0] ); ?>px">
							<?php
						}
						?>
						<amp-img<?php if ( $size == 'large' ) { ?> on="tap:lightbox1" role="button" tabindex="0"<?php } ?> src="<?php echo $this->getImageUrl( $image[ $size ], $size ); ?>" width="<?= $imageinfo[0] ?>" height="<?= $imageinfo[1] ?>" layout="responsive" alt=""></amp-img>
						<?php
						if(count( $images ) < 2) {
							?>
							</div>
							<?php
						}
					} else {
						?>
						<amp-img src="<?php echo $this->getImageUrl( $image[ $size ], $size ); ?>" layout="fill" alt=""></amp-img>
						<?php
					}
				}
			}
			if ( count( $images ) > 1 ) {
				?>
				</amp-carousel>
				<?php
			}

		}
	}

	/**
	 * @param string $literal
	 *
	 * @return array|null
	 */
	public function pg_array_parse( $literal ) {
		if ( $literal == '' ) {
			return null;
		}
		preg_match_all( '/(?<=^\{|,)(([^,"{]*)|\s*"((?:[^"\\\\]|\\\\(?:.|[0-9]+|x[0-9a-f]+))*)"\s*)(,|(?<!^\{)(?=\}$))/i', $literal, $matches, PREG_SET_ORDER );
		$values = [];
		foreach ( $matches as $match ) {
			$value    = $match[3] != '' ? stripcslashes( $match[3] ) : ( strtolower( $match[2] ) == 'null' ? null : $match[2] );
			$arrvalue = @json_decode( $value, true );
			if ( empty( $arrvalue ) && ! empty( $value ) ) {
				$values[] = $value;
			} else {
				$values[] = $arrvalue;
			}
		}

		return $values;
	}

	public function buylink( $slugPeerId ) {
		$oburl = explode( '-', $slugPeerId, 2 );
		$oburl = 'ob://' . $oburl[0] . '/store/' . $oburl[1];

		return $this->link( $slugPeerId, $oburl );
	}
}
