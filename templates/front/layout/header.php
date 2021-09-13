<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> id="rsp-single-page">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top muscleboss-single-page" style="font-size: 12px;">
  <div class="container">
    <a class="navbar-brand" href="<?php echo site_url(); ?>">
        <img style="height: 32px" src="" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <?php if( !is_user_logged_in()): ?>
        <li class="nav-item">
          <a class="nav-link" href="">Crie sua conta</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="">Entre</a>
        </li>
        <?php endif; ?>
        <?php if( is_checkout() ): ?>
        <li class="nav-item">
          <a class="nav-link" href="">Loja</a>
        </li>
        <?php endif; ?>
        <li class="nav-item">
          <a class="nav-link" href=""></a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<main>