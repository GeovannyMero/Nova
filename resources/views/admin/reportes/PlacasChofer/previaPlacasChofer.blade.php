
		
				@foreach($res as $i)
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
