@extends('layouts.layout')

@section('content')

<div class="page-title">

	<div class="title-env">

			@if($chofer->eCodReg == '')
			<h1 class="title">Agregar Conductor</h1>
		@else
			<h1 class="title">Editar conductor</h1>
		@endif


		<!--<p class="description">Plain text boxes, select dropdowns and other basic form elements</p>-->
	</div>

		<div class="breadcrumb-env">
			<ol class="breadcrumb bc-1" >
				<li>
					<a href="#"><i class="fa-home"></i>Inicio</a>
				</li>
				<li>
					<a href="#">Conductor</a>
				</li>
				<li class="active">

						@if($chofer->eCodReg == '')
						<strong>Agregar Conductor</strong>
					@else
						<strong>Editar</strong>
					@endif

				</li>
			</ol>
	</div>

</div>

<div class="row">
	<div class="col-sm-12">
@include('alerts')
		<div class="panel panel-default">
			<div class="panel-heading">
		@if($chofer->aNombre == '')
					<h3 class="panel-title">Crear Conductor</h3>
				@else
					<h3 class="panel-title">Editar datos: {{ $chofer->aNombre }}</h3>
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
					<label class="col-sm-2 control-label" for="codigo" >Código:</label>
					<div class="col-sm-10">
						<input type ="text"class="form-control" id="codigo" value="{{$chofer->eCodReg}}"name="codigo" disabled autofocus >
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label" for="aCedula">Cedula:</label>

					<div class="col-sm-10">
						<input type="text" class="form-control" maxlength="10" id="aCedula" value="{{$chofer->aCedula or old('aCedula')}}"name="aCedula" placeholder="" data-validate="number" data-message-number="Ingrese un numero valido" >
							<span class="help-block"></span>


					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label" for="aNombre">Nombre:</label>

					<div class="col-sm-10">
						<input type="text" class="form-control" id="aNombre" name="aNombre" value="{{$chofer->aNombre or old('aNombre')}}" placeholder="" data-validate="required" data-message-required="Este campo es requerido" onkeypress="return soloLetras(event)">
							<span class="help-block"></span>

					</div>
				</div>

				<!--<div class="form-group">
					<label class="col-sm-2 control-label" for="aTelefono">Telefono:</label>

					<div class="col-sm-10">
						<input type="text" class="form-control" id="aTelefono" name="aTelefono" value="{{$chofer->aTelefono}}"placeholder="" data-validate="required" data-message-required="Este campo es requerido">
						@if ($errors->has('aTelefono'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('aTelefono') }}</strong>
                                </span>
                            @endif
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label" for="aDireccion">Direccion:</label>

					<div class="col-sm-10">
						<input type="text" class="form-control" id="aDireccion" name="aDireccion" value="{{$chofer->aDireccion}}"placeholder="" data-validate="required" data-message-required="Este campo es requerido">
						@if ($errors->has('aDireccion'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('aDireccion') }}</strong>
                                </span>
                            @endif
					</div>
				</div>-->

				<div class="form-group">
					<label class="col-sm-2 control-label" for="eCodCamion">Camión:</label>
						<div class="col-sm-10">
							<select class="form-control select"id="eCodCamion" name="eCodCamion"  data-validate="required" data-message-required="Este campo es requerido" >
								<option value=0>Selecione un camión</option>
							@if($chofer->eCodCamion <> '')
							<option value="{{$chofer->eCodCamion}}" selected>{{$cami->aPlaca}}</option>

							@endif
							   @foreach($camion as $i)
		    	               <option value="{{$i->eCodReg}}" >{{$i->aMarca . ' ' . $i->aPlaca}}</option>
        			           @endforeach


        		    	   </select>
        		    	   <span class="help-block"></span>
						</div>
				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label">Compañia de transporte:</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="ciaTrans" name="ciaTrans" value="{{$chofer->aCompaTrans or old('ciaTrans')}}" placeholder="" data-validate="required" data-message-required="Este campo es requerido">
						<span class="help-block"></span>
					</div>

				</div>

					<input type="hidden" name="eCodReg" value="{{$chofer->eCodReg}}" />


				</form>
				<div class="form-group pull-right">
						<!--  <a  class="btn btn-primary btn-single" href="javascript:;" onclick="window.history.back();"><i class="fa-chevron-left"></i></a>
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
	$('#aCedula').keypress(function(event){
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
	var id = $('#codigo').val();

	//guardar
	if(id == ''){

		var obtener = $("#frmDatos").serialize();
		var cedula = $('#aCedula').val();
		var nombre = $('#aNombre').val();
		var camion = $('#eCodCamion').val();
		var cia = $('#ciaTrans').val();
		 bootbox.confirm("Est&aacute; seguro que desea crear un <strong>Nuevo Conductor?</strong>",function(result){
		 	if(result){
		 		route = "{{ url('/conductor/store') }}";
				con = "{{url ('/conductores')}}"
			 		$.ajax({
			 			type: 'POST',
			 			url: route,
			 			data: obtener,
			 			success: function(data){
								window.location = (con);
					//handleData(data);
					//alert(data);
					//return alertify.error('Cédula ingresada ya existe');

			 			},
			 			error: function(data){
							console.clear();
			 				console.log('ERROR:' + data.responseJSON);

							$('#aCedula').parent().parent().attr('class','form-group has-error ');
							$('#aCedula').parent().children("span").text(data.responseJSON.aCedula);

							$('#aNombre').parent().parent().attr('class','form-group has-error ');
							$('#aNombre').parent().children("span").text(data.responseJSON.aNombre);

							$('#eCodCamion').parent().parent().attr('class','form-group has-error ');
							$('#eCodCamion').parent().children("span").text(data.responseJSON.eCodCamion);

							$('#ciaTrans').parent().parent().attr('class','form-group has-error ');
							$('#ciaTrans').parent().children("span").text(data.responseJSON.aCompaTrans);


			 				// alertify.notify('<strong>Error</strong> al guardar registro','success', 2, function(){console.log('dismissed');});
			 			}
			 		});//end ajax



		 	}
		 });
	}//endif validacion de si codigo es null..
	else{
		 bootbox.confirm("Est&aacute; seguro que desea guardar los cambios de  <strong>Conductor?</strong>",function(result){
		 	if(result){
		 		var obtener = $("#frmDatos").serialize();
		 		route = "{{ url('/conductor/update') }}";
				con = "{{url ('/conductores')}}"
		 		$.ajax({
		 			type: 'POST',
		 			url: route,
		 			data: obtener,
		 			success: function(data){
		 				window.location = (	con);
		 			},
		 			error: function(data){
		 				console.log('ERROR:' + data);
		 				 alertify.notify('<strong>Error</strong> al guardar registro','success', 2, function(){console.log('dismissed');});
		 			}
		 		});//fin ajax
		 	}
		 });
	}

}
</script>
<script src="{{ asset('assets/js/jquery-validate/jquery.validate.min.js') }}"></script>




@endsection
