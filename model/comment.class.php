<?php

class Comment
{
	protected $id, $id_recipe, $id_user, $comment;

	function __construct( $id, $id_recipe, $id_user, $comment )
	{
		$this->id = $id;
		$this->id_recipe = $id_recipe;
        $this->id_user = $id_user;
        $this->comment = $comment;
	}

	function __get( $prop ) { return $this->$prop; }
	function __set( $prop, $val ) { $this->$prop = $val; return $this; }
}

?>