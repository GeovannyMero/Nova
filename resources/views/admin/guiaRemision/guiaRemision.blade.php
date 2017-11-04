
@extends('layouts.layout')

@section('content')

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

				<table id="example-1" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>Fecha</th>
					<th>Cliente</th>
					<th>Camión</th>
					<th>Placa</th>
					<th>Guia</th>
					<th>Adjuntar</th>



				</tr>
			</thead>

			<tfoot>
				<tr>
				   <th>Fecha</th>
					<th>Cliente</th>
					<th>Camión</th>
					<th>Placa</th>
					<th>Guia</th>
					<th>Adjuntar</th>


				</tr>
			</tfoot>
		<tbody>
			@foreach($guia as $i)

					<tr>
						<td>{{$i->fecha}}</td>
						<td>{{$i->nombre}}</td>
						<td></td>
						<td>{{$i->placa}}</td>
						<td>

							<a href="javascript:;" onclick="ima();"><button class="btn btn-gray"><i class="fa-image"></i></button></a>

						</td>


						<td>
						<a href="javascript:;" onclick="seleccion();"><button class="btn btn-gray"><i class="fa-paperclip"></i></button></a>

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
