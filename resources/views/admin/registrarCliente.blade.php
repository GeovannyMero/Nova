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

				<form role="form" class="form-horizontal validate" role="form" id="frmDatos" method="POST" action="{{ url('/cliente/store') }}">
					{{ csrf_field() }}

				<div class="form-group">
					<label class="col-sm-2 control-label" for="eCodReg" >Código:</label>
					<div class="col-sm-5">
						<input type ="text"class="form-control" id="eCodReg" value="{{$cliente->eCodReg}}"name="eCodReg" disabled autofocus >
					</div>


				</div>
					
				<div class="form-group">
					<label class="col-sm-2 control-label" for="aCedula">RUC:</label>

					<div class="col-sm-5">
						<input type="text" class="form-control" id="aCedula" name="aCedula" value="{{$cliente->aRUC}}" placeholder="" data-validate="required" data-message-required="Este campo es requerido">
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
						<input type="text" class="form-control" id="aNombre" name="aNombre" placeholder="" value="{{$cliente->aNombre}}" data-validate="required" data-message-required="Este campo es requerido">
						@if ($errors->has('aNombre'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('aNombre') }}</strong>
                                </span>
                            @endif
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label" for="aDireccion">Direccion:</label>

					<div class="col-sm-5">
						<input type="text" class="form-control" id="aDireccion" name="aDireccion" placeholder="" value="{{$cliente->aDireccion}}"data-validate="required" data-message-required="Este campo es requerido">
						@if ($errors->has('aDireccion'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('aDireccion') }}</strong>
                                </span>
                            @endif
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label" for="aTelefono">Telefono:</label>

					<div class="col-sm-5">
						<input type="text" class="form-control" id="aTelefono" name="aTelefono" placeholder="" value="{{$cliente->aTelefono}}" data-validate="required" data-message-required="Este campo es requerido">
						@if ($errors->has('aTelefono'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('aTelefono') }}</strong>
                                </span>
                            @endif
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label" for="aMail">Correo Electronico:</label>

					<div class="col-sm-5">
						<input type="text" class="form-control" id="aMail" name="aMail" placeholder="" value="{{$cliente->aMail}}" data-validate="required" data-message-required="Este campo es requerido">
						@if ($errors->has('aMail'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('aMail') }}</strong>
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