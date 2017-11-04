<!--<div class="modal fade in " id='modal1' aria-hidden="false" style="display: block;">
	<div class="modal-backdrop fade  " style="height: 534px" ></div>-->
	
<div class="modal-dialog  modal-lg data-backdrop=”static” data-keyboard=”false” ">
	<div class="modal-content">

		<form role="form" class="form-horizontal validate" role="form" id="frmDatos" method="POST" action="{{ url ('/detalles/store')}}">
			{{ csrf_field() }}
			<input type="hidden" name="cliente" value="{{$cliente->aNombre}} "/>
			<input type="hidden" name="camion" value="{{$camion->aPlaca}} "/>
			<input type="hidden" name="fecha" value="{{$fecha->dFechaLLegada}} "/>
			<input type="hidden" name="pro" value="{{$pro->eCodReg}} "/>
			<input type="hidden" name="CodPro" value="{{$pro->codigo}} "/>
			<input type="hidden" name="desde" value="{{$desde}} "/>
			<input type="hidden" name="hasta" value="{{$hasta}} "/>
			<input type="hidden" name="idCliente" value="{{$cliente->eCodReg}} "/>

			
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
		<u><strong><CENTER><h3 class="modal-title">SEGUIMIENTO</h3></CENTER></strong></u>
	<div class="row">
		<div class="col-sm-4">
			<div class="from-group">
					<h5><strong>Cliente:</strong>{{$cliente->aNombre}}</h5>
					<h5><strong>Camión:</strong>{{$camion->aPlaca}}</h5>
			</div>
		</div>

		<div class="col-sm-4">
			<div class="form-group">
				<h5><strong>Fecha:</strong>{{ Carbon\Carbon::parse($fecha->dFechaLLegada)->format('Y-m-d')}}</h5>
				<h5><strong>Producto:</strong>{{$pro->aNombreProducto}}</h5>

			</div>

		</div>
		
	</div>	
		
		</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-4">

						<div class="form-group">
						<CENTER><label class="radion-inline"><strong>TIEMPO</strong></label></CENTER>
						@if($se->tiempoB == 'si')
						<input type="radio" name="tiemporadio" id="tiemporadio" value=si  onchange="javascript:bloquearTextarea()" checked>SI 
						@else
						<input type="radio" name="tiemporadio" id="tiemporadio" value=si  onchange="javascript:bloquearTextarea()">SI
						@endif 
						@if($se->tiempoB == 'no')
						<input type="radio" name="tiemporadio" id="tiemporadio" value=no onchange="javascript:bloquearTextarea()" checked>NO
						@else 
						<input type="radio" name="tiemporadio" id="tiemporadio" value=no onchange="javascript:bloquearTextarea()" >NO
						@endif
						<br>
						<label class=" control-label">Observación:</label>
						@if($se->tiempoB == 'si')
						<input  type="text" class=" form-control  "  id="tiempo" value='{{$se->t}}' name="tiempo" placeholder="" data-validate="required" data-message-required="Este campo es requerido" disabled>
						@else 
						<input  type="text" class=" form-control  "  id="tiempo" value='{{$se->t}}' name="tiempo" placeholder="" data-validate="required" data-message-required="Este campo es requerido" >
						@endif
						<label class="control-label">Corrección:</label>
						@if($se->tiempoB == 'si')
						<textarea  MAXLENGTH="200"class ="form-control" rows="4" cols="42" id="CorrecTiempo" name="CorrecTiempo" class="CorrecTiempo" disabled>{{$se->tiempo}}</textarea>
						@else
						<textarea  MAXLENGTH="200"class ="form-control" rows="4" cols="42" id="CorrecTiempo" name="CorrecTiempo" class="CorrecTiempo" >{{$se->tiempo}}</textarea>
						@endif
						</div>
					</div>

					<div class="col-sm-4">
						<CENTER><label class="radion-inline"><strong>CANTIDAD</strong></label></CENTER>
						@if($se->cantidadB == 'si')
						<input type="radio" name="Cantiradio" id="Cantiradio" value=si onchange="javascript:bloquearTextareaCan()" checked>SI
						@else
						<input type="radio" name="Cantiradio" id="Cantiradio" value=si onchange="javascript:bloquearTextareaCan()" >SI
						@endif
						@if($se->cantidadB == 'no')
						<input type="radio" name="Cantiradio" id="Cantiradio" value=no onchange="javascript:bloquearTextareaCan()" checked>NO
						@else
						<input type="radio" name="Cantiradio" id="Cantiradio" value=no onchange="javascript:bloquearTextareaCan()" >NO
						@endif
						<br>
						<label class=" control-label">Observación:</label>
						@if($se->cantidadB == 'si')
						<input  type="text" class=" form-control  "  id="cantidad" name="cantidad" value="{{$se->ca}}" placeholder="" data-validate="required" data-message-required="Este campo es requerido" disabled>
						@else
						<input  type="text" class=" form-control  "  id="cantidad" name="cantidad" value="{{$se->ca}}" placeholder="" data-validate="required" data-message-required="Este campo es requerido">
						@endif
						<label class="control-label">Corrección:</label>
						@if($se->cantidadB == 'si')
						<textarea MAXLENGTH="200" class="form-control" rows="4" cols="38" id="CorrecCant"  name ="CorrecCant" disabled>{{$se->cantidad}}</textarea>
						@else
						<textarea MAXLENGTH="200" class="form-control" rows="4" cols="38" id="CorrecCant"  name ="CorrecCant">{{$se->cantidad}}</textarea>
						@endif
					</div>
					<div class="col-sm-4">
						<CENTER><label class="radion-inline"><strong>CALIDAD</strong></label></CENTER>
						@if($se->calidadB == 'si')
						<input type="radio" name="Caliradio" id="Caliradio" value=si onchange="javascript:bloquearTextareaCal()" checked>SI
						@else
						<input type="radio" name="Caliradio" id="Caliradio" value=si onchange="javascript:bloquearTextareaCal()" >SI
						@endif
						@if($se->calidadB == 'no')
						<input type="radio" name="Caliradio" id="Caliradio" value=no onchange="javascript:bloquearTextareaCal()" checked>NO
						@else
						<input type="radio" name="Caliradio" id="Caliradio" value=no onchange="javascript:bloquearTextareaCal()" >NO
						@endif
						<br>
						<label class=" control-label">Observación:</label>
						@if($se->calidadB == 'si')
						<input  type="text" class=" form-control  "  id="calidad" name="calidad" placeholder="" data-validate="required" value="{{$se->cal}}"data-message-required="Este campo es requerido" disabled>
						@else
						<input  type="text" class=" form-control  "  id="calidad" name="calidad" placeholder="" data-validate="required" value="{{$se->cal}}" data-message-required="Este campo es requerido">
						@endif
						<label class="control-label">Corrección:</label>
						@if($se->calidadB == 'si')
						<textarea MAXLENGTH="200" class="form-control" rows="4" cols="38" id="CorrecCali" name="CorrecCali" disabled>{{$se->calidad}}</textarea>
						@else
						<textarea MAXLENGTH="200" class="form-control" rows="4" cols="38" id="CorrecCali" value ="{{$se->calidad}}"name="CorrecCali">{{$se->calidad}}</textarea>
						@endif
					</div>

				</div>

			</div>
			<div class="modal-footer">
						<input type="hidden" name="eCodReg" value="{{$se->CodSeg}}"/>
				<button class="btn btn-secondary btn-icon btn-icon-standalone"><i class="fa-floppy-o"></i><span>Guardar</span></button>
				<!--<button class="btn btn-secondary btn-single">Registrar</button>
				<button type="button" class="btn btn-red btn-icon btn-icon-standalone" data-dismiss="modal"><i class="fa-times-circle"></i><span>Cerrar</span></button>-->
			</div>
			</form>

	</div>
