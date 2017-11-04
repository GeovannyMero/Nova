@extends('layouts.layout')

@section('content')

<div class="page-title">

	<div class="title-env">
		@if($cliente->eCodReg == '')
			<h1 class="title">Agregar Cliente</h1>
		@else
			<h1 class="title">Editar Cliente</h1>
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

						@if($cliente->eCodReg == '')
						<strong>Agregar Cliente</strong>
					@else
						<strong>Editar</strong>
					@endif

				</li>
			</ol>
	</div>

</div>

<div class="row">
	<div class="col-sm-12">

		<div class="panel panel-default">
			<div class="panel-heading">
		@if($cliente->aNombre == '')
					<h3 class="panel-title">Crear Cliente</h3>
				@else
					<h3 class="panel-title">Editar datos: {{ $cliente->aNombre }}</h3>
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
						<input type ="text"class="form-control" id="eCodReg" value="{{$cliente->eCodReg}}"name="eCodReg" disabled autofocus >
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label " for="eCodExtCliente">Codigo Ext:</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" maxlength="10" id="eCodExtCliente" name="eCodExtCliente" value="{{$cliente->eCodExtCliente or old('eCodExtCliente')}}" placeholder="" data-validate="required" data-message-required="Este campo es requerido">
  						<span class="help-block">  </span>

					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label" for="aRUC">RUC:</label>

					<div class="col-sm-10">
						<input type="text" class="form-control" maxlength="13" id="aRUC" name="aRUC" value="{{$cliente->aRUC or old('aRUC')}}" placeholder="" data-validate="required" data-message-required="Este campo es requerido">
								<span class="help-block"></span>

					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label" for="aNombre">Nombre:</label>

					<div class="col-sm-10">
						<input type="text" class="form-control" id="aNombre" name="aNombre" placeholder="" value="{{$cliente->aNombre or old('aNombre')}}" data-validate="required" data-message-required="Este campo es requerido" onkeypress="return soloLetras(event)">
							<span class="help-block"></span>

					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label" for="aDireccion">Direcci&oacute;n:</label>

					<div class="col-sm-10">
						<input type="text" class="form-control" id="aDireccion" name="aDireccion" placeholder="" value="{{$cliente->aDireccion or old('aDireccion')}}"data-validate="required" data-message-required="Este campo es requerido">
						@if ($errors->has('aDireccion'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('aDireccion') }}</strong>
                                </span>
                            @endif
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label" for="aTelefono">Tel&eacute;fono:</label>

					<div class="col-sm-10">
						<input type="text" class="form-control" maxlength ="10" id="aTelefono" name="aTelefono" data-mask="phone" inputmask="" placeholder="" value="{{$cliente->aTelefono or old('aTelefono')}}" data-validate="required" data-message-required="Este campo es requerido">
							<span class="help-block"></span>

					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label" for="aMail">Correo Electr&oacute;nico:</label>

					<div class="col-sm-10">
						<input type="text" class="form-control focus-inputmask" id="aMail" name="aMail" placeholder="" value="{{$cliente->aMail or old('aMail')}}" data-validate="required" data-message-required="Este campo es requerido">
							<span class="help-block"></span>

					</div>
				</div>
					<input type="hidden" name="eCodReg" value="{{$cliente->eCodReg}}"/>

				</form>
					<div class="form-group pull-right">
					  <!--	  <a  class="btn btn-primary btn-single" href="javascript:;" onclick="window.history.back();"><i class="fa-chevron-left"></i></a>
	                <a  class="btn btn-primary btn-single" href="{{ url('/clientes') }}"><i class="fa-chevron-left"></i></a>-->
	                <!--  <button class="btn btn-secondary btn-single">Registrar</button>-->
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
 	var id = $('#eCodReg').val();
	var obtener = $("#frmDatos").serialize();

 	//guardar
 	if(id == ''){
 		var ext = $('#eCodExtCliente').val();
 		var ruc = $('#aRUC').val();
 		var nombre = $('#aNombre').val();
 		var tel = $('#aTelefono').val();
 		var mail = $('#aMail').val();
 		bootbox.confirm("Est&aacute; seguro que desea crear un <strong>Nuevo Cliente?</strong>",function(result){
 			if(result){
	 				route = "{{ url('/cliente/store') }}";
					cli = "{{ url ('/clientes')}}";
	 				$.ajax({
	 					type: 'POST',
	 					url: route,
	 					data: obtener,
	 					success: function(data){
							//alert(data);
							console.log(JSON.stringify(data));
	 						window.location = (cli);
	 					},
	 					error: function(data){
	 						//window.location.reload();
							console.log('ERROR:' + data);
							console.clear();
							$('#eCodExtCliente').parent().parent().attr('class','form-group has-error ');
							$('#eCodExtCliente').parent().children("span").text(data.responseJSON.eCodExtCliente);

							$('#aRUC').parent().parent().attr('class','form-group has-error ');
							$('#aRUC').parent().children("span").text(data.responseJSON.aRUC);

							$('#aNombre').parent().parent().attr('class','form-group has-error ');
							$('#aNombre').parent().children("span").text(data.responseJSON.aNombre);

							/*$('#aTelefono').parent().parent().attr('class','form-group has-error ');
							$('#aTelefono').parent().children("span").text(data.responseJSON.aTelefono);

							$('#aMail').parent().parent().attr('class','form-group has-error ');
							$('#aMail').parent().children("span").text(data.responseJSON.aMail);*/
							//alertify.notify('<strong>Error</strong> al guardar registro','success', 2, function(){console.log('dismissed');});

	 					}
	 				});


 			}
 		});
 	}//endif de validacion null
 	else{
 		bootbox.confirm("Est&aacute; seguro que desea guardar los cambios del <strong> Cliente?</strong>",function(result){
 			if(result){
 				var obtener = $("#frmDatos").serialize();
 				route = "{{ url('/cliente/update') }}";
				cli = "{{ url ('/clientes')}}";
 				$.ajax({
 					type: 'POST',
 					url: route,
 					data: obtener,
 					success: function(data){
 						window.location = (cli);
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
