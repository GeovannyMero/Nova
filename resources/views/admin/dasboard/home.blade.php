
@extends('layouts.layout')

@section('content')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">

// Load the Visualization API and the corechart package.
google.charts.load('current', {'packages':['corechart']});

// Set a callback to run when the Google Visualization API is loaded.
google.charts.setOnLoadCallback(drawChart);

// Callback that creates and populates a data table,
// instantiates the pie chart, passes in the data and
// draws it.
function drawChart() {

	// Create the data table.
	var data = new google.visualization.DataTable();
	data.addColumn('string', 'Topping');
	data.addColumn('number', 'Slices');
	data.addRows([
		@foreach($pt as $pt)
		['{{$pt->eTipoProducto}}',{{$pt->count}}],
		@endforeach

	]);

	// Set chart options
	var options = {'title':'Materia Prima y Producto Terminado',
								 'width':900,
								 'height':500,
									is3D: true,};

	// Instantiate and draw our chart, passing in some options.
	var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
	chart.draw(data, options);
}
</script>
<div class="page-title">

	<div class="title-env">
		<h1 class="title">Dashboard</h1>
	</div>

		<div class="breadcrumb-env">
			<ol class="breadcrumb bc-1" >
				<li>
					<a href="#"><i class="fa-home"></i>Inicio</a>
				</li>

				<li class="active">
					<strong>Dashboard </strong>
				</li>
			</ol>
		</div>

	</div>
	<!--grafico PieChart-->
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Tipos de Ingreso del Día</h3>
		<div class="panel-options">
			<a href="#" data-toggle="panel">
				<span class="collapse-icon">&ndash;</span>
				<span class="expand-icon">+</span>
			</a>
		</div>
	</div>
	<div class="panel-body">
		<center>
				<div id="chart_div" ></div>
		 </center>
	</div>
	</div>
	<!--Fin del PieChart-->
<div class="row">
	<div class="col-sm-12">

	<div class="form-inline">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Procesos Totales del día</h3>
				<div class="panel-options">
					<a href="#" data-toggle="panel">
						<span class="collapse-icon">&ndash;</span>
						<span class="expand-icon">+</span>
					</a>
				</div>
			</div>

		<div class="panel-body">
		<!--LLegada-->
			<div class="col-sm-3">
				<div class="xe-widget xe-counter-block " >
				<div class="xe-upper">
					<div class="xe-icon">
						<i class="linecons-truck"></i>
					</div>
					<div class="xe-label">
						<strong class="num">{{$ciclo}}</strong>
						<span class="Ingreso">camiones</span>
					</div>
				</div>
				<div class="xe-lower">
					<div class="border">
						<span>Proceso</span>
						<strong>LLegada</strong>
					</div>
				</div>
				</div>
			</div>
		<!--Ingreso-->
			<div class="col-sm-3">
				<div class="xe-widget xe-counter-block xe-counter-block-purple" >
				<div class="xe-upper">
					<div class="xe-icon">
						<i class="fa-sign-in"></i>
					</div>
					<div class="xe-label">
						<strong class="num">{{$ingreso}}</strong>
						<span class="Ingreso">camiones</span>
					</div>
				</div>
				<div class="xe-lower">
					<div class="border">
						<span>Proceso</span>
						<strong>Ingreso</strong>
					</div>
				</div>
				</div>
			</div>
			<!--Aprobacion-->
			<div class="col-sm-3">
				<div class="xe-widget xe-counter-block xe-counter-block-yellow" >
				<div class="xe-upper">
					<div class="xe-icon">
						<i class="fa-check-circle"></i>
					</div>
					<div class="xe-label">
						<strong class="num">{{$aprobacionSi}}</strong>
						<span class="Ingreso">camiones</span>
					</div>
				</div>
				<div class="xe-lower">
					<div class="border">
						<span>Proceso</span>
						<strong>Aprobación-Aceptada</strong>
					</div>
				</div>
				</div>
			</div>
			<!--Fin de Aprobacion si-->
			<!--Aprobacion No-->
			<div class="col-sm-3">
				<div class="xe-widget xe-counter-block xe-counter-block-blue" >
				<div class="xe-upper">
					<div class="xe-icon">
						<i class="fa-close"></i>
					</div>
					<div class="xe-label">
						<strong class="num">{{$aprobacionNo}}</strong>
						<span class="Ingreso">camiones</span>
					</div>
				</div>
				<div class="xe-lower">
					<div class="border">
						<span>Proceso</span>
						<strong>Aprobación-Denegada</strong>
					</div>
				</div>
				</div>
			</div>

			<!--Fin del no-->
			<!--Aprabacion en espera-->
			<div class="col-sm-3">
				<div class="xe-widget xe-counter-block xe-counter-block-turquoise" >
				<div class="xe-upper">
					<div class="xe-icon">
						<i class="fa-clock-o"></i>
					</div>
					<div class="xe-label">
						<strong class="num"></strong>
						<span class="Ingreso">camiones</span>
					</div>
				</div>
				<div class="xe-lower">
					<div class="border">
						<span>Proceso</span>
						<strong>Aprobación-Espera</strong>
					</div>
				</div>
				</div>
			</div>
			<!--Espera fin -->
			<!--Inspeccion si-->
			<div class="col-sm-3">
				<div class="xe-widget xe-counter-block xe-counter-block-info" >
				<div class="xe-upper">
					<div class="xe-icon">
						<i class="fa-check-square-o"></i>
					</div>
					<div class="xe-label">
						<strong class="num">{{$inspeccionSi}}</strong>
						<span class="Ingreso">camiones</span>
					</div>
				</div>
				<div class="xe-lower">
					<div class="border">
						<span>Proceso</span>
						<strong>Insp. Aceptada</strong>
					</div>
				</div>
				</div>
			</div>
			<!--Fin del Insp Si-->
			<!--Insp. denegado-->
			<div class="col-sm-3">
				<div class="xe-widget xe-counter-block xe-counter-block-pink" >
				<div class="xe-upper">
					<div class="xe-icon">
						<i class="fa-close"></i>
					</div>
					<div class="xe-label">
						<strong class="num">{{$inspeccionNo}}</strong>
						<span class="Ingreso">camiones</span>
					</div>
				</div>
				<div class="xe-lower">
					<div class="border">
						<span>Proceso</span>
						<strong>Insp. Denegada</strong>
					</div>
				</div>
				</div>
			</div>
			<!--fin insp denegado-->
