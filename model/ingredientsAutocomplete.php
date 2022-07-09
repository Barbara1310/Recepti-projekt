<?php
session_start();

require_once __DIR__ . '/../app/db.class.php';
require_once __DIR__ . '/recipe.class.php';
require_once __DIR__ . '/category.class.php';

if (isset($_GET['term'])) {
  $query = "SELECT ingredient FROM p_recipes_ingredients WHERE ingredient LIKE '%{$_GET['term']}%' GROUP BY ingredient LIMIT 10";
  $ingredients = [];
  $db = DB::getConnection();
  $st = $db->prepare( $query );
  $st->execute();

  while( $row = $st->fetch() ){
    array_push($ingredients, $row['ingredient']);
  }
  echo json_encode($ingredients);
}
?>
