<?php 
require_once("conexao.php");

$query = $pdo->query("SELECT * FROM usuarios where nivel = 'Administrador'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_registo = @count($res);
    if ($total_registo == 0){
        $res = $pdo->query("INSERT INTO usuarios SET nome = 'Administrador', nif = '0000000', email = '$email_adm', senha = '123', nivel = 'Administrador'");
    }
 ?>
<!DOCTYPE html>
<html lang="pt-pt">
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login | Mais RH</title>
        <link rel="icon" type="image/png" sizes="16x16" href="assets/img/icon.png">

        <!-- Common Plugins -->
        <link href="assets/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom Css-->
        <link href="assets/css/style.css" rel="stylesheet">
        <style type="text/css">
            html,body{
                height: 100%;
            }
        </style>
    </head>
    <body class="bg-light">

        <div class="misc-wrapper">
            <div class="misc-content">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-4">
                              <div class="misc-header text-center">
								<style type="text/css">
                                    h2{
                                        font-family: broadway;
                                        font-size: 65px;
                                        color: #4266B2;
                                        margin-bottom: -50px;
                                    }                        
                                </style>
								<h2>MAIS RH.</h2>
                            </div>
                            <div class="misc-box">  
                            <hr> 
                                <form role="form" action="autenticar.php" method="post">
                                    <div class="form-group">                                      
                                        <label  for="exampleuser1">E-mail</label>
                                        <div class="group-icon">
                                        <input id="email" name="email" type="email" placeholder="E-mail" class="form-control" required="" autofocus>
                                        <span class=" icon-envelope text-muted icon-input"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Senha</label>
                                        <div class="group-icon">
                                        <input id="senha" name="senha" type="password" placeholder="Senha" class="form-control">
                                        <span class="icon-lock text-muted icon-input"></span>
                                        </div>
                                    </div>
                                    <div class="clearfix">
                                    <button type="submit" class="btn btn-block btn-primary box-shadow">Login</button>
                                    </div>
                                    <hr>
                                    <div>
                                        <div class="float-left" style="margin-top: -25px;">
                                           <div class="checkbox checkbox-primary margin-r-1">
                                                <input id="checkbox2" type="checkbox" checked="">
                                                <label for="checkbox2"> Lembrar-Me </label>
                                            </div>
                                        </div>
                                        <div class="float-right">
                                            <a href="" data-toggle="modal" data-target="#modalRecuperar" title="Recuperar a senha"> Recuperar senha? </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="text-center misc-footer mt-4" style="">
                               <p>Copyright &copy; 2020 MaingDigital</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Common Plugins -->
        <script src="assets/lib/jquery/dist/jquery.min.js"></script>
        <script src="assets/lib/bootstrap/js/popper.min.js"></script>
        <script src="assets/lib/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/lib/pace/pace.min.js"></script>
        <script src="assets/lib/jasny-bootstrap/js/jasny-bootstrap.min.js"></script>
        <script src="assets/lib/slimscroll/jquery.slimscroll.min.js"></script>
        <script src="assets/lib/nano-scroll/jquery.nanoscroller.min.js"></script>
        <script src="assets/lib/metisMenu/metisMenu.min.js"></script>
        <script src="assets/js/custom.js"></script>
		
    </body>
</html>

<div class="modal" id="modalRecuperar" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-times"></span></button>
                        <h5 class="modal-title" id="mySmallModalLabel">Recuperar Senha</h5>
                    </div>
                    <form method="POST" id="form">
                    <div class="modal-body">
                     <div class="form-group">
                        <label>Insira o seu e-mail para recuperar a sua senha.</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="E-mail" autofocus>
                    </div>
                    <small>
                        <div id="mensagem">

                        </div>
                    </small>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Recuperar</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

<!--AJAX PARA INSERÇÃO E EDIÇÃO DOS DADOS COM OU SEM IMAGEM -->
<script type="text/javascript">
    $("#form").submit(function () {
        
        event.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url:"recuperar.php",
            type: 'POST',
            data: formData,

            success: function (mensagem) {
                $('#mensagem').removeClass()
                if (mensagem.trim() == "A sua senha foi Enviada para seu Email!") {
                    //$('#email').val('');
                    //$('#btn-fechar').click();
                    $('#mensagem').addClass('text-success')
                } else {
                    $('#mensagem').addClass('text-danger')
                }
                $('#mensagem').text(mensagem)
            },

            cache: false,
            contentType: false,
            processData: false,
            xhr: function () {  // Custom XMLHttpRequest
                var myXhr = $.ajaxSettings.xhr();
                if (myXhr.upload) { // Avalia se tem suporte a propriedade upload
                    myXhr.upload.addEventListener('progress', function () {
                        /* faz alguma coisa durante o progresso do upload */
                    }, false);
                }
                return myXhr;
            }
        });
    });
</script>
<script type="text/javascript">
$(".modal-header").on("mousedown", function(mousedownEvt) {
    var $draggable = $(this);
    var x = mousedownEvt.pageX - $draggable.offset().left,
        y = mousedownEvt.pageY - $draggable.offset().top;
    $("body").on("mousemove.draggable", function(mousemoveEvt) {
        $draggable.closest(".modal-dialog").offset({
            "left": mousemoveEvt.pageX - x,
            "top": mousemoveEvt.pageY - y
        });
    });
    $("body").one("mouseup", function() {
        $("body").off("mousemove.draggable");
    });
    $draggable.closest(".modal").one("bs.modal.hide", function() {
        $("body").off("mousemove.draggable");
    });
});
</script>
<style type="text/css">
    .modal-header {
    cursor: move;
}
</style>