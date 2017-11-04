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
