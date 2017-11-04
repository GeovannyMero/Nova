@extends('layouts.layout')

@section('content')

<div class="page-title">

	<div class="title-env">
		@if($producto->eCodReg == '')
			<h1 class="title">Agregar Producto</h1>
		@else
			<h1 class="title">Editar Producto</h1>
		@endif


		<!--<p class="description">Plain text boxes, select dropdowns and other basic form elements</p>-->
	</div>

		<div class="breadcrumb-env">
			<ol class="breadcrumb bc-1" >
				<li>
					<a href="#"><i class="fa-home"></i>Inicio</a>
				</li>
				<li>
					<a href="#">Camion</a>
				</li>
				<li class="active">

						@if($producto->eCodReg == '')
						<strong>Registrar Producto</strong>
					@else
						<strong>Editar </strong>
					@endif

				</li>
			</ol>
	</div>

</div>

<div class="row">
	<div class="col-sm-12">

		<div class="panel panel-default">
			<div class="panel-heading">
		@if($producto->aNombre == '')
					<h3 class="panel-title">Crear Producto</h3>
				@else
					<h3 class="panel-title">Editar datos del Producto:  {{ $producto->aNombre }}</h3>
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
					<label class="col-sm-2 control-label" for="eCodReg" >Código:</label>
					<div class="col-sm-10">
						<input type ="text"class="form-control" id="eCodReg" value="{{$producto->eCodReg}}"name="eCodReg" disabled autofocus >
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label" for="eCodExtProduc" >Código EXT:</label>
					<div class="col-sm-10">
						<input type ="text"class="form-control"  maxlength="10" id="eCodExtProduc" value="{{$producto->eCodExtProduc or old('eCodExtProduc')}}"name="eCodExtProduc" placeholder="" data-validate="required" data-message-required="Este campo es requerido" >
					<span class="help-block"></span>

					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label" for="aNombre">Nombre:</label>

					<div class="col-sm-10">
						<input type="text" class="form-control" id="aNombre" name="aNombre" value="{{$producto->aNombre or old('aNombre')}}" placeholder="" data-validate="required" data-message-required="Este campo es requerido">
						<span class="help-block"></span>

					</div>
				</div>







					<input type="hidden" name="eCodReg" value="{{$producto->eCodReg}}"/>


				</form>
					<div class="form-group pull-right">
					<!--  	  <a  class="btn btn-primary btn-single" href="javascript:;" onclick="window.history.back();"><i class="fa-chevron-left"></i></a>
	                <a  class="btn btn-primary btn-single" href="{{ url('/clientes') }}"><i class="fa-chevron-left"></i></a>-->
	                  <!--<button class="btn btn-secondary btn-single">Registrar</button>-->
	                  <a href="javascript:;" onclick="guardar()"><button class="btn btn-secondary">Guardar</button></a>
	                </div>

			</div>
		</div>

	</div>
</div>
<link  rel="stylesheet" href="{{ asset('assets/js/alertify/css/alertify.css')}}">
<link  rel="stylesheet" href="{{ asset('assets/js/alertify/css/alertify.min.css')}}">


<script src="{{ asset('assets/js/bootbox/bootbox.min.js') }}"></script>
<script src="{{ asset('assets/js/alertify/alertify.js')}}"></script>
<script src="{{ asset('assets/js/alertify/alertify.min.js')}}"></script>
<script src="{{ asset('assets/js/jquery-validate/jquery.validate.min.js') }}"></script>

<script type="text/javascript">
function guardar(){
var id = $('#eCodReg').val();
	if(id == ''){
		var ext = $('#eCodExtProduc').val();
		var nombre = $('#aNombre').val();
		bootbox.confirm("Est&aacute; seguro que desea crear un <strong>Nuevo Producto?</strong>",function(result){
			if(result){
						var obtener = $("#frmDatos").serialize();
						route = "{{ url('/producto/store') }}";
						pro = "{{ url ('productos')}}";
						$.ajax({
							type: 'post',
							url: route,
							data: obtener,
							success: function(data) {
								window.location = (pro);
							},
							error: function(data){
								console.log('ERROR:' + data);
								$('#eCodExtProduc').parent().parent().attr('class','form-group has-error ');
								$('#eCodExtProduc').parent().children("span").text(data.responseJSON.eCodExtProduc);

								$('#aNombre').parent().parent().attr('class','form-group has-error ');
								$('#aNombre').parent().children("span").text(data.responseJSON.aNombre);
								console.clear();

								//alertify.notify('<strong>Error</strong> al guardar registro','success', 2, function(){console.log('dismissed');});

							}
						});//fin de ajax


			}

		});
	}//endif id null
	else{
		bootbox.confirm("Est&aacute; seguro que desea guardar los cambios del <strong> Producto?</strong>",function(result){
			if(result){
				var obtener = $("#frmDatos").serialize();
				route = "{{ url('/producto/update') }}";
				pro = "{{ url ('productos')}}";
				$.ajax({
					type: 'post',
					url: route,
					data: obtener,
					success: function(data) {
						window.location = (pro);
					},
					error: function(data){
						console.log('ERROR:' + data);
						alertify.notify('<strong>Error</strong> al guardar registro','success', 2, function(){console.log('dismissed');});

					}
				})
			}

		});
	}
}
</script>


@endsection
