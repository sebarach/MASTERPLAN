<main class="main sidebar-fixed sidebar-compact aside-menu-off-canvas aside-menu-hidden header-fixed" style="height: 100%;">
	<ol class="breadcrumb " id="breadcrumb">
		<li class="breadcrumb-item ">
	        <a href="<?php echo base_url("empresas"); ?>"><?php echo $empresa; ?></a>
	    </li>
	    <li class="breadcrumb-item ">
	        <a href="<?php echo base_url("campanas"); ?>"><?php echo $campana["campana"]; ?></a>
	    </li>
	   	<li class="breadcrumb-item active">
	        <a href="">Acciones</a>
	    </li>
	</ol>
	<div class="container-fluid">
		<div class="animated fadeIn">
			<h3>Acciones</h3>
			<div class="row">
				<div class="col-md-4">
					<div class="card">
						<div class="card-body">
							<div class="analytics-list">
								<div class="clearfix">
									<div class="float-left">
										<h6>Cantidad Puntos</h6>
										<div class="h3 text-theme"><?php echo number_format($campana["q_puntos"],0,",","."); ?></div>
										<div class="h6"><?php echo "100%&nbsp;"; ?></div>
									</div>
									<div class="float-right">
										<div class="h1 text-theme">
											<span class="mdi mdi-cards"></span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card">
						<div class="card-body">
							<div class="analytics-list">
								<div class="clearfix">
									<div class="float-left">
										<h6>Cantidad Implementados</h6>
										<div class="h3 text-theme"><?php echo number_format($campana["q_implementados"],0,",","."); ?></div>
										<div class="h6"><?php if($campana["q_implementados"]==0) { echo "0%&nbsp;"; } else { echo round(($campana["q_implementados"]/$campana["q_puntos"])*100,2)."%&nbsp;"; } ?></div>
									</div>
									<div class="float-right">
										<div class="h1 text-theme">
											<span class="mdi mdi-checkbox-multiple-marked-circle-outline"></span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card">
						<div class="card-body">
							<div class="analytics-list">
								<div class="clearfix">
									<div class="float-left">
										<h6 >Cant. Por Implementar</h6>
										<div class="h3 text-theme"><?php echo number_format(($campana["q_puntos"]-$campana["q_implementados"]),0,",","."); ?></div>
										<div class="h6"><?php if(($campana["q_puntos"]-$campana["q_implementados"])==0){ echo "0%&nbsp;"; } else { echo round(((($campana["q_puntos"]-$campana["q_implementados"])*100)/$campana["q_puntos"]),2)."%&nbsp;"; } ?></div>
									</div>
									<div class="float-right">
										<div class="h1 text-theme">
											<span class="mdi   mdi-cube-send"></span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="card card-accent-theme">
						<div class="card-body">
							<div class="table-responsive">
								<table class="display table table-hover table-striped" id="tabla5">
									<thead>
										<tr>
											<th></th>
											<th class="text-theme">ID Accion</th>
											<th class="text-theme">Accion</th>
											<th class="text-theme">Grupo Motivos</th>
											<th class="text-theme">Motivos Cliente</th>
											<th class="text-theme">Posee Materiales</th>
											<th class="text-theme">Activo Digita</th>
											<th class="text-theme">Fecha Creación</th>
											<th class="text-theme">Activo</th>
										</tr>
									</thead>
									<tbody>
										<?php
											foreach ($acciones as $a) {
												echo "<tr>";
												echo "<td style='text-align:center;' ><div class='btn-group-vertical'>";
												for($i=0; $i<count($modulos); $i++) {
													if($modulos[$i]=="Clientes_Informacion"){
														echo "<button type='button' class='btn btn-outline-theme btn-sm' onclick='clientes(\"".base64_encode($a["id_accion"])."\")' title='Master'><i class='mdi mdi-google-physical-web' ></i></button>";
													}												
												}
												echo "<button type='button' class='btn btn-outline-theme btn-sm' data-toggle='modal' data-target='#modal14' onclick='infoaccion(\"".base64_encode($a["id_accion"])."\")' title='Información'><i class='mdi mdi-chart-areaspline'></i></button>";
												echo "</div></td>";
												echo "<td>".$a["id_accion"]."</td>";
												echo "<td>".$a["accion"]."</td>";
												echo "<td>".$a["grupo_motivos"]."</td>";
												echo "<td>".$a["motivos_donde"]."</td>";
												echo "<td>".$a["posee_materiales"]."</td>";
												echo "<td>".$a["activo_digita"]."</td>";
												echo "<td>".$a["fecha_registro"]."</td>";
												if($a["activo"]==1){
													echo "<td class='status'><span class='badge badge-boxed badge-success' >".strtoupper($a["estado"])."</span></td>";
												} else {
													echo "<td class='status'><span class='badge badge-boxed badge-danger' >".strtoupper($a["estado"])."</span></td>";
												}
												echo "</tr>";
											}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
<div class="modal fade" id="modal14"  role="dialog"  aria-hidden="true">
	<div class="modal-dialog" role="document">
        <div class="modal-content">
        	<div class="modal-header ">
	           	<h6 class="modal-title"></h6>
	            <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
	                <span aria-hidden="true">×</span>
	            </button>
	        </div>
	        <div class="modal-body">
	        	<div class="row">
	        		<div class="col-md-12">
	        			<div class="card">
	        				<div class="products-widget">
	        					<div class="table-responsive">
	        						<table class="table">
	        							<tbody>	   
	        								<tr class="fecha"></tr>     								
	        							</tbody>
	        						</table>
	        					</div>
	        				</div>
	        			</div>
	        		</div>
	        	</div>
	        	<div class="row">
	        		<div class="col-md-12">
	        			<div class="card">
	        				<div class="card-body">
	        					<div class="category-progress">
	        						<div class="row">
	        							<div class="col-md-12">
	        								<div class="category-progress"></div>
	        							</div>
	        						</div>
	        					</div>
	        				</div>
	        			</div>
	        		</div>
	        	</div>
	        	<div class="row" >
	        		<div class="col-md-4">
	        			<div class="card">
	        				<div class="card-body">
	        					<div class="clearfix">
	        						<div class="float-right">
	        							<div class="h2 text-theme">
	        								<i class="mdi mdi-chart-bubble"></i>
	        							</div>
	        						</div>
	        					</div>
	        					<div class="reminder-text puntos">
	        					</div>
	        				</div>
	        			</div>
	        		</div>
	        		<div class="col-md-4" >
	        			<div class="card">
	        				<div class="card-body">
	        					<div class="clearfix">
	        						<div class="float-right">
	        							<div class="h2 text-theme">
	        								<i class="mdi mdi-chart-bubble"></i>
	        							</div>
	        						</div>
	        					</div>
	        					<div class="reminder-text implement">
	        					</div>
	        				</div>
	        			</div>
	        		</div>
	        		<div class="col-md-4" >
	        			<div class="card">
	        				<div class="card-body">
	        					<div class="clearfix">
	        						<div class="float-right">
	        							<div class="h2 text-theme">
	        								<i class="mdi mdi-chart-bubble"></i>
	        							</div>
	        						</div>
	        					</div>
	        					<div class="reminder-text pendiente">
	        					</div>
	        				</div>
	        			</div>
	        		</div>
	        	</div>
	        </div>
        </div>
    </div>
</div>
<script type="text/javascript">
	$(function () {
		$('#tabla5').DataTable({
		       
		 });
	});

	


</script>
<style type="text/css">
	th,td{
		font-size: 90% !important;
	}
</style>