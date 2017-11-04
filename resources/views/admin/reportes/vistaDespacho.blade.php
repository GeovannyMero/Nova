@foreach($cliente as $i)
<tr>
	<td>{{Carbon\Carbon::parse($i->fecha)->format('Y-m-d')}}</td>
	<td>{{$i->tipo}}</td>
	<td>{{$i->doc}}</td>
	<td>{{$i->trans}}</td>
	<td>{{$i->entidad}}</td>
	<td>{{$i->cliente}}</td>
	<td>{{$i->ticket}}</td>
	<td>{{$i->guia}}</td>
	
	<td>{{$i->placa}}</td>
	<td>{{$i->chofer}}</td>
	<td>{{$llega = Carbon\Carbon::parse($i->horaLL)->format('H:i')}}</td>
	<td>{{$ing = Carbon\Carbon::parse($i->hora)->format('H:i')}}</td>
	<td>{{$pesadaIni = Carbon\Carbon::parse($i->pesadainicial)->format('H:i')}}</td>
	<td>{{$pesadaFin = Carbon\Carbon::parse($i->pesadafinal)->format('H:i')}}</td>
	<td>{{$sal = Carbon\Carbon::parse($i->salida)->format('H:i')}}</td>
	<!--Calculo de tiempo-->
	<td>{{(date("H:i", strtotime("00:00:00") + strtotime($ing) - strtotime($llega) ))}}</td>
	<!--<td>{{$Tcarga = (date("H:i", strtotime("00:00:00") + strtotime($pesadaFin) - strtotime($pesadaIni) ))}}</td>-->
	<td>{{$Tcarga = number_format( ((($pesadaFin - $pesadaIni)*60)+((date("i", strtotime("00:00:00") + strtotime($pesadaFin) - strtotime($pesadaIni) ))))/60,2,'.',',')}}</td>
	<td>{{(date("H:i", strtotime("00:00:00") + strtotime($sal) - strtotime($pesadaFin) ))}}</td>
	<!--
	<td>{{(date("H:i", strtotime("00:00:00") + strtotime($sal) - strtotime($ing) ))}}</td>-->
	<!--transito   ((($sal - $ing)*60)+((date("i", strtotime("00:00:00") + strtotime($sal) - strtotime($ing) ))))/60}}-->
	<td>{{$T = (date("H:i", strtotime("00:00:00") + strtotime($sal) - strtotime($llega) ))}} </td>
	<td>{{$sa = $i->sacos}}</td>
	<td>{{$peso = $i->peso}}</td>
	<td>{{$peso / $sa}}</td>
	<td>{{number_format($sa / $Tcarga,2,'.',',')}}</td>
	<td>{{number_format(($T/$sa)*400,1,'.',',')}}</td>
</tr>
@endforeach



<!--<div class="vertical-top">
<a  class="btn btn-primary  btn-icon btn-icon-standalone" href="javascript:;" onclick="window.history.back();"><i class="fa-chevron-left"></i></a>
<a href="/ver/reporteDespacho" > <button class="btn btn-red  btn-icon btn-icon-standalone" ><i class="fa-file-pdf-o"></i><span> PDF </span></button></a>
<a href="/excel" > <button class="btn btn-secondary  btn-icon btn-icon-standalone" ><i class="fa-file-excel-o"></i><span> EXCEL </span></button></a>
</div>-->


