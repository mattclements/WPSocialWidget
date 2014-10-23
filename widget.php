<?php
class SocialWidget extends WP_Widget
{
	private $social_types = array(
		array(
			'field' => 'instagram_url',
			'name' => 'Instagram URL',
			'icon' => 'fa fa-instagram'
		),
		array(
			'field' => 'twitter_url',
			'name' => 'Twitter URL',
			'icon' => 'fa fa-twitter'
		),
		array(
			'field' => 'facebook_url',
			'name' => 'Facebook URL',
			'icon' => 'fa fa-facebook'
		),
		array(
			'field' => 'twitter_url',
			'name' => 'Twitter URL',
			'icon' => 'fa fa-twitter'
		),
		array(
			'field' => 'tumblr_url',
			'name' => 'Tumblr URL',
			'icon' => 'fa fa-tumblr'
		),
		array(
			'field' => 'flickr_url',
			'name' => 'Flickr URL',
			'icon' => 'fa fa-flickr'
		),
		array(
			'field' => 'pinterest_url',
			'name' => 'Pinterest URL',
			'icon' => 'fa fa-pinterest'
		),
		array(
			'field' => 'email_url',
			'name' => 'Email URL',
			'icon' => 'fa fa-envelope-o'
		),
		array(
			'field' => 'search_url',
			'name' => 'Search URL',
			'icon' => 'fa fa-search'
		),
	);

	function SocialWidget()
	{
		$widget_ops = array('classname' => 'SocialWidget', 'description' => 'Social Widgets' );
		$this->WP_Widget('SocialWidget', 'Social Widgets', $widget_ops);
	}

	function form($instance)
	{
		$default_values = array();
		foreach($this->social_types as $social_type)
		{
			$default_values[$social_type['field']] = "";
		}

		$instance = wp_parse_args((array) $instance, $default_values);

		foreach($this->social_types as $social)
		{
			echo "<p><label for=\"".$this->get_field_id($social['field'])."\">".$social['name'].": <input class=\"widefat\" id=\"".$this->get_field_id($social['field'])."\" name=\"".$this->get_field_name($social['field'])."\" type=\"text\" value=\"".attribute_escape($instance[$social['field']])."\" /></label></p>";
		}
	}

	function update($new_instance, $instance)
	{
		foreach($this->social_types as $social)
		{
			$instance[$social['field']] = $new_instance[$social['field']];
		}

		return $instance;
	}

	function widget($args, $instance)
	{
		extract($args, EXTR_SKIP);

		echo $before_widget;

		echo '<div class="social-widget">';

		foreach($this->social_types as $social)
		{
			if(isset($instance[$social['field']]) && $instance[$social['field']]!=="")
			{
				echo '<a href="'.$instance[$social['field']].'"><div class="social-bg"><i class="'.$social['icon'].'"></i></div></a>';
			}
		}

		echo '</div>';

		echo $after_widget;
	}

}

function register_social_widget() {
	return register_widget("SocialWidget");
}

add_action('widgets_init', 'register_social_widget');