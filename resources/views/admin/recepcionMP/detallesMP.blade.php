@extends('layouts.layout')

@section('content')
<div class="page-title">

	<div class="title-env">
		<h1 class="title">Detalles de MP</h1>
	</div>

		<div class="breadcrumb-env">
			<ol class="breadcrumb bc-1" >
				<li>
					<a href="#"><i class="fa-home"></i>Inicio</a>
				</li>

				<li class="active">
					<strong>Detalles MP</strong>
				</li>
			</ol>
		</div>

	</div>





  <div class="panel panel-default">
    <!--panel de la llegada del camion-->

    <div class="panel-heading">
      <h3 class="panel-title">Llegada</h3>
    </div>
    <div class="panel-body">
      <table id="example-1" class="table table-small-font table-bordered table-striped" cellspacing="0" width="100%">
        <thead>
          <tr>
           <!-- <th >Ciclo</th>-->
            <th>Fecha Llegada</th>
            <th>Hora Llegada</th>
            <th>Camión</th>
			<th>Cedula</th>
            <th>Chofer</th>

            </th>
          </tr>
        </thead>
        <tbody  id="bo">
          @foreach($ciclo as $i)

            <tr>
              <!--<td>{{ $i->eCodReg}}</td>-->
              <td>{{Carbon\Carbon::parse($i->fecha)->format('Y-m-d')}}</td>
              <td>{{ $i->hora}}</td>

              <td>{{ $i->placa}}</td>
							<td>{{$i->cedula}}</td>
              <th>{{ $i->aNombre}}</th>



            </tr>
          @endforeach
        </tbody>
      </table>
