<!--<div class="modal fade in " id='modal1' aria-hidden="false" style="display: block;">
	<div class="modal-backdrop fade  " style="height: 534px" ></div>-->


		<div class="modal-dialog  modal-lg data-backdrop=”static” data-keyboard=”false” ">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"> <strong>Seleccionar Archivo</strong></h4>
				</div>
				<div class="modal-body">
					<form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;  border-style: dashed;" action="{{ url ('/subirGuia') }}" file = "true" class="form-horizontal" method="post" enctype="multipart/form-data">
					{{ csrf_field() }}
					<input type="hidden" name="eCodReg" value="{{$id}}"/>
						<center><input type="file" accept="image/*" name="import_file" /></center>
						<br>
						<center><button class="btn btn-primary">subir Imagen</button></center>
					</form>

				
				</div>

			</div>
		</div>

		<script src="{{ asset('assets/js/select2/select2.js')}}"></script>

<script type="text/javascript">
$(":file").filestyle({
input: false,
buttonText: "",
iconName: 'fa-cloud-upload',
size: 'lg'
});

</script>