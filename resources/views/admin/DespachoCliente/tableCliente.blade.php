<table>
	<tr>
		<th>Codigo</th>
		<th>RUC</th>
		<th>Nombre</th>
		<th>Direccion</th>
		<th>Telefono</th>
		<th>Correo Electronico</th>
		<th>Acciones</th>
	</tr>

		@foreach($clienteDespacho as $i)
			<tr>
			<td>{{ $i->eCodReg }}</td>
			<td>{{ $i->aRUC }}</td>
			<td>{{ $i->aNombre }}</td>
			<td>{{ $i->aDireccion }}</td>
			<td>{{ $i->aTelefono }}</td>
			<td>{{ $i->aMail }}</td>
			</tr>
		@endforeach
	
</table>