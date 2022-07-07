<?php
require_once __DIR__ . '/app/db.class.php';

//ovo je skripta koja se izvršava jednom dnevno i stavlja slučajne recepte na početnu stranicu
// koristi se crontab za svakodnevno izvršavanje u 23:59

$db = DB::getConnection();
$db->exec(
    'DROP TABLE IF EXISTS p_recepti_dana'
);





  //izbriše ju ako postoji, a to treba napraviti svaki dan
    


	//stvori novu i puni ju

        
        try {  //stvara ju
            
            $st = $db->prepare(
                'CREATE TABLE IF NOT EXISTS p_recepti_dana (' .
                    'id int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
                    'id_recipe int NOT NULL,' .
                    'id_category int NOT NULL)'
            );
        
            $st->execute();
        } catch (PDOException $e) {
            
            exit("PDO error [create p_recepti_dana]: " . $e->getMessage());
        }

        //sad ju treba popuniti
        $broj_kategorija=0;
        while($broj_kategorija < 4)
        {
            if($broj_kategorija=== 3)
                break;
            $st = $db->prepare('SELECT * FROM p_recipes_categories ORDER BY RAND() LIMIT 1');
            $st->execute();
            $row =$st->fetch();
            $istina=0; //pretpostavimo da nemamo tu kategoriju u bazi taj dan, niti taj recept

            
            $st2= $db->prepare('SELECT * FROM p_recepti_dana');
            $st2->execute();
            while($row2 =$st2-> fetch())
            {
                if($row['id_category'] === $row2['id_category'])
                   { $istina=1;
                    break;}
                if($row['id_recipe'] === $row2['id_recipe']) 
                {
                    $istina=1;
                    break;
                }   
            }

            if($istina === 0)
            {
                $st3 = $db->prepare( 'INSERT INTO p_recepti_dana(id, id_recipe, id_category) VALUES (:id, :id_recipe, :id_category)' );
                $st3->execute( array( 'id' => $row['id'], 'id_recipe' => $row['id_recipe'], 'id_category' => $row['id_category'] ) );
                $broj_kategorija++;
            }
        }
        



    



?>