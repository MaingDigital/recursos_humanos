<?php 

require_once("../conexao.php");
@session_start();

if(@$_SESSION['nivel_usuario'] == null || @$_SESSION['nivel_usuario'] != 'Administrador'){
    echo "<script language='javascript'> window.location='../index.php' </script>";
}

// Array com os dias da semana
$diasemana = array('Domingo', 'Segunda Feira', 'Terça Feira', 'Quarta Feira', 'Quinta Feira', 'Sexta Feira', 'Sábado');

// Aqui podemos usar a data atual ou qualquer outra data no formato Ano-mês-dia (2014-02-28)
$data = date('Y-m-d');

// Varivel que recebe o dia da semana (0 = Domingo, 1 = Segunda ...)
$diasemana_numero = date('w', strtotime($data));

// Exibe o dia da semana com o Array

//RECUPERAR DADOS DO USUÁRIO
$query = $pdo->query("SELECT * FROM usuarios where id = '$_SESSION[id_usuario]'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$nome_usu = @$res[0]['nome'];
$nif_usu = @$res[0]['nif'];
$email_usu = @$res[0]['email'];

//variaveis para o menu
$pag = @$_GET["pag"];
$menu1 = "funcionarios";
$menu2 = "novo_funcionario";
$menu3 = "menu3";
$menu4 = "menu4";
$menu5 = "menu5";
$menu6 = "menu6";


?>
<!DOCTYPE html>
<html lang="pt-pt">
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Administração | Mais RH</title>
		<link rel="icon" type="image/png" sizes="16x16" href="../assets/img/icon.png">
		
        <!-- jQuery library-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <!-- Common Plugins -->
        <link href="../assets/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		
		<!-- Vector Map Css-->
        <link href="../assets/lib/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
		
		<!-- Chart C3 -->
		<link href="../assets/lib/chart-c3/c3.min.css" rel="stylesheet">
		<link href="../assets/lib/chartjs/chartjs-sass-default.css" rel="stylesheet">

        <!-- DataTables -->
        <link href="../assets/lib/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
        <link href="../assets/lib/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="../assets/lib/toast/jquery.toast.min.css" rel="stylesheet">
        <link href="../assets/lib/datatables/buttons.dataTables.css" rel="stylesheet" type="text/css">
		
        <!-- Custom Css-->
        <link href="../assets/css/style.css" rel="stylesheet">

    </head>
    <body>
		<div class="top-bar primary-top-bar">
			<div class="container-fluid">
				<div class="row">
					<div class="col">
						<a class="admin-logo" href="index.php?pag=home">
							<h1>
								<img alt="" src="../assets/img/icon.png" class="logo-icon margin-r-2 mt-2" style="width: 40px">
								<img alt="" src="../assets/img/logo-dark.png" class="toggle-none hidden-xs" style="width: 120px">
							</h1>
						</a>				
						<div class="left-nav-toggle" >
							<a  href="#" class="nav-collapse"><i class="fa fa-bars"></i></a>
						</div>
						<div class="left-nav-collapsed" >
							<a  href="#" class="nav-collapsed"><i class="fa fa-bars"></i></a>
						</div>
						<div class="search-form hidden-xs">
							<style type="text/css">
                                    h4{
                                        color: #FFFFFF;
                                        margin-top: 6px;
                                    }                        
                                </style>
							<h4><?php
                      echo  $diasemana[$diasemana_numero]; ?> <?php $date = date('d-m-Y'); echo $date;?></h4>
						</div>
						<ul class="list-inline top-right-nav">
							<li>
								<a  href="#"><i class="fa fa-envelope"></i></a>
							</li>
							<li>
								<a href="#"><i class="fa fa-book"></i> </a>
								
							</li>
							
							<li class="dropdown avtar-dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#">
									<img alt="" class="rounded-circle" src="../assets/img/avtar-2.png" width="30">
									<?php echo @$_SESSION['nome_usuario']; ?>
								</a>
								<ul class="dropdown-menu top-dropdown">
									<li>
										<a href="" data-toggle="modal" data-target="#ModalNotas" title="Minhas Notas"><i class="icon-docs"></i> Notas</a>
									</li>
									<li>
										<a href="" data-toggle="modal" data-target="#ModalPerfil" title="Meu Perfil"><i class="icon-user"></i> Perfil</a>
									</li>
									<li>
										<a class="dropdown-item" href="javascript:%20void(0);"><i class="icon-settings"></i> Definições</a>
									</li>
									<li class="dropdown-divider"></li>
									<li>
										<a class="dropdown-item" href="../logout.php"><i class="icon-logout"></i> Terminar Sessão</a>
									</li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>

        <div class="main-sidebar-nav default-navigation">
            <div class="nano">
                <div class="nano-content sidebar-nav">
				
					<div class="card-body border-bottom text-center nav-profile">
						<div class="notify setpos"> 
							<span class="heartbit"></span> 
							<span class="point"></span> 
						</div>
                        <img alt="profile" class="margin-b-10  " src="../assets/img/avtar-2.png" width="80">
                        <p class="lead margin-b-0 toggle-none"><?php echo @$_SESSION['nome_usuario']; ?></p>
                        <p class="text-muted mv-0 toggle-none">Bem-vindo</p>						
                    </div>
					
                    <ul class="metisMenu nav flex-column" id="menu">
                        <li class="nav-heading"><span>PESSOAL</span></li>

						<li class="nav-item">
							<a class="nav-link" href="index.php?pag=<?php echo $menu4 ?>">
								<i class="fa fa-database"></i> 
								<span class="toggle-none">
									Cargos
								</span>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="index.php?pag=<?php echo $menu1 ?>">
								<i class="fa fa-users"></i> 
								<span class="toggle-none">
									Funcionários
								</span>
							</a>
						</li>
						<li class="nav-heading"><span>PAGAMENTOS</span></li>

						<li class="nav-item">
							<a class="nav-link" href="index.php?pag=<?php echo $menu3 ?>">
								<i class="fa fa-cc-visa"></i> 
								<span class="toggle-none">
									Proc. Salário
								</span>
							</a>
						</li>	
                    </ul>
                </div>
            </div>
        </div>
		
        <section class="main-content">
            <div class="row w-no-padding margin-b-30 mt-4" style="background-color: #ffffff;">
            	<?php if (@$pag == null) { 
                            @include_once("home.php"); 
                            
                        } else if (@$pag==$menu1) {
                            @include_once(@$menu1.".php");
                            
                        } else if (@$pag==$menu2) {
                            @include_once(@$menu2.".php");

                        } else if (@$pag==$menu3) {
                            include_once(@$menu3.".php");

                        } else if (@$pag==$menu4) {
                            @include_once(@$menu4.".php");

                        } else if (@$pag==$menu5) {
                            @include_once(@$menu5.".php");

                        } else if (@$pag==$menu6) {
                            @include_once(@$menu6.".php");
                        } else {
                            @include_once("home.php");
                        }
                        ?>
			</div>
				
            <footer class="footer">
                <span>Copyright &copy; 2020 MaingDigital</span>
            </footer>

        </section>
        <!-- Common Plugins -->
        <script src="../assets/lib/jquery/dist/jquery.min.js"></script>
		<script src="../assets/lib/bootstrap/js/popper.min.js"></script>
        <script src="../assets/lib/bootstrap/js/bootstrap.min.js"></script>
        <script src="../assets/lib/pace/pace.min.js"></script>
        <script src="../assets/lib/jasny-bootstrap/js/jasny-bootstrap.min.js"></script>
        <script src="../assets/lib/slimscroll/jquery.slimscroll.min.js"></script>
        <script src="../assets/lib/nano-scroll/jquery.nanoscroller.min.js"></script>
        <script src="../assets/lib/metisMenu/metisMenu.min.js"></script>
        <script src="../assets/js/custom.js"></script>
			
        <!--Chart Script-->
        <script src="../assets/lib/chartjs/chart.min.js"></script>
		<script src="../assets/lib/chartjs/chartjs-sass.js"></script>

		<!--Vetor Map Script-->
		<script src="../assets/lib/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
        <script src="../assets/lib/vectormap/jquery-jvectormap-us-aea-en.js"></script>
		
		<!-- Chart C3 -->
        <script src="../assets/lib/chart-c3/d3.min.js"></script>
        <script src="../assets/lib/chart-c3/c3.min.js"></script>
	
        <!-- Datatables-->
        <script src="../assets/lib/datatables/jquery.dataTables.min.js"></script>
        <script src="../assets/lib/datatables/dataTables.responsive.min.js"></script>

		<script src="../assets/lib/datatables/dataTables.buttons.min.js"></script>
		<script src="../assets/lib/datatables/jszip.min.js"></script>
		<script src="../assets/lib/datatables/pdfmake.min.js"></script>
		<script src="../assets/lib/datatables/vfs_fonts.js"></script>
		<script src="../assets/lib/datatables/buttons.html5.min.js"></script>
        <script>
            $(document).ready(function () {
                $('#datatable').dataTable();
				
				$('#datatable2').DataTable({
					 dom: 'Bfrtip',
					buttons: [
						'copyHtml5',
						'excelHtml5',
						'csvHtml5',
						'pdfHtml5'
					]
				});
				
				 $('#datatable3').DataTable( {
					"scrollY":        "400px",
					"scrollCollapse": true,
					"paging":         false
				} );
            });
			
        </script>
		
    </body>
</html>

<div class="modal" id="ModalPerfil" tabindex="-1" role="dialog" aria-labelledby="myDefaultModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-times"></span></button>
                        <h5 class="modal-title" id="myDefaultModalLabel">Meu Perfil</h5>
                    </div>
                    <form id="form-perfil" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">

                                   <div class="form-group">
                                        <label >Nome</label>
                                        <input value="<?php echo $nome_usu ?>" type="text" class="form-control" id="nome_usu" name="nome_usu" placeholder="Nome">
                                    </div>

                                    <div class="form-group">
                                        <input value="<?php echo $nif_usu ?>" type="hidden" class="form-control" id="nif" name="nif_usu" placeholder="NIF">
                                    </div>

                                    <div class="form-group">
                                        <label >Email</label>
                                        <input value="<?php echo $email_usu ?>" type="email" class="form-control" id="email_usu" name="email_usu" placeholder="Email">
                                    </div>

                                    <div class="form-group">
                                        <label >Senha</label>
                                        <input value="" type="password" class="form-control" id="senha_usu" name="senha_usu" placeholder="Senha">
                                    </div>
                                
                                   
                           
                            <small>
                                <div id="mensagem" class="mr-4">

                                </div>
                            </small>

                    </div>
                    <div class="modal-footer">
                    	<input value="<?php echo $_SESSION['id_usuario'] ?>" type="hidden" name="id_usu" id="id_usu">
                        <input value="<?php echo $nif_usu ?>" type="hidden" name="antigo_usu" id="antigo_usu">

                        <button type="button" id="btn-fechar-perfil" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="submit" name="btn-salvar-perfil" id="btn-salvar-perfil" class="btn btn-primary">Salvar</button>
                        
                    </div>
                </form>
                </div>
            </div>
        </div>

<!--AJAX PARA INSERÇÃO E EDIÇÃO DOS DADOS COM OU SEM IMAGEM -->
<script type="text/javascript">
    $("#form-perfil").submit(function () {
       
        event.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: "editar-perfil.php",
            type: 'POST',
            data: formData,

            success: function (mensagem) {
                $('#mensagem').removeClass()
                if (mensagem.trim() == "Salvo com Sucesso!") {
                    //$('#nome').val('');
                    $('#btn-fechar-perfil').click();
                    window.location = "index.php";
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