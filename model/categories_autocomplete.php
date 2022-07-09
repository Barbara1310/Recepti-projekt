<?php
session_start();

require_once __DIR__ . '/../app/db.class.php';
require_once __DIR__ . '/recipe.class.php';
require_once __DIR__ . '/category.class.php';

if (isset($_GET['term'])) {
  echo "aaaa";
   $query = "SELECT * FROM p_categories WHERE name LIKE '{$_GET['term']}%' LIMIT 25";
    $result = mysqli_query($conn, $query);
 
    if (mysqli_num_rows($result) > 0) {
     while ($category = mysqli_fetch_array($result)) {
      $res[] = $category['name'];
     }
    } else {
      $res = array();
    }
    //return json res
    return json_encode($res);
}
?>
