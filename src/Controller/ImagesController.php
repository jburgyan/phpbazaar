<?php

namespace App\Controller;

use Cake\Routing\Router;

/**
 * Images Controller
 */
class ImagesController extends AppController {

	/**
	 * index method
	 *
	 * @param string $hash
	 * @param string $size
	 */
	public function index( $hash, $size ) {
		$this->viewBuilder()->disableAutoLayout();
		$filename = $hash . '_' . $size;
		$subdir   = 'img' . DS . 'ob' . DS . substr( $hash, - 2 );
		$obdir    = WWW_ROOT . $subdir;
		if ( ! is_dir( $obdir ) ) {
			mkdir( $obdir );
		}
		$path = $obdir . DS . $filename;
		if ( ! is_file( $path ) ) {
			$imagedata = @file_get_contents(
				"http://localhost:4002/ipfs/" . $hash . "?usecache=false"
			);
			if ( ! empty( $imagedata ) ) {
				file_put_contents( $path, $imagedata );
			}
		}
		if ( is_file( $path ) ) {
			$this->redirect( Router::url( DS . $subdir . DS . $filename, true ), 301 );
		} else {
			header( 'Content-Type: image/png' );
			die( hex2bin( '89504e470d0a1a0a0000000d494844520000000100000001010300000025db56ca00000003504c5445000000a77a3dda0000000174524e530040e6d8660000000a4944415408d76360000000020001e221bc330000000049454e44ae426082' ) );
		}
	}

}
