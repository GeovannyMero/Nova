@extends('layouts.layout')

@section('content')

<div class="page-title">

	<div class="title-env">
		<h1 class="title">Guia de Remisión</h1>
	</div>

		<div class="breadcrumb-env">
			<ol class="breadcrumb bc-1" >
				<li>
					<a href="#"><i class="fa-home"></i>Inicio</a>
				</li>

				<li class="active">
					<strong>Guia de Remisión </strong>
				</li>
			</ol>
		</div>

	</div>

<div class="row">
	<div class="col-sm-12">
@include('alerts')
		<div class="panel panel-default">
			<div class="panel-heading">

					<h3 class="panel-title">Buscar Camión</h3>


				<div class="panel-options">
					<a href="#" data-toggle="panel">
						<span class="collapse-icon">&ndash;</span>
						<span class="expand-icon">+</span>
					</a>

				</div>
			</div>
			<div class="panel-body">


				<!--<form role="form" class="form-inline validate" role="form" id="frmDatos" method="POST" action="{{ url('/subirGuia/show')}}">-->
					<!--	{{ csrf_field() }}-->
					<div class="form-inline">

					<div class="form-group">
						<label class="control-label">Fecha desde:</label>
						<input type="text" class="form-control datepicker" format=" dd-MM-yyyy" id="fd" name="fd" placeholder="" data-validate="required" data-message-required="Este campo es requerido">
					</div>
					<div class="form-group">
						<label class="control-label">Fecha hasta:</label>
						<input type="text" class="form-control datepicker" format=" dd-MM-yyyy" id="fh" name="fh" placeholder="" data-validate="required" data-message-required="Este campo es requerido">
					</div>

					<div class="form-group">
						<label class="control-label">Camión:</label>
						<select class=" form-control select"id="aPlaca" name="aPlaca">
							@foreach($camion as $i)
			                   	<option value="{{$i->eCodReg}}">{{$i->aPlaca}}</option>
			                @endforeach

						</select>
					</div>

					 <a  class="btn btn-secondary btn-single " href="javascript:;" onclick="buscar();">Buscar</a>
				</div>
					<!--<div class="form-group">


					</div>	-->
			</div>

		</div>

		<!--talb a de resultado-->

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
				<table id="example-1" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
					<thead>
							<tr>
								<th>Ciclo</th>
								<th>Fecha</th>

								<th>Hora de Ingreso</th>
								<th>Hora Salida</th>
								<th>Placa</th>
								<th>Detalles</th>
							</tr>
					</thead>
					<tbody id="bo">

					</tbody>

				</table>

			</div>
		</div>
			<div class="modal fade in " id="imagenGuia"></div>
		<div class="modal fade in " id="selecionDoc"></div>
		<!--fin-->
</div>
</div>


		<script src="{{ asset('assets/js/datatables/js/jquery.datatables.min.js') }}"></script>
		<script src="{{ asset('assets/js/jquery-validate/jquery.validate.min.js') }}"></script>
		<script src="{{ asset('assets/js/datepicker/bootstrap-datepicker-es.js') }}"></script>



<script >
	var f = $('#fd').datepicker({
		format: "yyyy-mm-dd"
	});

	var f = $('#fh').datepicker({
		format: "yyyy-mm-dd"
	});

	function buscar(){
		//alert('ok');
		var desde = $('#fd').val();
		var hasta = $('#fh').val();
		var cliente = $('#aPlaca').val();
		route = "{{ url('/subirGuia/show')}}" + '/' + desde + '/' + hasta + '/' + cliente;
		$.ajax({
			type: 'GET',
			url: route,
			success: function(data){
				$('#bo').html(data);

			},
			error: function(data){
				console.log('ERROR:' + data);
			}
		})

	}
</script>
<script src="{{ asset('assets/js/datatables/js/jquery.datatables.min.js') }}"></script>
		<script src="{{ asset('assets/js/jquery-validate/jquery.validate.min.js') }}"></script>
		<script src="{{ asset('assets/js/datepicker/bootstrap-datepicker-es.js') }}"></script>
		<script src="{{ asset('assets/js/bootstrap-filestyle.min.js') }}"></script>
		<script src="{{ asset('assets/js/select2/select2.js')}}"></script>




<script >
$(":file").filestyle({input: false,
buttonText: ""
});
		$("·aPlaca").select2({
	  placeholder: "Seleccione uno o mas clientes",
	  allowClear: true
	});

		function ima(){

		$("#imagenGuia").html("");

	    $.ajax({
	    	//route = "{{url ('/Inproducto')}}" + "/" + idCliente;

	    	type: 'GET',
	    	url: '/showGuia'  ,
	    	success: function(data){
	    	$("#imagenGuia").html(data);
	    	$('#imagenGuia').modal('show', {backdrop: 'static'});
	    	}
	    });
	}
	function seleccion(){
			$("#selecionDoc").html("");

	    $.ajax({
	    	//route = "{{url ('/Inproducto')}}" + "/" + idCliente;

	    	type: 'GET',
	    	url: '/show'  ,
	    	success: function(data){
	    	$("#selecionDoc").html(data);
	    	$('#selecionDoc').modal('show', {backdrop: 'static'});
	    	}
	    });
	}



</script>
	@endsection
