<body class="app sidebar-fixed aside-menu-off-canvas aside-menu-hidden header-fixed  pace-done">
	<div class="app-body">
		<main class="main" style="height: 100%; ">
			<div class="container-fluid">
				<div class="animated fadeIn">
					<div class="row">
						<div class="col-md-6">
							<div class="card card-accent-theme">
								<div class="card-body">
									<h4 class="text-theme">Campañas asignadas</h4>
									<div class="table-responsive sales-list">
										<table class="table table-hover">
											<thead>
												<tr class="text-theme">
													<th>Campaña</th>
													<th>Porcentaje Avance</th>
												</tr>
											</thead>
											<tbody>
												<?php
													foreach ($campanas as $c) {
														echo "<tr>";
														echo "<td>".$c["campana"]."</td>";
														if($c["implementado"]==0){
															echo "<td>0%</td>";
														} else {
															echo "<td>".round((($c["implementado"]/$c["acuerdo"])*100),2)."%</td>";
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
	$("#scrollList").niceScroll({
        cursorcolor: "#AEC6D2",
        //cursorborder:"1px solid #F3F7F9"
    });
</script>
<style type="text/css">
	.todo-widget li{
		font-size: 0.84rem !important;
		padding-left: 1rem;
	}

	.badge{
		font-size: 120%;
	}
</style>