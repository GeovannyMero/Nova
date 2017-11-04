@extends('layouts.layout')

@section('content')

<div class="page-title">
			
	<div class="title-env">
	
			<h1 class="title">Agregar Rol</h1>
	
		<!--<p class="description">Plain text boxes, select dropdowns and other basic form elements</p>-->
	</div>

		<div class="breadcrumb-env">
			<ol class="breadcrumb bc-1" >
				<li>
					<a href="#"><i class="fa-home"></i>Inicio</a>
				</li>
				<li>
					<a href="#">Rol</a>
				</li>
				<li class="active">
					
						<strong>Agregar Rol</strong>
				
				</li>
			</ol>
	</div>
	
</div>

<div class="row">
	<div class="col-sm-12">

		<div class="panel panel-default">
			<div class="panel-heading">
		
					<h3 class="panel-title">Crear Rol</h3>
			
				<div class="panel-options">
					<a href="#" data-toggle="panel">
						<span class="collapse-icon">&ndash;</span>
						<span class="expand-icon">+</span>
					</a>
					
				</div>
			</div>
			<div class="panel-body">

				<form role="form" class="form-horizontal validate" role="form" id="frmDatos" method="POST" action="{{ url('/rol/store') }}">
					{{ csrf_field() }}

				<div class="form-group">
					<label class="col-sm-2 control-label" for="id" >Código:</label>
					<div class="col-sm-5">
						<input type ="text"class="form-control" id="id" name="id" disabled autofocus >
					</div>


				</div>
					
				<div class="form-group">
					<label class="col-sm-2 control-label" for="name">Nombre:</label>

					<div class="col-sm-5">
						<input type="text" class="form-control" id="name" name="name" placeholder="" data-validate="required" data-message-required="Este campo es requerido">
						@if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label" for="slug">Slug:</label>

					<div class="col-sm-5">
						<input type="text" class="form-control" id="slug" name="slug" placeholder="" data-validate="required" data-message-required="Este campo es requerido">
						@if ($errors->has('slug'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('slug') }}</strong>
                                </span>
                            @endif
					</div>
				</div>


				<div class="form-group">
					<label class="col-sm-2 control-label" for="description">Descripción:</label>

					<div class="col-sm-5">
						<input type="text" class="form-control" id="description" name="description" placeholder="" data-validate="required" data-message-required="Este campo es requerido">
						
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