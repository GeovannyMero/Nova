@extends('layouts.layout')

@section('content')

<div class="page-title">
			
	<div class="title-env">
	
			<h1 class="title">Satisfacción de los clientes</h1>
	
			
	
		<!--<p class="description">Plain text boxes, select dropdowns and other basic form elements</p>-->
	</div>

		<div class="breadcrumb-env">
			<ol class="breadcrumb bc-1" >
				<li>
					<a href="#"><i class="fa-home"></i>Inicio</a>
				</li>
				
				<li class="active">
					
						
						<strong>Satisfacción </strong>
			
				
				</li>
			</ol>
	</div>
	
</div>

<div class="row">
	<div class="col-sm-12">

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
				<!--<form class="form-inline">-->
				<form role="form" class="form-inline validate" role="form" id="frmDatos" method="POST" action="{{ url('/ver/excelSatisfaccion')}}">
						{{ csrf_field() }}
				<div class="form-inline">
					
					<div class="form-group">
						<label class="control-label">Fecha Desde:</label>
						<input type="text" size="10" class="form-control datepicker" date-format="D, dd MM yyyy" id="fd" name="fd" placeholder="" data-validate="required" data-message-required="Este campo es requerido">
					</div>

					<div class="form-group">
						<label class="control-label">Fecha Hasta:</label>
						<input type="text" size="10" class="form-control datepicker" date-format="D, dd MM yyyy" id="fh" name="fh" placeholder="" data-validate="required" data-message-required="Este campo es requerido">
					</div>

					<div class="form-group">
						<label class="control-label">Cliente:</label>
						<select class=" form-control select"id="despacho" name="despacho">
							<option value='null'>Selecione un cliente</option>
							@foreach($cliente as $i)
								
                   				 <option value="{{$i->eCodReg}}">{{$i->aNombre}}</option>
                 			 @endforeach
                 			 <option value=0>Todos</option>
						</select>	
					</div>


					<div class="form-group">
						<label class="control-label">Camión:</label>
						<select class=" form-control select"id="placa" name="placa">
							<option value = 'null'>Selecione un camión</option>
							@foreach($placa as $i)
								
                   				 <option value="{{$i->eCodReg}}">{{$i->aPlaca}}</option>
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
				<div class="panel-body">
					<div class="table-responsive"  data-pattern="priority-columns" data-focus-btn-icon="fa-asterisk" data-sticky-table-header="false" data-add-display-all-btn="true" data-add-focus-btn="false">	
						<table id="example-1" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>Fecha</th>
									<th>Cliente</th>
									<th>Camión</th>
									<th>Producto</th>
									<th>Tiempo</th>
									<th>Correción Tiempo</th>
									<th>Cantidad</th>
									<th>Correción Cantidad</th>
									<th>Calidad</th>
									<th>Correción Calidad</th>
									
								</tr>
							</thead>
							<tbody id="bo">
				
				
							</tbody>
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
			<!--fin de tabla de resultado-->
		</div>

	</div>
</div>

<script src="{{ asset('assets/js/jquery-validate/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/js/datepicker/bootstrap-datepicker-es.js') }}"></script>

<script type="text/javascript">
function buscar(){
	var desde = $('#fd').val();
	var hasta = $('#fh').val();
	var cli = $('#despacho').val();
	var placa = $('#placa').val();
	alert(placa);
	//alert(cli);
	route = "{{url('/previa/sastifaccionCliente')}}" + '/' + desde + '/' + hasta + '/' + cli + '/' + placa;
	$.ajax({
		type: 'GET',
		url: route,
		success: function(data){
			//alert(data);
			$('#bo').html(data)
		},
		error: function(data){
			 console.log('ERROR:' + data)
		}

	});
}

	var f = $('#fd').datepicker({
		format: "yyyy-mm-dd"
	});
		var f = $('#fh').datepicker({
		format: "yyyy-mm-dd"
	});
</script>


@endsection