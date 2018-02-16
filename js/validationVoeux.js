$('document').ready(function()
{
    /* validation */
    $("#voeux-form").validate({
        rules:
            {
                lastname: {
                    required: true,
                },
                firstname: {
                    required: true,
                }
            },
        messages:
            {
                lastname:{
                    required: "Veuillez saisir votre nom"
                },
                firstname:{
                    required: "Veuillez saisir votre prénom"
                }
            },
        submitHandler: submitForm
    });
    /* validation */

    /* formulaire voeux submit */
    function submitForm()
    {
        var data = $("#voeux-form").serialize();

        $.ajax({

            type : 'POST',
            url  : '../validationVoeux.php',
            data : data,
            beforeSend: function()
            {
                $("#error").fadeOut();
                $("#btn-login").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; sending ...');
            },
            success :  function(response)
            {
                if(response=="ok"){

                    $("#btn-login").html('<img src="btn-ajax-loader.gif" /> &nbsp; Signing In ...');
                    setTimeout(' window.location.href = "../index.php"; ',4000);
                }
                else{

                    $("#error").fadeIn(500, function(){
                        $("#error").html('<div class="alert">\n' +
                            '  <span class="closebtn">&times;</span>  \n' +
                            '  <b>Erreur ! </b>La connexion est impossible.\n' +
                            '</div>');
                    });
                }
            }
        });
        return false;
    }
});