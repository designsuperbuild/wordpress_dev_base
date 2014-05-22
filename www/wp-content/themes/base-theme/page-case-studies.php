<?php get_template_part('templates/page', 'header'); ?>
<?php get_template_part('templates/content', 'page'); ?>

<?php
  // custom post query and display example
  $args = array(
  'post_type' => 'casestudy',
  'posts_per_page' => '8',
  'post_status' => 'publish',
  );
  global $casestudies;
  $casestudies = new WP_Query( $args );
?>

<?php while ($casestudies->have_posts()) : $casestudies->the_post(); ?>
  <?php get_template_part('templates/content', get_post_format()); ?>
<?php endwhile; ?>

