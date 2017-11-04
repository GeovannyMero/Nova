<!-- Add "fixed" class to make the sidebar fixed always to the browser viewport. -->
<!-- Adding class "toggle-others" will keep only one menu item open at a time. -->
<!-- Adding class "collapsed" collapse sidebar root elements and show only icons. -->

<div class="sidebar-menu toggle-others fixed">

	<div class="sidebar-menu-inner">

		<header class="logo-env"><meta http-equiv="Content-Type" content="text/html; charset=gb18030">

			<!-- logo -->
			<div class="logo">
				<a href="{{url('/home')}}" class="logo-expanded">
					<img src="{{ asset('assets/images/logoNova.png') }}" width="80" alt="" />
				</a>

				<a href="#" class="logo-collapsed">
					<img src="{{ asset('assets/images/logoNovaSmall.png') }}" width="40" alt="" />
				</a>
			</div>

			<!-- This will toggle the mobile menu and will be visible only on mobile devices -->
			<div class="mobile-menu-toggle visible-xs">

				<a href="#" data-toggle="mobile-menu">
					<i class="fa-bars"></i>
				</a>
			</div>

			<!-- This will open the popup with user profile settings, you can use for any purpose, just be creative -->
			<div class="settings-icon">
				<a href="#" data-toggle="settings-pane" data-animate="true">
					<i class="linecons-cog"></i>
				</a>
			</div>


		</header>



		<ul id="main-menu" class="main-menu">
			<!-- add class "multiple-expanded" to allow multiple submenus to open -->
			<!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->



 @if( Auth::user()->can('Dashboard') == true)

				<li id="liDashboard">
					<a href="{{url('/')}}">
						<i class="fa-area-chart"></i>
						<span class="title">Dashboard 	</span>
					</a>

				</li>
				@endif
 @if( Auth::user()->can('maestros') == true)
				<li id="liMaestros">
					<a href="{{url('/Usuarios')}}">
						<i class="fa-users"></i>
						<span class="title">Maestros</span>
					</a>
			<ul>


				<li id="liTransportista">
					<a href="{{ url('/conductores')}}">
						<i class="el-group"></i>
						<span class="title">Conductores</span>
					</a>
				</li>

				<li id="liCliente">
					<a href="{{url ('/clientes')}}">
						<i class="el-group"></i>
						<span class="title">Clientes</span>
					</a>
				</li>
				<li id="liCliente">
					<a href="{{url ('/proveedores')}}">
						<i class="el-group"></i>
						<span class="title">Proveedor</span>
					</a>
				</li>


					<li id="liCliente">
					<a href="{{url ('/camiones')}}">
						<i class="fa-truck"></i>
						<span class="title">Camiones</span>
					</a>
				</li>
					<li id="liCliente">
					<a href="{{url ('/productos')}}">
						<i class="fa-circle"></i>
						<span class="title">Productos</span>
					</a>
				</li>
					<li id="liCliente">
					<a href="{{url ('/insumos')}}">
						<i class="fa-circle-o"></i>
						<span class="title">Insumos</span>
					</a>
				</li>
			</ul>


				</li>


			@endif
			 @if( Auth::user()->can('seguridad') == true)
			<li id="liCliente">
				<a href="#">
					<i class="fa-lock"></i>
					<span class="title">Seguridad</span>
				</a>

				<ul>


					<li id="liCLientes">
					<a href="{{url('/Usuarios')}}">
						<i class="fa-user"></i>
						<span class="title">Usuarios</span>
					</a>
				</li>

			<li id="liAdmins">
					<a href="#">
						<i class="fa-sitemap"></i>
						<span class="title">Roles</span>
					</a>
					<ul>
				<li id="liAdmins">
					<a href="{{url ('/rol')}}">
						<i class="el-group"></i>
						<span class="title">Registrar Rol</span>
					</a>
				</li>
				<li id="liAdmins">
					<a href="{{url ('/asignarRol')}}">
						<i class="el-group"></i>
						<span class="title">Asignar Rol a Usuarios </span>
					</a>
				</li>
				<li id="liAdmins">
					<a href="{{url ('/revovarRol')}}">
						<i class="el-group"></i>
						<span class="title">Deshabilitar Rol </span>
					</a>
				</li>



					</ul>

				</li>
				<li id="liPermoso">
					<a href="">
						<i class="fa-key"></i>
						<span class="title">Permisos</span>
					</a>
					<ul>
						<li id="liAdmins">
							<a href="{{url ('/permisos')}}">
								<i class="el-group"></i>
								<span class="title">Registrar Permiso</span>
							</a>

						</li>
				<li id="liAdmins">
					<a href="{{url ('/asignarPermisos')}}">
						<i class="el-group"></i>
						<span class="title">Asignar Permisos a Rol </span>
					</a>
				</li>

				<li id="liAdmins">
					<a href="{{url ('revocarPermisos')}}">
						<i class="el-group"></i>
						<span class="title">Deshabilitar Permisos  </span>
					</a>
				</li>
					</ul>
				</li>


				</ul>
			</li>

			@endif
		<li id="liAdmins">
					<a href="#">
						<i class="fa-file-text-o"></i>
						<span class="title">Subir Información</span>
					</a>
					<ul>
						@if(Auth::user()->can('Datos')==true)
						<li id="liAdmins">
							<a href="{{url('/datosAdicionales')}}">
								<i class="fa-cloud-upload"></i>
								<span class="title">Subir datos PT y MP</span>
							</a>
						</li>
						@endif
						@if(Auth::user()->can('Guia')==true)
							<li id="liAdmins">
							<a href="{{url ('/guiaRemision')}}">
								<i class="fa-cloud-upload"></i>
								<span class="title">Subir Guia de Remision</span>
							</a>
						</li>
						@endif
					</ul>
		</li>
		 @if( Auth::user()->can('Seguimiento') == true)
				<li id="liAdmins">
					<a href="{{url ('/seguimiento')}}">
						<i class="fa-eye"></i>
						<span class="title">Seguimiento</span>
					</a>
				</li>
			@endif
			<li id="liAdmins">
			<a href="{{url('/encuesta')}}">
				<i class="fa fa-pencil"></i>
				<span class="title">Encuesta</span>
			</a>
		</li>
	@if(Auth::user()->can('Despacho'))
				<li id="liAdmins">
					<a href="/despachoCliente">
						<i class="fa-edit"></i>
						<span class="title">Consultas</span>
					</a>
					<ul>
						<li>
							<a href="{{url('/despachoCliente')}}">
								<i class="fa-edit"></i>
								<span class="title">Despacho Cliente </span>
							</a>

						</li>
						<li>
							<a href="{{url('/recepcionMP')}}">
								<i class="fa-edit"></i>
								<span class="title">Recepción de MP</span>
							</a>

						</li>



					</ul>
				</li>
				@endif

		 @if( Auth::user()->can('reportes') == true)
				<li id="liAdmins">
					<a href="#">
						<i class="fa-file-text-o"></i>
						<span class="title">Reportes</span>
					</a>
					<ul>

					<li id="lidespacho">
					<a href="{{url ('/despacho')}}">
						<i class="glyphicon glyphicon-time"></i>
						<span class="title">Control de Tiempos</span>
					</a>
				</li>

<!---->
				<li id="liAdmins">
					<a href="{{url ('/sastifaccionCliente')}}">
						<i class="el-group"></i>
						<span class="title">Satisfación de Clientes</span>
					</a>
				</li>

				<li id="liAdmins">
					<a href="{{url ('/placasChofer')}}">
						<i class="fa-reorder"></i>
						<span class="title">Placas y Chofer</span>
					</a>
				</li>
					<li id="liAdmins">
					<a href="{{url ('/controlLotesDespacho')}}">
						<i class="fa-tachometer"></i>
						<span class="title">Control Lotes Despachos</span>
					</a>
				</li>

					<li id="liAdmins">
					<a href="{{url('/reporte/materiaPrima')}}">
						<i class="fa-tachometer"></i>
						<span class="title">Recepción de MP</span>
					</a>
				</li>
					</ul>
				</li>
				@endif





			<li class="last">
				<a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
					<i class="fa-sign-out"></i>
                                    <span class="title">Cerrar Sesi&oacute;n</span>
                                </a>
	                      	<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
			</li>
		</ul>

	</div>
</div>
