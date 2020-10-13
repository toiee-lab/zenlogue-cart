<?php
/**
 * Zenlogue カードのための簡単なプログラム
 *
 */

require 'function.php';
 
$request_uri = $_SERVER[ 'REQUEST_URI' ];

/* ---------------------------------------
 *  ルーthんぐ
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

	header( 'Location: https://toiee.jp/tools/zenlogue');
	exit;

}
