@extends('layouts.layout')

@section('content')

<div class="page-title">

	<div class="title-env">
		<h1 class="title">Subir PT y MP</h1>
	</div>

		<div class="breadcrumb-env">
			<ol class="breadcrumb bc-1" >
				<li>
					<a href="#"><i class="fa-home"></i>Inicio</a>
				</li>

				<li class="active">
					<strong>Subir PT y MP </strong>
				</li>
			</ol>
		</div>

	</div>

<div class="row">
	<div class="col-sm-12">
@include('alerts')
		<div class="panel panel-default">
			<div class="panel-heading">

					<h3 class="panel-title">Subir PT y MP</h3>


				<div class="panel-options">
					<a href="#" data-toggle="panel">
						<span class="collapse-icon">&ndash;</span>
						<span class="expand-icon">+</span>
					</a>

				</div>
			</div>
			<div class="panel-body">

			<form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;  border-style: dashed;" action="{{ url ('/importExcel') }}" file = "true" class="form-horizontal" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="form-group radion-inline">&nbsp;
					<input type="radio" class="radio-inline" name ="tipo" id="tipo" value="PT" >PT
					<input type="radio" class="radio-inline" name= "tipo" id="tipo" value="MP">MP
				</div>
				<center><input type="file" name="import_file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" size="50" /></center>
				<br>
				<center><button class="btn btn-primary">Subir datos</button></center>
			</form>




			</div>

		</div>
	</div>
</div>


		<script src="{{ asset('assets/js/datatables/js/jquery.datatables.min.js') }}"></script>
		<script src="{{ asset('assets/js/jquery-validate/jquery.validate.min.js') }}"></script>
		<script src="{{ asset('assets/js/datepicker/bootstrap-datepicker-es.js') }}"></script>
		<script src="{{ asset('assets/js/bootstrap-filestyle.min.js') }}"></script>



<script type="text/javascript">
$(":file").filestyle({
input: false,
buttonText: "",
iconName: 'fa-cloud-upload',
size: 'lg'
});

</script>
	@endsection
