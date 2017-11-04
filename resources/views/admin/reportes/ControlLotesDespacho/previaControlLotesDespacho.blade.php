
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

			<!--<div class="vertical-top">
			  <a  class="btn btn-primary  btn-icon btn-icon-standalone" href="javascript:;" onclick="window.history.back();"><i class="fa-chevron-left"></i></a>
		 <a href="/ver/controlLotesDespacho" > <button class="btn btn-red  btn-icon btn-icon-standalone" ><i class="fa-file-pdf-o"></i><span> PDF </span></button></a>
			  <a href="/reporteExcel" > <button class="btn btn-secondary  btn-icon btn-icon-standalone" ><i class="fa-file-excel-o"></i><span> EXCEL </span></button></a>
		</div>-->
