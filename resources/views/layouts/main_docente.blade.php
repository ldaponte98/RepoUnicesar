@php
        $usuario = \App\Usuario::find(session('id_usuario'));

@endphp
@if ($usuario == null)

    <script>
        location.href = '{{ route('logout') }}'
     </script>
  @php
       die();
  @endphp
@endif

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="30x30" href="{{ asset("Imagenes/iconoupc.png") }}">
    <title>Repositorio-Unicesar</title>
    
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset("assets/plugins/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset("assets/css/style.css") }}" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="{{ asset("assets/css/colors/blue.css") }}" id="theme" rel="stylesheet">
    <link href="{{ asset("Iconos/css/all.css") }}" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"/>
    <script src="https://jquery-ui.googlecode.com/svn-history/r3982/trunk/ui/i18n/jquery.ui.datepicker-nl.js"></script>
    <script src="{{ asset('js/TableToExcel.js') }}"></script>


     <style type="text/css">
     #fotico:hover{
       cursor: hand;
       width: 205;
    }
    div#iconedit{
        width: 40;
        height: 40;
        background-color: rgba(160, 191, 76, 1);
        position: absolute;
        right: 65;
        top: 200;

    }
    div#iconedit a{
        color : white;
        top: 12;
        position: relative;
    }

    div#iconedit:hover{
         background-color: rgba(160, 191, 76, 0.9);
    }
    .dropdown-item.active, .dropdown-item:active {
    color: #fff;
    text-decoration: none;
    background-color: #9bbf4c;
    }
    .search{
    line-height: inherit;
    height: 31px;
    background-color: #f2f7f8;
    border-left-color: transparent;
    border-right-color: transparent;
    border-top-color: transparent;
    border-bottom-color: #ddd;
    }
    .search:focus{
       border-bottom-color: black; 
       transition: 2.5s;
    }
    .fil{
        cursor: pointer;
    }
    .fil:hover{
        background-color: #DAF7A6;

    }
    input[type="checkbox"] {
        cursor: pointer;
    }

    li .active{
        background-color:  #DAF7A6;
    }
    .sidebar-nav ul li a {
        font-size: 14px !important;
    }


