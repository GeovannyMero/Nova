@foreach($mp as $i)
	<tr>
		<td>{{ $i->cod }}</td>
		<td>{{ $i->aPlaca }}</td>
		<td>{{ $i->eCodChofer}}</td>
		<td>{{$i->aNombre}}</td>
		<td>{{$i->cia}}</td>
		

		<td>
			<a href="{{ url('detallesMP',$i->cod) }}"><button class="btn btn-secondary"><i class="fa-plus"></i></button></a>
		</td>
	</tr>
@endforeach
