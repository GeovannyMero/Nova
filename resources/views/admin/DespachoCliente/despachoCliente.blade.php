
@foreach($ciclo1 as $i)
	<tr>
		<td>{{ $i->cod }}</td>
		<td>{{ $i->aPlaca }}</td>
		<td>{{ $i->eCodChofer}}</td>
		<td>{{$i->aNombre}}</td>
		<td>{{$i->cia}}</td>
		@if($i->estado == 'NO')
		<td >
			<h4><span class="label label-danger">Reprobado</span></h4>

		</td>
		@else
		<td>
			<h4><span class="label label-success">Aprobado</span></h4></td>
		@endif

		<td>
			<a href="{{ url('detallesPT',$i->cod) }}"><button class="btn btn-secondary"><i class="fa-plus"></i></button></a>
		</td>
	</tr>
@endforeach
