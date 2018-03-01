@extends('layouts.layout')

@section('content')

<div class="page-title">

	<div class="title-env">
		<h1 class="title">Consulta de los despachos de clientes</h1>
	</div>

		<div class="breadcrumb-env">
			<ol class="breadcrumb bc-1" >
				<li>
					<a href="#"><i class="fa-home"></i>Inicio</a>
				</li>

				<li class="active">
					<strong>Consulta despacho </strong>
				</li>
			</ol>
		</div>

	</div>

<div class="row">
	<div class="col-sm-12">
@include('alerts')
		<div class="panel panel-default">
			<div class="panel-heading">

					<h3 class="panel-title">Despacho de Clientes</h3>


				<div class="panel-options">
					<a href="#" data-toggle="panel">
						<span class="collapse-icon">&ndash;</span>
						<span class="expand-icon">+</span>
					</a>

				</div>
			</div>
			<div class="panel-body">
							<div class="form-inline">

			<!--	<form role="form" class="form-inline validate" role="form" id="frmDatos" method="POST" action="{{ url('/clientesDespacho')}}">
						{{ csrf_field() }}-->
					<div class="form-group">
						<label class="control-label">Fecha Desde:</label>
						<input type="text" size="8" class="form-control datepicker" format=" dd-MM-yyyy" id="fd" name="fd" placeholder="" data-validate="required" data-message-required="Este campo es requerido">
					</div>

					<div class="form-group">
						<label class="control-label">Fecha Hasta:</label>
						<input type="text" size="8" class="form-control datepicker" format=" dd-MM-yyyy" id="fh" name="fh" placeholder="" data-validate="required" data-message-required="Este campo es requerido">
					</div>


					<div class="form-group">
						<label class="control-label">Camión:</label>
						<select class=" form-control select"id="aPlaca" name="aPlaca" placeholder="selecione un camion">
							 <option value="" disabled selected>Selecione un placa</option>
							@foreach($camion as $i)
								<option value="{{$i->eCodReg}}">{{$i->placa}}</option>
							@endforeach
								<option value=0>Todos</option>
						</select>
					</div>


					<div class="form-group">
						<label class="control-label">Aprobación:</label>
						<select class=" form-control select"id="apro" name="apro" placeholder="selecione un camion">
							 <option value="" disabled selected>Selecione una opción</option>
							 <option value="SI">SI</option>
							 <option value="NO">NO</option>
							 <option value=0>Todos</option>


						</select>
					</div>
					<!--ticket se carga mediante la selecion de un camion
					<div class="form-group">
						<label class="control-label">Ticket:</label>
						<input type="text" class="form-control"  id="ticket" name="ticket" placeholder="" data-validate="required" data-message-required="Este campo es requerido">
					</div>-->

					<div class="form-group">
						<!--<button type="submit" value="Submit"id='btnAgregarCliente' class="btn btn-secondary btn-icon btn-icon-standalone" ><i class="fa-search-plus"></i><span>Buscar</span></button>-->
						  <a  class="btn btn-secondary btn-single" href="javascript:;" onclick="buscar();">Cargar</a>
					</div>

				<!--</form>-->
				</div>
			</div>

		</div>

		<!--tabla-->
			<div class="panel panel-default">
			<div class="panel-heading">
					<h3 class="panel-title">Resultado</h3>
				<div class="panel-options">
					<a href="#" data-toggle="panel">
						<span class="collapse-icon">&ndash;</span>
						<span class="expand-icon">+</span>
					</a>

				</div>
			</div>
			<div class="panel-body">

<!---->				<div id="seg"  class="table-responsive"  data-pattern="priority-columns" data-focus-btn-icon="fa-asterisk" data-sticky-table-header="false" data-add-display-all-btn="true" data-add-focus-btn="false">
					<table id="example-1" class="table table-small-font table-bordered table-striped" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th >Ciclo</th>
								<th>Camión</th>

								<th>Código Chofer</th>
								<th>Chofer</th>
								<th>Compañia</th>
								<th>Estado</th>
								<th>Acciones</th>

								</th>
							</tr>
						</thead>
						<tbody  id="bo">

						</tbody>
					</table>

				</div>
			</div>
<div class="modal fade in " id="pro"></div>
		</div>
	</div>
