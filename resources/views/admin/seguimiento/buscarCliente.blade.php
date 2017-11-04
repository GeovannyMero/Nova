@extends('layouts.layout')

@section('content')


<div class="page-title">

	<div class="title-env">
		<h1 class="title">Seguimiento a Clientes</h1>
	</div>

		<div class="breadcrumb-env">
			<ol class="breadcrumb bc-1" >
				<li>
					<a href="#"><i class="fa-home"></i>Inicio</a>
				</li>

				<li class="active">
					<strong>Seguimiento </strong>
				</li>
			</ol>
		</div>

	</div>

<div class="row">
	<div class="col-sm-12">

@include('alerts')
		<div class="panel panel-default">
			<div class="panel-heading">

					<h3 class="panel-title">Seguimiento de Clientes</h3>



				<div class="panel-options">
					<a href="#" data-toggle="panel">
						<span class="collapse-icon">&ndash;</span>
						<span class="expand-icon">+</span>
					</a>

				</div>
			</div>
			<div class="panel-body">


				<!--<form role="form" class="form-inline " role="form" id="frmDatos" method="POST" action="{{ url('/seguimientoCreate')}}">
						{{ csrf_field() }}-->
					<div class="form-inline">


					<div class="form-group">
						<label class="control-label">Fecha Desde:</label>
						<input type="text" size="10" value="{{ $desde }}" class="form-control datepicker" format=" dd-MM-yyyy" id="fd" name="fd" placeholder="" data-validate="required" data-message-required="Este campo es requerido">
					</div>

					<div class="form-group">
						<label class="control-label">Fecha Hasta:</label>
						<input type="text" class="form-control datepicker"  value="{{ $hasta }}" format=" dd-MM-yyyy" id="fh" name="fh" placeholder="" data-validate="required" data-message-required="Este campo es requerido">
					</div>

					<div class="form-group">
						<label class="control-label">Cliente:</label>
						<select class="form-control select" id="aNombre" name="aNombre" >
							@foreach($cliente as $i)
								@if($i->eCodReg == $idcliente)
			                   		<option value="{{$i->eCodReg}}" selected>{{$i->aNombre}}</option>
			                   	@else
			                   		<option value="{{$i->eCodReg}}">{{$i->aNombre}}</option>
			                   	@endif
			                @endforeach

						</select>
					</div>

					<div class="form-group">
						<!--<br>
						<button type="submit" value="Submit"id='btnAgregarCliente' class="btn btn-secondary btn-icon btn-icon-standalone" ><i class="fa-plus"></i><span>Buscar</span></button>-->
						  <a  class="btn btn-secondary btn-single" href="javascript:;" onclick="buscarS();">Cargar</a>
					</div>

				<!--</form>-->
			</div>
			<br>
</div>
</div>

		<div class="panel panel-default">
			<div class="panel-heading">
					<h3 class="panel-title">Seguimiento de Clientes</h3>
				<div class="panel-options">
					<a href="#" data-toggle="panel">
						<span class="collapse-icon">&ndash;</span>
						<span class="expand-icon">+</span>
					</a>

				</div>
			</div>
			<div class="panel-body">

<!---->	<div id="seg"  class="table-responsive"  data-pattern="priority-columns" data-focus-btn-icon="fa-asterisk" data-sticky-table-header="false" data-add-display-all-btn="true" data-add-focus-btn="false">
					<table id="example-1" class="table table-small-font table-bordered table-striped" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>codigo</th>
								<th data-priority="1">Fecha</th>
								<th data-priority="1">Cliente</th>
								<th data-priority="1">Camión</th>
								<th>C&oacute;digo</th>
								<th data-priority="1">Producto</th>
								<th data-priority="1">Tiempo</th>
								<th data-priority="1">Correción Tiempo</th>
								<th data-priority="1">Cantidad</th>
								<th data-priority="1">Correción Cantidad</th>
								<th data-priority="1">Calidad</th>
								<th data-priority="1">Correción Calidad</th>
								<th>Acción

								</th>
							</tr>
						</thead>
						<tbody  id="bo">

						</tbody>
					</table>

				</div>
			</div>

		</div>
				<div class="modal fade in " id="deta"></div>



</div>
</div>


		<script src ="{{ asset('assets/js/datatables/js/jquery.datatables.min.js') }}"></script>
		<script src ="{{ asset('assets/js/jquery-validate/jquery.validate.min.js') }}"></script>
		<script src ="{{ asset('assets/js/datepicker/bootstrap-datepicker-es.js') }}"></script>
		<script src ="{{ asset('assets/js/select2/select2.min.js')}}"></script>
		<script src ="{{ asset('assets/js/select2/select2.js')}}"></script>

<script type="text/javascript">

$( document ).ready(function() {
	var idcliente = $("#aNombre").val();
	var fechaDesde = $("#fd").val();
	var fechaHasta = $("#fh").val();

	if(idcliente.length > 0 && fechaDesde.length > 0 && fechaHasta.length > 0){
		buscarS();
	}
});






function buscarS(){
	var cliente = $('#aNombre ').val();
	var desde = $('#fd').val();
	var hasta = $('#fh').val();
	var route = " {{ url('/seguimientoCreate')}}" + '/' + cliente + '/' + desde +'/' + hasta;
	$.ajax({
		type: 'GET',
		url: route,
		/*beforeSend: function (data) {
           $("#bo").html("Procesando, espere por favor...");
        },*/
		success: function(data){

			$('#bo').html('');
			$('#bo').html("");
			$('#bo').html(data);
		},
		error: function(data){

			  console.log('ERROR:' + data)
			  alert('No hay datos que considen con la busqueda');
			  $('#bo').html('');

		},
	})

}

var f = $('#fd').datepicker({
		format: "yyyy-mm-dd"
	});

var f = $('#fh').datepicker({
		format: "yyyy-mm-dd"
	});
</script>


<link rel="stylesheet" href="{{ asset('assets/js/datatables/dataTables.bootstrap.css') }}">

<!-- Imported scripts on this page -->
<script src="{{ asset('assets/js/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/datatables/dataTables.bootstrap.js') }}"></script>
<script src="{{ asset('assets/js/datatables/yadcf/jquery.dataTables.yadcf.js') }}"></script>
<script src="{{ asset('assets/js/datatables/tabletools/dataTables.tableTools.min.js') }}"></script>
<!--<script src="{{ asset('assets/js/rwd-table/js/rwd-table.min.js') }}"></script>


-->
<script>




	function detalles(cliente, camion, codigo, cod){
		//alert(cliente);
		//var cliente = $('#aNombre ').val();
		var desde = $('#fd').val();
		var hasta = $('#fh').val();

	//alert(cod);
		$("#deta").html("");
		var route = "{{url ('/detalles')}}" + '/' + cliente + '/' + camion + '/' + codigo + '/' + desde + '/' + hasta + '/' + cod;
	    	$.ajax({
	    		type: 'GET',
	    		url: route,
	    		success: function(data){
	    			$('#deta').html(data);
	    			$('#deta').modal('show',{backdrop: 'static'});
	    		},
	    		error: function(data)
	    		{
	    			console.log('ERROR' + data);
	    		}
	    	});

	}


	function mostrarContenido() {
        element = document.getElementById("contenido");
        check = document.getElementById("check");
        if (check.checked) {
            element.style.display='block';
        }
        else {
            element.style.display='none';
        }
    }



</script>


@endsection
