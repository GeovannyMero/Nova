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
					<th>Bodega Transacción</th>
					<th>Fecha</th>
					<th>Tipo</th>
					<th>Trans. No</th>
					<th>Doc. No</th>
					<th>Dcto. Resp.</th>
					<th>No. Entidad</th>
					<th>Entidad</th>
					<th>Placa</th>
					<th>Chofer</th>
					<!--<th>Guia</th>-->
					<th>Código</th>
					<th>Descripción</th>

					<th>Cantidad</th>
					<th>Lote</th>
					<th>Observación</th>
				</tr>
			</thead>
		
			
		<tbody>
				
				@foreach($mp as $i)
			<tr>
				<th>{{$i->bodega}}</td>
				<td>{{Carbon\Carbon::parse($i->fecha)->format('Y-m-d')}}</td>
				<td>{{$i->tipo}}</td>
				<td>{{$i->tran}}</td>
				<td>{{$i->doc}}</td>
				<td>{{$i->dcto}}</td>
				<td>{{$i->entidad}}</td>
				<td>{{$i->cliente}}</td>
				<td>{{$i->placa}}</td>
				<td>{{$i->chofer}}</td>
				<!--<td>{{$i->ticket}}</td>
				<td>{{$i->guia}}</td>-->

				<td>{{$i->codigo}}</td>
				<td>{{$i->producto}}</td>
				<td>{{$i->sacos}}</td>
				<td>{{$i->lote}}</td>
				<td>{{$i->obs}}</td>
			</tr>
			@endforeach

				

			</tbody>
	
		</table>

	</div>

</body>
</html>

		
		
		


