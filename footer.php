<?php 

$img_url = get_stylesheet_directory_uri() . '/img'; 

?>
<footer class="footer">

  <div class="container footer-info">
    <section class="footer-info-left">  
      <div class="logo-footer">
  <img src="<?= $img_url?>/logo.png" alt="">
  </div> 
  <span><?php bloginfo('name'); ?></span>
  </section>
  <section>
  <h3>Páginas</h3>
    <?php 
    wp_nav_menu([
      'menu' => 'footer',
      'container' => 'nav',
      'container_class' => 'footer-menu'
    ]);
    ?>
    </section>
  <section>
    <h3>Redes sociais</h3>
    <?php 
    wp_nav_menu([
      'menu' => 'redes',
      'container' => 'nav',
      'container_class' => 'footer-redes'
    ]);
    ?>
  </section>
  <section>
    <h3>Pagamentos</h3>
    <ul>
      <li>Cartão de crédito</li>
      <li>Boleto bancário</li>
      <li>Pagseguro</li>
    </ul>
  </section>
  </div>
  <?php 
  $countries = WC()->countries;
  $base_address = $countries->get_base_address();
  $base_city = $countries->get_base_city();
  $base_state = $countries->get_base_state();

  $complete_address = "$base_address, $base_city, $base_state"
  
  ?>
  <small class="footer-copy"> Maria Modas &copy; <?php echo date('Y')?>. Todos os direitos reservados</br>
<?= $complete_address; ?></small>
</footer>

<?php wp_footer(); ?>
<script src="<?php echo get_template_directory_uri()?>/js/plugins.js"></script>
<script src="<?php echo get_template_directory_uri()?>/js/all.js"></script>
</body>
</html>