$('document').ready(function()
{
    /* validation */
    $("#login-form").validate({
        rules:
            {
                password: {
                    required: true,
                },
                user_email: {
                    required: true,
                    email: true
                }
            },
        messages:
            {
                password:{
                        required: "Veuillez saisir votre mot de passe"
                },
                user_email: "Veuillez saisir votre nom d'utilisateur"
            },
        submitHandler: submitForm
    });
    /* validation */

    /* login submit */
    function submitForm()
    {
        var data = $("#login-form").serialize();

        $.ajax({

            type : 'POST',
            url  : '../connexion.php',
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
    /* login submit */
});