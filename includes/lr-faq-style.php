<?php
add_shortcode( 'LRFAQ', 'lr_faq_shortcode_style' );
function lr_faq_shortcode_style($atts) {
ob_start();

	extract( shortcode_atts( array (
        'limit' => '-1',
    ), $atts ) );
	
	if(isset($atts['limit'])){
		$limit = $atts['limit'];
	}else{
		$limit = -1;
	}
?>
<div class="row">
  <div class="col-md-12">
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">      
        <?php
		$args = array('post_type' => 'lrfaq', 'posts_per_page' => $limit, 'order' => 'DESC' );
		$loop = new WP_Query( $args );
		$i=1;
		while ( $loop->have_posts() ) : $loop->the_post();
        ?>
        <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="heading_<?php echo $i; ?>">
          <h4 class="panel-title"> 
          <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse_<?php echo $i; ?>" aria-expanded="<?php if($i==1){echo 'true';}else{echo 'false';} ?>" aria-controls="collapse_<?php echo $i; ?>"> 
		  <?php the_title(); ?> 
          </a> 
          </h4>
        </div>
        <div id="collapse_<?php echo $i; ?>" class="panel-collapse collapse <?php if($i==1){echo 'in';} ?>" role="tabpanel" aria-labelledby="heading_<?php echo $i; ?>">
          <div class="panel-body">
            <?php the_content(); ?>
          </div>
        </div>
        </div>
        <?php $i++; endwhile; wp_reset_query();?>      
    </div>
  </div>
</div>
<?php return ob_get_clean();}