<!--fin de llegada-->
<!-- Ingreso MP-->
      <div class="panel-heading">
        <h3 class="panel-title">Ingreso</h3>
      </div>
      <div class="panel-body">
      
       <table id="example-1" class="table table-small-font table-bordered table-striped" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th >Ciclo</th>
            <th colspan='2'>Fecha Ingreso</th>
            <th colspan='2'>Hora Ingreso</th>




          </tr>
        </thead>
        <tbody  id="bo">
          @foreach($ingreso as $i)
          <tr>
              <td>{{ $i->eCodCiclo}}</td>
              <td colspan='2'>{{ $i->dtFechaIngreso }}</td>
              <td colspan='2'>{{ $i->hHoraIngreso}}</td>
          </tr>
          @endforeach
          <!--Historial de carga-->
                 <thead>
                    <tr>
                        <th colspan='5' bgcolor="#08F2FF">HISTORIAL DE CARGA</th>
                    </tr>
                    <tr>
                        <th>Fecha</th>
                        <th>Procedencia</th>
                        <th colspan='2'>Insumo</th>
                        <th>Guia remisón</th>
                    </tr>
                   </thead>
                   <tbody>
                       @foreach($hcarga as $i)
                        <td>{{$i->fecha}}</td>
                        <td>{{$i->procedencia}}-</td>
                        <td  colspan='2'>{{$i->insumo}}</td>
                        <td>{{$i->guia}}</td>
                       @endforeach
                   </tbody>
            <!--Historial de Limpieza-->
            <thead>
                <tr>
                    <th colspan ='5' bgcolor="#08F2FF">HISTORIAL DE LIMPIEZA</th>
                </tr>
                <tr>
                    <th>Fecha</th>
                    <th>Método Limpieza</th>
                    <th>Agente Limpieza</th>
                    <th>Método Fumigación</th>
                    <th>Agente Fumigación</th>

                </tr>
            </thead>
            <tbody>
                @foreach($hLimpieza as $i)
                <td>{{$i->fecha}}</td>
                <td>{{$i->MLim}}</td>
                <td>{{$i->ALim}}</td>
                <td>{{$i->MFumi}}</td>
                <td>{{$i->AFumi}}</td>
                @endforeach
            </tbody>
             
            

        </tbody>
      </table>
          
      </div>
    <!--Aprobacion-->
    <div class="panel-heading">
      <h3 class="panel-title">Aprobación</h3>
    </div>
    <div class="panel-body">
      <table id="example-1" class="table table-small-font table-bordered table-striped" cellspacing="0" width="100%">
        <thead>
          <tr>
           <!-- <th >Ciclo</th>-->
            <th>Aprobación Financiera</th>
            <th>Observación</th>
            <th >Producción Calidad</th>
            <th>Observación</th>
            <th>Logistica</th>
            <th>Observación</th>
           </tr>
        </thead>
        <tbody  id="bo">
          @foreach($apro as $i)
          <tr>
          <!--    <td>{{ $i->eCodReg}}</td>-->
              <td>{{ $i->bfina }}</td>
              <td>{{ $i->fina}}</td>
              <td>{{$i->bpro}}</td>
              <td>{{$i->pro}}</td>
              <td>{{$i->blog}}</td>
              <td>{{$i->log}}</td>
          </tr>
          @endforeach

        </tbody>
      </table>
     <!--fin de aprobacion-->
     <!--Peso Inicial-->
    <div class="panel-heading">
      <h3 class="panel-title">Peso Inicial</h3>
    </div>
    <div class="panel-body">
       <table id="example-1" class="table table-small-font table-bordered table-striped" cellspacing="0" width="100%">
        <thead>
          <tr>
          <!--  <th >Ciclo</th>-->
            <th>Fecha</th>
            <th>Hora</th>
            <th>Ticket</th>
            <th>Peso</th>
            <th>Número de pedido</th>

           </tr>
        </thead>
        <tbody  id="bo">
          @foreach($PI as $i)
          <tr>
             <!-- <td>{{ $i->eCodReg}}</td>-->
              <td>{{Carbon\Carbon::parse($i->fecha)->format('Y-m-d')}}</td>
              <td>{{ $i->hora}}</td>
              <td>{{$i->ticket}}</td>
              <td>{{$i->peso}}</td>
              <td>{{$i->pedido}}</td>
          </tr>
          @endforeach

        </tbody>
      </table>
    </div>
    <!--fin peso inicial-->
    <!--Inspeccion-->
    <div class="panel-heading">
      <h3 class="panel-title">Inspección</h3>
    </div>
    <div class="panel-body">
      <div id='ex'class="table-responsive"  data-pattern="priority-columns" data-focus-btn-icon="fa-asterisk" data-sticky-table-header="false" data-add-display-all-btn="true" data-add-focus-btn="false">
       <table id="example-1" class="table table-small-font table-bordered table-striped" cellspacing="0" width="100%">
        <thead>
          <tr>
          <!--  <th >Ciclo</th>-->
            <th>Fecha</th>
           <!-- <th>Hora</th>-->
            <th>Cubierto</th>
            <th>Lona</th>
            <th>Desinfección</th>
            <th>Limpieza</th>
            <th>Insectos</th>
            <th>Contaminantes</th>
            <th>Observaciones</th>
            <th>Resultado</th>

           </tr>
        </thead>
        <tbody  id="bo">
          @foreach($insp as $i)
          <tr>
              <!--<td>{{ $i->eCodReg}}</td>-->
              <td>{{Carbon\Carbon::parse($i->fecha)->format('Y-m-d')}}</td>
              <td>{{ $i->aCubierto}}</td>
              <td>{{$i->aLona}}</td>
              <td>{{$i->aDesinfeccion}}</td>
              <td>{{$i->aLimpieza}}</td>
              <td>{{$i->aInsectos}}</td>
              <td>{{$i->aContaminantes}}</td>
              <td>{{$i->aObservaciones}}</td>
              <td>{{$i->aResultado}}</td>
          </tr>
          @endforeach

        </tbody>
      </table>
    </div>
    </div>
    <!--fin de inspeccion-->
    <!--Carga-->
    <div class="panel-heading">
      <h3 class="panel-title">Carga</h3>
    </div>
    <div class="panel-body">
       <table id="example-1" class="table table-small-font table-bordered table-striped" cellspacing="0" width="100%">
        <thead>
          <tr>
           <!-- <th >Ciclo</th>-->
            <th>Fecha</th>
           <!-- <th>Hora</th>-->
            <th>Inicio de carga</th>
            <th>Fin de Carga</th>
            <th>Observacion</th>
          </tr>
        </thead>
        <tbody  id="bo">
            @foreach($carga as $i)
          <tr>
              <!--<td>{{ $i->eCodReg}}</td>-->
							<td>{{Carbon\Carbon::parse($i->dFechaIniMovimiento)->format('Y-m-d')}}</td>

              <td>{{ $i->dIniMovimiento}}</td>
              <td>{{$i->dFinMovimiento}}</td>
              <td>{{$i->aObservaciones}}</td>

          @endforeach

        </tbody>
      </table>
    </div>
    <!--fin de carga-->
    <!--Peso de Salida-->
    <div class="panel-heading">
      <h3 class="panel-title">Peso Salida</h3>
    </div>
    <div class="panel-body">
       <table id="example-1" class="table table-small-font table-bordered table-striped" cellspacing="0" width="100%">
        <thead>
          <tr>
            <!--<th >Ciclo</th>-->
            <th>Fecha</th>
            <th>Hora</th>
            <th>ticket</th>
            <th>Peso final de camión</th>
            <th>Peso del producto terminado</th>
          </tr>
        </thead>
        <tbody  id="bo">
            @foreach($pesoS as $i)
          <tr>
              <!--<td>{{ $i->eCodReg}}</td>-->
              <td>{{Carbon\Carbon::parse($i->fecha)->format('Y-m-d')}}</td>
              <td>{{ $i->hora }}</td>
              <td>{{ $i->ticket}}</td>
              <td>{{$i->peso}}</td>
              <td>{{$i->pesoP}}</td>

          @endforeach

        </tbody>
      </table>
    </div>
    <!--fin de Peso de salida-->
    <!--Salida-->
    <div class="panel-heading">
      <h3 class="panel-title">Salida</h3>
    </div>
    <div class="panel-body">
      <table id="example-1" class="table table-small-font table-bordered table-striped" cellspacing="0" width="100%">
        <thead>
          <tr>
          <!--  <th >Ciclo</th>-->
            <th>Fecha</th>
            <th>Hora</th>
            <th>Observación</th>

          </tr>
        </thead>
        <tbody  id="bo">
             @foreach($salida as $i)
          <tr>
           <!--   <td>{{ $i->ciclo}}</td>-->
              <td>{{Carbon\Carbon::parse($i->fecha)->format('Y-m-d')}}</td>
              <td>{{ $i->hora }}</td>
              <td>{{ $i->obs}}</td>


          @endforeach


        </tbody>
      </table>
    </div>
    <!--Fin de salida-->
    </div>

  
     
  </div>
  <script src="https://cdn.jsdelivr.net/handlebarsjs/4.0.5/handlebars.min.js"></script>
<script id="details-template" type="text/x-handlebars-template">
        <div class="label label-info">Ingreso</div>
        <table class="table details-table"  id="posts-@{{id}}">
            <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
				<th>Descripción</th>

            </tr>
            </thead>
						<tbody>

						</tbody>
        </table>
    </script>







@endsection
