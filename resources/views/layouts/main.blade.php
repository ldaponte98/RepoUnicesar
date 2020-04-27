@php
        $usuario = \App\Usuario::find(session('id_usuario'));
@endphp
@if (session('is_admin') == false)
    <h1>Usted no tiene permisos para ingresar a esta pagina</h1>
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
    <link href="{{ asset("css/estilos_card.css") }}" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="{{ asset("assets/css/colors/blue.css") }}" id="theme" rel="stylesheet">

        <link href="{{ asset("css/estilos_card.css") }}" rel="stylesheet">

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

    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css">
<script src="http://malsup.github.io/jquery.blockUI.js"></script>
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

                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                        


                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-email"></i>
                                <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                            </a>
                            <div class="dropdown-menu mailbox animated bounceInDown" aria-labelledby="2">
                                <ul>
                                    <li>
                                        <div class="drop-title">You have 4 new messages</div>
                                    </li>
                                    <li style="overflow: visible;">
                                        <div class="slimScrollDiv" style="position: relative; overflow: visible hidden; width: auto; height: 250px;"><div class="message-center" style="overflow: hidden; width: auto; height: 250px;">
                                            <!-- Message -->
                                            <a href="#">
                                                <div class="user-img"> <img src="../assets/images/users/1.jpg" alt="user" class="img-circle"> <span class="profile-status online float-right"></span> </div>
                                                <div class="mail-contnet">
                                                    <h5>Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:30 AM</span> </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="#">
                                                <div class="user-img"> <img src="../assets/images/users/2.jpg" alt="user" class="img-circle"> <span class="profile-status busy float-right"></span> </div>
                                                <div class="mail-contnet">
                                                    <h5>Sonu Nigam</h5> <span class="mail-desc">I've sung a song! See you at</span> <span class="time">9:10 AM</span> </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="#">
                                                <div class="user-img"> <img src="../assets/images/users/3.jpg" alt="user" class="img-circle"> <span class="profile-status away float-right"></span> </div>
                                                <div class="mail-contnet">
                                                    <h5>Arijit Sinh</h5> <span class="mail-desc">I am a singer!</span> <span class="time">9:08 AM</span> </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="#">
                                                <div class="user-img"> <img src="../assets/images/users/4.jpg" alt="user" class="img-circle"> <span class="profile-status offline float-right"></span> </div>
                                                <div class="mail-contnet">
                                                    <h5>Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span> </div>
                                            </a>
                                        </div><div class="slimScrollBar" style="background: rgb(220, 220, 220); width: 5px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 186.012px;"></div><div class="slimScrollRail" style="width: 5px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
                                    </li>
                                    <li>
                                        <a class="nav-link text-center" href="javascript:void(0);"> <strong>See all e-Mails</strong> <i class="fa fa-angle-right"></i> </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <style type="text/css">
                            .cuadro_busqueta{
                                background: white; 
                                position: absolute;
                                border-radius: 5px;
                                padding: 15px;
                                width: 400px;
                            }

                            .link_search:hover{
                                color: #9bbf4c;
                                cursor: pointer;
                            }
                            .link_search{
                                color: #54667a;
                            }

                        </style>
                        <li class="nav-item hidden-sm-down">
                            <form class="app-search p-l-20">
                                <input type="text" class="form-control" placeholder="Buscar aqui..."> <a class="srh-btn"><i class="ti-search"></i></a>
                                <div class="cuadro_busqueta" id="ul_listado" style="display: none;">
                                    <div class="ul-filter"><a class="link_search" href="ww.com">LUIS DANIEL APONTE DAZA </a></div><hr>
                                    <div class="ul-filter"><a class="link_search" href="ww.com">ALFREDO JOSE MAESTRE BALENZUELA</a></div>
                                </div>
                            </form>
                        </li>


                    </ul>
                    @php
                                {{ 
                                    $imagen = 'assets/images/users/sin_foto.jpg';
                                if($usuario->tercero->foto) 
                                $imagen = '../../files/'.$usuario->tercero->cedula.'/'.$usuario->tercero->foto;
                                
                            
                                 }}
                    @endphp
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
                        <li class="nav-item dropdown">
                            <a href="" class="nav-link  text-muted waves-effect waves-dark"  aria-haspopup="true" aria-expanded="false"><img width="35" height="35" src="{{ asset($imagen) }} " alt="user" class="profile-pic m-r-5" />
                            @php
                                {{ echo $usuario->usuario; }}
                            @endphp  </a>
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
                            <a href="EditarDocenteUsu.php" class="dropdown-item"><i class="ti-user"></i> Mi Perfil</a>
                            <a href="VerCalendarioAcademico.php" class="dropdown-item"><i class="ti-wallet"></i>  Fechas </a>

                            <div class="dropdown-divider"></div> <a href="{{ route('logout') }}" class="dropdown-item"><i class="fa fa-power-off"></i> Cerrar sesion</a>
                        </div>
                    </div>
                </div>
                <ul id="sidebarnav" class="in">
                        <li >
                            <a class="waves-effect "><i class="fa fa-window-restore m-r-10" aria-hidden="true"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Tablero</font></font></a>
                        </li>
                        <li>
                            <a href="{{ route('docente/view', $usuario->tercero->id_tercero) }}" class="waves-effect"><i class="fa fa-user m-r-10" aria-hidden="true"></i>Mi perfil</a>
                        </li>
                        <li>
                            <a href="{{ route('docente/listado_docentes') }}" class="waves-effect"><i class="fa fa-users m-r-10" aria-hidden="true"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Docentes</font></font></a>
                        </li>
                        
                        <li >
                            <a href="{{ route('asignatura/listado_asignaturas') }}" class="waves-effect "><i class="fa fa-book m-r-10" aria-hidden="true"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Asignaturas</font></font></a>
                        </li>
                        <li>
                            <!--<a href="PeriodosAcademicos.php" class="waves-effect"><i class="fa fa-area-chart m-r-10" aria-hidden="true"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Carga academica</font></font></a>-->
                        </li>
                         @php
                            $total_seguimientos_sin_leer = \Illuminate\Support\Facades\DB::table('seguimiento_asignatura')
                                            ->leftJoin('asignatura', 'asignatura.id_asignatura', '=', 'seguimiento_asignatura.id_asignatura')
                                            ->where('estado', 'Enviado')
                                            ->where('id_licencia', session('id_licencia'))
                                            ->count();
                        @endphp 
                        <li class="">
                            <a class="has-arrow " href="#" aria-expanded="false"><i class="mdi mdi-file-chart m-r-10"></i><span class="hide-menu">Reportes</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li class="">
                                    <a class="has-arrow " href="#" aria-expanded="false" style="font-size: 14px;">Seguimiento de asignatura
                                   
                             @if ($total_seguimientos_sin_leer > 0)
                                <span class="label label-rounded label-warning" title="{{ $total_seguimientos_sin_leer }} sin revisar ">{{ $total_seguimientos_sin_leer }}
                                </span>
                             @endif
                             </a>
                             <ul aria-expanded="false" class="collapse">
                                    <li>
                                    <a href="{{ route('seguimiento/consultar') }}" style="font-size: 14px;">Seguimiento por corte</a>
                                    <a href="{{ route('seguimiento/consultar_informe_final') }}"  style="font-size: 14px;">Informe final</a>
                                </li>

                                </ul>
                                </li>
                            </ul>
                        </li>
                       
                        <li class="">
                            <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-cog m-r-10"></i><span class="hide-menu">Ajuste de fechas</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ route('fechas/plazo_extra_por_docente') }}">Plazo por docente</a></li>
                                <li><a href="{{ route('fechas/fechas_de_entrega') }}">Fechas Generales</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}" class="waves-effect"><i class="fa fa-sign-out m-r-10" aria-hidden="true"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Salir</font></font></a>
                        </li>
                        

                        
                       
                       
                    </ul>

                <!--
                <li class="nav-small-cap"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">PERSONAL</font></font></li>
                        <li class="active">
                            <a href="EditarDocenteUsu.php?x=cedula" class="waves-effect active"><i class="fa fa-users m-r-10" aria-hidden="true"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Mi Perfil</font></font></a>
                        </li>
                        <li >
                            <a href="miseguimientos.php" class="waves-effect "><i class="fa fa-table m-r-10" aria-hidden="true"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Seguimiento de asignatura</font></font></a>
                        </li>
                        <li>
                            <a href="../cerrarsesion.php" class="waves-effect"><i class="fa fa-sign-out m-r-10" aria-hidden="true"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Salir</font></font></a>
                        </li>
                        <div id="men" style="background-color: red; display: none;" >
                        <li >
                            <a id="mensajewey" style="color: white; font-size: 12px;"></a>
                        </li>
                        </div>
                    -->
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


