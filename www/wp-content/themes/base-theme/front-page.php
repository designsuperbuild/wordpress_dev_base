<?php get_template_part('templates/page', 'header'); ?>
<?php get_template_part('templates/content', 'page'); ?>

<?php
  // custom post query and display example
  $args = array(
  'post_type' => 'post',
  'posts_per_page' => '8',
  'post_status' => 'publish',
  );
  global $fp_posts;
  $fp_posts = new WP_Query( $args );
?>

<div class="row">
  <?php while ($fp_posts->have_posts()) : $fp_posts->the_post(); ?>
    <?php get_template_part('templates/content-block', get_post_format()); ?>
  <?php endwhile; ?>
</div>
