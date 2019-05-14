<!-- load header  -->
<?php include "../include/_layout/header.php";?>

<!-- load css for this page -->
<link rel="stylesheet" href="../include/_css/chart.css">

<!-- load js for this page -->
<script src="../include/_js/charts.js"></script>

<!-- load main area -->
<div class="row text-center full-height">
	<div class="col-md-12">

		<!-- controls are here  -->
		<div class="row mt-3 chart-control-row">
			<div class="col-md-3 form-group">
				<label for="data-select">Data:</label>
				<select id="data-select" class="form-control" name="data-select">
				</select>
			</div>
			<div class="col-md-3 form-group">
				<label for="chart-type">Chart Type:</label>
				<select id="chart-type" class="form-control" name="chart-type">
					<option value="column">Column</option>
					<option value="pie">Pie</option>
					<option value="area">Area</option>
					<option value="line">Linear</option>
					<option value="bar">Bar</option>
				</select>
			</div>
			<div class="col-md-3 form-group">
				<label for="dimX-select">DimX:</label>
				<select id="dimX-select" class="form-control" name="dimX-select">
				</select>
			</div>
			<div class="col-md-3 form-group">
				<label for="value-select">Value:</label>
				<select id="value-select" class="form-control" name="value-select">
				</select>
			</div>
		</div>
		
		<!-- render chart here  -->
		<div class="row chart-container-row">
			<div class="col-md-12 p-0">
				<div id="chart-container"></div>
			</div>
		</div>

	</div>
</div>

<!-- load footer -->
<?php include "../include/_layout/footer.php";?>