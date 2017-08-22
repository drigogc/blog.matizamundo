<?php if ( ! defined('ABSPATH')) exit; ?>

<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" lang="pt-BR">
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" lang="pt-BR">
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html lang="pt-BR">
<!--<![endif]-->

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="Solução online">
    <meta name="keywords" content="HTML,CSS,JavaScript,Jquery">
    <meta name="author" content="Rodrigo Carvalho">

	<!-- CSS -->
	<link rel="stylesheet" href="<?php echo HOME_URI;?>/views/_css/jquery.mobile-1.4.5.min.css">
	<link rel="stylesheet" href="<?php echo HOME_URI;?>/views/_css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo HOME_URI;?>/views/_css/style.min.css">

	<!-- JAVASCRIPT - JQUERY -->
	<script src="<?php echo HOME_URI;?>/views/_js/jquery-1.11.3.min.js" defer></script>
	<script src="<?php echo HOME_URI;?>/views/_js/jquery.mobile-1.4.5.min.js" defer></script>
	<script src="<?php echo HOME_URI;?>/views/_js/main.js" defer></script>

	<!--[if lt IE 9]>
	<script src="<?php echo HOME_URI;?>/views/_js/scripts.js"></script>
	<![endif]-->

	<title><?php echo $this->title; ?></title>
</head>

<body>
<div data-role="page">