<?php

class Recipe
{
	protected $id, $title, $description, $link, $duration, $id_user;

	function __construct( $id, $title, $description, $link, $duration, $id_user )
	{
		$this->id = $id;
		$this->title = $title;
        $this->description = $description;
        $this->link = $link;
        $this->duration = $duration;
        $this->id_user = $id_user;
	}

	function __get( $prop ) { return $this->$prop; }
	function __set( $prop, $val ) { $this->$prop = $val; return $this; }
}

?>