<?php

@session_start();
if(!isset($_SESSION['nome_usuario']) || $_SESSION['cargo_usuario'] != 'Administrador'){
	header("location:../index.php");
}

$pagina = 'home';
require_once("../conexao.php");

?>
<div class="row mt-2">
	<div class="col-md-12">
		<div class="col-md-6 float-left">
			<div class="card">
				<div class="card-header sortable-title bg-primary">
					Drag me 1
				</div>
				<div class="card-body">
					<p class="margin-b-0">
						Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown
						printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting,
						remaining essentially unchanged.
					</p> 
				</div>
			</div>
		</div>
		<div class="col-md-6 float-right">
			<div class="card">
				<div class="card-header sortable-title bg-indigo">
					Drag me 2
				</div>
				<div class="card-body">
					<p class="margin-b-0">
						Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown
						printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting,
						remaining essentially unchanged.
					</p> 
				</div>
			</div>
		</div>
		<div class="col-md-6 float-left">
			<div class="card">
				<div class="card-header sortable-title bg-success">
					Drag me 3
				</div>
				<div class="card-body">
					<p class="margin-b-0">
						Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown
						printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting,
						remaining essentially unchanged.
					</p> 
				</div>
			</div>
		</div>
		<div class="col-md-6 float-right">
			<div class="card">
				<div class="card-header sortable-title bg-warning">
					Drag me 4
				</div>
				<div class="card-body">
					<p class="margin-b-0">
						Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown
						printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting,
						remaining essentially unchanged.
					</p> 
				</div>
			</div>
		</div>
	</div>

</div>