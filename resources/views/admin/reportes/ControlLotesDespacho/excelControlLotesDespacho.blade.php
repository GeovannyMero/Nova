

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
					
					<th style="background-color:#A4A4A4; text-align: center; color: #FFFFFF;">Bodega Transacción</th>
					<th style="background-color:#A4A4A4; text-align: center; color: #FFFFFF;">Fecha</th>
					<th style="background-color:#A4A4A4; text-align: center; color: #FFFFFF;">Tipo</th>
					<th style="background-color:#A4A4A4; text-align: center; color: #FFFFFF;">Trans. No</th>
					<th style="background-color:#A4A4A4; text-align: center; color: #FFFFFF;">Doc. No</th>
					<th style="background-color:#A4A4A4; text-align: center; color: #FFFFFF;">Dcto. Resp.</th>
					<th style="background-color:#A4A4A4; text-align: center; color: #FFFFFF;">No. Entidad</th>
					<th style="background-color:#A4A4A4; text-align: center; color: #FFFFFF;">Entidad</th>
					<th style="background-color:#A4A4A4; text-align: center; color: #FFFFFF;">Placa</th>
					<th style="background-color:#A4A4A4; text-align: center; color: #FFFFFF;">Chofer</th>
					<!--<th>Guia</th>-->
					<th style="background-color:#A4A4A4; text-align: center; color: #FFFFFF;">Código</th>
					<th style="background-color:#A4A4A4; text-align: center; color: #FFFFFF;">Descripción</th>

					<th style="background-color:#A4A4A4; text-align: center; color: #FFFFFF;">Cantidad</th>
					<th style="background-color:#A4A4A4; text-align: center; color: #FFFFFF;">Lote</th>
					<th style="background-color:#A4A4A4; text-align: center; color: #FFFFFF;">Observación</th>
					<!--<th>Lote</th>-->

				</tr>

			</thead>


		<tbody>

			@foreach($depacho as $i)
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
