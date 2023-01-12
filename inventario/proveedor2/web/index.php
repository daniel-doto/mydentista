<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="witdth-device-width, initial-scale-1.0">
	<meta http-equiv="X-UA-Compatible" content="ie-edge">
	<title>Dashboard-Proveedor 1</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../web/css/style.css">
</head>
<body>

	<div class="container">
		<div class="row">
		<div class="col-md-4">
			<div class="bg-success text-white text-center mb-3">
  			<div class="card-header">Total de stock</div>
  			<div class="card-body">
   			 <h1 class="card-title"><span id="idstock">35</span></h1>
    <p class="card-text">Total de productos en stock.</p>
  </div>
		</div>
	</div>
		<div class="col-md-4">
			<div class="bg-warning text-white text-center m-1">
  			<div class="card-header">Total de stock de productos registrados</div>
  			<div class="card-body">
   			 <h1 class="card-title"><span id="idalmacen">35</span></h1>
    <p class="card-text">Total de productos registrados</p>
  </div>
		</div>
		</div>

		<div class="col-md-4">
				<div class="bg-info text-white text-center m-1">
  			<div class="card-header">Total gastado</div>
  			<div class="card-body">
   			 <h1 class="card-title"><span id="idgastos">35</span></h1>
    <p class="card-text">Costo total gastado en productos</p>
  </div>
		</div>
		</div>
</div>
</div>

<div class="container">
		<div class="row">
		</div>
		<div class="row-my-3">
			<div class="col-md-12 text-center">
  			<h2>Reporte de gastos</h2>
   			 <canvas id="idgrafica" class="grafica"></canvas>
  </div>
		</div>
		<div class="row-my-3">
			<div class="col-md-12 text-center">
  			<div id="idcontabla"></div>
  </div>
		</div>
	</div>




<script type="text/javascript" src="../web/js/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script type="text/javascript" src="../web/js/index.js"></script>

</body>
</html>