</div>


		<script src="{{ asset('assets/js/datatables/js/jquery.datatables.min.js') }}"></script>
		<script src="{{ asset('assets/js/jquery-validate/jquery.validate.min.js') }}"></script>
		<script src="{{ asset('assets/js/datepicker/bootstrap-datepicker-es.js') }}"></script>



<script >

 function buscar(){
	var desde  = $('#fd').val();
	var hasta  = $('#fh').val();
	var placa  = $('#aPlaca').val();
	var apro = $('#apro').val();
//alert(apro);
	var route = "{{ url ('/clientesDespacho')}}" + '/' + desde +'/' + hasta + '/' + placa + '/' + apro  ;
	
$.ajax({
 		type:'GET',
 		url: route,

  		success: function(data){
  			$('#bo').html("")
 			$('#bo').html(data);
 			$('#bo').html('');
			$('#bo').html("");
			$('#bo').html(data);

 		},
 		error: function(data){
 			 console.log('ERROR:' + data)
			  alert('No hay datos que considen con la busqueda');
			  $('#res').html(data);
 		},

 	});


}
	var f = $('#fd').datepicker({
		format: "yyyy-mm-dd"
	});

	var f = $('#fh').datepicker({
		format: "yyyy-mm-dd"
	});
/*busca el ticket del camion del ciclo
$(document).ready(function(){
	$('#aPlaca').change(function(){
	var placa = $('#aPlaca').val();
	//route = {{url('/despachoCliente')}} + '/' + placa;

	$('#ticket').val($(this).val());
	//alert(placa);
	})
});
*/

</script>

<script >

	/*$("#s").select2({
	  placeholder: "Seleccione uno o mas clientes",
	  allowClear: true
	});*/

	var f = $('#fd').datepicker({
		format: "mm-dd-yyyy"
	});

function producto(idCliente=0, idCiclo=0){
	//alert(idCliente);
		$("#pro").html("");
		//if(idCliente != 0 ){



		/*$.get(route, function(data){
	    	$("#pro").html(data);
	    	$('#pro').modal('show', {backdrop: 'static'});
	    	//initFormAlim();
	    })*/
	    $.ajax({
	    //	route = "{{url ('/Inproducto')}}" + "/" + idCliente + '/' + idCiclo;

	    	type: 'GET',
	    	url: "{{url ('/Inproducto')}}" + "/" + idCliente + '/' + idCiclo,
	    	success: function(data){
	    	$("#pro").html(data);
	    	$('#pro').modal('show', {backdrop: 'static'});
			},
				error : function (data){
					console.log(data);
				}
	    });
	}


	function Captura(){

		var fecha = f.val();
	//	var idCamion = document.getElementById('aPlaca').value;
		var placa = $('#aPlaca option:selected').html();
		var ticket = $('#ticket').val();
		//alert(placa +'--'+ fecha + '--' + ticket);
		$.ajax({
			 type:'GET',
          //   data: fecha,idCamion,ticket,
              url:'/buscar/'+ fecha + '/' + placa + '/' + ticket,
              success: function(data){

              	$('#example').html('');
              	$('#res').html(data);
              	alert(data);
/*	var dhtml ='';
               for(datas in data.clienteDespacho){

             	dhtml = dhtml +'<tr>';
               	dhtml = dhtml +'<td>'+data.clienteDespacho[datas].eCodReg+'</td>';
               	dhtml = dhtml +'<td>'+data.clienteDespacho[datas].aRUC+'</td>';
               	dhtml = dhtml +'<td>'+data.clienteDespacho[datas].aNombre+'</td>';
               	dhtml = dhtml +'<td>'+data.clienteDespacho[datas].aDireccion+'</td>';
               	dhtml = dhtml +'<td>'+data.clienteDespacho[datas].aTelefono+'</td>';
               	dhtml = dhtml +'<td>'+data.clienteDespacho[datas].aMail+'</td>';
               	dhtml = dhtml +'<td><a href="javascript:;" onclick="producto({{$i->eCodReg}});" > <button class="btn btn-secondary btn-icon btn-icon-standalone" ><i class="fa-search-plus"></i></button></a></td>';

               	dhtml = dhtml +'</tr>';




               };
				 $("#bo").append(dhtml);*/
				// url= 'admin/DespachoCliente/tableCliente'
				 //$('#res').load(url);
              }
           });
	}


</script>
	@endsection
