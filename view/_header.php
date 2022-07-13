
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>RecipesApp</title>
  <style>
	  .h3{
		font-family: "Brush Script MT", "Lucida Handwriting";
		font-style: italic;
		text-align: center;
		color: red;
	  }
    .column {
  column-gap: 10px;
  float: left;
  width: 33.33%;
  
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
  background-color: #F9E3E3; /*  #F75D59;*/
  padding: 10px;
}
span:checked {
  color: orange;
  background-color: orange;
}
.star-rating input {
   display: none;
}
.star-rating {
   display: flex;
   align-items: center;
   width: 160px;
   flex-direction: row-reverse;
}
.star-rating > label {
   width: 30px;
   height: 30px;
   font-family: Verdana;
   font-size: 30px;
   color:orange;
}
.star-rating label::before {
   content: '\2606';
   /*position: absolute;*/
   /*top: 0px;*/
   line-height: 26 px;
}
.star-rating input:checked ~ label:before{
  content: '\2605';
}
.star-rating input:checked ~ label{
  content: '\2605';
}
.star-rat input {
   display: none;
}
.star-rat {
   display: flex;
   align-items: center;
   width: 160px;
   /*flex-direction: row-reverse;*/
}
.star-rat > label {
   width: 30px;
   height: 30px;
   font-family: Verdana;
   font-size: 30px;
   color:orange;
}
.star-rat label::before {
   content: '\2606';
   /*position: absolute;*/
   /*top: 0px;*/
   line-height: 26 px;
}
.star-rat input:checked ~ label{
  content: '\2605';
}
.gubmic{
  align:center; border: 1px solid #000000;/*black;*/
  color:  #F9E3E3;/*lightsteelblue;*/
  font-family: 'Goudy Old Style', Garamond, 'Big Caslon', 'Times New Roman';
  background-image:
  url(https://wallpapercave.com/wp/wp3114035.jpg);
  width: 9vw;
  height: 5vh;
  font-size: 1.15rem;
  text-align:center;
  border-radius: 5vw;
  margin-bottom: 1vw
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
    <?php if($_SESSION['is_admin'] === '1') ?>  <li class="nav-item"><a class="nav-link" href="recipes.php?rt=categories/addCategory">Dodaj kategoriju</a></li>
    <li class="nav-item"><a class="nav-link" href="recipes.php?rt=users/logout">Odjavi se</a></li>
    </ul>
  </div>
</nav>


<h3 class="h3 my-2 font-weight-light"><?php echo $title; ?></h3>
