@extends('layouts.layout')

@section('content')


<div class="row">
	<div class="col-sm-12">

		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Cambio de Clave</h3>
				<div class="panel-options">
					<a href="#" data-toggle="panel">
						<span class="collapse-icon">&ndash;</span>
						<span class="expand-icon">+</span>
					</a>
					<!--<a href="#" data-toggle="remove">
						&times;
					</a>-->
				</div>
			</div>
			<div class="panel-body">

				<form role="form" class="form-horizontal" role="form" id="frmDatos" method="POST" action="{{url('/cambioClave')}}">
					{{ csrf_field() }}

					<div class="form-group">
						<label class="col-sm-2 control-label" for="username">Usuario:</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="username" name="username" value="{{ Auth::user()->username }}" placeholder="" disabled autofocus>
						</div>
					</div>
					<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
						<label class="col-sm-2 control-label" for="password">Contraseña:</label>
						<div class="col-sm-10">
							<input type="password" class="form-control" id="password" name="password" value="" placeholder="Nueva Contraseña" required>
							@if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label" for="password_confirmation">Confirmar Contraseña</label>
						<div class="col-sm-10">
							<input type="password" class="form-control" id="password_confirmation" name="password_confirmation" value="" placeholder="Confirmar Contraseña" required>
						</div>
					</div>

					<div class="form-group pull-right">
	                  <a  class="btn btn-primary btn-single" href="javascript:;" onclick="window.history.back();"><i class="fa-chevron-left"></i></a>
	                  <button class="btn btn-secondary btn-single">Cambiar</button>
	                </div>

				</form>

			</div>
		</div>

	</div>
</div>


@endsection