@extends('layouts.layout')

@section('content')

<div class="page-title">

	<div class="title-env">
		@if($roles->id == '')
			<h1 class="title">Agregar Rol</h1>
			@else
			<h1 class="title">Editar Rol</h1>
			@endif

		<!--<p class="description">Plain text boxes, select dropdowns and other basic form elements</p>-->
	</div>

		<div class="breadcrumb-env">
			<ol class="breadcrumb bc-1" >
				<li>
					<a href="#"><i class="fa-home"></i>Inicio</a>
				</li>
				<li>
					<a href="#">Rol</a>
				</li>
				<li class="active">
					@if($roles->id == '')
						<strong>Agregar Rol</strong>
					@else
						<strong>Editar Rol</strong>
					@endif

				</li>
			</ol>
	</div>

</div>

<div class="row">
	<div class="col-sm-12">

		<div class="panel panel-default">
			<div class="panel-heading">
				@if($roles->id == '')
					<h3 class="panel-title">Agregar Rol</h3>
				@else
					<h3 class="panel-title">Editar Rol: {{$roles->name}}</h3>
					@endif

				<div class="panel-options">
					<a href="#" data-toggle="panel">
						<span class="collapse-icon">&ndash;</span>
						<span class="expand-icon">+</span>
					</a>

				</div>
			</div>
			<div class="panel-body">

					<form role="form" class="form-horizontal validate" role="form" id="frmDatos">
				{{ csrf_field() }}

				<div class="form-group">
					<label class="col-sm-2 control-label" for="id" >Código:</label>
					<div class="col-sm-10">
						<input type ="text"class="form-control" id="id" name="id" value="{{$roles->id}}" disabled autofocus >
					</div>


				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label" for="name">Nombre:</label>

					<div class="col-sm-10">
						<input type="text" class="form-control" id="name" name="name" value="{{$roles->name}}" placeholder="" data-validate="required" data-message-required="Este campo es requerido">
						@if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
					</div>
				</div>

				<!--<div class="form-group">
					<label class="col-sm-2 control-label" for="slug">Slug:</label>

					<div class="col-sm-10">
						<input type="text" class="form-control" id="slug" name="slug" value="{{$roles->slug}}"placeholder="" data-validate="required" data-message-required="Este campo es requerido">
						@if ($errors->has('slug'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('slug') }}</strong>
                                </span>
                            @endif
					</div>
				</div>-->


				<div class="form-group">
					<label class="col-sm-2 control-label" for="description">Descripción:</label>

					<div class="col-sm-10">
						<input type="text" class="form-control" id="description" name="description" value="{{$roles->description}}"placeholder="" data-validate="required" data-message-required="Este campo es requerido">

					</div>
				</div>

					<input type="hidden" name="id" value="{{$roles->id}}"/>


				</form>
				<div class="form-group pull-right">
            <!--  <a  class="btn btn-primary btn-single" href="javascript:;" onclick="window.history.back();"><i class="fa-chevron-left"></i></a>-->
                  <!--  <a  class="btn btn-primary btn-single" href="{{ url('/clientes') }}"><i class="fa-chevron-left"></i></a>-->
                  <a href="javascript:;" onclick="guardar()"><button class="btn btn-secondary">Guardar</button></a>
                  </div>

			</div>
		</div>

	</div>
</div>


<link  rel="stylesheet" href="{{ asset('assets/js/alertify/css/alertify.css')}}">
<link  rel="stylesheet" href="{{ asset('assets/js/alertify/css/alertify.min.css')}}">


<script src="{{ asset('assets/js/jquery-validate/jquery.validate.min.js') }}"></script>


<script src="{{ asset('assets/js/jquery-1.11.1.min.js')}}"></script>
<link  rel="stylesheet" href="{{ asset('assets/js/select2/select2.css')}}">
<script src="{{ asset('assets/js/select2/select2.min.js')}}"></script>
<script src="{{ asset('assets/js/select2/select2.js')}}"></script>
<script src="{{ asset('assets/js/bootbox/bootbox.min.js') }}"></script>
<script src="{{ asset('assets/js/alertify/alertify.js')}}"></script>
<script src="{{ asset('assets/js/alertify/alertify.min.js')}}"></script>


<script type="text/javascript">
function guardar(){
  bootbox.confirm("Est&aacute; seguro que desea guardar un nuevo <strong>Rol?</rol>",function(result){
    if(result){
      var obtener = $("#frmDatos").serialize();
      var cod = $('#id').val();
      if(cod == ''){
         route = "{{ url('/rol/store') }}";
        $.ajax({
          type: 'POST',
          url: route ,
          data: obtener,
           success: function() {
            window.location = ('/rol');
               //window.location.reload(); // This is not jQuery but simple plain ol' JS
         },
         error: function(data){
          alertify.notify('<strong>Error</strong> al guardar registro','success', 2, function(){console.log('dismissed');});
              console.log('ERROR',data);
         }

        });
        //fin ajax

      }else{
        // actualizar
          route = "{{ url('/rol/update') }}";
        $.ajax({
          type: 'POST',
          url: route ,
          data: obtener,
           success: function() {
            window.location = ('/rol');
               //window.location.reload(); // This is not jQuery but simple plain ol' JS
         },
         error: function(data){
          alertify.warnig('Paso algo');
              console.log('ERROR',data);
         }

        });
        //fin ajax
      }

      }//endif
  });//bootbox
}

</script>

@endsection
