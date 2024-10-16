<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Notificaciones</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="css/_all-skins.min.css">
    <link rel="apple-touch-icon" href="img/apple-touch-icon.png">
    <link rel="shortcut icon" href="https://designerapp.officeapps.live.com/designerapp/document.ashx?path=/fce5d6f4-aa8e-41c9-8238-346561005426/UserAssets/Thumbnails/0251674942078296140100.jpg&dcHint=BrazilSouth&fileToken=791396c3-b9ef-4b9b-93b7-8833c7380f04">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">

        <!-- Logo -->
        <a href="https://designerapp.officeapps.live.com/designerapp/document.ashx?path=/fce5d6f4-aa8e-41c9-8238-346561005426/UserAssets/Thumbnails/0251674942078296140100.jpg&dcHint=BrazilSouth&fileToken=791396c3-b9ef-4b9b-93b7-8833c7380f04" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>ANDY</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>ANDYInc</b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <small class="bg-red">Online</small>
                  <span class="hidden-xs">Andy Trillo Rodriguez</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                    <li class="user-header">
                        <p>
                            <a href="https://mail.google.com/mail/?view=cm&fs=1&to=ndtrillo@gmail.com" target="_blank">ndtrillo@gmail.com</a> - Estudiante de Desarrollo de Software
                            <small>
                                <a href="https://wa.me/51907458975" target="_blank">+51907458975</a>
                            </small>
                        </p>
                    </li>
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    
                    <div class="pull-right">
                      <a href="#" class="btn btn-default btn-flat">Cerrar</a>
                    </div>
                  </li>
                </ul>
              </li>
              
            </ul>
          </div>

        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
                    
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header"></li>
            
            <li class="treeview">
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>Registro</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="alertas"><img src="https://img.icons8.com/?size=100&id=13632&format=png&color=000000"style="width: 20px; height: 20px; vertical-align: middle;"/> </i>Alertas</a></li>
                <li><a href="alertas_departamento"><img src="https://img.icons8.com/?size=100&id=13632&format=png&color=000000"style="width: 20px; height: 20px; vertical-align: middle;"/> </i>Alerta-Departamento</a></li>
                <li><a href="alertas_usuario"><img src="https://img.icons8.com/?size=100&id=13632&format=png&color=000000"style="width: 20px; height: 20px; vertical-align: middle;"/> </i>Alerta-Usuario</a></li>
                <li><a href="departamentos"><img src="https://img.icons8.com/?size=100&id=20497&format=png&color=000000"style="width: 20px; height: 20px; vertical-align: middle;"/> </i>Departamento</a></li>
                <li><a href="logins"><img src="https://img.icons8.com/?size=100&id=16204&format=png&color=000000"style="width: 20px; height: 20px; vertical-align: middle;"/> </i>Login</a></li>
                <li><a href="usuarios"><img src="https://img.icons8.com/?size=100&id=23244&format=png&color=000000"style="width: 20px; height: 20px; vertical-align: middle;"/> </i>Usuario</a></li>
                <li><a href="usuarios_departamento"><img src="https://img.icons8.com/?size=100&id=23244&format=png&color=000000"style="width: 20px; height: 20px; vertical-align: middle;"/> </i>Usuario-Departamento</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-th"></i>
                <span>API</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ route('api.config') }}"><img src="https://img.icons8.com/?size=100&id=16713&format=png&color=000000"style="width: 20px; height: 20px; vertical-align: middle;"/></i>MENSAJE CONFIGURAR</a></li>
                <li><a href="{{ route('file.send.config') }}"><img src="https://img.icons8.com/?size=100&id=13593&format=png&color=000000"style="width: 20px; height: 20px; vertical-align: middle;"/></i>PDF CONFIGURAR</a></li>
              </ul>
            </li>
            <!--
            <li class="treeview">
              <a href="#">
                <i class="fa fa-shopping-cart"></i>
                <span>Ventas</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="ventas/venta"><img src="https://img.icons8.com/?size=100&id=16713&format=png&color=000000"style="width: 20px; height: 20px; vertical-align: middle;"/> </i> Ventas</a></li>
                <li><a href="ventas/cliente"><img src="https://img.icons8.com/?size=100&id=16713&format=png&color=000000"style="width: 20px; height: 20px; vertical-align: middle;"/> </i> Clientes</a></li>
              </ul>
            </li>
                       
            <li class="treeview">
              <a href="#">
                <i class="fa fa-folder"></i> <span>Acceso</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="configuracion/usuario"><img src="https://img.icons8.com/?size=100&id=16713&format=png&color=000000"style="width: 20px; height: 20px; vertical-align: middle;"/> </i> Usuarios</a></li>
                
              </ul>
            </li>
             <li>
              <a href="#">
                <i class="fa fa-plus-square"></i> <span>Ayuda</span>
                <small class="label pull-right bg-red">PDF</small>
              </a>
            </li>
            <li>
              <a href="#">
                <i class="fa fa-info-circle"></i> <span>Acerca De...</span>
                <small class="label pull-right bg-yellow">IT</small>
              </a>
            </li>
-->       
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>





       <!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        
        <!-- Main content -->
        <section class="content">
          
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title"></h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  	<div class="row">
	                  	<div class="col-md-12">
		                          <!--Contenido-->
                              @yield('contenido')
		                          <!--Fin Contenido-->
                           </div>
                        </div>
		                    
                  		</div>
                  	</div><!-- /.row -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <!--Fin-Contenido-->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.3.0
        </div>
        <strong>Copyright &copy; 2015-2020 <a href="www.incanatoit.com">IncanatoIT</a>.</strong> All rights reserved.
      </footer>

      
    <!-- jQuery 2.1.4 -->
    <script src="js/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="js/app.min.js"></script>
    
  </body>
</html>
