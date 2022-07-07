<?php require_once __DIR__ . '/_header.php';
//ovdje će biti forma za dodavenje nove kategorije (to mogu samo admini)
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

  <form role="form" method="post" id="add_category">
        <div class="form-group row">
          <?php echo "  la"; ?><label for="inputCategory" class="col-sm-2 col-form-label">Unesite novu kategoriju:</label>
          <div class="col-sm-5">
            <input type="text" class="form-control" id="inputCategory" name="category" placeholder="kategorija">
          </div>
        </div>

        <div class="form-group row">
          <div class="offset-sm-2 col-sm-5">
          <input type="submit" value="Dodaj" name="submit" id= "add_btn2" class="btn btn-primary"/>
          </div>
        </div>
      </form>

      <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
      <script>

      $(document).ready(function(){
      $("#add_category").submit(function(e){
         e.preventDefault();
         $("#add_btn2").val('Dodajem...');
         //console.log("tu sam");

         $.ajax({
           url: '../Recepti-projekt/controller/dodajKategoriju.php',
           method: 'post',
           data: $(this).serialize(),
           success: function(response){
           console.log(response);
             $("#add_btn2").val('Add');
             $("#add_category")[0].reset();
             $(".append_item").remove();
             $("#show_alert").html('<div class="alert alert-success" role="alert">Uspješno dodano</div>');
           }

         });
      });
     });

      </script>

</body>
</html>
<?php require_once __DIR__ . '/_footer.php'; ?>
