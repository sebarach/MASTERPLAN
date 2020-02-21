<body class="app sidebar-fixed aside-menu-off-canvas aside-menu-hidden header-fixed  pace-done">
	<div class="app-body">
		<main class="main" style="height: 100%; ">
			<div class="container-fluid">
				<div class="animated fadeIn">
					<div class="row">
						<div class="col-md-2">
							<div class="card-body">
								<div class="btn-group">
									<a href="<?php echo base_url("clientes"); ?>" class="btn btn-lg btn-theme">
										<i class="fa fa-cubes"></i>Formularios</a>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-8">
							<div class="card border-primary mb-3">
								<div class="card-body">
									<h5 class="text-theme">Campañas asignadas</h5>
									<div class="table-responsive sales-list">
										<table class="table table-hover">
											<thead>
												<tr class="text-theme" style='text-align:center;'>
													<th>CAMPAÑA</th>
													<th>BIBLIOTECA</th>
													<th>% AVANCE</th>													
												</tr>
											</thead>
											<tbody>
												<?php
													foreach ($campanas as $c) {
														echo "<tr style='text-align:center;'>";
														echo "<td>".$c["campana"]."</td>";
														echo "<td>
														<form method='post' action='".base_url("informes/bibliotecadef")."'>
															<input type='hidden' name='id_campana' id='id_campana' value='".base64_encode($c["id_campana"])."' >
															<button class='btn btn-theme' type='submit'><i class='fa fa-book'></i></button>
														</form>
															</td>";
														if($c["implementado"]==0){
															echo "<td >0%</td>";
														} else {
															echo "<td >".round((($c["implementado"]/$c["acuerdo"])*100),2)."%</td>";
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
						<!-- <div class="col-md-6">
							<div class="card card-accent-theme">
								<div class="card-body">
									<div class="table-responsive sales-list">
										<table class="table table-hover">
											<tr>
												<th></th>
											</tr>
										</table>
									</div>
								</div>
							</div>
						</div> -->
					</div>
				</div>
			</div>
		</main>
	</div>
</body>
<script type="text/javascript">
	// $("#scrollList").niceScroll({
 //        cursorcolor: "#AEC6D2",
 //        //cursorborder:"1px solid #F3F7F9"
 //    });
</script>
<style type="text/css">
	.table th, .table td{
 		padding:0.5rem;
 		text-align: center;
 		font-size: 0.6rem;
 	}

	.border-primary {
	    border: 2px solid #f57c00;
	}
</style>