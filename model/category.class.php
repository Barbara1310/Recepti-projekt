<?php

class Category
{
	protected $id, $name;

	function __construct( $id, $name )
	{
		$this->id = $id;
		$this->name = $name;
	}

	function __get( $prop ) { return $this->$prop; }
	function __set( $prop, $val ) { $this->$prop = $val; return $this; }
}

?>