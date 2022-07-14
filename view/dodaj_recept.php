<?php require_once __DIR__ . '/_header.php'; ?>


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

body {
  font-family: Arial, Helvetica, sans-serif; 
        background-repeat: no-repeat;
        background-attachment: fixed;  
        background-size: auto;
        background-position: center bottom; /*Positioning*/

}

	  .h3{
		font-family: "Brush Script MT", "Lucida Handwriting";
		font-style: italic;
		text-align: center;
		color: white;
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
  background-color: white;
  padding: 10px;
}
  </style>

</head>
<body style = "background-color: white;">


<h3 class="h3 my-2 font-weight-light" style = "background-color: white;"><?php echo $title; ?></h3>

<!-- Tu ide forma za unos recepta -->
<div class="container" style = "background-color: white;">
  <div class="row my-4" style = "background-color: white;">
    <div class="col-lg-10 mx-auto" style = "background-color: white;">
      <div class="card shadow" style = "background-color: white;">
        <div class="card-header" style = "background-color: white;">
          <h4 style="color: #A60E2E">Dodaj recept</h4>
        </div>
        <div class="card-body p-4" style = "background-color: white;">
          <div id="show_alert"></div>
          <form class="#" method="post" id="add_form" style = "background-color: white;">
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
            <p>Označite kojoj kategoriji jelo pripada: </p>
              <?php   //tu zapravo ispisujemo sve kategorije u obliku checkboxa kako bismo onda u bazu mogli pospremiti id tog recepta i njegove kategorije (moguće više kategorija)

              for($i=0; $i<count($kategorije); $i++)
              {
                ?>
                  <input type="checkbox" name="categories[]" value="<?php echo $kategorije[$i]->id ?>" id="<?php echo $kategorije[$i]->name ?>">
                   <label for="<?php echo $kategorije[$i]->name ?>"> <?php echo $kategorije[$i]->name ?> </label>

               <?php
              }
              ?>
            <div>

            </div>

            <div class="">
              <input type="submit" id="add_btn" value="Dodaj" class="btn btn-primary w-25" style="background-color: #A60E2E; border-color: #A60E2E; ; ">
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
     //tu ćemo napisati ajax zahtjev kako bismo poslali te podatke od recepta i onda ih spremili u bazu
     $("#add_form").submit(function(e){
        e.preventDefault();
        $("#add_btn").val('Dodajem...');
        //console.log("tu sam");

        $.ajax({
          url: '../Recepti-projekt/controller/action.php',
          method: 'post',
          data: $(this).serialize(),
          success: function(response){
          //console.log(response);
            $("#add_btn").val('Add');
            $("#add_form")[0].reset();
            $(".append_item").remove();
            $("#show_alert").html('<div class="alert alert-success" role="alert">Uspješno dodano</div>');
          }

        });
     });
    });


</script>
</body>
</html>
