@extends('layouts.layout')

@section('content')
					
			
<div class="page-title">

	<div class="title-env">
		<h1 class="title">Conductor</h1>
		<!--<p class="description">Dynamic table variants with pagination and other controls</p>-->
	</div>

	<div class="breadcrumb-env">

		<ol class="breadcrumb bc-1" >
			<li>
				<a href="#"><i class="fa-home"></i>Inicio</a>
			</li>
			<li class="active">
				<strong>Conductor</strong>
			</li>
		</ol>
			
	</div>
</div>

@include('alerts')

<div class="panel-default">
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				<div class="tocify-content">
					<div class="icon-collection">
						<div class="fontawesome-icon-list">
							<a href="{{url('/crearConductor')}}"><div class="fa-hover"><div class="icon-str"><i class="fa fa-plus"></i> <span>Agregar Conductor</span></div></div></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Basic Setup -->
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Conductores</h3>
		
		<div class="panel-options">
			<a href="#" data-toggle="panel">
				<span class="collapse-icon">&ndash;</span>
				<span class="expand-icon">+</span>
			</a>
		</div>
	</div>
	<div class="panel-body">
		
		<script type="text/javascript">
		jQuery(document).ready(function($)
		{
			$("#example-1").dataTable({
				aLengthMenu: [
					[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]
				],
				language: {
					search: "Buscar:",
					infoEmpty: "Mostrando 0 a 0 de 0 resultados",
					info: "Mostrando  _START_ a _END_ de _TOTAL_ resultados",
					emptyTable: "No hay datos disponibles en la tabla",
					lengthMenu: "Mostrar _MENU_ resultados",
					paginate: {
				                first:      "Primer",
				                previous:   "Anterior",
				                next:       "Siguiente",
				                last:       "Ultimo"
				        },
					
				}
			});
		});
		</script>
		
		<table id="example-1" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>Codigo</th>
					<th>Cedula</th>
					<th>Nombre</th>
					<th>Telefono</th>
					<th>Direccion</th>
					<th>Acciones</th>
					
				</tr>
			</thead>
		
			<tfoot>
				<tr>
				    <th>Codigo</th>
					<th>Cedula</th>
					<th>Nombre</th>
					<th>Telefono</th>
					<th>Direccion</th>
					<th>Acciones</th>
				
				</tr>
			</tfoot>
		<tbody>
				@foreach($chofer as $i)
					<!--<tr onclick="document.location = '{{ url('/piscinas',[$i->eCodReg]) }}';">-->
					<tr>
						<td>{{ $i->eCodReg}}</td>
						<td>{{ $i->aCedula }}</td>
						<td>{{ $i->aNombre}}</td>
						<td>{{ $i->aTelefono}}</td>
						<td>{{ $i->aDireccion}}</td>
						
						<td>
							<a href="#"><button class="btn btn-gray"><i class="fa fa-pencil"></i></button></a>
							<a href="#"><button class="btn btn-gray"><i class="fa fa-remove"></i></button></a>
						</td>
						
					</tr>
				@endforeach
			</tbody>
	
		</table>
		
	</div>
</div>


<link rel="stylesheet" href="{{ asset('assets/js/datatables/dataTables.bootstrap.css') }}">

<!-- Imported scripts on this page -->
<script src="{{ asset('assets/js/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/datatables/dataTables.bootstrap.js') }}"></script>
<script src="{{ asset('assets/js/datatables/yadcf/jquery.dataTables.yadcf.js') }}"></script>
<script src="{{ asset('assets/js/datatables/tabletools/dataTables.tableTools.min.js') }}"></script>


<!--<script>
	jQuery(document).ready(function($){
		$('#liCamaroneras').attr("class","active");
	})
</script>-->



@endsection