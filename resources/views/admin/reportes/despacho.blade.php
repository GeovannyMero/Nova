@extends('layouts.layout')

@section('content')

<div class="page-title">
	
	<div class="title-env">
		<h1 class="title">Control de Tiempo</h1>
	</div>

		<div class="breadcrumb-env">
			<ol class="breadcrumb bc-1" >
				<li>
					<a href="#"><i class="fa-home"></i>Inicio</a>
				</li>
				
				<li class="active">
					<strong>Control de Tiempo </strong>
				</li>
			</ol>
		</div>
	
	</div>

<div class="row">
	<div class="col-sm-12">
@include('alerts')
		<div class="panel panel-default">
			<div class="panel-heading">
		
					<h3 class="panel-title">Buscar</h3>
				
			
				<div class="panel-options">
					<a href="#" data-toggle="panel">
						<span class="collapse-icon">&ndash;</span>
						<span class="expand-icon">+</span>
					</a>
					
				</div>
			</div>
			<div class="panel-body">
							
				
				<!----><form role="form" class="form-inline validate" role="form" id="frmDatos" method="POST" action="{{ url('/excel')}}">
						<!---->{{ csrf_field() }}
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
						<label class="control-label">Cliente:</label>
						<select class=" form-control select"id="aPlaca" name="aPlaca">
							@foreach($camion as $i)
			                   	<option value="{{$i->eCodReg}}">{{$i->aNombre}}</option>
			                @endforeach
			                <option value=0>Todos</option>
							
						</select>	
					</div>

					<!----></form>
					<div class="form-group">
						 <a  class="btn btn-secondary btn-single" href="javascript:;" onclick="buscar();">Cargar</a>
					</div>
					</div>
				
								
			</div>

	</div>


	<!--tabla de resultados-->
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Resultado</h3>
				<div class="panel-options">
					<a href="#" data-toggle="panel">
						<span class="collapse-icon">&ndash;</span>
						<span class="expand-icon">+</span>
					</a>
					
				</div>
		</div>

		<div  class="panel-body">
				<div id="seg"  class="table-responsive"  data-pattern="priority-columns" data-focus-btn-icon="fa-asterisk" data-sticky-table-header="false" data-add-display-all-btn="true" data-add-focus-btn="false">
					<table id="example-1" class="table table-small-font table-bordered table-striped" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>Fecha</th>
								<th>Tipo</th>
								<th>Doc. No.</th>
								<th>Trans. No.</th>
								<th>No. Entidad</th>
								<th>Cliente</th>
								<th>Ticket Peso</th>
								<th>Guia</th>
								<th>Placa</th>
								<th>Chofer</th>
								<th>Llegada</th>
								<th>Ingreso</th>
								<th>Pesada 1</th>
								<th>Pesada 2</th>
								<th>Salida</th>
								<th>Tiempo Ingreso</th>
								<th>Tiempo Carga</th>
								<th>Tiempo Salida</th>
								<!--<th>Tiempo</th>-->
								<th>Transito</th>
								<th>Sacos</th>
								<th>Peso Kg</th>
								<th>Peso por sacos</th>
								<th>Sacos/Hora</th>
								<th>Indice 400 Sac</th>

								</th>
							</tr>
						</thead>
						<tbody  id="bo">
							
						</tbody>
					</table>


				</div>
	<!--						<div class="vertical-top">
<a  class="btn btn-primary  btn-icon btn-icon-standalone" href="javascript:;" onclick="window.history.back();"><i class="fa-chevron-left"></i></a>
<a href="/ver/reporteDespacho" > <button class="btn btn-red  btn-icon btn-icon-standalone" ><i class="fa-file-pdf-o"></i><span> PDF </span></button></a>-->
 <a href="#" > <button class="btn btn-secondary  btn-icon btn-icon-standalone"  form="frmDatos"><i class="fa-file-excel-o"></i><span> EXCEL </span></button></a>
</div>
		</div>

	</div>
	<!--fin de tabla resul-->
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
		var cli = $('#aPlaca').val();
		//alert(cli);
		route = "{{url('/ver/reporteDespacho')}}" + '/' + desde + '/' + hasta + '/' + cli;
		$.ajax({
			type: 'GET',
			url: route,
			success: function(data){
				//alert(data);
				$('#bo').html(data);

			},
			error: function(data){
				 console.log('ERROR:' + data)
			},
		})

	}
</script>
	@endsection