<?php
/**
 * @var \App\View\AppView $this
 */

namespace App\View\Helper;

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
	 */
	public function price( array $pricejson, $contractType ) {
		$html = '';
		if ( $pricejson['amount'] || $contractType != 'CRYPTOCURRENCY' ) {
			$html .= $pricejson['amount'] / 100;
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

	/**
	 * @param array|string $images
	 * @param string       $size
	 * @param array        $options
	 */
	public function printimages( $images, $size = 'large', $options = array() ) {
		if ( ! is_array( $images ) ) {
			$images = $this->pg_array_parse( $images );
		}
		if ( ! empty( $images ) && ! isset( $images[0] ) ) {
			$images = array( $images );
		}
		if ( ! empty( $images ) ) {
			$filtered_images = [];
			foreach ( $images as $image ) {
				if ( ! empty( $image[ $size ] ) ) {
					$filtered_images[] = $image;
				}
			}
			$images = $filtered_images;
			unset( $filtered_images );
			if ( $size == 'large' && count( $images ) > 1 ) {
				?>
				<amp-carousel height="480" layout="fixed-height" type="slides" loop autoplay delay="5000" media="(min-width: 481px)">
					<?php
					foreach ( $images as $image ) {
						if ( ! empty( $image[ $size ] ) ) {
							$filename = $image[ $size ] . '_' . $size;
							$obdir    = $path = WWW_ROOT . 'img' . DS . 'ob';
							if ( ! is_dir( $obdir ) ) {
								mkdir( $obdir );
							}
							$path = $obdir . DS . $filename;
							if ( ! is_file( $path ) ) {
								$imagedata = @file_get_contents( "http://localhost:4002/ipfs/" . $image[ $size ] . "?usecache=false" );
								if ( ! empty( $imagedata ) ) {
									file_put_contents( $path, $imagedata );
								}
							}
							if ( is_file( $path ) ) {
								?>
								<amp-img src="<?php echo $this->Url->image( 'ob/' . $filename, $options ); ?>" height="480" layout="fixed-height" alt=""></amp-img>
								<?php
							}
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
				delay="5000"<?php if ( $size == 'large' ) { ?>media="(max-width: 480px)"<?php } ?>>
				<?php
			}
			foreach ( $images as $image ) {
				if ( ! empty( $image[ $size ] ) ) {
					$filename = $image[ $size ] . '_' . $size;
					$obdir    = $path = WWW_ROOT . 'img' . DS . 'ob';
					if ( ! is_dir( $obdir ) ) {
						mkdir( $obdir );
					}
					$path = $obdir . DS . $filename;
					if ( ! is_file( $path ) ) {
						$imagedata = @file_get_contents( "http://localhost:4002/ipfs/" . $image[ $size ] . "?usecache=false" );
						if ( ! empty( $imagedata ) ) {
							file_put_contents( $path, $imagedata );
						}
					}
					if ( is_file( $path ) ) {
						$imageinfo = getimagesize( $path );
						if($size == 'large' && count( $images ) < 2) {
							?>
							<div class="image-max-height" style="max-width:<?php echo (480/$imageinfo[1]*$imageinfo[0]); ?>px">
							<?php
						}
						?>
						<amp-img src="<?php echo $this->Url->image( 'ob/' . $filename, $options ); ?>" width="<?= $imageinfo[0] ?>" height="<?= $imageinfo[1] ?>" layout="responsive" alt=""></amp-img>
						<?php
						if($size == 'large' && count( $images ) < 2) {
							?>
							</div>
							<?php
						}
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
}
