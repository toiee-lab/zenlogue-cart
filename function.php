<?php

define( 'URL_DIR', '/tools/zenlogue/' );
define( 'TMP_DIR' , 'tmp/' );
define( 'CARD_NUM', 16 );

/*
 * ランダムなコードを指定桁数作成して返す
 */
function get_code( $length = 6 ) {
	$code = '';
	for($i=0; $i<$length; $i++ ) {
		$code .= rand(0, 9);
	}
	
	return $code;
}

/*
 * 1日1回クリーニングを実施する。30日以上たったファイルを削除する
 */
function cleaning() {
	$cpath = TMP_DIR . 'cleaning.txt';
	if ( ! file_exists( $cpath ) ){
		touch( $cpath );
	} 
	
	if ( filemtime( $cpath ) < time() - 60*60*24  ) {
		$list = glob( 'tmp/zenlogue_*' );
		foreach( $list as $f ) {
			if ( filemtime( $f ) < time() - 60*60*24*30 ) {
				unlink( $f );
			}
		}
		
		touch( $cpath );
	}
}

function start_session( $code ) {
	$file = 'zenlogue_' . sha1( $code );
	$path = TMP_DIR .  $file;
	
	if( ! file_exists( $path ) ) {
		file_put_contents( $path, rand(1, CARD_NUM) );
	}
	
	return $path;
}
