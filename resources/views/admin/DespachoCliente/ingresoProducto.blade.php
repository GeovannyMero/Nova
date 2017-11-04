<!--<div class="modal fade in " id='modal1' aria-hidden="false" style="display: block;">
	<div class="modal-backdrop fade  " style="height: 534px" ></div>-->
	
		<div class="modal-dialog  modal-lg data-backdrop=”static” data-keyboard=”false” ">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Productos del Cliente: <strong>{{$cliente->aNombre}}</strong></h4>
				</div>
				<div class="modal-body">
					
					<!--<form role="form" class="form-inline validate" role="form" id="frmDatos" method="POST" action="{{ url ('/despachoCliente/storeProducto/')}}">
						{{ csrf_field() }}
						<input type="hidden" name="eCodReg" value="{{$cliente->eCodReg}}"/>


					

						<div class="form-group">
						<label class=" control-label">Productos:</label>
						<select class=" form-control select"id="aNombre" name="aNombre">
							@foreach($producto as $i)
							<option value="{{$i->eCodReg}}">{{$i->aNombre}}</option>
							@endforeach
						
						</select>	
					</div>

					<div class="form-group ">
						<label class=" control-label">Sacos:</label>
						<input  type="text" size="8"class=" form-control  "  id="sacos" name="sacos" placeholder="" data-validate="required" data-message-required="Este campo es requerido">
					</div>

					<div class="form-group">
						<label class=" control-label">Peso de PT:</label>
						<input type="text" class=" form-control "  id="peso" name="peso" placeholder="" data-validate="required" data-message-required="Este campo es requerido">
					</div>

					
					<div class="form-group">
						<a href="#"><button class="btn btn-secondary btn-single" >Agregar</button></a>
					</div>
				</form>-->
					
						<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th >C&oacute;digo</th>
								<th>Nombre Producto</th>
								<th>Sacos</th>
								<th>Peso</th>
								<!--<th>Acciones</th>-->
								
							</tr>
						</thead>
					
						<!--<tfoot>
							<tr>
							  	<th >Codigo</th>
								<th>Nombre Producto</th>
								<th>Sacos</th>
								<th>Peso</th>
								
							
							</tr>
						</tfoot>-->
						<tbody id="bo">
							@foreach($prod as $i)
							<tr>
								<td>{{$i->eCodProducto}}</td>
								<td>{{$i->aNombreProducto}}</td>
								<td>{{$i->eSacos}}</td>
								<td>{{$i->ePesoPT}}</td>
								
							</tr>
							@endforeach
						</tbody>	
					</table>
					
				</div>

			</div>
		</div>
<!--</div>
<script type="text/javascript">

function agregar(){
		$.ajax({
			type: 'POST',
			url: '/despachoCliente/storeProducto/',
			success: function(data){
				alert('ok');
			}
		});
	}-->
</script>