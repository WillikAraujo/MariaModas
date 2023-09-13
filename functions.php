<?php
  
function maria_add_woocommerce_support()
{
  add_theme_support('woocommerce');
}

add_action('after_setup_theme', 'maria_add_woocommerce_support');

function maria_css()
{
  wp_register_style('maria-style', get_template_directory_uri() . '/style.css');
  wp_enqueue_style('maria-style');
}
add_action('wp_enqueue_scripts', 'maria_css');

function maria_custom_images()
{
  add_image_size('slide', 1000, 800, ['center', 'top']);
  update_option('medium_crop', 1);
}

add_action('after_setup_theme', 'maria_custom_images');

function format_products($products, $img_size = 'medium'){
  $products_final = [];
  foreach($products as $product){
    $products_final[] = [
      'name' => $product->get_name(),
      'price' => $product->get_price_html(),
      'link' => $product->get_permalink(),
      'img' => wp_get_attachment_image_src($product->get_image_id(), $img_size)[0],
    ];
  }
return $products_final;
};

function modas_loop_shoop_per_page()
{
  return 6;
}

add_filter('loop_shop_per_page', 'modas_loop_shoop_per_page');

function remove_some_body_class($classes){
  $woo_class = array_search('woocommerce', $classes);
  $woopage_class = array_search('woocommerce-page', $classes);
  $search = array_search('archive', $classes) || array_search('product-template-default', $classes);
  if($woo_class && $woopage_class && $search){
    unset($classes[$woo_class]);
    unset($classes[$woopage_class]);
  }
  print_r($woopage_class);
  return $classes;
}

add_filter('body_class', 'remove_some_body_class');


function modas_product_list($products)
{
  ?>
  <ul class="produtos-list">
    <?php foreach ($products as $product) { ?>
      <li class="produtos-item">
        <a href="<?= $product['link'] ?>">
          <div class="produtos-info">
            <img src="<?= $product['img'] ?>" alt="<?= $product['name'] ?>">
            <h2>
              <?= $product['name'] ?><span>
                <?= $product['price'] ?>
              </span>
            </h2>
          </div>
          <div class="produtos-overlay">
            <span>
              Ver mais
            </span>
          </div>
        </a>
      </li>
    <?php } ?>
  </ul>
  <?php
}
?>