<?php

// Manualno inicijaliziramo bazu ako već nije.
require_once 'db.class.php';

$db = DB::getConnection();

$has_tables = false;

try
{
	$st = $db->prepare(
		'SHOW TABLES LIKE :tblname'
	);

	$st->execute( array( 'tblname' => 'p_recipes' ) );
	if( $st->rowCount() > 0 )
		$has_tables = true;

	$st->execute( array( 'tblname' => 'p_users' ) );
	if( $st->rowCount() > 0 )
		$has_tables = true;

	$st->execute( array( 'tblname' => 'p_categories' ) );
	if( $st->rowCount() > 0 )
		$has_tables = true;

  $st->execute( array( 'tblname' => 'p_recipes_ingredients' ) );
	if( $st->rowCount() > 0 )
		$has_tables = true;

  $st->execute( array( 'tblname' => 'p_recipes_categories' ) );
	if( $st->rowCount() > 0 )
		$has_tables = true;

  $st->execute( array( 'tblname' => 'p_recipes_comments' ) );
	if( $st->rowCount() > 0 )
		$has_tables = true;

  $st->execute( array( 'tblname' => 'p_recipes_rates' ) );
	if( $st->rowCount() > 0 )
		$has_tables = true;
}
catch( PDOException $e ) { exit( "PDO error [show tables]: " . $e->getMessage() ); }


if( $has_tables )
{
	exit( 'Tablice već postoje. Obrišite ih pa probajte ponovno.' );
}


try {
    $st = $db->prepare(
        'CREATE TABLE IF NOT EXISTS p_users (' .
            'id int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
            'username varchar(50) NOT NULL,' .
            'password_hash varchar(255) NOT NULL,' .
            'email varchar(50) NOT NULL,' .
            'has_registered int,' .
            'registration_sequence varchar(20) NOT NULL,' .
            'is_admin tinyint)'
    );

    $st->execute();
} catch (PDOException $e) {
    exit("PDO error [create p_users]: " . $e->getMessage());
}

echo "Napravio tablicu p_users.<br />";

try {
    $st = $db->prepare(
        'CREATE TABLE IF NOT EXISTS p_recipes (' .
            'id int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
            'title varchar(100) NOT NULL,' .
            'description varchar(1000) NOT NULL,' .
            'link varchar(250) NOT NULL,'.
						'duration varchar(100) NOT NULL,'.
						'id_user int NOT NULL)'
    );

    $st->execute();
} catch (PDOException $e) {
    exit("PDO error [create p_recipes]: " . $e->getMessage());
}

echo "Napravio tablicu p_recipes.<br />";

try {
    $st = $db->prepare(
        'CREATE TABLE IF NOT EXISTS p_categories (' .
            'id int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
            'name varchar(100) NOT NULL)'
    );

    $st->execute();
} catch (PDOException $e) {
    exit("PDO error [create p_categories]: " . $e->getMessage());
}

echo "Napravio tablicu p_categories.<br />";

try {
    $st = $db->prepare(
        'CREATE TABLE IF NOT EXISTS p_recipes_ingredients (' .
            'id int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
            'id_recipe int NOT NULL,' .
						'amount varchar(100) NOT NULL,' .
            'ingredient varchar(100) NOT NULL)'
    );

    $st->execute();
} catch (PDOException $e) {
    exit("PDO error [create p_recipes_ingredients]: " . $e->getMessage());
}

echo "Napravio tablicu p_recipes_ingredients.<br />";

try {
    $st = $db->prepare(
        'CREATE TABLE IF NOT EXISTS p_recipes_comments (' .
            'id int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
            'id_recipe int NOT NULL,' .
						'id_user int NOT NULL,'.
            'comment varchar(300) NOT NULL)'
    );

    $st->execute();
} catch (PDOException $e) {
    exit("PDO error [create p_recipes_comments]: " . $e->getMessage());
}

echo "Napravio tablicu p_recipes_comments.<br />";

try {
    $st = $db->prepare(
        'CREATE TABLE IF NOT EXISTS p_recipes_categories (' .
            'id int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
            'id_recipe int NOT NULL,' .
            'id_category int NOT NULL)'
    );

    $st->execute();
} catch (PDOException $e) {
    exit("PDO error [create p_recipes_categories]: " . $e->getMessage());
}

echo "Napravio tablicu p_recipes_categories.<br />";

try {
    $st = $db->prepare(
        'CREATE TABLE IF NOT EXISTS p_recipes_rates (' .
            'id int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
						'id_recipe int NOT NULL,' .
						'id_user int NOT NULL,' .
            'rate int NOT NULL)'
    );

    $st->execute();
} catch (PDOException $e) {
    exit("PDO error [create p_recipes_rates]: " . $e->getMessage());
}

