

<style type="text/css">

h1{
	text-align: center;
}
table {
 
       border-collapse: collapse;
        font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
    	font-size: 12px;
    	margin: 3px; 
    	margin-right: 3px;
    	width: 480px;
    	text-align: left; 
}

th {

	text-align: center;
	font-size: 14px; 
	border: 1px solid none;   
	font-weight: normal;     
	padding: 8px;     
	background: #A4A4A4;
    border-top: 1px solid none;  
    border-bottom: 1px solid none;
    color: white;
    width: 65px;
        }
    td {
    	text-align: center;
        border: 1px solid transparent; 
    	padding: 8px;   
        background: transparent;  
        border-bottom: 1px solid transparent;
    	color: black; 
        border-top: 1px solid transparent;
        }
        tr:hover td { background: #d0dafd; color: #339; }
</style>
<!DOCTYPE html>
<html>
<head>
	<title>Despacho</title>
</head>
<body>
	<hr>
	<h1>Reporte de Control de Tiempos</h1>
	<hr>

	<div>

		<table >
			<thead>
				<tr>
					<th>Fecha</th>
					<th>Cliente</th>
					<th>Placa</th>
					<th>Chofer</th>
					<th>Llegada</th>
					<th>Ingreso</th>
					<th>Pesada 1</th>
					<th>Pesada 2</th>
					<th>Salida</th>
					<th>Tiempo Ingreso</th>
					<th>Tiempo Carga</th>
					<th>Tiempo Salida</th>
					<!--<th>Tiempo</th>-->
					<th>Transito</th>
					<th>Sacos</th>
					<th>Peso Kg</th>
					<th>Peso por sacos</th>
					<th>Sacos/Hora</th>
					<th>T/400</th>
				</tr>
			</thead>
		
			
		<tbody>
				
					@foreach($cliente as $i)
				<tr>
					<td>{{Carbon\Carbon::parse($i->fecha)->format('Y-m-d')}}</td>
					<td>{{$i->clie}}</td>
					<td>{{$i->placa}}</td>
					<td>{{$i->chofer}}</td>
					<td>{{$llega = Carbon\Carbon::parse($i->fecha)->format('H:i')}}</td>
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

		
		
		