</style>
    <script type="text/javascript">
    $(document).ready(function () {
    $('#txtfiltro').keyup(function () {
      var rex = new RegExp($(this).val(), 'i');
        $('#bodytable tr').hide();
        $('#bodytable tr').filter(function () {
            return rex.test($(this).text());
        }).show();

        })


      $(document).on('change', 'input[type=file]', function(e) {
       
        var TmpPath = URL.createObjectURL(e.target.files[0]);
        var nombre =  e.target.files[0].name;
        var size =  e.target.files[0].size;
        var dosmb = 1024 * 1024 * 2;
        console.log("Tamaño de la imagen: "+size)
        console.log("2MB: "+dosmb)
        if (size > dosmb) {
            alert("La imagen es muy pesada, tamaño maximo 2MB")
            return false;
        }
        $("#labelfile").html(nombre);
        $('#imagen_update').attr('src', TmpPath);
      });

});
</script>

     
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="fix-header fix-sidebar card-no-border mini-sidebar">

    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->

       <header class="topbar">
            <nav class="navbar top-navbar navbar-toggleable-sm navbar-light">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="">
                        <!-- Logo icon -->
                        <span>
                            <b>
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src=" {{ asset('assets/images/logo.png') }}"  alt="homepage" class="dark-logo" />
                            
                        </b>
                        </span>
                        
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        
                    </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto mt-md-0 ">
                        <!-- This is  -->

                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-message"></i>
                                <div class="notify"> 
                                     @php
                                     $total_notificaciones = \App\Notificaciones::where('estado', 0) 
                                                            ->where('id_tercero_recibe', $usuario->tercero->id_tercero)
                                                            ->count();
                                                            //0 es una notificacion no leida
                                     @endphp 
                                     @if ($total_notificaciones > 0)
                                         <span class="heartbit"></span> <span class="point"></span>
                                     @endif
                                    
                                </div>
                            </a>
                            <div class="dropdown-menu mailbox animated bounceInDown">
                                <ul>
                                    <li>
                                        <div class="drop-title">Notificaciones</div>
                                    </li>
                                    <li style="overflow: visible;">
                                        <div class="slimScrollDiv" style="position: relative; overflow: visible; width: auto; height: 250px;"><div class="message-center" style="overflow: hidden; width: auto; height: 250px;">                                           
                                        @php
                                            $notificaciones = Illuminate\Support\Facades\DB::table('notificaciones') 
                                                            ->where('id_tercero_recibe', $usuario->tercero->id_tercero)
                                                            ->orderBy('fecha', 'desc')
                                                            ->get();
                                        @endphp

                                        @foreach ($notificaciones as $notificacion)

                                        @php
                                        $notificacion = (object) $notificacion;
                                        if ($notificacion->id_dominio_tipo == 6) $icono = "fa fa-calendar-check-o";
                                        if ($notificacion->id_dominio_tipo == 7) $icono = "fa fa-bullhorn";
                                        if ($notificacion->id_dominio_tipo == 8) $icono = "fa fa-user-plus";
                                        if ($notificacion->id_dominio_tipo == 9) $icono = "fa fa-clock-o";

                                        if ($notificacion->id_dominio_tipo == 6) $color_boton = "btn-success";
                                        if ($notificacion->id_dominio_tipo == 7) $color_boton = "btn-info";
                                        if ($notificacion->id_dominio_tipo == 8) $color_boton = "btn-warning";
                                        if ($notificacion->id_dominio_tipo == 9) $color_boton = "btn-danger";

                                        $fecha = date("d-m-Y",strtotime($notificacion->fecha));
                                        $hora = date("H:m",strtotime($notificacion->fecha));
                                        $hoy =  date("d-m-Y");
                                        if ($fecha == date("d-m-Y")) $fecha = "Hoy";
                                        if ($fecha == date("d-m-Y",strtotime($hoy."- 1 days"))) $fecha = "Ayer";
                                        @endphp
                                            <a href="#" title="{{ $notificacion->notificacion }}">

                                            <div class="btn {{ $color_boton }} btn-circle"><i class="{{ $icono }}"></i></div>
                                            <div class="mail-contnet">
                                                <h5>{{ \App\Dominio::find($notificacion->id_dominio_tipo)->dominio }}<span class="pull-right" style="font-size: 9px">{{ $fecha }}</span></h5> <span class="mail-desc">{{ $notificacion->notificacion }}</span> <span class="time">{{ $hora }}</span> 
                                                @if ($notificacion->estado == 0)
                                                    <div class="notify"> 
                                                    <span class="heartbit"></span> <span class="point"></span>
                                                    </div>
                                                @endif
                                             
                                        </div>
                                            </a>
                                        @endforeach

                                        </div><div class="slimScrollBar" style="background: rgb(220, 220, 220); width: 5px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px; height: 192.901px;"></div><div class="slimScrollRail" style="width: 5px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div>
                                    </div>
                                    </li>
                                    <li>
                                        <a class="nav-link text-center" href="MisNotificaciones.php"> <strong>Ver todas las notificaciones</strong> <i class="fa fa-angle-right"></i> </a>
                                    </li>


                                </ul>


                            </div>
                        </li>


                        <li class="nav-item dropdown">
                            <a title="Ver mis extra-plazos" class="nav-link text-muted waves-effect waves-dark" href="MisPlazos.php" id="2" aria-expanded="false"> <i class="mdi mdi-alarm"></i>
                                <div class="notify">  </div>
                            </a>
                        </li>


                    </ul>
                    @php

                    $imagen = 'assets/images/users/sin_foto.jpg';
                    if($usuario->tercero->foto) 
                    $imagen = '../../files/'.$usuario->tercero->cedula.'/'.$usuario->tercero->foto;

                    @endphp
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
                        <li class="nav-item dropdown">
                            <a href="" class="nav-link  text-muted waves-effect waves-dark"  aria-haspopup="true" aria-expanded="false"><img width="35" height="35" src="{{ asset($imagen) }} " alt="user" class="profile-pic m-r-5" />
                               <b> {{ strtoupper($usuario->usuario) }} </b>
                           </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav" class="in">
                    <div class="user-profile">
                    <!-- User profile image -->
                    <div class="profile-img"> <img width="50" height="50"  src="{{ asset($imagen) }}" alt="usuario"> </div>
                    <!-- User profile text-->
                    <div class="profile-text"> <a href="#" class="dropdown-toggle link u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">@php
                        {{ echo $usuario->tercero->getNameFull();}}
                    @endphp</font></font><span class="caret"></span></a>
                        <div class="dropdown-menu animated flipInY">
                            <a href="{{ route('docente/view', $usuario->tercero->id_tercero) }}" class="dropdown-item"><i class="ti-user"></i> Mi Perfil</a>
                            <a href="VerCalendarioAcademico.php" class="dropdown-item"><i class="ti-wallet"></i>  Fechas </a>
                            <a href="MisPlazos.php" class="dropdown-item"><i class="mdi mdi-alarm"></i> Mis extra-plazos</a>
                           
                            <div class="dropdown-divider"></div> <a href="{{ route('logout') }}" class="dropdown-item"><i class="fa fa-power-off"></i> Cerrar sesion</a>
                        </div>
                    </div>
                </div>
                <ul id="sidebarnav" class="in">
                        <li >
                            <a class="waves-effect"><i class="fa fa-window-restore m-r-10" aria-hidden="true"></i>Tablero</a>
                        </li>
                        <li>
                            <a href="{{ route('docente/view', $usuario->tercero->id_tercero) }}" class="waves-effect"><i class="fa fa-user m-r-10" aria-hidden="true"></i>Mi perfil</a>
                        </li>

                        <li>

                             <a class="has-arrow " href="#" aria-expanded="false"><i class="fas fa-tasks m-r-10" aria-hidden="true"></i><span class="hide-menu">Seguimiento de asignatura  @php
                            $total_seguimientos_pendientes = \App\SeguimientoAsignatura::where('estado', 'Pendiente')
                                                    ->where('id_tercero', $usuario->tercero->id_tercero)
                                                    ->count();
                             @endphp 
                             @if ($total_seguimientos_pendientes > 0)
                                <span class="label label-rounded label-danger" title="{{ $total_seguimientos_pendientes }} pendientes">{{ $total_seguimientos_pendientes }}</span></a>
                             @endif</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li class="">
                                    <a href="{{ route('seguimiento/consultar') }}">Seguimiento por corte</a>
                                </li>
                                <li class="">
                                    <a href="#">Informe final</a>
                                </li>
                            </ul>

                            
                        </li>
                        <li class="">
                            <a class="has-arrow " href="#" aria-expanded="false"><i class="far fa-clipboard m-r-10"></i><span class="hide-menu">Reportes</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li class="">
                                    <a href="fgdfgdf">.</a>
                                </li>
                            </ul>
                        </li>
                        <li>                    

                        
                       
                       
                    </ul>
                    </ul>
                    
                </nav>
                <!-- End Sidebar navigation -->
            </div>

