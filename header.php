<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
  <title>
    <?php bloginfo('name'); ?>
    <?php wp_title('|'); ?>
  </title>
</head>
<?php wp_head(); ?>

<body <?php body_class(); ?>>
<?php 
?>

  <?php

  $img_url = get_stylesheet_directory_uri() . '/img';
  $cart_count = WC()->cart->get_cart_contents_count();
  ?>

  <header class="header">
    <div class="container">
      <a href="<?php bloginfo('url'); ?>/" alt="logo" class="logo">
        <img src="<?= $img_url ?>/Logo.png" alt="">
      </a>
      <div class="busca">
          <form action="<?php bloginfo('url'); ?>/loja/" method="get">
            <input type="text" name="s" id="s" placeholder="Buscar" value="<?php the_search_query(); ?>">
            <input type="text" name="post_type" value="product" hidden>
            <input type="submit" value="Buscar" id="searchsubmit">
          </form>
        </div>
      <nav class="conta">
        <a href="<?php bloginfo('url'); ?>/minha-conta/" class="btn-conta">Minha conta</a>
        <a href="<?php bloginfo('url'); ?>/carrinho/" class="btn-carrinho">Carrinho
          <?php if ($cart_count > 0): ?>
            <span class="carrinho-count">
              <?= $cart_count ?>
            </span>
          <?php endif; ?>
        </a>

      </nav>
      <button class="menu-hamburguer" id="js-btn-menu-hamburguer"><img src="<?= $img_url ?>/icons/icon-hamburguer.svg" alt="menu-hamburguer"></button>
    </div>
  </header>

  <div class="menu-mobile">
    <div class="overlay js-overlay"></div>
    <aside>
      <div class="logo">
      <a href="<?php bloginfo('url'); ?>/"><img src="<?= $img_url ?>/Logo.png" alt=""></a>
      </div>
      <span class="nome-site"><?php bloginfo('name'); ?></span>
      <nav class="conta">
        <a href="<?php bloginfo('url'); ?>/minha-conta/" class="btn-conta">Minha conta</a>
        <a href="<?php bloginfo('url'); ?>/carrinho/" class="btn-carrinho">Carrinho
          <?php if ($cart_count > 0): ?>
            <span class="carrinho-count">
              <?= $cart_count ?>
            </span>
          <?php endif; ?>
        </a>

      </nav>
    </aside>
  </div>

  <?php wp_nav_menu([
    'menu' => 'categorias',
    'container' => 'nav',
    'container_class' => 'menu-categorias'
  ]) ?>