echo "Napravio tablicu p_recipes_rates.<br />";


//Ubacimo korisnike
try {
    $st = $db->prepare('INSERT INTO p_users(username, password_hash, email, has_registered, registration_sequence, is_admin) VALUES (:username, :password, \'a@b.com\', \'1\', \'abc\', \'1\')');

    $st->execute(array('username' => 'ana', 'password' => password_hash('aninasifra', PASSWORD_DEFAULT)));
    $st->execute(array('username' => 'mirko', 'password' => password_hash('mirkovasifra', PASSWORD_DEFAULT)));
    $st->execute(array('username' => 'maja', 'password' => password_hash('majinasifra', PASSWORD_DEFAULT)));
		$st->execute(array('username' => 'pero', 'password' => password_hash('perinasifra', PASSWORD_DEFAULT)));
		$st->execute(array('username' => 'ivana', 'password' => password_hash('ivaninasifra', PASSWORD_DEFAULT)));
} catch (PDOException $e) {
    exit("PDO error [insert p_users]: " . $e->getMessage());
}

echo "Ubacio u tablicu p_users.<br />";

//ubacimo i recepte
try {
    $st = $db->prepare('INSERT INTO p_recipes(title, description, link, duration, id_user) VALUES (:title, :description, :link, :duration, :id_user)');

    $st->execute(array('title' => 'Carbonara', 'description' => 'Tjesteninu skuhati al dente. Na malo maslinova ulja pržiti sjeckanu slaninu. U posebnoj zdjeli umutiti jaja s parmezanom. Kuhanu tjesteninu istresti na prženu slaninu, promiješati te dodati jaja s parmezanom. Po želji začiniti.', 'link' => 'https://tinyurl.com/4ptutmfx', 'duration' => '30min', 'id_user' => 1 ));
		$st->execute(array('title' => 'Piletina s tikvicama', 'description' => 'Piletinu narežite na rezance. Tikvice prerežite na tanke ploške. U wok ulijte ulje, zagrijte ga. Stavite meso i kratko pecite. Izvadite meso i na istoj masnoći kratko pecite tikvice. Dodajte malo soli i papra. Ubacite meso i dodajte još maslinovog ulja.', 'link' => 'https://tinyurl.com/2s4ft86m','duration' => '35min' ,'id_user' => 2 ));
		$st->execute(array('title' => 'Palačinke', 'description' => 'Umutiti jaja. Dodati polovicu mlijeka i brašna te sve sjediniti. Zatim dodati drugu polovicu mlijeka, mineralnu vodu, ulje, maslac, sol te ostatak brašna uz pažljivo miješanje. Neka odstoji 20 minuta.Istresi zatim jednu zaimaču smjese na zagrijanu tavu, peći minutu-dvije, okrenuti na drugu stranu i ispeći da porumeni.', 'link' => 'https://tinyurl.com/ys2ztnmw','duration' => '75min' , 'id_user' => 2 ));
		$st->execute(array('title' => 'Kruh', 'description' => 'Kvasac razmrvite, dodajte malo šećera i 50ml mlake vode pa ostavite na toplom mjestu oko 10 min. Brašnu dodajte sol i kvasac pa pomiješajte s preostalom vodom. Umiješajte maslac i zamijesite. Ostavite na toplom 30 min da se tijesto digne.Nakon toga oblikujte štrucu i stavite u namašćeni kalup. Pecite 45 min na 180 stupnjeva.', 'link' => 'https://tinyurl.com/2p9bpch5','duration' => '1h 15min' , 'id_user' => 3 ));
		$st->execute(array('title' => 'Namaz od tunjevine', 'description' => 'Maslac pjenasto izmiješajte, a tvrdo kuhano jaje i tunjevinu sitno nasjeckajte. Sve to ubacite u maslac te dodajte senf i masline. Sve dobro izmiješajte i ohladite.', 'link' => 'https://tinyurl.com/jfd2faub', 'duration' =>'50min', 'id_user' => 3 ));
		$st->execute(array('title' => 'Pavlova', 'description' => 'Bjelanjke miksamo dok ne postane čvrsti snijeg, dodajemo šećer i miješamo dok ne bude glatka smjesa od bjelanjka. Stavimo peći 2 sata na 180 stupnjeva. Za kremu pomiješamo mascarpone i šećer. Miksamo dok se ne sjedini te dodamo slatko vrhnje i nastavljamo miksati. Kad se biskvit ohladi, na njega stavimo kremu te je ukrasimo voćem.', 'link' => 'https://tinyurl.com/msnj8er4', 'duration' => '2h 30min', 'id_user' => 3 ));
		$st->execute(array('title' => 'Smoothie', 'description' => 'Sve sastojke ubaciti u blender i izmikasati. Dodati po ukusu kocku kocku leda i poslužiti.', 'link' => 'https://tinyurl.com/3ffxzfre', 'duration' => '10min', 'id_user' => 4 ));



} catch (PDOException $e) {
    exit("PDO error [insert p_recipes]: " . $e->getMessage());
}

