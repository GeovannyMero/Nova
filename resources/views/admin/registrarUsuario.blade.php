
@extends('layouts.layout')

@section('content')
 
<div class="page-title">

  <div class="title-env">
  
      <h1 class="title">Agregar Usuario</h1>
  
    <!--<p class="description">Plain text boxes, select dropdowns and other basic form elements</p>-->
  </div>

    <div class="breadcrumb-env">
      <ol class="breadcrumb bc-1" >
        <li>
          <a href="#"><i class="fa-home"></i>Inicio</a>
        </li>
        <li>
          <a href="#">Usuario</a>
        </li>
        <li class="active">
          
            <strong>Agregar Nuevo</strong>
        
        </li>
      </ol>
  </div>
  
</div>

<div class="row">
  <div class="col-sm-12">

    <div class="panel panel-default">
      <div class="panel-heading">
    
          <h3 class="panel-title">Crear Usuario</h3>
      
        <div class="panel-options">
          <a href="#" data-toggle="panel">
            <span class="collapse-icon">&ndash;</span>
            <span class="expand-icon">+</span>
          </a>
          
        </div>
      </div>
      <div class="panel-body">

        <form role="form" class="form-horizontal validate" role="form" id="frmDatos" method="POST" action="{{ url('/usuario/store') }}">
          {{ csrf_field() }}

        <div class="form-group">
          <label class="col-sm-2 control-label" for="name" >Nombre:</label>
          <div class="col-sm-5">
            <input type ="text"class="form-control" id="name" name="name" required >
          </div>
        </div>
          
        <div class="form-group">
          <label class="col-sm-2 control-label" for="username">Usuario:</label>
          <div class="col-sm-5">
            <input type="text" class="form-control" id="username" name="username" placeholder="" data-validate="required" data-message-required="Este campo es requerido">
            @if ($errors->has('username'))
                 <span class="help-block">
                     <strong>{{ $errors->first('username') }}</strong>
                  </span>
             @endif
          </div>
        </div>

      <div class="form-group">
          <label class="col-sm-2 control-label" for="email" >Correo Electrónico:</label>
        <div class="col-sm-5">
          <input type ="text"class="form-control" id="email" name="email" required >
        </div>
      </div>

              <div class="form-group">
                <label class="col-sm-2 control-label" for="namer">Rol:</label>
               <div class="col-sm-5 ">
                <select class="form-control select"id="namer" name="namer"  data-validate="required" data-message-required="Este campo es requerido" >
                 
                  @foreach($roles as $i)
                    <option value="{{$i->id}}">{{$i->name}}</option>
                  @endforeach
                </select>
              
               
                </div>
                </div>

                

       



        <input type="hidden" name="id"/>
          <div class="form-group pull-right">
                  <!--  <a  class="btn btn-primary btn-single" href="{{ url('/clientes') }}"><i class="fa-chevron-left"></i></a>-->
                    <button class="btn btn-secondary btn-single">Registrar</button>
                  </div>

        </form>

      </div>
    </div>
 
  </div>





<script src="{{ asset('assets/js/jquery-validate/jquery.validate.min.js') }}"></script>

<script src="{{ asset('assets/js/jquery-1.11.1.min.js')}}"></script>
<link  rel="stylesheet" href="{{ asset('assets/js/select2/select2.css')}}">
<script src="{{ asset('assets/js/select2/select2.min.js')}}"></script>
<script src="{{ asset('assets/js/select2/select2.js')}}"></script>


<!--<script  >
$('#s').select2();


</script>
-->


  @endsection
