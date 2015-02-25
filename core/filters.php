<?php
class Sizeable_Filters
{
	public static $instance;
	
	public $body_class = array();

	public static function init()
	{
		null === self::$instance && self::$instance = new self();
		return self::$instance;
	}

	private function __construct()
	{
		add_filter( 'body_class', array( $this, 'body_class' ) );
	}

	public static function add_body_class( $class )
	{
		self::$instance->body_class[] = $class;
	}

	public function body_class( $classes ) 
	{
		$classes[] = implode( ' ', $this->body_class );
		return $classes;
	}
}

Sizeable_Filters::init();