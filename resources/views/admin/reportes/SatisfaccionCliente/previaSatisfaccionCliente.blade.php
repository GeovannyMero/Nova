
@foreach ($seguimiento as $j)
	<tr>
		<td>{{  date_format(date_create(date($j->fecha)),'Y-m-d') }}</td>
		<td>{{$j->cliente}}</td>
		<td>{{$j->placa}}</td>
		<td>{{$j->producto}}</td>
		<td>{{$j->tiempoB}}</td>
		<td>{{$j->tiempo}}</td>
		<td>{{$j->cantidadB}}</td>
		<td>{{$j->cantidad}}</td>
		<td>{{$j->calidadB}}</td>
		<td>{{$j->calidad}}</td>
	</tr>
@endforeach 
	
				
	
			<!--<div class="vertical-top">
			  <a  class="btn btn-primary  btn-icon btn-icon-standalone" href="javascript:;" onclick="window.history.back();"><i class="fa-chevron-left"></i></a>
		 <a href="/ver/reporteDespacho" > <button class="btn btn-red  btn-icon btn-icon-standalone" ><i class="fa-file-pdf-o"></i><span> PDF </span></button></a>
			  <a href="/ver/excelSatisfaccion" > <button class="btn btn-secondary  btn-icon btn-icon-standalone" ><i class="fa-file-excel-o"></i><span> EXCEL </span></button></a>
		</div>-->
		
		
	