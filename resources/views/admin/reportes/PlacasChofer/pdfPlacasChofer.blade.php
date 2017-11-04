

<style type="text/css">

h1{
	text-align: center;
}
table {
 
       border-collapse: collapse;
        font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
    	font-size: 12px;
    	margin: 3px; 
    	margin-right: 3px;
    	width: 730px;
    	text-align: left; 
}

th {

	text-align: center;
	font-size: 14px; 
	border: 1px solid none;   
	font-weight: normal;     
	padding: 8px;     
	background: #A4A4A4;
    border-top: 1px solid none;  
    border-bottom: 1px solid none;
    color: white;
    width: 75px;
        }
    td {
    	text-align: center;
        border: 1px solid transparent; 
    	padding: 8px;   
        background: transparent;  
        border-bottom: 1px solid transparent;
    	color: black; 
        border-top: 1px solid transparent;
        }
        tr:hover td { background: #d0dafd; color: #339; }
</style>
<!DOCTYPE html>
<<html>
<head>
	<title>PlacasChofer</title>
</head>
<body>
	<hr>
	<h1>Reporte de Placas y Chofer</h1>
	<hr>

	<div>

		<table >
			<thead>
				<tr>
					<th>Placa</th>
					<th>Chofer</th>
					
			</thead>
		
			
		<tbody>
				
					@foreach($placachofer as $i)
				<tr>
					<td>{{$i->aPlacaCamion}}</td>
					<td>{{$i->aNombreChofer}}</td>
				</tr>
				@endforeach
						
				

				

			</tbody>
	
		</table>

	</div>

</body>
</html>

		
		
		



