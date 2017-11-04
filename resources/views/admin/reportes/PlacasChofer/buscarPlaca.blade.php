@extends('layouts.layout')

@section('content')

<div class="page-title">
	
	<div class="title-env">
		<h1 class="title">Placa y Chofer</h1>
	</div>

		<div class="breadcrumb-env">
			<ol class="breadcrumb bc-1" >
				<li>
					<a href="#"><i class="fa-home"></i>Inicio</a>
				</li>
				
				<li class="active">
					<strong>Placa y Chofer </strong>
				</li>
			</ol>
		</div>
	
	</div>

<div class="row">
	<div class="col-sm-12">
@include('alerts')
		<div class="panel panel-default">
			<div class="panel-heading">
		
					<h3 class="panel-title">Placa y Chofer</h3>
				
			
				<div class="panel-options">
					<a href="#" data-toggle="panel">
						<span class="collapse-icon">&ndash;</span>
						<span class="expand-icon">+</span>
					</a>
					
				</div>
			</div>
			<div class="panel-body">
							
				
				<!----><form role="form" class="form-inline validate" role="form" id="frmDatos" method="POST" action="{{ url('/excel/reportePlacasChofer/')}}">
						{{ csrf_field() }}
				<div class="form-inline">
					
					<div class="form-group">
						<label class="control-label">Desde:</label>	
						<input type="text" class="form-control datepicker" format=" dd-MM-yyyy" id="fd" name="fd" placeholder="" data-validate="required" data-message-required="Este campo es requerido">
					</div>
					<div class="form-group">
						<label class="control-label">Hasta:</label>	
						<input type="text" class="form-control datepicker" format=" dd-MM-yyyy" id="fh" name="fh" placeholder="" data-validate="required" data-message-required="Este campo es requerido"> 
					</div>

					<div class="form-group">
						<label class="control-label">Cami&oacute;n:</label>
						<select class=" form-control select"id="aPlaca" name="aPlaca" data-validate="required" data-message-required="Este campo es requerido">
							<option >Seleccione un placa</option>
							@foreach($camion as $i)
			                   	<option value="{{$i->eCodReg}}">{{$i->aPlaca}}</option>
			                @endforeach
			                <option value=0>Todos</option>
							
						</select>	
					</div>

					
					<!--<div class="form-group">
						<label class="control-label">Ticket:</label>
						<input type="text" class="form-control"  id="ticket" name="ticket" placeholder="" data-validate="required" data-message-required="Este campo es requerido">
					</div>-->
	<!----></form>
					<div class="form-group">
				 <a  class="btn btn-secondary btn-single  " href="javascript:;" onclick="buscar();">Buscar</a>
					
					</div>
					</div>
			
								
			</div>

		</div>
		<!--tabla de Resultados-->
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Resultados</h3>
				<div class="panel-options">
					<a href="#" data-toggle="panel">
						<span class="collapse-icon">&ndash;</span>
						<span class="expand-icon">+</span>
					</a>
					
				</div>
			</div>
			<div class="panel-body">

				<div class="table-responsive"  data-pattern="priority-columns" data-focus-btn-icon="fa-asterisk" data-sticky-table-header="false" data-add-display-all-btn="true" data-add-focus-btn="false">
		<table id="example-1" class="table table-small-font table-bordered table-striped" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>Fecha Ingreso</th>
					<th>Hora Ingreso</th>
					<th>Fecha Salida</th>
					<th>Hora Salida</th>
					<th>Chofer</th>
					<th>Placa</th>
					<th>Cia. Transporte</th>
					<th>Cliente</th>
					<th>Producto</th>

				</tr>
			</thead>
		
			
		<tbody id="bo">
			
			
				
				
		</tbody >

	
		</table>
	</div>
	<div class="vertical-top">
					<!-- <a  class="btn btn-primary  btn-icon btn-icon-standalone" href="javascript:;" onclick="window.history.back();"><i class="fa-chevron-left"></i></a>
					<a href="/ver/controlLotesDespacho" > <button class="btn btn-red  btn-icon btn-icon-standalone" ><i class="fa-file-pdf-o"></i><span> PDF </span></button></a>
					<a href= "{{url('/reporteExcel')}}"> <button class="btn btn-red  btn-icon btn-icon-standalone" ><i class="fa-file-pdf-o"></i><span> PDF </span></button></a>-->
					
			   <a href="#" > <button class="btn btn-secondary  btn-icon btn-icon-standalone"  form="frmDatos"><i class="fa-file-excel-o"></i><span> EXCEL </span></button></a>
		</div>
			</div>

		</div>
		<!--Fin de tabla de resultado-->

	</div>
</div>
		

		<script src="{{ asset('assets/js/datatables/js/jquery.datatables.min.js') }}"></script>
		<script src="{{ asset('assets/js/jquery-validate/jquery.validate.min.js') }}"></script>
		<script src="{{ asset('assets/js/datepicker/bootstrap-datepicker-es.js') }}"></script>
		


<script >
	var f = $('#fd').datepicker({
		format: "yyyy-mm-dd"
	});
	$('#fh').datepicker({
		format: "yyyy-mm-dd"
	});

function buscar(){
	var desde = $('#fd').val();
	var hasta = $('#fh').val();
	var cliente = $('#aPlaca').val();
	route = "{{ url('/ver/placas')}}" + '/' + desde + '/' + hasta + '/' + cliente;
		$.ajax({
			type: 'GET',
			url: route,
			success: function(data){
				$('#bo').html(data);

			},
			error: function(data){
				console.log('ERROR:' + data);

			},

		})


					
					
			
	
/*	;*/

}
	
</script>
	@endsection