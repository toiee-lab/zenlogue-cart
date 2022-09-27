<?php
/**
 * Zenlogue カードのための簡単なプログラム
 *
 */
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

$request_uri = rtrim( $_SERVER[ 'REQUEST_URI' ], '/' );

/* ---------------------------------------
 *  メイン
 * ---------------------------------------
 */

/*
カードをめくる命令が来た場合
*/
if( preg_match('|/(\d{6})/renew/?$|', $request_uri, $matches ) ) {

	$code = $matches[1];	
	$ss_path = start_session( $code );
	
	$num = rand(1, CARD_NUM);
	echo json_encode( $num );
	
	file_put_contents($ss_path, $num );
} 
/*
カードの情報を得る命令が来た場合
*/
elseif( preg_match('|/(\d{6})/get/?$|', $request_uri, $matches ) ) {

	$code = $matches[1];
	$ss_path = start_session( $code );
	
	$num = file_get_contents( $ss_path );
	echo json_encode( $num );

}
/*
ゼンローグ開始
*/
elseif ( preg_match('|/(\d{6})/?$|', $request_uri, $matches) ) {

	$code = $matches[1];	
	$ss_path = start_session( $code );	
	
	require 'session.php';	
}
/*
トップページ
*/
 elseif ( preg_match('|^' . URL_DIR . '?$|', $request_uri) ) {

	cleaning();
	$code = get_code();
	require 'start.php';

}
/*
トップページへ転送
*/
else {

	header( 'Location: https://www.toiee.jp/tools/zenlogue');
	exit;

}
