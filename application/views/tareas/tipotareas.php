<body class="app sidebar-fixed aside-menu-off-canvas aside-menu-hidden header-fixed  pace-done">
	<div class="app-body">
		<main class="main" style="height: 100%;">
		    <ol class="breadcrumb" id="breadcrumb">
			    <li class="breadcrumb-item active">
			        <a href="">Grupos Tareas</a>
			    </li>
			</ol>
			<div class="container-fluid">
		        <div class="animated fadeIn">
		        	<h3>Grupos Tareas</h3>
		            <div class="row">
		            	<div class="col-md-12">
		            		<div class="row">
		            			<div class="col-md-5">
		            				<form class="form-group" id="form1" method="POST" action="<?php echo base_url("tareas"); ?>">
		            					<select class="form-control" name="id_empresa" id="id_empresa" onchange="filtrar()">
		            						<?php
		            							if($empresa==0){
		            								echo "<option value='0'>Seleccionar Grupo Tareas</option>";
		            							}
		            							foreach ($emp as $e) {
		            								if($empresa==$e["id_empresa"]){
		            									$selected="selected";
		            								} else {
		            									$selected="";
		            								}
		            								echo "<option value='".$e["id_empresa"]."'  ".$selected.">".$e["empresa"]."</option>";
		            							}
		            						?>
		            					</select>
		            				</form>
		            			</div>
		            			<div class="col-md-1">
		            				<a href="<?php echo base_url("tareas"); ?>" class="btn btn-sm btn-theme"><i class="fa fa-refresh"></i></a>
		            			</div>
		            		</div>
		            		<div class="row">
		            			<?php
		            			$it=0;
		            			foreach ($empresas as $e) { 
		            				echo "<div class='col-md-2' onclick='tareas(\"".base64_encode($e["id_empresa"])."\")'>";
		            				echo "<div class='card border-primary mb-3' >";
		            				echo "<div class='card-body text-center' >
		            				<div class='h1 text-theme'><i class='mdi mdi-file-check'></i></div>";
		            				if(strlen($e["empresa"])<20){
		            					echo "<small>".$e["empresa"]."</small><br>";
		            				} else {
		            					echo "<small>".$e["empresa"]."</small>";
		            				}
		            				echo "</div>";
		            				echo "</div>";
		            				echo "</div>";	

		            			}
		            			?>
		            		</div>
		            	</div>
		            </div>
		        </div>
		    </div>
		</main>
	</div>
</body>
<style type="text/css">
	small{
		color:#f57c00 !important;
		display:block;
	    width:100%;
	    word-wrap:break-word;
	    text-transform: uppercase;
	    font-size: 0.8rem;
	    font-weight: 600;
	}

	.col-md-2{
		cursor: pointer;
	}

	.card-body{
		padding: 0.75rem;
	}

	.h1{
		margin-bottom: 0px;
	}
</style>
<script type="text/javascript">
	$("#id_empresa").select2();

	function filtrar(){
		$("#form1").submit();
	}
</script>