echo "Ubacio u tablicu p_recipes.<br />";

//Ubacimo kategorije
try {
    $st = $db->prepare('INSERT INTO p_categories(name) VALUES (:name)');

    $st->execute(array('name' => 'deserti' ));
		$st->execute(array('name' => 'tjestenine' ));
		$st->execute(array('name' => 'glavna jela' ));
		$st->execute(array('name' => 'brza jela' ));



} catch (PDOException $e) {
    exit("PDO error [insert p_categories]: " . $e->getMessage());
}

echo "Ubacio u tablicu p_categories.<br />";

//Ubacimo u p_recipe_categories gdje povezujemo jela i kategorije
try {
    $st = $db->prepare('INSERT INTO p_recipes_categories(id_recipe, id_category) VALUES (:id_recipe, :id_category)');

    $st->execute(array('id_recipe' => 1 , 'id_category' => 2 ));
		$st->execute(array('id_recipe' => 1 , 'id_category' => 3 ));
		$st->execute(array('id_recipe' => 2 , 'id_category' => 3 ));
		$st->execute(array('id_recipe' => 2 , 'id_category' => 4 ));
		$st->execute(array('id_recipe' => 3 , 'id_category' => 1 ));
		$st->execute(array('id_recipe' => 4 , 'id_category' => 3 ));
		$st->execute(array('id_recipe' => 5 , 'id_category' => 4 ));
		$st->execute(array('id_recipe' => 6 , 'id_category' => 1 ));
		$st->execute(array('id_recipe' => 7 , 'id_category' => 1 ));
		$st->execute(array('id_recipe' => 7 , 'id_category' => 4 ));


} catch (PDOException $e) {
    exit("PDO error [insert p_recipes_categories]: " . $e->getMessage());
}

echo "Ubacio u tablicu p_recipes_categories.<br />";

//Ubacimo p_recipes_comments gdje su spremljeni komentari na recepte

try {
    $st = $db->prepare('INSERT INTO p_recipes_comments(id_recipe, id_user, comment) VALUES (:id_recipe, :id_user, :comment)');

    $st->execute(array('id_recipe' => 1 , 'id_user' => 2, 'comment' => 'Najbolji recept za carbonaru!' ));
		$st->execute(array('id_recipe' => 2 , 'id_user' => 1, 'comment' => 'Isprobala sam recept i super je. Dobila sam puno pohvala.' ));
		$st->execute(array('id_recipe' => 3 , 'id_user' => 5, 'comment' => 'Ovaj recept nije dobar, tijesto ispadne pregusto. Ako se doda još mlijeka, palačinke su solidne.' ));
		$st->execute(array('id_recipe' => 4 , 'id_user' => 1, 'comment' => 'Umjesto maslaca dodala sam maslinovo ulje i bilo je još finije. Hvala za recept!' ));
		$st->execute(array('id_recipe' => 4 , 'id_user' => 4, 'comment' => 'Prvi put sam radio kruh po ovom receptu i ispao je savršen.' ));
		$st->execute(array('id_recipe' => 4 , 'id_user' => 5, 'comment' => 'Hvala na receptu, ali smatram da bi trebalo ići manje kvasca.' ));
		$st->execute(array('id_recipe' => 6 , 'id_user' => 5, 'comment' => 'Napravila prijateljici za rođendan i bila je oduševljena. Uopće se ne osjeti miris bjelanjka. Prvom prigodom ću je ponovno napraviti.' ));
		$st->execute(array('id_recipe' => 6 , 'id_user' => 4, 'comment' => 'Meni je biskvit ispucao. Zna li netko u čemu bi mogao biti problem?' ));


} catch (PDOException $e) {
    exit("PDO error [insert p_recipes_comments]: " . $e->getMessage());
}

echo "Ubacio u tablicu p_recipes_comments.<br />";

