@extends('layouts.layout')

@section('content')

<div class="page-title">

	<div class="title-env">

			<h1 class="title">Agregar Encuesta</h1>



		<!--<p class="description">Plain text boxes, select dropdowns and other basic form elements</p>-->
	</div>

		<div class="breadcrumb-env">
			<ol class="breadcrumb bc-1" >
				<li>
					<a href="#"><i class="fa-home"></i>Inicio</a>
				</li>

				<li class="active">


						<strong>Registrar Encuesta</strong>

				</li>
			</ol>
	</div>

</div>

<div class="row">
	<div class="col-sm-12">

		<div class="panel panel-default">
			<div class="panel-heading">

					<h3 class="panel-title">Crear Encuesta</h3>



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
					<label class="col-sm-2 control-label" for="eCodCliente">Cliente:</label>
						<div class="col-sm-10">
							<select class="form-control select"id="eCodCliente" name="eCodCliente"  data-validate="required" data-message-required="Este campo es requerido" >
								<option value=0>Selecione un Cliente</option>
							@foreach($cliente as $i)
                    			<option value="{{$i->eCodReg}}">{{$i->aNombre}}</option>
                  			@endforeach

        		    	   </select>
										 <span class="help-block"></span>
						</div>
				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label" for="aMes">Mes:</label>
						<div class="col-sm-10">
							<select class="form-control select"id="aMes" name="aMes"  data-validate="required" data-message-required="Este campo es requerido" >
								<<option value=0>Seleccione un mes</option>
								<option value="ENERO">ENERO</option>
								<option value="FEBRERO">FEBRERO</option>
								<option value="MARZO">MARZO</option>
								<option value="ABRIL">ABRIL</option>
								<option value="MAYO">MAYO</option>
								<option value="JUNIO">JUNIO</option>
								<option value="JULIO">JULIO</option>
								<option value="AGOSTO">AGOSTO</option>
								<option value="SEPTIEMBRE">SEPTIEMBRE</option>
								<option value="OCTUBRE">OCTUBRE</option>
								<option value="NOVIEMBRE">NOVIEMBRE</option>
								<option value="DICIEMBRE">DICIEMBRE</option>
        		    	   </select>

                        <span class="help-block"></span>

						</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2"><strong>Visitas Técnicas</strong></label>
				<div class="col-sm-10">
					<input type="radio" class="radio-inline" name="visiTec" id="visiTec" value=si onchange="javascript:tecnicas()">SI
					<input type="radio" class="radio-inline"  name="visiTec" id="visiTec" value=no onchange="javascript:tecnicas()">NO
				&nbsp;
				&nbsp;
				&nbsp;
				&nbsp;
				&nbsp;
				&nbsp;
					<label class="control-label">Cantidad de Visitas Técnicas</label>
				&nbsp;
				&nbsp;

					<input type="text"  id="eCantidadVisiTec" name="eCantidadVisiTec" size="45" value="{{old('eCantidadVisiTec')}}"  placeholder="" data-validate="required" data-message-required="Este campo es requerido">
					<span class="help-block"></span>
				</div>

				</div>
				<div class="form-group">
					<label class="control-label col-sm-2 "><strong>Visitas Vendedores</strong></label>
					<div class="col-sm-10">
						<input type="radio" class="radio-inline"  name="visitaVen" id="visitaVen" value=si onchange="javascript:vendedores()" >SI
						<input type="radio" class="radio-inline"  name="visitaVen" id="visitaVen" value=no  onchange="javascript:vendedores()"  >NO
				&nbsp;
				&nbsp;
				&nbsp;
				&nbsp;
				&nbsp;
				&nbsp;
						<label class="control-label">Cantidad de Visitas vendedores</label>
						<input type="text" id="eCantidadVisiVen" size="45" name="eCantidadVisiVen" value="{{old('eCantidadVisiVen')}}"  placeholder="" data-validate="required" data-message-required="Este campo es requerido" >
							<span class="help-block"></span>
					</div>
				</div>


		<!--<div class="form-inline">
			<div class="form-group">
				<label class=" control-label">Visitas Tècnicas:</label>
				<input type="radio" class="radio-inline" name="visiTec" id="visiTec" value=si>SI
				<input type="radio" class="radio-inline" name="visiTec" id="visiTec" value=si>NO
				&nbsp;
				&nbsp;
				&nbsp;
				&nbsp;
				&nbsp;
				&nbsp;

				<label class="control-label">Cantidad de visitas técnicas:</label>
				<input type="text" class="form-control">

			</div>

		</div>
			<div class="form-group">

			</div>

			<div class="form-group">
				<div class="radio">
					<label class="radion-inline">
					<input type="radio" name="visiTec" id="visiTec" value=no >No</label>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label">Cantidad Visita Técnica:</label>
				<input type="text" class="form-control " id="cantVisiTec" name="cantVisiTec" placeholder="" data-validate="required" data-message-required="Este campo es requerido">
			</div>


			<br>
			<div class="form-group">
				<label class="control-label">Visita Vendedor:</label>

			</div>

			<div class="form-group">
				<div class="radio">
					<label class="radion-inline">
					<input type="radio" name="visitaVen" id="visitaVen" value=si >SI</label>
				</div>
			</div>

			<div class="form-group">
				<div class="radio">
					<label class="radion-inline">
					<input type="radio" name="visitaVen" id="visitaVen" value=no >No</label>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label">Cantidad Visita Vendedor:</label>
				<input type="text" class="form-control " id="cantVisiVEn" name="cantVisiVEn" placeholder="" data-validate="required" data-message-required="Este campo es requerido">
			</div>


				-->






					<input type="hidden" name="eCodReg" value=""/>


				</form>
				<div class="form-group pull-right">

						<!--	<a  class="btn btn-primary btn-single" href="javascript:;" onclick="window.history.back();"><i class="fa-chevron-left"></i></a>
							  <a  class="btn btn-primary btn-single" href="{{ url('/clientes') }}"><i class="fa-chevron-left"></i></a>-->
									<!--<button class="btn btn-secondary btn-single">Registrar</button>-->
									<a href="javascript:;" onclick="guardar()"><button class="btn btn-secondary">Guardar</button></a>
								</div>

			</div>
		</div>

	</div>
