<?php
//Prevent direct file call
defined( 'ABSPATH' ) || exit;
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<link rel='stylesheet' id='bootstrap'  href='<?php echo \INFIXS_RSP_ASSETS_URL . 'bootstrap/css/bootstrap.min.css';?>' media='all' />
<link rel='stylesheet' id='bootstrap'  href='<?php echo \INFIXS_RSP_ASSETS_URL . 'css/public/subscription.css';?>' media='all' />
<script type='text/javascript' src='<?php echo \INFIXS_RSP_ASSETS_URL . 'bootstrap/js/bootstrap.min.js';?>' id='bootstrap-js'></script>
<script type='text/javascript' src='<?php echo \INFIXS_RSP_ASSETS_URL . 'js/public/jquery-3.6.0.min.js';?>' id='jquery-js'></script>
<script type='text/javascript' src='<?php echo \INFIXS_RSP_ASSETS_URL . 'js/public/jquery.mask.js';?>' id='jquery-mask-js'></script>
<script type='text/javascript' src='<?php echo \INFIXS_RSP_ASSETS_URL . 'js/public/jquery.inputmask.js';?>' id='jquery-input-mask-js'></script>
<script type='text/javascript' src='<?php echo \INFIXS_RSP_ASSETS_URL . 'js/public/subscription.js';?>' id='subscription-js'></script>
<?php if( is_admin_bar_showing() ): ?>
<style>
  html{
    margin-top: 32px !important;
  }
</style>
<?php endif; ?>
</head>
<body class="" <?php echo is_admin_bar_showing()? 'style="min-height: calc(100vh - 32px);"' : ''; ?> id="rsp-custom-page">
<nav class="navbar navbar-expand-lg static-top" style="font-size: 12px;">
  <div class="container">
    <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
        <img style="height: 32px" src="<?php echo \INFIXS_RSP_PLUGIN_URL;?>assets/img/logo.png" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav">
                <li class="nav-item">
          <a class="nav-link" href="#">Crie sua conta</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Entre</a>
        </li>
                        <li class="nav-item">
          <a class="nav-link" href="#">Contato</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<main>