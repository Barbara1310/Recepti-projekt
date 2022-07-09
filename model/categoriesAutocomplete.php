<?php
session_start();

require_once __DIR__ . '/../app/db.class.php';
require_once __DIR__ . '/recipe.class.php';
require_once __DIR__ . '/category.class.php';

if (isset($_GET['term'])) {
  $query = "SELECT DISTINCT name FROM (SELECT name FROM p_categories WHERE name LIKE '%{$_GET['term']}%') LIMIT 10";
  $categories = [];
  $db = DB::getConnection();
  $st = $db->prepare( $query );
  $st->execute();

  while( $row = $st->fetch() ){
    array_push($categories, $row['name']);
  }
  echo json_encode($categories);
}
?>
