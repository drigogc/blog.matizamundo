<?php if ( ! defined('ABSPATH')) exit; ?>

<?php if ( $this->login_required && ! $this->logged_in ) return; ?>

<div data-role="panel" data-position-fixed="true" data-position="right" data-display="push" data-theme="b" id="main-menu">
    <ul data-role="listview">
        <li data-icon="delete" class="ui-nodisc-icon"><a href="#" data-rel="close">Close menu</a></li>
        <li data-icon="home" class="ui-nodisc-icon"><a href="<?php echo HOME_URI;?>/home/">Home</a></li>
        <li data-icon="grid" class="ui-nodisc-icon"><a href="<?php echo HOME_URI;?>/posts/">Posts</a></li>
    </ul>
</div><!-- /panel -->

<!-- HEADER -->
<div id="main-navbar" data-role="header" data-position="fixed" data-theme="m">
	<h1 id="nav-title" style="font-size: 1.250em; text-align: left; margin-left: 1.250em; text-shadow: none;">
		Matiza Mundo
	</h1>

	<a href="#main-menu" class="ui-btn-right"><i class="fa fa-bars fa-2x"></i></a>
	<!--<a href="<?php //echo HOME_URI;?>/home/" class="ui-btn-right"><i class="fa fa-home fa-2x"></i></a>
	<a href="<?php //echo HOME_URI;?>/posts/" class="ui-btn-right" style="margin-right: 3.5em;"><i class="fa fa-file-text fa-2x"></i></a>-->
</div><!-- /header -->