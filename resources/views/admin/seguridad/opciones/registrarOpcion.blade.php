
@extends('layouts.layout')

@section('content')
 
<div class="page-title">

  <div class="title-env">
    @if($opcion->eCodReg == '')
      <h1 class="title">Agregar Opcion</h1>
 @else
   <h1 class="title">Editar Opcion</h1>
   @endif
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
             @if($opcion->eCodReg == '')
               <strong>Registrar</strong>
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
        @if($opcion->eCodReg == '')
          <h3 class="panel-title">Crear Usuario</h3>
    @else
     <h3 class="panel-title">Editar Usuario</h3>
     @endif
        <div class="panel-options">
          <a href="#" data-toggle="panel">
            <span class="collapse-icon">&ndash;</span>
            <span class="expand-icon">+</span>
          </a>
          
        </div>
      </div>
      <div class="panel-body">
       <!--  <div class="col-md-10 col-sm-10"><img src="{{ asset('assets/images/user-2.png') }}" class="img-responsive img-circle" alt="user-pic" </div>-->
        <form role="form" class="form-horizontal validate" role="form" id="frmDatos" method="POST" action="{{ url('/opcion/store') }}">
          {{ csrf_field() }}


        <div class="form-group">
          <label class="col-sm-2 control-label" for="aNombre" >Sistema:</label>
          <div class="col-sm-10">
             <select class="form-control select"id="aNombre" name="aNombre"  data-validate="required" data-message-required="Este campo es requerido" >
                  @foreach($sistema as $i)
                    <option value="{{$i->eCodReg}}">{{$i->aNombre}}</option>
                  @endforeach
                </select>
             
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="aNombreO" >Nombre:</label>
          <div class="col-sm-10">
            <input type ="text"class="form-control" id="aNombreO" name="aNombreO" required >
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="aEstado" >Estado:</label>
          <div class="col-sm-10">
             <select class="form-control select"id="aEstado" name="aEstado"  data-validate="required" data-message-required="Este campo es requerido" >
               
                    <option >Activo</option>
                    <option >Inactivo</option>
              
                </select>
             
          </div>
        </div>
          
       

    
             

                

       



        <input type="hidden" name="id"/>
          <div class="form-group pull-right">
              <a  class="btn btn-primary btn-single" href="javascript:;" onclick="window.history.back();"><i class="fa-chevron-left"></i></a>
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
