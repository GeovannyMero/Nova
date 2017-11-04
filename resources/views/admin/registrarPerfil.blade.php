@extends('layouts.layout')

@section('content')

<div class="page-title">
			
	<div class="title-env">
	
			<h1 class="title">Agregar Perfil</h1>
	
		<!--<p class="description">Plain text boxes, select dropdowns and other basic form elements</p>-->
	</div>

		<div class="breadcrumb-env">
			<ol class="breadcrumb bc-1" >
				<li>
					<a href="#"><i class="fa-home"></i>Home</a>
				</li>
				<li>
					<a href="#">Perfil</a>
				</li>
				<li class="active">
					
						<strong>Agregar Cliente</strong>
				
				</li>
			</ol>
	</div>
	
</div>

<div class="row">
	<div class="col-sm-12">

		<div class="panel panel-default">
			<div class="panel-heading">
		
					<h3 class="panel-title">Crear Perfil</h3>
			
				<div class="panel-options">
					<a href="#" data-toggle="panel">
						<span class="collapse-icon">&ndash;</span>
						<span class="expand-icon">+</span>
					</a>
					
				</div>
			</div>
			<div class="panel-body">

				<form role="form" class="form-horizontal validate" role="form" id="frmDatos" method="POST" action="{{ url('/perfil/store') }}">
					{{ csrf_field() }}

				<div class="form-group">
					<label class="col-sm-2 control-label" for="codigo" >Código:</label>
					<div class="col-sm-5">
						<input type ="text"class="form-control" id="codigo" name="codigo" disabled autofocus >
					</div>


				</div>
					
				<div class="form-group">
					<label class="col-sm-2 control-label" for="nombre">Nombre:</label>

					<div class="col-sm-5">
						<input type="text" class="form-control" id="nombre" name="aNombre" placeholder="" data-validate="required" data-message-required="Este campo es requerido">
						@if ($errors->has('aNombre'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('aNombre') }}</strong>
                                </span>
                            @endif
					</div>
				</div>

					<input type="hidden" name="eCodReg"/>
					<div class="form-group pull-right">
						  <a  class="btn btn-primary btn-single" href="javascript:;" onclick="window.history.back();"><i class="fa-chevron-left"></i></a>
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