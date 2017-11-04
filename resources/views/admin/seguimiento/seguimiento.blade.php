
@foreach($se as $j)
	<tr>
		<td>{{$j->Cod}}</td>
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
		<td>
			<a href="javascript:;" onclick="detalles({{$j->eCodReg}},{{$j->eCodCamion}},{{$j->eCodPro}},{{$j->Cod}});"><button class="btn btn-gray"><i class="fa fa-pencil"></i></button></a>
		</td>
	</tr>
@endforeach


