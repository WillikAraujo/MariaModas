<?php 
/*
Template name: Home
*/
get_header(); ?>

<?php 

$products_slide = wc_get_products([
  'limit' => 6,
  'tag' => ['slide']
]);


$products_new = wc_get_products([
  'limit' => 9,
  'orderby' => 'date',
  'order' => 'DESC'
]);

$products_sales = wc_get_products([
  'limit' => 9,
  'meta_key' => 'total_sales',
  'orderby' => 'meta_value_num',
  'order' => 'DESC'
]);


$data = [];

$data['slide'] = format_products($products_slide, 'slide');
$data['lacamentos'] = format_products($products_new, 'medium');
$data['vendidos'] = format_products($products_sales, 'medium');

$home_id = get_the_ID();

$categoria_esquerda = get_post_meta($home_id, 'categoria_esquerda', true);
$categoria_direita = get_post_meta($home_id, 'categoria_direita', true);
?>

  <?php 
function get_product_category_data($category){
  $cat = get_term_by('slug', $category, 'product_cat');
  $cat_id = $cat->term_id;
  $img_id = get_term_meta($cat_id, 'thumbnail_id', true);
  $img_cat = wp_get_attachment_image_src($img_id, 'slide')[0];
  return[
    'name' => $cat->name,
    'id' => $cat_id,
    'link' => get_term_link($cat_id, 'product_cat'),
    'img' => wp_get_attachment_image_src($img_id, 'slide')[0]
  ];
}

$data['categorias'][$categoria_esquerda] = get_product_category_data($categoria_esquerda);
$data['categorias'][$categoria_direita] = get_product_category_data($categoria_direita);

?>


<?php if (have_posts()) : while (have_posts()) : the_post(); ?>


<section class="slide-home">
  <div class="container">
  <div class="swiper">
  <div class="swiper-wrapper">
    <?php foreach($data['slide'] as $product){ ?>
    <div class="swiper-slide">
      <img href="<?= $product['link']?>" src="<?= $product['img']?>" alt="<?= $product['name']?>">
  <div class="slide-info">
  <h2><?= $product['name']?></h2>
  <span class="preco"><?= $product['price']?></span>
  <a href="<?= $product['link']?>">Comprar</a>
  </div>      
    </div>
    <?php } ?>
  </div>
  </div>
</section>

<section class="produtos">
  <div class="container">
    <h1 class="subtitulo">Lançamentos</h1>
    <?php modas_product_list($data['lacamentos']);?>
  </div>
</section>

<section class="categorias-home">
  <div class="container">
    <?php foreach($data['categorias'] as $categoria){  ?>
      <a href="<?= $categoria['link']?>">
        <img src="<?= $categoria['img']?>" alt="<?php $categoria['name']?>">
        <span class="btn"><?= $categoria['name']?></span>
      </a>
    <?php } ?>
  </div>
</section>

<section class="vendidos">
  <div class="container">
    <h1 class="subtitulo">Mais vendidos</h1>
    <?php modas_product_list($data['vendidos']);?>
  </div>
</section>


<?php endwhile; endif; ?>

<?php get_footer(); ?>