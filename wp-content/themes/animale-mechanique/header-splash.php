<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php wp_title(); ?> <?php bloginfo( 'name' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />

<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<script type="text/javascript">
var templateDir = "<?php bloginfo('template_directory') ?>";
</script>

<?php wp_head(); ?>
<!-- Google Fonts! -->
<!--<link href='http://fonts.googleapis.com/css?family=Playfair+Display' rel='stylesheet' type='text/css'>-->
<link href='http://fonts.googleapis.com/css?family=Quattrocento' rel='stylesheet' type='text/css'>
</head>

<body <?php body_class('custom'); ?>>
	<div id="wrapper" class="container row">
	<div class="ponies">
		<div class="pony left">
		</div>
		<div class="pony right">
		</div>
	</div>
	<div id="header" class="row">
		
		<h1 class="logo"><?php bloginfo('name'); ?></h1>
	</div><!-- end header -->
	<div class="wrap-header row" ></div>
	<div id="content-wrapper" class="row">
	<div class="content-padding ten columns centered">
	