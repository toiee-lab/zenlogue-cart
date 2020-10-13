<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<title>ゼンローグ</title>
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
			margin: auto;
		}
	</style>
</head>
<body>
<div id="card-panel" class="fullheight">
<a href="<?php echo  $code; ?>"><img src="title.png" id="card-img"></a>
</div>
</body>
</html>
