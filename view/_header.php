<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
  <title>RecipesApp</title>
  <style>
	  .h3{
		font-family: "Brush Script MT", "Lucida Handwriting";
		font-style: italic;
		text-align: center;
		color: red;
	  }
    .column {
  float: left;
  width: 25%;
}
.content {
  background-color: white;
  padding: 10px;
}
.prvidiv{
  width: 400px;
  height: 300px;
  margin-right: auto;
  margin-left: auto;
}
.tekst {
  background-color: #F75D59;
  padding: 10px;
}
  </style>

</head>
<body>

	<nav class="navbar navbar-expand-sm bg-light navbar-light">
	<!--<a class="navbar-brand" href="https://cdn.pixabay.com/photo/2020/10/31/10/56/chef-5700886_1280.png">
	<img src="chef.jpg" alt="Logo" style="width:40px;">
  </a> -->
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="recipes.php?rt=recipes/index">Recepti</a>
    </div>
    <ul class="navbar-nav">
      <li class="nav-item"><a class="nav-link" href="recipes.php?rt=recipes/recepti">Moji recepti</a></li>
      <li class="nav-item"><a class="nav-link" href="recipes.php?rt=recipes/favoriti">Moji favoriti</a></li>
      <li class="nav-item"><a class="nav-link" href="recipes.php?rt=recipes/pretraga">Pretraži recepte</a></li>
	  <li class="nav-item"><a class="nav-link" href="recipes.php?rt=recipes/dodaj">Dodaj novi recept</a></li>
    <li class="nav-item"><a class="nav-link" href="recipes.php?rt=users/logout">Odjavi se</a></li>
    </ul>
  </div>
</nav>


<h3 class="h3 my-2 font-weight-light"><?php echo $title; ?></h3>
