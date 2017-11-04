
@extends('layouts.layout')

@section('content')
<style>





</style>
<div class="page-title">

	<div class="title-env">
		<h1 class="title">Guia de Remisón</h1>
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
	<div class="form-inline">
		<!--<div class="panel panel-default">
			<div class="panel-heading">

					<h3 class="panel-title">Buscar</h3>


				<div class="panel-options">
					<a href="#" data-toggle="panel">
						<span class="collapse-icon">&ndash;</span>
						<span class="expand-icon">+</span>
					</a>

				</div>
			</div>
			<div class="panel-body">-->


				<!--<form role="form" class="form-inline validate" role="form" id="frmDatos" method="POST" action="{{ url('/subirGuia')}}">-->
				<!--		{{ csrf_field() }}
					<div class="form-group">
						<label class="control-label">Fecha:</label>
						<input type="text" class="form-control datepicker" format=" dd-MM-yyyy" id="fd" name="fd" placeholder="" data-validate="required" data-message-required="Este campo es requerido">
					</div>

					<div class="form-group">
						<label class="control-label">Camión:</label>
						<select class=" form-control select"id="aPlaca" name="aPlaca">
							@foreach($camion as $i)
			                   	<option value="{{$i->eCodReg}}">{{$i->aPlaca}}</option>
			                @endforeach

						</select>
					</div>

					<div class="form-group">
						<label class="control-label">Cliente:</label>
						<select class=" form-control select"id="aPlaca" name="aPlaca">
							@foreach($cliente as $i)
			                   	<option value="{{$i->eCodReg}}">{{$i->aNombre}}</option>
			                @endforeach

						</select>
					</div>



						<div class="form-group">
						<button type="submit" value="Submit"id='btnAgregarCliente' class="btn btn-secondary btn-icon btn-icon-standalone" ><i class="fa-search-plus"></i><span>Buscar</span></button>
					</div>

			</form>

			</div>

		</div>-->

	</div>
		<div class="panel panel-default">
			<div class="panel-heading">

					<h3 class="panel-title">Subir foto de guia de remisión</h3>


				<div class="panel-options">
					<a href="#" data-toggle="panel">
						<span class="collapse-icon">&ndash;</span>
						<span class="expand-icon">+</span>
					</a>

				</div>
			</div>
			<div class="panel-body">
		<!--	<form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;" action="{{ url ('/subirGuia') }}" file = "true" class="form-horizontal" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
				<input type="file" name="import_file" />
				<br>
				<button class="btn btn-primary">subir Imagen</button>-->

				<table id="example-1" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>Fecha</th>
					<th>Chofer</th>
					<!--<th>Camión</th>-->
					<th>Placa</th>
					<th>Guia</th>
					<th>Adjuntar</th>



				</tr>
			</thead>


		<tbody>
			@foreach($guia as $i)

					<tr>
						<td>{{Carbon\Carbon::parse($i->fecha)->format('Y-m-d')}}</td>
						<td>{{$i->nombre}}</td>
						<!--<td></td>-->
						<td>{{$i->placa}}</td>
						<td>

							<a href="javascript:;" onclick="ima({{$i->eCodReg}});"><button class="btn btn-gray"><i class="fa-image"></i></button></a>

						</td>


						<td>
						<a href="javascript:;" onclick="seleccion({{$i->eCodReg}});"><button class="btn btn-gray"><i class="fa-paperclip"></i></button></a>

						</td>

					</tr>
				@endforeach
			</tbody>

		</table>
		<div class="modal fade in " id="imagenGuia"></div>
		<div class="modal fade in " id="selecionDoc"></div>

			<!--</form>	-->




			</div>

		</div>
<!--foto-->
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Guia de Remisión</h3>
				<div class="panel-options">
					<a href="#" data-toggle="panel">
						<span class="collapse-icon">&ndash;</span>
						<span class="expand-icon">+</span>
					</a>
				</div>
			</div>
			<div class="panel-body">
				<div id='foto'></div>
			</div>
		</div>
	</div>
</div>


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

		function ima(id){
//	alert(id);
		$("#foto").html("");
		route = "{{url ('/showGuia')}}" + '/' + id;
	    $.ajax({
	    	//route = "{{url ('/Inproducto')}}" + "/" + idCliente;

	    	type: 'GET',
	    	url: route,
	    	success: function(data){
	    	$("#foto").html(data);
	  // 	$('#imagenGuia').modal('show', {backdrop: 'false'});
	    	}
	    });
	}

	function seleccion(id){
			$("#selecionDoc").html("");

	    $.ajax({
	    	//route = "{{url ('/Inproducto')}}" + "/" + idCliente;

	    	type: 'GET',
	    	url: '/show' + '/' + id,
	    	success: function(data){
	    	$("#selecionDoc").html(data);
	    	$('#selecionDoc').modal('show', {backdrop: 'static'});
	    	}
	    });
	}



</script>
	@endsection