<!--
            <div class="sidebar-footer">
               
                <a href="" class="link" data-toggle="tooltip" title="Ajustes"><i class="ti-settings"></i></a>
               
                <a href="" class="link" data-toggle="tooltip" title="Email"><i class="mdi mdi-gmail"></i></a>
              

                <a href="" class="link" data-toggle="tooltip" title="Cerrar sesión"><i class="mdi mdi-power"></i></a>
            </div>
           
            -->
        </aside>

        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!--<div class="row page-titles">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Tabla</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
                            <li class="hidden-sm-down breadcrumb-item active">Inicio</li>
                        </ol>
                    </div>
                    
                </div> -->

                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                
                 @yield('header_content','')
                 @yield('content','')
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
               

            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">
                © 2018 Luis Aponte y Ever Lazo
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
   
   
    <!--<script src="assets/plugins/jquery/jquery.min.js"></script>-->
    <!-- Bootstrap tether Core JavaScript -->
   
   
    <script src=" {{ asset('assets/plugins/bootstrap/js/tether.min.js') }} "></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{ asset('assets/js/jquery.slimscroll.js') }}"></script>
    <!--Wave Effects -->
    <script src="{{ asset('assets/js/waves.js') }}"></script>

    <!--Menu sidebar -->
    <script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>
    <!--stickey kit -->
    <script src="{{ asset('assets/plugins/sticky-kit-master/dist/sticky-kit.min.js') }}"></script>
    <!--Custom JavaScript -->
    <script src="{{ asset('assets/js/custom.min.js') }}"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
</body>

</html>


