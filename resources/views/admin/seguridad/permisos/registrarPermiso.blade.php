@extends('layouts.layout')

@section('content')

<div class="page-title">

	<div class="title-env">
		@if($permiso->id == '')
			<h1 class="title">Agregar Permisos</h1>
		@else
			<h1 class="title">Editar Permisos</h1>
		@endif
		<!--<p class="description">Plain text boxes, select dropdowns and other basic form elements</p>-->
	</div>

		<div class="breadcrumb-env">
			<ol class="breadcrumb bc-1" >
				<li>
					<a href="#"><i class="fa-home"></i>Inicio</a>
				</li>
				<li>
					<a href="#">Permisos</a>
				</li>
				<li class="active">
					@if($permiso->id == '')
						<strong>Agregar Permisos</strong>
					@else
						<strong>Editar Permisos</strong>
					@endif
				</li>
			</ol>
	</div>

</div>

<div class="row">
	<div class="col-sm-12">

		<div class="panel panel-default">
			<div class="panel-heading">
				@if($permiso->id == '')
					<h3 class="panel-title">Crear Permiso</h3>
				@else
					<h3 class="panel-title">Editar Permiso</h3>
				@endif
				<div class="panel-options">
					<a href="#" data-toggle="panel">
						<span class="collapse-icon">&ndash;</span>
						<span class="expand-icon">+</span>
					</a>

				</div>
			</div>
			<div class="panel-body">

				<form role="form" class="form-horizontal validate" role="form" id="frmDatos" >
				{{ csrf_field() }}

				<div class="form-group">
					<label class="col-sm-2 control-label" for="id" >Código:</label>
					<div class="col-sm-10">
						<input type ="text"class="form-control" id="id" name="id" value="{{$permiso->id}}" disabled autofocus >
					</div>


				</div>

				<div class="form-group {{ $errors->has('name') ? 'jas-error' : ''}}">
					<label class="col-sm-2 control-label" for="name">Nombre:</label>

					<div class="col-sm-10">
						<input type="text" class="form-control" id="name" name="name"  value="{{$permiso->name}}" placeholder="" data-validate="required" data-message-required="Este campo es requerido" onkeypress="return soloLetras(event)" >
							<span class="help-block"></span>

					</div>
				</div>

			<!--<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
					<label class="col-sm-2 control-label" for="slug">Slug:</label>

					<div class="col-sm-10">
						<input type="text" class="form-control" id="slug" name="slug" placeholder="" value="{{$permiso->slug}}"data-validate="required" data-message-required="Este campo es requerido">
						@if ($errors->has('slug'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('slug') }}</strong>
                                </span>
                            @endif
					</div>
				</div>-->


				<div class="form-group {{ $errors->has('description') ? 'jas-error' : ''}}">
					<label class="col-sm-2 control-label" for="description">Descripción:</label>

					<div class="col-sm-10">
						<input type="text" class="form-control" id="description" name="description"  value="{{$permiso->description}}" placeholder="" data-validate="required" data-message-required="Este campo es requerido">
						@if ($errors->has('description'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
					</div>
				</div>
					<div class="form-group">
					<label class="col-sm-2 control-label" for="aNombre">Sistema:</label>

					<div class="col-sm-10">
						 <select class="form-control select"id="aNombre" name="aNombre"  data-validate="required" data-message-required="Este campo es requerido" >
						 	@if($permiso->eCodSistema <> '')
						 	<option value="{{$permiso->eCodSistema}}" selected>{{$sis->aNombre}}</option>
						 	@endif
						   @foreach($sistema as $i)
                    <option value="{{$i->eCodReg}}">{{$i->aNombre}}</option>
                  @endforeach
						</select>


					</div>
				</div>



					<input type="hidden" name="id" value="{{$permiso->id}}"/>

				</form>
					<div class="form-group pull-right">
					<!--	  <a  class="btn btn-primary btn-single" href="javascript:;" onclick="window.history.back();"><i class="fa-chevron-left"></i></a>
	                  <a  class="btn btn-primary btn-single" href="{{ url('/clientes') }}"><i class="fa-chevron-left"></i></a>-->
	                 <!-- <button class="btn btn-secondary btn-single">Registrar</button>-->
	                  <a href="javascript:;" onclick="guardar()"><button class="btn btn-secondary">Guardar</button></a>
	                </div>


			</div>
		</div>

	</div>
</div>
<link  rel="stylesheet" href="{{ asset('assets/js/alertify/css/alertify.css')}}">
<link  rel="stylesheet" href="{{ asset('assets/js/alertify/css/alertify.min.css')}}">

<script src="{{ asset('assets/js/jquery-validate/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/js/bootbox/bootbox.min.js') }}"></script>
<script src="{{ asset('assets/js/alertify/alertify.js')}}"></script>
<script src="{{ asset('assets/js/alertify/alertify.min.js')}}"></script>

<script type="text/javascript">
function soloLetras(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
       especiales = "8-37-39-46";

       tecla_especial = false
       for(var i in especiales){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }

        if(letras.indexOf(tecla)==-1 && !tecla_especial){
            return false;
        }
    }
function guardar(){
 bootbox.confirm("Est&aacute; seguro que desea crear un <strong>Nuevo Permiso?</strong>", function(result){
 		if(result){
	 			 var obtener = $("#frmDatos").serialize();
    			 var cod = $('#id').val();
    			 if(cod == ''){
    			 	route = "{{ url('/permiso/store') }}";
						per = "{{url('/permisos')}}";
    			 	$.ajax({
    			 		type: 'POST',
    			 		url: route,
    			 		data: obtener,
    			 		success: function(data){
    			 			window.location = (per);
    			 		},
    			 		error: function(data){
    			 			console.log('ERROR:'+ data);
								$('#name').parent().parent().attr('class','form-group has-error ');
								$('#name').parent().children("span").text(data.responseJSON.name);
    			 		}
    			 	})
    			 }//fin si es null inicio de actualizar
    			 else{
    			 	route = "{{ url('/permiso/update') }}";
						per = "{{url('/permisos')}}";
    			 	$.ajax({
    			 		type: 'POST',
    			 		url: route,
    			 		data: obtener,
    			 		success: function(data){
    			 			window.location = (per);
    			 		},
    			 		error: function(data){
    			 			console.log('ERROR:'+ data);
    			 			 alertify.notify('<strong>Error</strong> al guardar registro','success', 2, function(){console.log('dismissed');});
    			 		}
    			 	})
    			 }
	 		}
 });

}
</script>


@endsection
