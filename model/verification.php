<?php

require_once __DIR__ . '/../app/db.class.php';
require_once __DIR__ . '/recipesservice.class.php';
require_once __DIR__ . '/recipe.class.php';


if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $code = $_GET['activation_code'];
    $email = $_GET['email'];
     $rs = new RecipesService();

        $ok = $rs->check_valid_verification($code, $email);

        // if user exists and activate the user successfully
        if ($ok) {
            echo '<script language="javascript">';
            echo 'alert("Verifikacija uspjesna!")';
            echo '</script>';
            $rs->activate_user($email);
        }
}

?>