<html>
<head>
	<title>Despacho</title>
</head>
<body>
		<!--<hr>
<h1>Reporte de Control de Tiempos</h1>
	<hr>-->

	<div>

		<table >
			<thead>
				<tr>
					<th  style="background-color:#A4A4A4; text-align: center; color: #FFFFFF;">Fecha</th>
					<th  style="background-color:#A4A4A4; text-align: center; color: #FFFFFF;">Tipo</th>
					<th  style="background-color:#A4A4A4; text-align: center; color: #FFFFFF;">Doc. No.</th>
					<th  style="background-color:#A4A4A4; text-align: center; color: #FFFFFF;">Trans. No.</th>
					<th  style="background-color:#A4A4A4; text-align: center; color: #FFFFFF;">No. Entidad</th>
					<th  style="background-color:#A4A4A4; text-align: center; color: #FFFFFF;">Cliente</th>
					<th  style="background-color:#A4A4A4; text-align: center; color: #FFFFFF;">Ticket Peso</th>
					<th  style="background-color:#A4A4A4; text-align: center; color: #FFFFFF;">Guia</th>
					<th  style="background-color:#A4A4A4; text-align: center; color: #FFFFFF;">Placa</th>
					<th  style="background-color:#A4A4A4; text-align: center; color: #FFFFFF;">Chofer</th>
					<th  style="background-color:#A4A4A4; text-align: center; color: #FFFFFF;">Llegada</th>
					<th  style="background-color:#A4A4A4; text-align: center; color: #FFFFFF;">Ingreso</th>
					<th  style="background-color:#A4A4A4; text-align: center; color: #FFFFFF;">Pesada 1</th>
					<th  style="background-color:#A4A4A4; text-align: center; color: #FFFFFF;">Pesada 2</th>
					<th  style="background-color:#A4A4A4; text-align: center; color: #FFFFFF;">Salida</th>
					<th  style="background-color:#A4A4A4; text-align: center; color: #FFFFFF;">Tiempo Ingreso</th>
					<th  style="background-color:#A4A4A4; text-align: center; color: #FFFFFF;">Tiempo Carga</th>
					<th  style="background-color:#A4A4A4; text-align: center; color: #FFFFFF;">Tiempo Salida</th>
					<!--<th>Tiempo</th>-->
					<th  style="background-color:#A4A4A4; text-align: center; color: #FFFFFF;">Transito</th>
					<th  style="background-color:#A4A4A4; text-align: center; color: #FFFFFF;">Sacos</th>
					<th  style="background-color:#A4A4A4; text-align: center; color: #FFFFFF;">Peso Kg</th>
					<th  style="background-color:#A4A4A4; text-align: center; color: #FFFFFF;">Peso por sacos</th>
					<th  style="background-color:#A4A4A4; text-align: center; color: #FFFFFF;">Sacos/Hora</th>
					<th  style="background-color:#A4A4A4; text-align: center; color: #FFFFFF;">Indice 400 Sac</th>
				</tr>
			</thead>
		
			
		<tbody>
				
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
						
				

				

			</tbody>
	
		</table>

	</div>

</body>
</html>

		
		
		


