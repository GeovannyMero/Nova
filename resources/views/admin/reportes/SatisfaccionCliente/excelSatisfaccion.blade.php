<!DOCTYPE html>
<<html>
<head>
	<title>ControlLotesDespacho</title>
</head>
<body>
	<!--<hr>
	<h1>Reporte de Control Lotes Despacho</h1>
	<hr>-->

	<div>

		<table >
			<thead>
				<tr>
					<th style="background-color:#A4A4A4; text-align: center; color: #FFFFFF;">Fecha</th>
					<th style="background-color:#A4A4A4; text-align: center; color: #FFFFFF;">Cliente</th>
					<th style="background-color:#A4A4A4; text-align: center; color: #FFFFFF;">Camión</th>
					<th style="background-color:#A4A4A4; text-align: center; color: #FFFFFF;">C&oacute;digo</th>
					<th style="background-color:#A4A4A4; text-align: center; color: #FFFFFF;">Producto</th>
					<th style="background-color:#A4A4A4; text-align: center; color: #FFFFFF;">Tiempo</th>
					<th style="background-color:#A4A4A4; text-align: center; color: #FFFFFF;">Correción Tiempo</th>
					<th style="background-color:#A4A4A4; text-align: center; color: #FFFFFF;">Cantidad</th>
					<th style="background-color:#A4A4A4; text-align: center; color: #FFFFFF;">Correción Cantidad</th>
					<th style="background-color:#A4A4A4; text-align: center; color: #FFFFFF;">Calidad</th>
					<th style="background-color:#A4A4A4; text-align: center; color: #FFFFFF;">Correción Calidad</th>
					<!--<th>Lote</th>-->
					
				</tr>
					
			</thead>
		
			
		<tbody>
				
			@foreach ($seguimiento as $j)
				<tr>
					<td>{{  date_format(date_create(date($j->fecha)),'Y-m-d') }}</td>
					<td>{{$j->cliente}}</td>
					<td>{{$j->placa}}</td>
					<td>{{$j->codigo}}</td>
					<td>{{$j->producto}}</td>
					<td>{{$j->tiempoB}}</td>
					<td>{{$j->tiempo}}</td>
					<td>{{$j->cantidadB}}</td>
					<td>{{$j->cantidad}}</td>
					<td>{{$j->calidadB}}</td>
					<td>{{$j->calidad}}</td>
					<!--<td></td>
					<td></td>-->
					


				</tr>
			@endforeach 

				

			</tbody>
	
		</table>

	</div>

</body>
</html>
