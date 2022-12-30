<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Clearvoice Freelancer Custom Posts
 *
 * This Widget will get posts from Hire Freelancer Post Type Categories.
 *
 * @since 1.0.0
 */
class  Clearvoice_Custom_Posts_Freelancer extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'clearvoice-custom-posts-freelancer';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Hire Freelancer Posts', 'ClearVoice-backend-functionality' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-posts-carousel';
	}

	/**
	 * Get widget categories.
	 *
	 * Register the widget in our own custom category.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'clearvoice' ];
	}

	/**
	 * Register widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			array(
				'label' => esc_html__( 'Content', 'ClearVoice-backend-functionality' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		/**
		 * Let's get all the cats and store them in $options array.
		 */
		$options = array();
		$args = array(
			'taxonomy'   => 'clv-hire-freelancer-categories',
			'hide_empty' => false,
		);
		$categories = get_categories( $args );
		if ( isset( $categories ) && is_array( $categories ) ) {
			foreach ( $categories as $key => $category ) {
				$options[ $category->name ] = $category->name;
			}
		}
		$this->add_control(
			'clv_categories',
			array(
				'label'       => esc_html__( 'Select Categories', 'ClearVoice-backend-functionality' ),
				'type'        => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple'    => true,
				'options'     =>  $options,
			)
		);
		$this->add_control(
			'clv_posts_per_page',
			array(
				'label'       => esc_html__( 'Posts Per Page', 'ClearVoice-backend-functionality' ),
				'type'        => \Elementor\Controls_Manager::NUMBER,
				'min'         => -1,
			)
		);
		$this->add_control(
			'clv_order',
			array(
				'label'    => esc_html__( 'Order', 'ClearVoice-backend-functionality' ),
				'type'     => \Elementor\Controls_Manager::SELECT,
				'default'  => 'ASC',
				'options'  => array(
					'DESC' => esc_html( 'DESC' ),
					'ASC'  => esc_html( 'ASC' ),
				),
				'separator'=> 'before',
			)
		);
		$this->add_control(
			'clv_order_by',
			array(
				'label'   => esc_html__( 'Order by', 'ClearVoice-backend-functionality' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'ASC',
				'options' => array(
					'date'       => esc_html( 'date' ),
					'title'      => esc_html( 'title' ),
					'menu_order' => esc_html( 'menu_order' ),
					'rand'       => esc_html( 'rand' ),
				),
			)
		);

		$this->end_controls_section();

	}

	/**
	 * Render ClearVoice Freelancers Custom Posts widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings          = $this->get_settings_for_display();
		$clv_post_per_page = isset( $settings['clv_posts_per_page'] ) ? $settings['clv_posts_per_page'] : -1;
		$clv_categories    = isset( $settings['clv_categories'] ) ? $settings['clv_categories'] : array();
		$clv_order         = isset( $settings['clv_order'] ) ? $settings['clv_order'] : 'ASC';
		$clv_order_by      = isset( $settings['clv_order_by'] ) ? $settings['clv_order_by'] : 'date';

		// Let's do the query magic now.
		$args = array(
			'post_type' => 'any',
			'tax_query' => array(
				array(
					'taxonomy' => 'clv-hire-freelancer-categories',
					'field'    => 'slug',
					'terms'    => $clv_categories,
				)
			),
			'posts_per_page' => $clv_post_per_page,
			'order'          => $clv_order,
			'orderby'        => $clv_order_by,
		);

		$query = new WP_Query( $args );
		if ( $query->have_posts() ) {

			while( $query->have_posts() ) {

				$query->the_post();
				$clv_post_categories       = get_the_terms( get_the_ID(), 'clv-hire-freelancer-categories' );
				$clv_current_category_name = isset( $clv_post_categories[0]->name ) ? $clv_post_categories[0]->name : '';
				?>
				<div class="post-single">
				<a href="<?php echo esc_url( get_permalink() ); ?>" class="clv-featured-img">
					<?php if ( has_post_thumbnail() ) : ?>
						<?php the_post_thumbnail( 'medium' ); ?>
					<?php endif; ?>
				</a>
				<div class="content-col-slide">
					<h6 class="post-title"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo  esc_html( get_the_title() ); ?></a></h6>
					<?php if ( isset( $clv_current_category_name ) && ! empty( $clv_current_category_name ) ) : ?>
					<div class="btn-wrp text-link">Category Name: <?php echo esc_html( $clv_current_category_name ) ?></div>
					<?php endif; ?>
				</div>
				</div>
				<?php

			}
		}
		// Reset Query.
		wp_reset_postdata();
	}
}
