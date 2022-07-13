<!--<form action="recipes.php?rt=recipes/dodajOcjenu" method="post">-->
<?php echo '<input type="hidden" name="id_recepta" id="id_recepta" value = "' . $recept->id . '">'; ?>
<?php echo '<input type="hidden" name="sumaOcjena" value = "' . $sumaOcjena . '">'; ?>
<?php echo '<input type="hidden" name="brojOcjena" value = "' . $brojOcjena . '">'; ?>
<div style =" align:center; ">
    <?php
        if($ocjena != NULL ){
            echo '<p id="infoOcjena"> Vaša ocjena: ' ;//$ocjena; 
            for($i = 1; $i <= $ocjena; $i++)
            {
                echo '<span class="mojaZvijezdica" checked>★</span>';
            }
            for($i = $ocjena + 1; $i <= 5; $i++)
                echo '<span class="mojaZvijezdica">☆</span>';
            ?>
            </p>
    <?php }
    else { 
        echo '<p id="infoOcjena2"> Još niste ocijenili recept!</p>';
        ?>
    <div class = "star-rating" id = "zvijezdice">
        <input type="radio" name="rating" id="star5" value = "5" class ="stars">
        <label for="star5"></label>
        <input type="radio" name="rating" id="star4" value = "4" class ="stars">
        <label for="star4"></label>
        <input type="radio" name="rating" id="star3" value = "3" class ="stars">
        <label for="star3"></label>
        <input type="radio" name="rating" id="star2" value = "2"  class ="stars">
        <label for="star2"></label>
        <input type="radio" name="rating" id="star1" value = "1" class ="stars">
        <label for="star1"></label>
    </div>
    <button id="ocjeni" name="ocjeni" type="sumbit" class = "gubmic">Ocjeni!</button>
    <?php } ?>
</div>
<!--</form>-->

<script>
    $(document).ready(function()
        {
            $('#ocjeni').on('click', function()
            {
                let mojaOcjena = 0;
                let idRecepta = $("#id_recepta").val();
                console.log(idRecepta);
                for(let i = 1; i < 6; i++){
                    if($("#star" + i).is(":checked"))
                        mojaOcjena = $("#star" + i).val();
                }
                console.log('idemo');
                console.log(mojaOcjena);
                if(mojaOcjena !== 0)
                {
                    $.ajax(
                    {
                        url: '../Recepti-projekt/controller/dodajOcjenu.php',
                        data:
                        {
                            idRecepta: idRecepta,
                            mojaOcjena: mojaOcjena
                        },
                        type: "POST",
                        //dataType: "json", // očekivani povratni tip podatka
                        success: function( data ) {
                            $("#show_alert").html('<div class="alert alert-success" role="alert">Uspješno dodano</div>');
                            console.log('uspjesno');
                            $("#infoOcjena2").html('Vaša ocjena: ');
                            $("#ocjeni").hide();
                            $("#zvijezdice").hide();
                            for(let i=1; i <= mojaOcjena; i++ ){
                                console.log('i je ' + i);
                                let zvijezdica = $("<span>");
                                zvijezdica.prop('class', 'mojaZvijezdica');
                                zvijezdica.html('★');
                                zvijezdica.val('★');
                                //zvijezdica.prop('checked', true);
                                $("#infoOcjena2").append(zvijezdica);
                            }
                            console.log('mojaOcjena je ' + mojaOcjena);
                            for(let j=1 + mojaOcjena; j < 6; j++ ){
                                console.log('j je ' + j);
                                let zvijezdica = $("<span>");
                                zvijezdica.prop('class', 'mojaZvijezdica');
                                zvijezdica.html('☆');
                                zvijezdica.val('☆');
                                $("#infoOcjena2").append(zvijezdica);
                            }
                            //console.log($("#infoOcjena2"));
                            if($("#pro").val()=='Nema ocjena:(' || $("#pro").html()=='Nema ocjena:('){
                                $("#pro").val(mojaOcjena);
                                $("#pro").html(mojaOcjena);
                            }
                            else{
                                console.log('pro' + $("#pro").val());
                                console.log('pro' + $("#pro").html());
                                let brojOcjena = $("#brojOcjena").val();
                                let sumaOcjena = $("#sumaOcjena").val();
                                console.log((sumaOcjena + mojaOcjena)/(brojOcjena +1));
                                $("#pro").val((sumaOcjena + mojaOcjena)/(brojOcjena +1));
                                $("#pro").html((sumaOcjena + mojaOcjena)/(brojOcjena +1));
                            }
                    
                        },
                        error: function( xhr, status, errorThrown ) { 
                            if( status !== null )
                                //console.log( "ajax::error" );
                                console.log( "Greška prilikom Ajax poziva: " + status );
                        }
                    } );
                }
            });   
        });

</script>