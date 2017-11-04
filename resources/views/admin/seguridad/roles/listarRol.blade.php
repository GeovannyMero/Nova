@extends('layouts.layout')

@section('content')
<style>
td.details-control {
    background: url("{{ asset('assets/images/details_open.png') }}") no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url("{{ asset('assets/images//details_close.png') }}") no-repeat center center;
}
</style>

<div class="page-title">

	<div class="title-env">
		<h1 class="title">Roles</h1>
		<!--<p class="description">Dynamic table variants with pagination and other controls</p>-->
	</div>

	<div class="breadcrumb-env">

		<ol class="breadcrumb bc-1" >
			<li>
				<a href="#"><i class="fa-home"></i>Inicio</a>
			</li>
			<li class="active">
				<strong>Roles</strong>
			</li>
		</ol>

	</div>
</div>

@include('alerts')

<div class="panel-default">
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				<div class="tocify-content">
					<div class="icon-collection">
						<div class="fontawesome-icon-list">
							<a href="{{url('/crearRol')}}"><div class="fa-hover"><div class="icon-str"><i class="fa fa-plus"></i> <span>Agregar Rol</span></div></div></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Basic Setup -->
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Roles</h3>

		<div class="panel-options">
			<a href="#" data-toggle="panel">
				<span class="collapse-icon">&ndash;</span>
				<span class="expand-icon">+</span>
			</a>
		</div>
	</div>
	<div class="panel-body">

		<!--<script type="text/javascript">
		jQuery(document).ready(function($)
		{
			$("#example-1").dataTable({
				aLengthMenu: [
					[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]
				],
				language: {
					search: "Buscar:",
					infoEmpty: "Mostrando 0 a 0 de 0 resultados",
					info: "Mostrando  _START_ a _END_ de _TOTAL_ resultados",
					emptyTable: "No hay datos disponibles en la tabla",
					lengthMenu: "Mostrar _MENU_ resultados",
					paginate: {
				                first:      "Primer",
				                previous:   "Anterior",
				                next:       "Siguiente",
				                last:       "Ultimo"
				        },

				}
			});
		});


	</script>-->


		<table id="example-1" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
			<thead>
					<th></th>
					<th>C&oacute;digo</th>
					<th>Nombre</th>
					<th>slug</th>
					<th>Descripci&oacute;n</th>
					<th>Acción</th>
				</tr>

			</thead>

		<tbody>

			</tbody>

		</table>

	</div>
</div>


<link rel="stylesheet" href="{{ asset('assets/js/datatables/dataTables.bootstrap.css') }}">

<!-- Imported scripts on this page -->
<!--<script src="{{ asset('assets/js/datatables/js/jquery.dataTables.min.js') }}"></script>-->
<script src="{{ asset('assets/js/jquery-1.11.1.min.js') }}"></script>
<script src="{{ asset('assets/js/datatables/js/jquery.dataTables-1.10.15.min.js') }}"></script>

<script src="{{ asset('assets/js/datatables/dataTables.bootstrap.js') }}"></script>
<script src="{{ asset('assets/js/datatables/yadcf/jquery.dataTables.yadcf.js') }}"></script>
<script src="{{ asset('assets/js/datatables/tabletools/dataTables.tableTools.min.js') }}"></script>
<script src="{{ asset('assets/js/bootbox/bootbox.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/handlebarsjs/4.0.5/handlebars.min.js"></script>

<script>
	function eliminar(id){
	//alert(id);
bootbox.confirm("Est&aacute; seguro que desea eliminar el registro del Rol con c&oacute;digo No. "+id+"?",function(result){
	    if(result){
	    route = "{{url('rol/delete' )}}" + "/" + id;
	    	$.ajax({
	    		type: 'GET',
	    		url: route,
	    		 success: function() {

     					 window.location.reload(); // This is not jQuery but simple plain ol' JS
   			 }

	    	})
	    }
	});
}

//master detail
$(document).ready(function() {

    var template = Handlebars.compile($("#details-template").html());
     var table = $('#example-1').DataTable({
			 aLengthMenu: [
				 [10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]
			 ],
			 language: {
				 search: "Buscar:",
				 infoEmpty: "Mostrando 0 a 0 de 0 resultados",
				 info: "Mostrando  _START_ a _END_ de _TOTAL_ resultados",
				 emptyTable: "No hay datos disponibles en la tabla",
				 lengthMenu: "Mostrar _MENU_ resultados",
				 paginate: {
											 first:      "Primer",
											 previous:   "Anterior",
											 next:       "Siguiente",
											 last:       "Ultimo"
							 },

			 },
        "processing": true,
        "serverSide": true,
        "ajax": "{{ url('/getRol') }}",
        "columns": [
					{
							"className":      'details-control',
							"orderable":      false,
							"searchable":     false,
							"data":           null,
							"defaultContent": ''
					},
            {data: 'id', name: 'codigo'},
            {data: 'name', name: 'nombre'},
            {data: 'slug', name: 'slug'},
            {data: 'description', name: 'Descripción'},
					  {data: 'action', name: 'action', orderable: false, searchable: false}

        ],
				 order: [[1, 'asc']]
    });
		$('#example-1 tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row(tr);
        var tableId = 'posts-' + row.data().id;

        if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        } else {
            // Open this row
            row.child(template(row.data())).show();
            initTable(tableId, row.data());
            tr.addClass('shown');
            tr.next().find('td').addClass('no-padding ');
        }
    });

    function initTable(tableId, data) {

        $('#' + tableId).DataTable({
					aLengthMenu: [
						[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]
					],
					language: {
						search: "Buscar:",
						infoEmpty: "Mostrando 0 a 0 de 0 resultados",
						info: "Mostrando  _START_ a _END_ de _TOTAL_ resultados",
						emptyTable: "No hay datos disponibles en la tabla",
						lengthMenu: "Mostrar _MENU_ resultados",
						paginate: {
													first:      "Primer",
													previous:   "Anterior",
													next:       "Siguiente",
													last:       "Ultimo"
									},

					},
            processing: true,
            serverSide: true,
            ajax: data.details_url,
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
								{ data: 'description', name: 'description'}


            ],
						 order: [[1, 'asc']]
        });
    }
});

</script>

<script id="details-template" type="text/x-handlebars-template">
        <div class="label label-info">Rol: @{{ name }}</div>
        <table class="table details-table"  id="posts-@{{id}}">
            <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
				<th>Descripción</th>

            </tr>
            </thead>
						<tbody>

						</tbody>
        </table>
    </script>

@endsection
