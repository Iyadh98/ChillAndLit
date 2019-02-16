<?php
/*
*
* Products By Category Widget
*
*/

if (!defined('ABSPATH')) {
	exit;
}

class WCPBC_Product_By_Category_Widget extends WP_Widget {
	function __construct() {
		parent::__construct(
			'wcpbc_products_by_category',
			__('WooCommerce Display Products by Category', 'wcpbc') ,
			array(
				'description' => __('List all products by a specific store category.', 'wcpbc')
				));
	}

	function form($instance) {
		$cat = $instance['cat'];
		$posts = $instance['posts'];
		$orderby = $instance['orderby'];
		$order = $instance['order'];
		$thumbs = $instance['thumbs'];

		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'Products By Category', 'wcpbc' );
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('cat'); ?>">Category</label>
			<select class='widefat' id="<?php echo $this->get_field_id('cat'); ?>" name="<?php echo $this->get_field_name('cat'); ?>">

				<?php
				$cat_taxonomy = 'product_cat';
				$cat_orderby = 'name';
				$cat_hierarchical = 1;
				$cat_catargs = array(
					'taxonomy' => $cat_taxonomy,
					'orderby' => $cat_orderby,
					'hierarchical' => $cat_hierarchical
					);
				$all_categories = get_categories($cat_catargs);
				foreach($all_categories as $pcat) {
					if ($pcat->category_parent == 0) {
						$category_id = $pcat->term_id;
						$category_slug = $pcat->slug;
						$category_name = $pcat->name;
						?>
						<option value='<?php echo $category_slug ?>' <?php echo ($cat == $category_slug) ? 'selected' : ''; ?>><?php echo $category_name ?></option>
						<?php
						$args2 = array(
							'taxonomy' => $cat_taxonomy,
							'child_of' => 0,
							'parent' => $category_id,
							'orderby' => $cat_orderby,
							'hierarchical' => $cat_hierarchical
							);
						$sub_cats = get_categories($args2);
						if ($sub_cats) {
							foreach($sub_cats as $sub_category) {
								$subcategory_slug = $sub_category->slug;
								$subcategory_name = $sub_category->name;
								?>
								<option value='<?php echo $subcategory_slug ?>' <?php echo ($cat == $subcategory_slug) ? 'selected' : ''; ?>><?php echo '&nbsp;&nbsp;&nbsp;' . $subcategory_name ?></option>
								<?php
							}
						}
					}
				}
				?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('posts'); ?>">Products Shown</label>
			<br/><small>Leave blank (or type -1) to show all products.</small>
			<input class="widefat" type="number" id="<?php echo $this->get_field_id('posts'); ?>" name="<?php echo $this->get_field_name('posts'); ?>" value="<?php echo esc_attr($posts); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('orderby'); ?>">Order By</label>
			<select class='widefat' id="<?php echo $this->get_field_id('orderby'); ?>" name="<?php echo $this->get_field_name('orderby'); ?>">
				<option value='post_title' <?php echo ($orderby == 'post_title') ? 'selected' : ''; ?>>Product Name</option>
				<option value='id' <?php echo ($orderby == 'id') ? 'selected' : ''; ?>>Product ID</option>
				<option value='date' <?php echo ($orderby == 'date') ? 'selected' : ''; ?>>Date Published</option>
				<option value='modified' <?php echo ($orderby == 'modified') ? 'selected' : ''; ?>>Last Modified</option>
				<option value='rand' <?php echo ($orderby == 'rand') ? 'selected' : ''; ?>>Random</option>
				<option value='none' <?php echo ($orderby == 'none') ? 'selected' : ''; ?>>None</option>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('order'); ?>">Order</label>
			<select class='widefat' id="<?php echo $this->get_field_id('order'); ?>" name="<?php echo $this->get_field_name('order'); ?>">
				<option value='ASC' <?php echo ($order == 'ASC') ? 'selected' : ''; ?>>Ascending (A to Z)</option>
				<option value='DESC' <?php echo ($order == 'DESC') ? 'selected' : ''; ?>>Descending (Z to A)</option>
			</select>
		</p>

		<?php
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['cat'] = strip_tags($new_instance['cat']);
		$instance['posts'] = strip_tags($new_instance['posts']);
		$instance['orderby'] = strip_tags($new_instance['orderby']);
		$instance['order'] = strip_tags($new_instance['order']);
		return $instance;
	}

	function widget($args, $instance) {
		$title = apply_filters( 'widget_title', $instance['title'] );

		echo $args['before_widget'];
		if ( !empty( $title )) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		$defaults = array(
			'cat' => '',
			'posts' => '-1',
			'orderby' => 'name',
			'order' => 'ASC',
			'thumbs' => ''
			);
		if (empty($instance['posts'])) {
			$instance['posts'] = $defaults['posts'];
		}

		if (empty($instance['orderby'])) {
			$instance['orderby'] = $defaults['orderby'];
		}

		if (empty($instance['order'])) {
			$instance['order'] = $defaults['order'];
		}

		?>
		<ul class="productsbycat_list productsbycat_<?php echo $instance['cat']; ?>">
			<?php
			$arggs = array(
				'post_type' => 'product',
				'posts_per_page' => $instance['posts'],
				'product_cat' => $instance['cat'],
				'orderby' => $instance['orderby'],
				'order' => $instance['order'],
				'thumbs' => $instance['thumbs']
				);
			$loop = new WP_Query($arggs);
			while ($loop->have_posts()):
				$loop->the_post();
			global $product; ?>
			<li class="wcpbc-product">
                <a href="<?php echo get_permalink( $loop->post->ID ) ?>" title="<?php echo esc_attr($loop->post->post_title ? $loop->post->post_title : $loop->post->ID); ?>">

                    <?php if (has_post_thumbnail( $loop->post->ID )) echo get_the_post_thumbnail($loop->post->ID, 'shop_catalog'); else echo '<img src="'.woocommerce_placeholder_img_src().'" alt="Placeholder" width="300px" height="300px" />'; ?>
                    <h3><?php the_title(); ?></h3>
                    <span class="price"><?php echo $product->get_price_html(); ?></span>
                </a>
                <?php woocommerce_template_loop_add_to_cart( $loop->post, $product ); ?>
		</li>
		<?php
		endwhile;
		wp_reset_query();
		?>
	</ul>
	<?php
	echo $args['after_widget'];
}
}

function product_by_category_widget() {
	register_widget('WCPBC_Product_By_Category_Widget');
}

add_action('widgets_init', 'product_by_category_widget');
?>
