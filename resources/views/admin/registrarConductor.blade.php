@extends('layouts.layout')

@section('content')

<div class="page-title">
			
	<div class="title-env">
	
			<h1 class="title">Agregar Conductor</h1>
	
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
					
						<strong>Agregar Conductor</strong>
				
				</li>
			</ol>
	</div>
	
</div>

<div class="row">
	<div class="col-sm-12">

		<div class="panel panel-default">
			<div class="panel-heading">
		
					<h3 class="panel-title">Crear Conductor</h3>
			
				<div class="panel-options">
					<a href="#" data-toggle="panel">
						<span class="collapse-icon">&ndash;</span>
						<span class="expand-icon">+</span>
					</a>
					
				</div>
			</div>
			<div class="panel-body">

				<form role="form" class="form-horizontal validate" role="form" id="frmDatos" method="POST" action="{{ url('/conductor/store') }}">
					{{ csrf_field() }}

				<div class="form-group">
					<label class="col-sm-2 control-label" for="codigo" >Código:</label>
					<div class="col-sm-5">
						<input type ="text"class="form-control" id="codigo" name="codigo" disabled autofocus >
					</div>


				</div>
					
				<div class="form-group">
					<label class="col-sm-2 control-label" for="aCedula">Cedula:</label>

					<div class="col-sm-5">
						<input type="text" class="form-control" id="aCedula" name="aCedula" placeholder="" data-validate="required" data-message-required="Este campo es requerido">
						@if ($errors->has('aCedular'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('aCedular') }}</strong>
                                </span>
                            @endif
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label" for="aNombre">Nombre:</label>

					<div class="col-sm-5">
						<input type="text" class="form-control" id="aNombre" name="aNombre" placeholder="" data-validate="required" data-message-required="Este campo es requerido">
						@if ($errors->has('aNombre'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('aNombre') }}</strong>
                                </span>
                            @endif
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label" for="aTelefono">Telefono:</label>

					<div class="col-sm-5">
						<input type="text" class="form-control" id="aTelefono" name="aTelefono" placeholder="" data-validate="required" data-message-required="Este campo es requerido">
						@if ($errors->has('aTelefono'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('aTelefono') }}</strong>
                                </span>
                            @endif
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label" for="aDireccion">Direccion:</label>

					<div class="col-sm-5">
						<input type="text" class="form-control" id="aDireccion" name="aDireccion" placeholder="" data-validate="required" data-message-required="Este campo es requerido">
						@if ($errors->has('aDireccion'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('aDireccion') }}</strong>
                                </span>
                            @endif
					</div>
				</div>
					<input type="hidden" name="eCodReg"/>
					<div class="form-group pull-right">
	                <!--  <a  class="btn btn-primary btn-single" href="{{ url('/clientes') }}"><i class="fa-chevron-left"></i></a>-->
	                  <button class="btn btn-secondary btn-single">Registrar</button>
	                </div>

				</form>

			</div>
		</div>

	</div>
</div>

<script src="{{ asset('assets/js/jquery-validate/jquery.validate.min.js') }}"></script>




@endsection