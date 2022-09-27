<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<title>ゼンローグ - セッション</title>
	<link rel="shortcut icon" href="icon.png">
	<link rel="apple-touch-icon" href="iphone-icon.png">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
	<meta name="viewport" content="target-densitydpi=device-dpi, width=device-width, maximum-scale=1.0, user-scalable=no minimal-ui">
	
	

	<style>
		html {
			height: 100%;
		}
		
		body {
			height: 100%;
			margin: 0;
		}
		
		.fullheight {
			height: 100%;
			width: 100%;
			background: #bbddff;
			display:table-cell;
			text-align:center;
			vertical-align:middle;
		}
		
		#card-img{
			max-height: 100%;
			max-width: 100%;
			position: absolute;
			top: 0;
			left: 0;
			right: 0;
			bottom: 0;
			margin:auto;
			cursor: pointer;
		}
	</style>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.js"></script>
</head>
<body>
<div id="card-panel" class="fullheight">
<img src="<?php echo URL_DIR;?>/imgs/0.png" id="card-img">
</div>
<script>
function change_card( num ) {
	$( "#card-img" ).fadeOut(
		500,
		function(){
			$( '#card-img' ).attr('src', '<?php echo rtrim( URL_DIR, '/' );?>' + '/imgs/' + num + '.png');
		}
	);
	$( "#card-img" ).fadeIn(500);
}
function removeTrailingSlash(url) {
  return url.replace(/\/$/, '')
}

/* 実行 */
var img_number = 0;
$(function() {
	setInterval( function(){
		$.getJSON(
			removeTrailingSlash( location.href ) +'/get',
			function(data){			
				if( img_number != data ) {
					change_card( data );
					img_number = data;
				}
			}
		);
	}, 1000);
});
$("#card-panel").click(function(){
 	$.getJSON(
		removeTrailingSlash( location.href ) + '/renew',
		function(data){			
			if( img_number != data ) {
				change_card( data );
				img_number = data;
			}
		}
	);
});


</script>
</body>
</html>
