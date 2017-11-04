@extends('layouts.layout')

@section('content')

<div class="page-title">

	<div class="title-env">
		@if($camion->eCodReg == '')
			<h1 class="title">Agregar Cami&oacute;n</h1>
		@else
			<h1 class="title">Editar Cami&oacute;n</h1>
		@endif


		<!--<p class="description">Plain text boxes, select dropdowns and other basic form elements</p>-->
	</div>

		<div class="breadcrumb-env">
			<ol class="breadcrumb bc-1" >
				<li>
					<a href="#"><i class="fa-home"></i>Inicio</a>
				</li>
				<li>
					<a href="#">Cami&oacute;n</a>
				</li>
				<li class="active">

						@if($camion->eCodReg == '')
						<strong>Registrar Cami&oacute;n</strong>
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
		@if($camion->aPlaca == '')
					<h3 class="panel-title">Crear Cami&oacute;n</h3>
				@else
					<h3 class="panel-title">Editar datos del Camion:  {{ $camion->aPlaca }}</h3>
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
					<label class="col-sm-2 control-label"  >Placa:</label>
					<div class="col-sm-10">
						<input type ="text"class="form-control" maxlength="7" id="aPlaca" value="{{$camion->aPlaca}}"name="aPlaca"  autofocus >
					  <span class="help-block">  </span>

					</div>


				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label" for="aMarca">Marca:</label>

					<div class="col-sm-10">
						<input type="text" class="form-control" id="aMarca" name="aMarca" value="{{$camion->aMarca}}" placeholder="" data-validate="required" data-message-required="Este campo es requerido" onkeypress="return soloLetras(event)">
<span class="help-block">  </span>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label" for="aModelo">Modelo:</label>

					<div class="col-sm-10">
						<input type="text" class="form-control" id="aModelo" name="aModelo" placeholder="" value="{{$camion->aModelo}}" data-validate="required" data-message-required="Este campo es requerido">

                                <span class="help-block">  </span>

					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label" for="aAnio">Año:</label>

					<div class="col-sm-10">
						<input type="text" maxlength = "4" class="form-control" id="aAnio" name="aAnio" placeholder="" value="{{$camion->aAnio}}"data-validate="required" data-message-required="Este campo es requerido">
						@if ($errors->has('aAnio'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('aAnio') }}</strong>
                                </span>
                            @endif
					</div>
				</div>



				<div class="form-group">
					<label class="col-sm-2 control-label">Observaci&oacute;n</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="aObservacion" name="aObservacion" placeholder="Observaci&oacute;n" value="{{$camion->aObservacion}}">
					</div>
				</div>


				<div class="form-group">
					<label class="col-sm-2 control-label" for="eCodEstructura">Estructura:</label>
						<div class="col-sm-10">
							<select class="form-control select"id="eCodEstructura" name="eCodEstructura"  data-validate="required" data-message-required="Este campo es requerido" >
							<option value=0>Selecione un cami&oacute;n</option>
							@if($camion->eCodEstructura <> '')
							<option value="{{$camion->eCodEstructura}}" selected>{{$estructur->aNombre}}</option>

							@endif
							@foreach($estructura as $i)
                    			<option value="{{$i->eCodReg}}">{{$i->aNombre}}</option>
                  			@endforeach

 										</select>
												<span class="help-block"></span>
						</div>
				</div>




					<input type="hidden" id='eCodReg' name="eCodReg" value="{{$camion->eCodReg}}"/>


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
<script src="{{ asset('assets/js/jquery-validate/jquery.validate.min.js') }}"></script>

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
function soloNumero(e){
		tecla = (document.all) ? e.keyCode : e.which;
		patron =/[0-9]/;
		te = String.fromCharCode(tecla);
		return patron.test(te);
	}
	$('#aAnio').keypress(function(event){
		return soloNumero(event);
	})

function guardar(){
	var id = $('#eCodReg').val();
	if(id == ''){
		var placa = $('#aPlaca').val();
		var est = $('#estructura').val();
		var marca = $('#aMarca').val();
		bootbox.confirm("Est&aacute; seguro que desea crear un <strong>Nuevo Cami&oacute;n?</strong>",function(result){
		if(result){
				var obtener = $("#frmDatos").serialize();
				route = "{{ url('/camion/store') }}";
				ca = "{{ url('/camiones')}}";
				$.ajax({
					type: 'post',
					url: route,
					data: obtener,
					success: function(data) {
							window.location = (ca);
						},
					error: function(data){
							console.log('ERROR:' + data.responseJSON.eCodEstructura);
							$('#aPlaca').parent().parent().attr('class','form-group has-error ');
							$('#aPlaca').parent().children("span").text(data.responseJSON.aPlaca);

							$('#eCodEstructura').parent().parent().attr('class','form-group has-error ');
							$('#eCodEstructura').parent().children("span").text(data.responseJSON.eCodEstructura);

							//$('#aMarca').parent().parent().attr('class','form-group has-error ');
							//$('#aMarca').parent().children("span").text(data.responseJSON.aMarca);
							console.clear();
							//alertify.notify('<strong>Error</strong> al guardar registro','success', 2, function(){console.log('dismissed');});

						}
				});//fin ajax


		}
		});
	}//endif validation and end save
	else{
		//actualizar
		bootbox.confirm("Est&aacute; seguro que desea guardar los cambios del <strong> Cami&oacute;n?</strong>",function(result){
			if(result){
				var obtener = $("#frmDatos").serialize();
				route = "{{ url('/camion/update') }}";
				ca = "{{ url('/camiones')}}";
					$.ajax({
				type: 'post',
				url: route,
				data: obtener,
				success: function(data) {
						window.location = (ca);
					},
				error: function(data){
						console.log('ERROR:' + data.responseJSON.aPlaca);

						alertify.notify('<strong>Error</strong> al guardar registro','success', 2, function(){console.log('dismissed');});

					}
			})
			}
		});

	}
}

</script>


@endsection
