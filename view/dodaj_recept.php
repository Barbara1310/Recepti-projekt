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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.1/css/bootstrap.min.css"/>
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
<body class="bg-secondary">

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

<div class="container">
  <div class="row my-4">
    <div class="col-lg-10 mx-auto">
      <div class="card shadow">
        <div class="card-header">
          <h4>Dodaj recept</h4>
        </div>
        <div class="card-body p-4">
          <form class="#" method="post" id="add_form">
            <div id="show_item">
              <div class="row">
                <div class="col-md-4 mb-3">
                  <input type="text" name="ingredient_quantity[]" class="form-control" placeholder="količina" required>
                </div>
                <div class="col-md-4 mb-3">
                  <input type="text" name="ingredient_name[]" class="form-control" placeholder="naziv sastojka" required>
                </div>

                <div class="col-md-3 mb-3 d-grid">
                  <button class="btn btn-success add_item_btn"> Dodaj još</button>
                </div>

              </div>

            </div>
            <div class="col-md-4 mb-3">
             <input type="text" name="naslov" placeholder="naslov"> 
              <input type="text" name="vrijeme" placeholder="vrijeme pripreme">
              <input type="text" name="link" placeholder="link fotografije jela"> 
              <textarea name="opis" id="" cols="30" rows="10" placeholder="Ovdje opišite postupak"></textarea>
            </div>

            <div class="">
              <input type="submit" id="add_btn" value="Dodaj" class="btn btn-primary w-25">
            </div>
          </form>

        </div>

      </div>

    </div>

  </div>

</div>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
<script>
  $(document).ready(function(){
    //alert("bok"); test
    $(".add_item_btn").click(function(e){
        e.preventDefault();
        $("#show_item").prepend('<div class="row"><div class="col-md-4 mb-3"><input type="text" name="ingredient_quantity[]" class="form-control" placeholder="količina" required></div><div class="col-md-4 mb-3"><input type="text" name="ingredient_name[]" class="form-control" placeholder="naziv sastojka" required></div><div class="col-md-3 mb-3 d-grid"><button class="btn btn-danger remove_item_btn">Ukloni</button></div></div>');

     });

     $(document).on('click', '.remove_item_btn', function(e){
       e.preventDefault();
       let row_item = $(this).parent().parent();
       $(row_item).remove();

     }); 
  });

</script>
</body>
</html>











