<?php

class Ingredient
{
	protected $id, $id_recipe, $amount, $ingredient;

	function __construct( $id, $id_recipe, $amount, $ingredient )
	{
		$this->id = $id;
		$this->id_recipe = $id_recipe;
        $this->amount = $amount;
        $this->ingredient = $ingredient;
	}

	function __get( $prop ) { return $this->$prop; }
	function __set( $prop, $val ) { $this->$prop = $val; return $this; }
}

?>