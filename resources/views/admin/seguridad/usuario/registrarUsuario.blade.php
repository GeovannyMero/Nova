
@extends('layouts.layout')

@section('content')

<div class="page-title">

  <div class="title-env">
  @if($user->id == '')
      <h1 class="title">Agregar Usuario</h1>
  @else
      <h1 class="title">Editar Usuario</h1>
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
          @if($user->id == '')
            <strong>Agregar Nuevo</strong>
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
        @if($user->id == '')
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



        <form role="form" class="form-horizontal validate" role="form" id="frmDatos">
          {{ csrf_field() }}


      <div class="form-group">
          <label class="col-sm-2 control-label" for="id" >C&oacute;digo:</label>
          <div class="col-sm-10">
            <input type ="text"class="form-control" id="id" name="id" value="{{$user->id}}" disabled autofocus >

          </div>
      </div>

        <div class="form-group">
          <label class="col-sm-2 control-label" for="name" >Nombre:</label>
          <div class="col-sm-10">
            <input type ="text"class="form-control" id="name" name="name" value="{{$user->name or old('name')}}"required onkeypress="return soloLetras(event)" >
          @if ($errors->has('name'))
            <span class="help-block">
              <strong>{{ $errors->first('name') }}</strong>
            </span>
          @endif
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label" for="username">Usuario:</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="username" name="username" value="{{$user->username or old('username')}}" placeholder="" data-validate="required" data-message-required="Este campo es requerido">
              <span class="help-block"></span>

          </div>
        </div>

      <div class="form-group">
          <label class="col-sm-2 control-label" for="email" >Correo Electrónico:</label>
        <div class="col-sm-10">
          <input type ="email"class="form-control" id="email" name="email" value="{{$user->email or old('email')}}" required >
            <span class="help-block"></span>

        </div>
      </div>







        <!--<input type="hidden" name="id"/>-->
        <input type="hidden" name="id" value="{{$user->id}}" />


        </form>
         <div class="form-group pull-right">
            <!--  <a  class="btn btn-primary btn-single" href="javascript:;" onclick="window.history.back();"><i class="fa-chevron-left"></i></a>-->
                  <!--  <a  class="btn btn-primary btn-single" href="{{ url('/clientes') }}"><i class="fa-chevron-left"></i></a>-->
                  <a href="javascript:;" onclick="guardar()"><button class="btn btn-secondary">Guardar</button></a>
                  </div>

      </div>
    </div>

  </div>


<link  rel="stylesheet" href="{{ asset('assets/js/alertify/css/alertify.css')}}">
<link  rel="stylesheet" href="{{ asset('assets/js/alertify/css/alertify.min.css')}}">


<script src="{{ asset('assets/js/jquery-validate/jquery.validate.min.js') }}"></script>


<script src="{{ asset('assets/js/jquery-1.11.1.min.js')}}"></script>
<link  rel="stylesheet" href="{{ asset('assets/js/select2/select2.css')}}">
<script src="{{ asset('assets/js/select2/select2.min.js')}}"></script>
<script src="{{ asset('assets/js/select2/select2.js')}}"></script>
<script src="{{ asset('assets/js/bootbox/bootbox.min.js') }}"></script>
<script src="{{ asset('assets/js/alertify/alertify.js')}}"></script>
<script src="{{ asset('assets/js/alertify/alertify.min.js')}}"></script>


<script type="text/javascript">
function soloLetras(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
       especiales = "8-37-39-46";

       tecla_especial = false
       for(var i in especiales){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }

        if(letras.indexOf(tecla)==-1 && !tecla_especial){
            return false;
        }
    }


function guardar(){
  bootbox.confirm("Est&aacute; seguro que desea guardar un <strong>Nuevo Usuario?</strong>",function(result){
    if(result){
      var obtener = $("#frmDatos").serialize();
      var cod = $('#id').val();
      if(cod == ''){
         route = "{{ url('/usuario/store') }}";
         usu = "{{url ('/Usuarios')}}";
        $.ajax({
          type: 'POST',
          url: route ,
          data: obtener,
           success: function() {
            window.location = (usu);

               //window.location.reload(); // This is not jQuery but simple plain ol' JS
         },
         error: function(data){
          console.clear();
          alertify.notify('<strong>Error</strong> al guardar registro','success', 2, function(){console.log('dismissed');});
              console.log('ERROR',data);
              $('#username').parent().parent().attr('class','form-group has-error ');
              $('#username').parent().children("span").text(data.responseJSON.username);
                $('#email').parent().parent().attr('class','form-group has-error ');
                $('#email').parent().children("span").text(data.responseJSON.email);



         }

        });
        //fin ajax

      }else{
        // alertify.alert('aki');
          route = "{{ url('/usuario/update') }}";
        $.ajax({
          type: 'POST',
          url: route ,
          data: obtener,
           success: function() {
            window.location = ('/Usuarios');
               //window.location.reload(); // This is not jQuery but simple plain ol' JS
         },
         error: function(data){
        //  alertify.warnig('Paso algo');
              console.log('ERROR',data);


         }

        });
        //fin ajax
      }

      }//endif
  });//bootbox
}

</script>

  @endsection
