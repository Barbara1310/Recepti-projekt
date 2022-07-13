<!--<form action="recipes.php?rt=recipes/dodajOcjenu" method="post">-->
<?php echo '<input type="hidden" name="id_recepta" id="id_recepta" value = "' . $recept->id . '">'; ?>
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
        echo '<p id="infoOcjena"> Još niste ocjenili recept!</p>';
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
                            $("#infoOcjena").html('Vaša ocjena: ' + mojaOcjena);
                            $("#ocjeni").hide();
                            $("#zvijezdice").hide();
                            for(let i=1; i <= mojaOcjena; i++ ){
                                let zvijezdica = $("<span>");
                                zvijezdica.prop('class', 'mojaZvijezdica');
                                zvijezdica.html('★');
                                zvijezdica.prop(checked, true);
                                $("#infoOcjena").append(zvijezdica);
                            }
                            for(let i= mojaOcjena+1; i<=5; i++ ){
                                let zvijezdica = $("<span>");
                                zvijezdica.prop('class', 'mojaZvijezdica');
                                zvijezdica.html('☆');
                                $("#infoOcjena").append(zvijezdica);
                            }
                            if($("#prosjecnaOcjena").val()=='Nema ocjena:('){
                                $("#pro").val(mojaOcjena);
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