</div>

<script type="text/javascript">
 function bloquearTextarea()
{
    	 elem = document.getElementsByName('tiemporadio');
  for(i=0;i<elem.length;i++) 
        if (elem[i].checked) { 
            valor = elem[i].value; 
               if(valor == 'si'){
              	   $('#tiempo').attr('disabled','enabled');
              	   $('#tiempo').val('');
             	   $('#CorrecTiempo').attr('disabled',"enabled");
             	   $('#CorrecTiempo').val('');

             	}else{
             	$('#tiempo').removeAttr("disabled");
             	$('#CorrecTiempo').removeAttr("disabled");
             	}
           		 return; 

        }  
}


function bloquearTextareaCan(){
	canti = document.getElementsByName('Cantiradio');
		for(i=0; i<canti.length; i++)
			if(canti[i].checked){
				valor = canti[i].value;
					if(valor == 'si'){
						$('#cantidad').attr('disabled','enabled');
						$('#cantidad').val('');
						$('#CorrecCant').attr('disabled','enabled');
						$('#CorrecCant').val('');

					}else{
							$('#cantidad').removeAttr('disabled');
							$('#CorrecCant').removeAttr('disabled');
						}
						return;
			}
}

function bloquearTextareaCal(){
	cali = document.getElementsByName('Caliradio');

		for(i=0; i<cali.length; i++)
			if(cali[i].checked){
				valor = cali[i].value;
					if(valor == 'si'){
						$('#calidad').attr('disabled','enabled');
						$('#calidad').val('');
						$('#CorrecCali').attr('disabled','enabled');

						$('#CorrecCali').val('');
					}else{
						$('#calidad').removeAttr('disabled');
						$('#CorrecCali').removeAttr('disabled');
				}
				return;
			}
}
</script>