@extends('layouts.layout')

@section('content')

<div class="page-title">

	<div class="title-env">

			<h1 class="title">Deshabilitar Rol a Usuario</h1>

		<!--<p class="description">Plain text boxes, select dropdowns and other basic form elements</p>-->
	</div>

		<div class="breadcrumb-env">
			<ol class="breadcrumb bc-1" >
				<li>
					<a href="#"><i class="fa-home"></i>Inicio</a>
				</li>

				<li class="active">

						<strong> Deshabilitar Roles</strong>

				</li>
			</ol>
	</div>

</div>

<div class="row">
	<div class="col-sm-12">
@include('alerts')
		<div class="panel panel-default">
			<div class="panel-heading">

					<h3 class="panel-title">Deshabilitar Roles</h3>

				<div class="panel-options">
					<a href="#" data-toggle="panel">
						<span class="collapse-icon">&ndash;</span>
						<span class="expand-icon">+</span>
					</a>

				</div>
			</div>
			<div class="panel-body">

				<form role="form" class="form-horizontal validate" role="form" id="frmDatos" method="POST" action="{{ url('/RevocarRolUsuario/') }}">
					{{ csrf_field() }}
				<div class="form-group">
					<label class="col-sm-2 control-label" for="namep">Usuario:</label>

					<div class="col-sm-10">
						<select  id="namep" name="namep"  data-validate="required" data-message-required="Este campo es requerido" ><!--onchange="cargaRoles()"-->
						   @foreach($user as $i)
		                    <option value="{{$i->id}}">{{$i->name}}</option>
        		           @endforeach
        		       </select>
					</div>

				</div>




				<div class="form-group">
					<label class="col-sm-2 control-label" for="namer">Roles:</label>

					<div class="col-sm-10">
						<select class="form-control select"id="namer" name="namer"  data-validate="required" data-message-required="Este campo es requerido" >

        		       </select>
					</div>

				</div>

				<div id="res"></div>





					<input type="hidden" name="eCodReg"/>

				</form>
					<div class="form-group pull-right">
					   <!-- 	  <a  class="btn btn-primary btn-single" href="javascript:;" onclick="window.history.back();"><i class="fa-chevron-left"></i></a>
	              <a  class="btn btn-primary btn-single" href="{{ url('/clientes') }}"><i class="fa-chevron-left"></i></a>-->
	                  <a href="javascript:;" onclick="revocarRol()"><button class="btn btn-secondary">Deshabilitar</button></a>
	                </div>

			</div>
		</div>

	</div>
</div>
<link  rel="stylesheet" href="{{ asset('assets/js/alertify/css/alertify.css')}}">
<link  rel="stylesheet" href="{{ asset('assets/js/alertify/css/alertify.min.css')}}">
<link  rel="stylesheet" href="{{ asset('assets/js/select2/select2.css')}}">
<script src="{{ asset('assets/js/jquery-validate/jquery.validate.min.js') }}"></script>

<script src="{{ asset('assets/js/jquery-1.11.1.min.js')}}"></script>
<script src="{{ asset('assets/js/select2/select2.min.js')}}"></script>
<script src="{{ asset('assets/js/select2/select2.js')}}"></script>
<script src="{{ asset('assets/js/bootbox/bootbox.min.js') }}"></script>
<script src="{{ asset('assets/js/alertify/alertify.js')}}"></script>
<script src="{{ asset('assets/js/alertify/alertify.min.js')}}"></script>

<script  >
$('#namep').select2({
	  placeholder: "Selecion un usuario",
  allowClear: true,
});

/*function cargaRoles()
{
	var usuario = $('#namep').val();
	route = "{{url ('/rolUsuario')}}" + '/' + usuario;
	$.ajax({
		type: 'GET',
		url: route,
		success: function(data, response)
		{
			$('#res').html(data);
			//$.each(data, function(i, v){
			$('#namer').html(data.html);
			//alert(i);
			//});
			console.log(response);
    },

		error: function(data)
		{
			console.log('ERROR' + data);
		}

	})
}*/
$('#namep').on('change', function(e){
	var usuario = $('#namep').val();
	var route = "{{url ('/rolUsuario')}}" + '/' + usuario;
	console.log(e);
	var cat = e.target.value;

	$.get(route, function(data)
	{
		$('#namer').empty();
			$.each(data, function(index, nameobj)
			{
				$('#namer').append('<option value='+nameobj.id+'>'+nameobj.name+'</option>');
			})
		})

	})

function revocarRol(){
	 bootbox.confirm("Est&aacute; seguro que desea deshabilitar el <strong>Rol?</strong>",function(result){
	 		if(result){
	 			var obtener = $("#frmDatos").serialize();
	 			route =  "{{ url('/RevocarRolUsuario/') }}";
	 			$.ajax({
	 				type: 'POST',
	 				url: route,
	 				data: obtener,
	 				success: function(data){
	 					 window.location = ('/revocarRol');
	 					 window.location.reload();
	 				},
	 				error: function(data){
	 					console.log('ERROR:'+data);
	 					alertify.error('<strong>ERROR:</strong> No se ha podido deshabilitar el <strong>Rol</strong> del  <strong>Usuario</strong>');
	 				}
	 			});
	 		}
	 });

}

</script>

@endsection
