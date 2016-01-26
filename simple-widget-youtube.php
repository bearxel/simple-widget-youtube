<?php
/*
	Plugin Name: Simple Widget YouTube
	Plugin URI: http://www.bearxel.com
	Description: A simple Widget YouTube
	Author: Alexandre Dumont <alexandre@bearxel.com>
	Author URI: 
	Version: 0.0.1
	License: GPL2 or later
*/


class SimpleWidgetYoutube extends WP_Widget {
	public function __construct() {
		$widgetArgs = array( 
			'class_name' => 'simple_widget_youtube',
			'description' => 'Display a YouTube Video',
		);

		parent::__construct('simple_widget_youtube', 'Widget YouTube', $widgetArgs);
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget($args, $instance) {
		extract($args);

		$youtubeVideoId = strip_tags($instance['youtubeVideoId']);
		$youtubeWidth = strip_tags($instance['youtubeWidth']);
		$youtubeHeight = strip_tags($instance['youtubeHeight']);

		echo $before_widget;

		$tpl = '
			<iframe width="'.$youtubeWidth.'" height="'.$youtubeHeight.'" src="https://www.youtube.com/embed/'.$youtubeVideoId.'" frameborder="0" allowfullscreen></iframe>
		';

		echo $tpl;

		echo $after_widget;
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form($instance) {
		// outputs the options form on admin
		$instance = wp_parse_args(
			$instance,
			[
				'youtubeVideoId' => 'ILua0jRCH-k',
				'width' => 560,
				'height' => 315
			]
		);

		$youtubeVideoId = strip_tags($instance['youtubeVideoId']);
		$youtubeWidth = strip_tags($instance['youtubeWidth']);
		$youtubeHeight = strip_tags($instance['youtubeHeight']);

		$tpl = '
			<p>
				<label for="'.$this->get_field_id('youtubeVideoId').'">Video ID</label>
				<input type="widefat" id="'.$this->get_field_id('youtubeVideoId').'" name="'.$this->get_field_name('youtubeVideoId').'" type="text" value="'.esc_attr($youtubeVideoId).'" />
			</p>

			<p>
				<label for="'.$this->get_field_id('youtubeWidth').'">Width</label>
				<input type="widefat" id="'.$this->get_field_id('youtubeWidth').'" name="'.$this->get_field_name('youtubeWidth').'" type="text" value="'.esc_attr($youtubeWidth).'" />
			</p>

			<p>
				<label for="'.$this->get_field_id('youtubeHeight').'">Height</label>
				<input type="widefat" id="'.$this->get_field_id('youtubeHeight').'" name="'.$this->get_field_name('youtubeHeight').'" type="text" value="'.esc_attr($youtubeHeight).'" />
			</p>
		';

		echo $tpl;
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	public function update( $newInstance, $oldInstance ) {
		// processes widget options to be saved

		$newInstance['youtubeVideoId'] = strip_tags($newInstance['youtubeVideoId']);
		$newInstance['youtubeWidth'] = strip_tags($newInstance['youtubeWidth']);
		$newInstance['youtubeHeight'] = strip_tags($newInstance['youtubeHeight']);

		return $newInstance;
	}
}

function init_youtube_widget() {
	register_widget('SimpleWidgetYoutube');
}

add_action('widgets_init', 'init_youtube_widget');