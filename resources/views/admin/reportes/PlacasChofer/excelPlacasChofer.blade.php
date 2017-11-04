<!DOCTYPE html>
<<html>
<head>
	<title>PlacasChofer</title>
</head>
<body>
	<!--<hr>
	<h1>Reporte de Placas y Chofer</h1>
	<hr>-->

	<div>

		<table >
			<thead>
				<tr>
					<th style="background-color:#A4A4A4; text-align: center; color: #FFFFFF;">Fecha Ingreso</th>
					<th style="background-color:#A4A4A4; text-align: center; color: #FFFFFF;">Hora Ingreso</th>
					<th style="background-color:#A4A4A4; text-align: center; color: #FFFFFF;">Fecha Salida</th>
					<th style="background-color:#A4A4A4; text-align: center; color: #FFFFFF;">Hora Salida</th>
					<th style="background-color:#A4A4A4; text-align: center; color: #FFFFFF;">Chofer</th>
					<th style="background-color:#A4A4A4; text-align: center; color: #FFFFFF;">Placa</th>
					<th style="background-color:#A4A4A4; text-align: center; color: #FFFFFF;">Cia. Transporte</th>
					<th style="background-color:#A4A4A4; text-align: center; color: #FFFFFF;">Cliente</th>
					<th style="background-color:#A4A4A4; text-align: center; color: #FFFFFF;">Producto</th>
					
			</thead>
		
			
		<tbody>
				
					@foreach($placachofer as $i)
				<tr>
					<td>{{Carbon\Carbon::parse($i->fechaI)->format('Y-m-d')}}</td>
					<td>{{Carbon\Carbon::parse($i->horaI)->format('H:i')}}</td>
					<td>{{Carbon\Carbon::parse($i->fechaS)->format('Y-m-d')}}</td>
					<td>{{Carbon\Carbon::parse($i->horaS)->format('H:i')}}</td>
					<td>{{$i->chofer}}</td>
					<td>{{$i->placa}}</td>
					<td>{{$i->cia}}</td>
					<td>{{$i->cliente}}</td>
					<td>{{$i->producto}}</td>
				</tr>
				@endforeach
						
				

				

			</tbody>
	
		</table>

	</div>

</body>
</html>
