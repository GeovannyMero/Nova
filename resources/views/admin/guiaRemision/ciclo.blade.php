
			@foreach($ciclo as $i)
					
					<tr>
						<td>{{$i->eCodReg}}</td>
						<td>{{Carbon\Carbon::parse($i->dFechaLLegada)->format('Y-m-d')}}</td>
						
						<td>{{Carbon\Carbon::parse($i->dHoraLLegada)->format('H:i')}}</td>
						<td>{{Carbon\Carbon::parse($i->dFechaSalida)->format('H:i')}}</td>
						<td>{{$i->aPlacaCamion}}</td>
						<td>
							<a href="{{ url('/guia',$i->eCodReg) }}"><button class="btn btn-gray"><i class="fa-search-plus"></i></button></a>
						</td>
						
						
						
	
					</tr>
				@endforeach
	

		
