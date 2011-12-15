<?
	require_once("includes/phpmyedit-conf.php");
	header('Content-Type: text/html; charset=UTF-8');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Mapa das r&aacute;dios comunit&aacute;rias - Gerenciamento</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="css/geral.css" rel="stylesheet" type="text/css">
<link href="css/phpmyedit.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div class="corpo">
	<h1>Mapa das r&aacute;dios comunit&aacute;rias</h1>
	<?php new phpMyEdit($opts); ?>
	</div>
</body>
</html>