</div>

<script src="{{ asset('assets/js/jquery-validate/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/js/bootbox/bootbox.min.js') }}"></script>

<script type="text/javascript">
function tecnicas(){

	elem = document.getElementsByName('visiTec');
	for(i=0;i<elem.length;i++)
        if (elem[i].checked) {
            valor = elem[i].value;
               if(valor == 'no'){
             	   //alert(' llego a tiempo');
             	 //  	$('#eCantidadVisiTec').val('0');
             	     $('#eCantidadVisiTec').attr('disabled','enabled');

             	}else {
             		  $('#eCantidadVisiTec').removeAttr('disabled');
             		  $('#eCantidadVisiTec').val('');
             	}
           		 return;

        }
}

function vendedores()
{
	elem =  document.getElementsByName('visitaVen');
		for(i=0;i<elem.length;i++)
        if (elem[i].checked) {
            valor = elem[i].value;
               if(valor == 'no'){
             	   //alert(' llego a tiempo');
             	  // 	$('#eCantidadVisiVen').val('0');
             	     $('#eCantidadVisiVen').attr('disabled','enabled');

             	}else {
             		  $('#eCantidadVisiVen').removeAttr('disabled');
             		  $('#eCantidadVisiVen').val('');
             	}
           		 return;

        }

}

function guardar(){
	bootbox.confirm("Est&aacute; seguro que desea crear una <strong>Nueva Encuesta?</strong>",function(result){
		if(result){
			var obtener = $("#frmDatos").serialize();
			route = "{{ url('/encuesta/store') }}";
			en = "{{ url('/encuesta')}}";
			$.ajax({
				type: 'post',
				url: route,
				data: obtener,
				success: function(data){
						window.location = (en);
				},
				error: function(data){
					//console.clear();
					console.log('ERROR' + data);
					$('#eCodCliente').parent().parent().attr('class','form-group has-error ');
					$('#eCodCliente').parent().children("span").text(data.responseJSON.eCodCliente);

					$('#aMes').parent().parent().attr('class','form-group has-error ');
					$('#aMes').parent().children("span").text(data.responseJSON.aMes);

					$('#eCantidadVisiVen').parent().parent().attr('class','form-group has-error ');
					$('#eCantidadVisiVen').parent().children("span").text(data.responseJSON.eCantidadVisiVen);

					$('#eCantidadVisiTec').parent().parent().attr('class','form-group has-error ');
					$('#eCantidadVisiTec').parent().children("span").text(data.responseJSON.eCantidadVisiTec);

				}
			})
		}

	});

}

function soloNumero(e){
		tecla = (document.all) ? e.keyCode : e.which;
		patron =/[0-9]/;
		te = String.fromCharCode(tecla);
		return patron.test(te);
	}

	$('#eCantidadVisiVen').keypress(function(event){
		return soloNumero(event);
	})
	$('#eCantidadVisiTec').keypress(function(event){
		return soloNumero(event);
	})
</script>


@endsection