<!--Inspeccion espera-->
<div class="col-sm-3">
	<div class="xe-widget xe-counter-block xe-counter-block-turquoise" >
	<div class="xe-upper">
		<div class="xe-icon">
			<i class="fa-clock-o"></i>
		</div>
		<div class="xe-label">
			<strong class="num"></strong>
			<span class="Ingreso">camiones</span>
		</div>
	</div>
	<div class="xe-lower">
		<div class="border">
			<span>Proceso</span>
			<strong>Inspección-Espera</strong>
		</div>
	</div>
	</div>
</div>
		<!--Pesada Inicial-->
			<div class="col-sm-3">
				<div class="xe-widget xe-counter-block xe-counter-block-danger" >
				<div class="xe-upper">
					<div class="xe-icon">
						<i class="fa-download"></i>
					</div>
					<div class="xe-label">
						<strong class="num">{{$pesadaI}}</strong>
						<span class="Ingreso">camiones</span>
					</div>
				</div>
				<div class="xe-lower">
					<div class="border">
						<span>Proceso</span>
						<strong>Pesada Inicial</strong>
					</div>
				</div>
				</div>
			</div>
		<!--carga-->
			<div class="col-sm-3">
				<div class="xe-widget xe-counter-block xe-counter-block-orange " >
				<div class="xe-upper">
					<div class="xe-icon">
						<i class="glyphicon glyphicon-shopping-cart"></i>
					</div>
					<div class="xe-label">
						<strong class="num">{{$movimiento}}</strong>
						<span class="Ingreso">camiones</span>
					</div>
				</div>
				<div class="xe-lower">
					<div class="border">
						<span>Proceso</span>
						<strong>Carga/Descarga</strong>
					</div>
				</div>
				</div>
			</div>
		<!--Pesada Final-->
			<div class="col-sm-3">
				<div class="xe-widget xe-counter-block xe-counter-block-red " >
				<div class="xe-upper">
					<div class="xe-icon">
						<i class="linecons-cloud"></i>
					</div>
					<div class="xe-label">
						<strong class="num">{{$pesadaF}}</strong>
						<span class="Ingreso">camiones</span>
					</div>
				</div>
				<div class="xe-lower">
					<div class="border">
						<span>Proceso</span>
						<strong>Pesada Final</strong>
					</div>
				</div>
				</div>
			</div>
		<!--SAlida-->
			<div class="col-sm-3">
				<div class="xe-widget xe-counter-block xe-counter-block-turquoise " >
				<div class="xe-upper">
					<div class="xe-icon">
						<i class="fa-sign-out"></i>
					</div>
					<div class="xe-label">
						<strong class="num">{{$salida}}</strong>
						<span class="Ingreso">camiones</span>
					</div>
				</div>
				<div class="xe-lower">
					<div class="border">
						<span>Proceso</span>
						<strong>Salida</strong>
					</div>
				</div>
				</div>
			</div>
		</div>

		</div>

	<!--TOTAL DEL DIA-->
	<div class="panel panel-default">
		<div class="panel-headimg">
			<h3 class="panel-title">Total del día</h3>
			<div class="panel-options">
				<a href="#" data-togle="panel">
					<span class="collapse-icon">&ndash;</span>
					<span class="expand-icon"></span>
				</a>
			</div>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-sm-10">
					<div class="xe-widget xe-counter">
						<div class="xe-icon">
							<i class="linecons-truck"></i>
						</div>
						<div class="xe-label">
							<strong>{{$salida}}</strong>
							<span>Ingreso del día de hoy</span>
						</div>
					</div>
				</div>
				<div class="col-sm-10">
					<div class="xe-widget xe-counter xe-counter-red">
						<div class="xe-icon">
							<i class="fa-warning"></i>
						</div>
						<div class="xe-label">
							<strong>{{$in}}</strong>
							<span>Ingreso con incidentes</span>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>

	</div>

	</div>
</div>


		<script src="{{ asset('assets/js/datatables/js/jquery.datatables.min.js') }}"></script>
		<script src="{{ asset('assets/js/jquery-validate/jquery.validate.min.js') }}"></script>
		<script src="{{ asset('assets/js/datepicker/bootstrap-datepicker-es.js') }}"></script>






	@endsection
