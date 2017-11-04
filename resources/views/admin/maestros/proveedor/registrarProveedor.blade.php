@extends('layouts.layout')

@section('content')

<div class="page-title">

	<div class="title-env">
		@if($proveedor->eCodReg == '')
			<h1 class="title">Agregar Proveedor</h1>
		@else
			<h1 class="title">Editar Proveedor</h1>
		@endif

		<!--<p class="description">Plain text boxes, select dropdowns and other basic form elements</p>-->
	</div>

		<div class="breadcrumb-env">
			<ol class="breadcrumb bc-1" >
				<li>
					<a href="#"><i class="fa-home"></i>Inicio</a>
				</li>
				<li>
					<a href="#">Cliente</a>
				</li>
				<li class="active">
					@if($proveedor->eCodReg == '')
						<strong>Agregar Proveedor</strong>
					@else
						<strong>Editar Proveedor</strong>
					@endif



				</li>
			</ol>
	</div>

</div>

<div class="row">
	<div class="col-sm-12">

		<div class="panel panel-default">
			<div class="panel-heading">
				@if($proveedor->eCodReg == '')
					<h3 class="panel-title">Crear Proveedor</h3>
				@else
					<h3 class="panel-title">Editar Proveedor</h3>
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
						<input type ="text"class="form-control" id="eCodReg" name="eCodReg" value="{{$proveedor->eCodReg}}" disabled autofocus >
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label" for="eCodExtProvee" >C&oacute;digo Ext:</label>
					<div class="col-sm-10">
						<input type ="text"class="form-control" maxlength="12" id="eCodExtProvee" name="eCodExtProvee" value="{{$proveedor->eCodExtProvee or old('eCodExtProvee')}}" placeholder="" data-validate="required" data-message-required="Este campo es requerido" >
					  	<span class="help-block">  </span>

					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label" for="aRUC">RUC:</label>

					<div class="col-sm-10">
						<input type="text" class="form-control"  maxlength="13" id="aRUC" name="aRUC" value="{{ $proveedor->aRUC or old('aRUC')}}" placeholder="" data-validate="required" data-message-required="Este campo es requerido">
							<span class="help-block">  </span>

					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label" for="aRazonSocial">Razón Social:</label>

					<div class="col-sm-10">
						<input type="text" class="form-control" id="aRazonSocial" name="aRazonSocial" value="{{$proveedor->aRazonSocial or old('aRazonSocial')}}" placeholder=""  data-validate="required" data-message-required="Este campo es requerido">
								<span class="help-block"></span>

					</div>
				</div>



				<div class="form-group">
					<label class="col-sm-2 control-label" for="aTelefono">Tel&eacute;fono:</label>

					<div class="col-sm-10">
						<input type="text" class="form-control" maxlength ="10" id="aTelefono" name="aTelefono" placeholder="" value="{{$proveedor->aTelefono or old('aTelefono')}}"  data-validate="required" data-message-required="Este campo es requerido">
							<span class="help-block"></span>

					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label" for="aMail">Correo Electr&oacute;nico:</label>

					<div class="col-sm-10">
						<input type="email" class="form-control" id="aMail" name="aMail" placeholder="" value="{{$proveedor->aMail or old('aMail')}}" data-validate="required" data-message-required="Este campo es requerido">
						  	<span class="help-block"></span>

					</div>
				</div>
					<input type="hidden" name="eCodReg" value="{{$proveedor->eCodReg}}"/>

				</form>
				<div class="form-group pull-right">
					 <!--	  <a  class="btn btn-primary btn-single" href="javascript:;" onclick="window.history.back();"><i class="fa-chevron-left"></i></a>
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

<script type="text/javascript">
function soloNumero(e){
		tecla = (document.all) ? e.keyCode : e.which;
		patron =/[0-9]/;
		te = String.fromCharCode(tecla);
		return patron.test(te);
	}
	$('#aRUC').keypress(function(event){
		return soloNumero(event);
	})
	$('#aTelefono').keypress(function(event){
		return soloNumero(event);
	})


function guardar(){
	var id = $('#eCodReg').val();
	if(id == ''){
		//guardar
		var ext = $('#eCodExtProvee').val();
		var ruc = $('#aRUC').val();
		var RS = $('#aRazonSocial').val();
		var mail = $('#aMail').val();
		bootbox.confirm("Est&aacute; seguro que desea crear un <strong>Nuevo Proveedor?</strong>",function(result){
			if(result){
				var obtener = $("#frmDatos").serialize();
					route = "{{ url('/proveedor/store') }}";
					pro = "{{ url ('/proveedores')}}";
					$.ajax({
						type: 'post',
						url: route,
						data: obtener,
						success: function(data) {
							window.location = (pro);
						},
						error: function(data){
							console.log('ERROR:' + data);
							console.clear();
							$('#eCodExtProvee').parent().parent().attr('class','form-group has-error ');
							$('#eCodExtProvee').parent().children("span").text(data.responseJSON.eCodExtProvee);

							$('#aRUC').parent().parent().attr('class','form-group has-error ');
							$('#aRUC').parent().children("span").text(data.responseJSON.aRUC);

						/*	$('#aMail').parent().parent().attr('class','form-group has-error ');
							$('#aMail').parent().children("span").text(data.responseJSON.aMail);

							$('#aTelefono').parent().parent().attr('class','form-group has-error ');
							$('#aTelefono').parent().children("span").text(data.responseJSON.aTelefono);*/

							$('#aRazonSocial').parent().parent().attr('class','form-group has-error ');
							$('#aRazonSocial').parent().children("span").text(data.responseJSON.aRazonSocial);
							//alertify.notify('<strong>Error</strong> al guardar registro','success', 2, function(){console.log('dismissed');});

						}
					});


			}
		})
	}//end if de validacion and end save
	// update
	else{

		bootbox.confirm("Est&aacute; seguro que desea guardar los cambios del <strong> Proveedor?</strong>",function(result){
			if(result){
				var obtener = $("#frmDatos").serialize();
				route = "{{ url('/proveedor/update') }}";
				pro = "{{ url ('/proveedores')}}";
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
<script src="{{ asset('assets/js/jquery-validate/jquery.validate.min.js') }}"></script>




@endsection