//Ubacimo p_recipes_ingredients
try {
    $st = $db->prepare('INSERT INTO p_recipes_ingredients(id_recipe, amount, ingredient) VALUES (:id_recipe, :amount, :ingredient)');

    $st->execute(array('id_recipe' => 1 , 'amount' => '300 g', 'ingredient' => 'tjestenine' ));
	  $st->execute(array('id_recipe' => 1 , 'amount' => '1 dcl', 'ingredient' => 'maslinovog ulja' ));
	  $st->execute(array('id_recipe' => 1 , 'amount' => '15 dkg', 'ingredient' => 'slanine' ));
	  $st->execute(array('id_recipe' => 1 , 'amount' => '2', 'ingredient' => 'jaja' ));
	  $st->execute(array('id_recipe' => 1 , 'amount' => '1 žlica', 'ingredient' => 'parmezana' ));
	  $st->execute(array('id_recipe' => 2 , 'amount' => '0.5 kg', 'ingredient' => 'piletine' ));
	  $st->execute(array('id_recipe' => 2 , 'amount' => '1', 'ingredient' => 'tikvica' ));
	  $st->execute(array('id_recipe' => 2 , 'amount' => '1 dcl', 'ingredient' => 'maslinovog ulja' ));
	  $st->execute(array('id_recipe' => 3 , 'amount' => '200 ml', 'ingredient' => 'mlijeka' ));
	  $st->execute(array('id_recipe' => 3 , 'amount' => '200 g', 'ingredient' => 'brašna' ));
	  $st->execute(array('id_recipe' => 3 , 'amount' => '200 ml', 'ingredient' => 'mineralne vode' ));
		$st->execute(array('id_recipe' => 3 , 'amount' => '1 žlica', 'ingredient' => 'ulja' ));
		$st->execute(array('id_recipe' => 3 , 'amount' => '2', 'ingredient' => 'jaja' ));
		$st->execute(array('id_recipe' => 3 , 'amount' => '1 žlica', 'ingredient' => 'maslaca' ));
		$st->execute(array('id_recipe' => 4 , 'amount' => '500 g', 'ingredient' => 'brašna' ));
		$st->execute(array('id_recipe' => 4 , 'amount' => '10 g', 'ingredient' => 'maslaca' ));
		$st->execute(array('id_recipe' => 4 , 'amount' => '40 g', 'ingredient' => 'kvasca' ));
		$st->execute(array('id_recipe' => 4 , 'amount' => '300 ml', 'ingredient' => 'vode' ));
		$st->execute(array('id_recipe' => 5 , 'amount' => '1 žlica', 'ingredient' => 'maslaca' ));
		$st->execute(array('id_recipe' => 5 , 'amount' => '1', 'ingredient' => 'jaje' ));
		$st->execute(array('id_recipe' => 5 , 'amount' => '1', 'ingredient' => 'tuna iz konzerve' ));
		$st->execute(array('id_recipe' => 5 , 'amount' => '1 žlica', 'ingredient' => 'senfa' ));
		$st->execute(array('id_recipe' => 5 , 'amount' => '10 g', 'ingredient' => 'maslina' ));
		$st->execute(array('id_recipe' => 6 , 'amount' => '5', 'ingredient' => 'jaja' ));
		$st->execute(array('id_recipe' => 6 , 'amount' => '200 g', 'ingredient' => 'šećera' ));
		$st->execute(array('id_recipe' => 6 , 'amount' => '200 g', 'ingredient' => 'mascarponea' ));
		$st->execute(array('id_recipe' => 6 , 'amount' => '500 ml', 'ingredient' => 'slatkog vrhnja' ));
		$st->execute(array('id_recipe' => 7 , 'amount' => '300 g', 'ingredient' => 'šumskog voća' ));
		$st->execute(array('id_recipe' => 7 , 'amount' => '2 dcl', 'ingredient' => 'jogurta' ));




} catch (PDOException $e) {
    exit("PDO error [insert p_recipes_ingredients]: " . $e->getMessage());
}

echo "Ubacio u tablicu p_recipes_ingredients.<br />";

//ubacimo i ocjene na recepte
try {
    $st = $db->prepare('INSERT INTO p_recipes_rates(id_recipe, id_user, rate) VALUES (:id_recipe, :id_user, :rate)');

		$st->execute(array('id_recipe' => 1 , 'id_user' => 2, 'rate' => 5 ));
		$st->execute(array('id_recipe' => 1 , 'id_user' => 3, 'rate' => 4 ));
		$st->execute(array('id_recipe' => 2 , 'id_user' => 1, 'rate' => 3 ));
		$st->execute(array('id_recipe' => 2 , 'id_user' => 5, 'rate' => 5 ));
		$st->execute(array('id_recipe' => 3 , 'id_user' => 5, 'rate' => 2 ));
		$st->execute(array('id_recipe' => 3 , 'id_user' => 4, 'rate' => 5 ));
		$st->execute(array('id_recipe' => 3 , 'id_user' => 1, 'rate' => 4 ));
		$st->execute(array('id_recipe' => 4 , 'id_user' => 5, 'rate' => 5 ));
		$st->execute(array('id_recipe' => 4 , 'id_user' => 4, 'rate' => 3 ));
		$st->execute(array('id_recipe' => 7 , 'id_user' => 3, 'rate' => 2 ));



} catch (PDOException $e) {
    exit("PDO error [insert p_recipes_rates]: " . $e->getMessage());
}

echo "Ubacio u tablicu p_recipes_rates.<br />";
