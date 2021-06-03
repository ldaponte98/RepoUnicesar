<?php
        $usuario = \App\Usuario::find(session('id_usuario'));
?>
<?php if(session('is_admin') == false): ?>    
  <?php
    $titulo = "Usted no tiene permisos para ingresar a esta pagina";
    $mensaje = "<a href='".route('index')."'>Iniciar sesion</a>";
  ?>
    <?php echo e(view('sitio.error',compact(['titulo', 'mensaje']))); ?>

  <?php
    die();
  ?>
<?php endif; ?>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="30x30" href="<?php echo e(asset("Imagenes/iconoupc.png")); ?>">
    <title>Repositorio-Unicesar</title>
    
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo e(asset("assets/plugins/bootstrap/css/bootstrap.min.css")); ?>" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo e(asset("assets/css/style.css")); ?>" rel="stylesheet">
    <link href="<?php echo e(asset("css/estilos_card.css")); ?>" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="<?php echo e(asset("assets/css/colors/blue.css")); ?>" id="theme" rel="stylesheet">

        <link href="<?php echo e(asset("css/estilos_card.css")); ?>" rel="stylesheet">
        <link href="<?php echo e(asset("css/menu_flotante.css")); ?>" rel="stylesheet">

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
    <script src="<?php echo e(asset('js/TableToExcel.js')); ?>"></script>

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

    <script src="<?php echo e(asset('ckeditor.js')); ?>"></script>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    
    <style type="text/css">
        body {
            --ck-z-default: 100;
            --ck-z-modal: calc( var(--ck-z-default) + 999 );
        }
        .ck-link_selected{
            text-decoration: underline !important;
        }
        .ck a{
            text-decoration: underline !important;
        }
        #fotico:hover{
           cursor: hand;
           width: 205;
        }
        div#iconedit{
            width: 40;
            height: 40;
            background-color: rgba(160, 191, 76, 1);
            position: absolute;
            right: 75;
            top: 180;

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
            background-color: #daf7a675;

        }
        input[type="checkbox"] {
            cursor: pointer;
        }

        li .active{
            background-color:  #DAF7A6;
        }
        .hidden-md-up{
            margin-top: 15px !important;
            margin-right: 40px !important;
        }
        @media (max-width: 767px){
            .mini-sidebar .left-sidebar, .mini-sidebar .sidebar-footer {
                left: -280px;
            }   
            .blockMsg h1{
                font-size:  13px !important;
            }
        }

        .blockMsg h1{
            color: #ffffff !important;
        }

        .select2-selection--single{
            padding-bottom: 35px !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            top: 6px !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            margin-top: 3px !important;
            font-size: 16px !important;
        }


        .ul-filter{
            padding-top: 10px;
            padding-bottom: 10px;
            cursor: pointer;
        }
        .ul-filter:hover{
            background-color: #a0bf4c47;
        }
    </style>

    <style type="text/css">
        .btn_tintilante{
            margin-right: 10px;
            border-radius: 20px; 
            padding-left: 20px;
            padding-right: 20px;
            padding-top: 7px;
            padding-bottom: 7px;
            background-color: #83a538;
            color: black !important;
            animation: animate 3s linear infinite;
        }
        @keyframes  animate{
            0%{
                box-shadow: 0 0 0 0 rgba(255, 79, 112, .5), 0 0 0 0 rgba(255, 79, 112, .5);
            }
            40%{
                box-shadow: 0 0 0 10px rgba(255, 79, 112, 0), 0 0 0 0 rgba(255, 79, 112, .5);
            }
            80%{
                box-shadow: 0 0 0 10px rgba(255, 79, 112, 0), 0 0 0 10px rgba(255, 79, 112, 0);
            }
            100%{
                box-shadow: 0 0 0 0 rgba(255, 79, 112, 0), 0 0 0 10px rgba(255, 79, 112, 0);
            }
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
            if(nombre.length > 10) nombre = nombre.substring(0,17) + "..."
            $("#labelfile").html(nombre);
            $('#imagen_update').attr('src', TmpPath);
          });
    });
</script>

<script>
        function buscar(caracteres) {
            //console.log(caracteres)
            if (caracteres.length > 3) {
                let url = "/docente/filtrar/"+caracteres
                $.get(url, (response) =>{
                    console.log(response)
                    var resultados = ""
                    if(response.length > 0){
                        response.forEach((tercero)=>{
                            resultados +='<div class="ul-filter" onclick="location.href=\'/docente/view/'+tercero.id_tercero+'\'"><a class="link_search" href="/docente/view/'+tercero.id_tercero+'">'+tercero.nombre.toUpperCase()+" "+tercero.apellido.toUpperCase()+" - "+tercero.cedula+'</a></div>'
                        })
                        if (resultados != "") {
                            $("#cuadro_busqueta").html(resultados)
                            $("#cuadro_busqueta").fadeIn()
                        }else{
                            $("#cuadro_busqueta").html("")
                            $("#cuadro_busqueta").fadeOut()
                        }
                    }else{
                        $("#cuadro_busqueta").html("")
                        $("#cuadro_busqueta").fadeOut()
                    }
                })
            }
            else{
                $("#cuadro_busqueta").html("")
                $("#cuadro_busqueta").fadeOut()
            }
        }
    </script>
</head>

<body onclick="$('#cuadro_busqueta').fadeOut(); $('#txt_busqueda').val('')" class="fix-header fix-sidebar card-no-border mini-sidebar">

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
                            <img src=" <?php echo e(asset('assets/images/logo.png')); ?>"  alt="homepage" class="dark-logo" />
                            
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
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" id="icon_message" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-email"></i>
                                <div class="notify"> 
                                     <?php
                                     $total_notificaciones = \App\Notificaciones::where('estado', 0) 
                                                            ->where('id_tercero_recibe', $usuario->tercero->id_tercero)
                                                            ->count();
                                                            //0 es una notificacion no leida
                                     ?> 
                                     <?php if($total_notificaciones > 0): ?>
                                         <span class="heartbit"></span> <span class="point"></span>
                                     <?php endif; ?>
                                    
                                </div>
                            </a>
                            <div class="dropdown-menu mailbox animated bounceInDown" aria-labelledby="2">
                                <ul>
                                    <li>
                                        <div class="drop-title">Tienes <?php echo e($total_notificaciones); ?> pendientes</div>
                                    </li>
                                    <li style="overflow: visible;">
                                        <div class="slimScrollDiv" style="position: relative; overflow: visible ; width: auto; height: 250px;"><div class="message-center" style=" width: auto; height: 250px;">
                                            <!-- Message -->
                                       <?php
                                            $notificaciones = Illuminate\Support\Facades\DB::table('notificaciones') 
                                                            ->where('id_tercero_recibe', $usuario->tercero->id_tercero)
                                                            ->orderBy('fecha', 'desc')
                                                            ->get();
                                        ?>

                                        <?php $__currentLoopData = $notificaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notificacion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $tercero_envia = \App\Tercero::find($notificacion->id_tercero_envia);
                                            $imagen = 'assets/images/users/sin_foto.jpg';
                                            if ($tercero_envia->foto)$imagen = 'files/'.$tercero_envia->cedula.'/'.$tercero_envia->foto;
                                             $fecha = date("d-m-Y",strtotime($notificacion->fecha));
                                            $hora = date("H:i",strtotime($notificacion->fecha));
                                            $hoy =  date("d-m-Y");
                                            if ($fecha == date("d-m-Y")) $fecha = "Hoy";
                                            if ($fecha == date("d-m-Y",strtotime($hoy."- 1 days"))) $fecha = "Ayer";
                                        ?>

                                       

                                            <a href="<?php echo e(route('notificacion/ver_notificacion', $notificacion->id_notificacion)); ?>" title="<?php echo e($notificacion->notificacion); ?>">
                                                <div class="user-img"> <img src="<?php echo e(asset($imagen)); ?>" alt="user" class="img-circle" width="35" height="35"> <span class="profile-status online float-right"></span> </div>
                                                <div class="mail-contnet">
                                                <h5><?php echo e($tercero_envia->getNameFull()); ?><span class="pull-right" style="font-size: 9px"><?php echo e($fecha); ?></span></h5> <span class="mail-desc"><?php echo e($notificacion->notificacion); ?></span> <span class="time"><?php echo e($hora); ?></span> 
                                                <?php if($notificacion->estado == 0): ?>
                                                    <div class="notify"> 
                                                    <span class="heartbit"></span> <span class="point"></span>
                                                    </div>
                                                <?php endif; ?>
                                             
                                        </div>
                                            </a>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div><div class="slimScrollBar" style="background: rgb(220, 220, 220); width: 5px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 186.012px;"></div><div class="slimScrollRail" style="width: 5px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
                                    </li>
                                    <li>
                                        <a class="nav-link text-center" href="<?php echo e(route('notificacion/mis_notificaciones')); ?>"> <strong>Ver todas las notificaciones</strong> <i class="fa fa-angle-right"></i> </a>
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
                                color: #54667a;
                            }

                            .link_search{
                                color: #54667a;
                                cursor: pointer;
                            }
                            .topbar .top-navbar .app-search .srh-btn {
                                position: absolute;
                                top: 13px;
                                cursor: pointer;
                                background: #ffffff;
                                width: 15px;
                                height: 15px;
                                right: 10px;
                                font-size: 14px;
                            }

                            @media(max-width: 767px){
                                .topbar .top-navbar .navbar-nav>.nav-item>.nav-link {
                                    padding-left: .75rem;
                                    padding-right: .75rem;
                                    font-size: 25px;
                                    line-height: 50px;
                                }

                                .mini-sidebar .top-navbar .navbar-header {
                                    width: 20px;
                                    text-align: center;
                                }
                                .hidden-md-up {
                                    margin-top: 15px !important;
                                    margin-right: 10px !important;
                                }
                                #icon_message{
                                    padding-top: 16px !important;
                                }

                                .blockMsg h1{
                                    font-size: 16px !important;
                                }
                            }

                            .topbar .top-navbar .app-search input {
                                width: 400px;
                                border-radius: 5px;
                                font-size: 14px;
                                transition: 0.5s ease-in;
                            }

                            .topbar .top-navbar .app-search input:focus {
                                width: 400px !important;
                            }
                            

                        </style>
                        <li class="nav-item hidden-sm-down">
                            <form class="app-search p-l-5">
                                <input type="text" autocomplete="off" class="form-control" id="txt_busqueda" placeholder="Buscar docente, por cualquier campo" onkeyup="buscar(this.value)"> <a class="srh-btn"><i class="ti-search mt-3"></i></a>
                                <div class="cuadro_busqueta" id="cuadro_busqueta" style="display: none;">
                                    
                                    <!--<div class="ul-filter"><a class="link_search" href="ww.com">ALFREDO JOSE MAESTRE BALENZUELA - 1065843703</a></div>-->
                                </div>
                            </form>
                        </li>


                    </ul>
                    <?php 
                        $imagen = 'assets/images/users/sin_foto.jpg';
                        if($usuario->tercero->foto) 
                        $imagen = 'files/'.$usuario->tercero->cedula.'/'.$usuario->tercero->foto;
                                
                    ?>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo e(asset($imagen)); ?>" alt="user" class="rounded-circle" width="50" height="50"></a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                                <div class="d-flex no-block align-items-center p-3 mb-2 border-bottom">
                                    <div class=""><img src="<?php echo e(asset($imagen)); ?>" alt="user" class="rounded" width="80"></div>
                                    <div class="ml-2">
                                        <h4 class="mb-0"><?php echo e(ucwords(strtolower($usuario->tercero->nombre))); ?></h4>
                                        <p class=" mb-0"><?php echo e($usuario->tercero->email); ?></p>
                                        <a href="<?php echo e(route('docente/view', $usuario->tercero->id_tercero)); ?>" class="btn btn-rounded btn-danger btn-sm">Ver perfil</a>
                                    </div>
                                </div>
                                <a href="<?php echo e(route('fechas/fechas_de_entrega')); ?>" class="dropdown-item"><i class="ti-wallet"></i>  Fechas generales</a>
                                <a href="<?php echo e(route('notificacion/mis_notificaciones')); ?>" class="dropdown-item"><i class="mdi mdi-alarm"></i> Notificaciones</a>
                               
                                <div class="dropdown-divider"></div> <a href="<?php echo e(route('logout')); ?>" class="dropdown-item"><i class="fa fa-power-off"></i> Cerrar sesion</a>
                            </div>
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
            <div class="scroll-sidebar">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav" class="in">
                        <div class="user-profile">
                            <div class="profile-img"> <img width="50" height="50"  src="<?php echo e(asset($imagen)); ?>" alt="usuario"> </div>
                            <div class="profile-text"> <a href="#" class="dropdown-toggle link u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php
                                {{ echo $usuario->tercero->getNameFull();}}
                            ?></font></font><span class="caret"></span></a>
                                <div class="dropdown-menu animated flipInY">
                                    <a href="<?php echo e(route('docente/view', $usuario->tercero->id_tercero)); ?>" class="dropdown-item"><i class="ti-user"></i> Mi Perfil</a>
                                    <a href="<?php echo e(route('fechas/fechas_de_entrega')); ?>" class="dropdown-item"><i class="ti-wallet"></i>  Fechas </a>

                                    <div class="dropdown-divider"></div> <a href="<?php echo e(route('logout')); ?>" class="dropdown-item"><i class="fa fa-power-off"></i> Cerrar sesion</a>
                                </div>
                            </div>
                        </div>
                        <ul id="sidebarnav" class="in">
                            <li >
                                <a class="waves-effect" href="<?php echo e(route('panel')); ?>" style="display: flex !important;"><i data-feather="airplay" class="m-r-10" aria-hidden="true"></i> Actividades</a>
                            </li>
                            <li>
                            </li>
                            <li>
                                <a href="<?php echo e(route('docente/listado_docentes')); ?>" class="waves-effect" style="display: flex !important;"><i data-feather="users" class="m-r-10" aria-hidden="true"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Docentes</font></font></a>
                            </li>
                            
                            <li >
                                <a href="<?php echo e(route('asignatura/listado_asignaturas')); ?>" class="waves-effect" style="display: flex !important;"><i data-feather="book" class="m-r-10" aria-hidden="true"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Asignaturas</font></font></a>
                            </li>
                             <?php
                                $total_seguimientos_sin_leer = \Illuminate\Support\Facades\DB::table('seguimiento_asignatura')
                                                ->leftJoin('asignatura', 'asignatura.id_asignatura', '=', 'seguimiento_asignatura.id_asignatura')
                                                ->where('seguimiento_asignatura.estado', 'Enviado')
                                                ->where('id_licencia', session('id_licencia'))
                                                ->count();

                                $total_plan_trabajo_sin_leer = \Illuminate\Support\Facades\DB::table('plan_trabajo')
                                                ->leftJoin('terceros', 'terceros.id_tercero', '=', 'plan_trabajo.id_tercero')
                                                ->where('plan_trabajo.estado', 'Enviado')
                                                ->where('terceros.id_licencia', session('id_licencia'))
                                                ->count();

                                $total_plan_desarrollo_sin_leer = \Illuminate\Support\Facades\DB::table('plan_desarrollo_asignatura')
                                                ->leftJoin('terceros', 'terceros.id_tercero', '=', 'plan_desarrollo_asignatura.id_tercero')
                                                ->where('plan_desarrollo_asignatura.estado', 'Enviado')
                                                ->where('terceros.id_licencia', session('id_licencia'))
                                                ->count();
                            ?> 
                            <li class="">
                                <a class="has-arrow waves-effect" style="display: flex !important;" href="#" aria-expanded="false"><i data-feather="clipboard" class="m-r-10" aria-hidden="true"></i><span class="hide-menu">Gestion docencia</span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li>
                                        <a href="<?php echo e(route('plan_trabajo/consultar')); ?>" class="waves-effect" style="font-size:14px;">Plan de trabajo  <?php if($total_plan_trabajo_sin_leer > 0): ?>
                                    <span class="label label-rounded label-warning" title="<?php echo e($total_plan_trabajo_sin_leer); ?> sin revisar "><?php echo e($total_plan_trabajo_sin_leer); ?>

                                    </span>
                                 <?php endif; ?></a>
                                    </li>
                                    <li>
                                        <a href="<?php echo e(route('plan_asignatura/buscar_asignatura')); ?>" class="waves-effect" style="font-size:14px;">Plan de asignatura</a>
                                    </li>
                                    <li>
                                        <a  class="has-arrow " href="#" aria-expanded="false" style="font-size:14px;">Plan desarrollo asignatura 
                                        <?php if($total_plan_desarrollo_sin_leer > 0): ?>
                                            <span class="label label-rounded label-warning" title="<?php echo e($total_plan_desarrollo_sin_leer); ?> sin revisar "><?php echo e($total_plan_desarrollo_sin_leer); ?>

                                            </span>
                                        <?php endif; ?></a>
                                        <ul aria-expanded="false" class="collapse">
                                            <li>
                                                <a href="<?php echo e(route('plan_desarrollo_asignatura/consultar')); ?>" style="font-size: 14px;">Busqueda individual</a>
                                                <a href="<?php echo e(route('plan_desarrollo_asignatura/consultar_general')); ?>"  style="font-size: 14px;">Informe general</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="">
                                        <a class="has-arrow " href="#" aria-expanded="false" style="font-size: 14px;">Seguimiento de asignatura
                                        <?php if($total_seguimientos_sin_leer > 0): ?>
                                            <span class="label label-rounded label-warning" title="<?php echo e($total_seguimientos_sin_leer); ?> sin revisar "><?php echo e($total_seguimientos_sin_leer); ?>

                                            </span>
                                        <?php endif; ?>
                                        </a>
                                        <ul aria-expanded="false" class="collapse">
                                            <li>
                                                <a href="<?php echo e(route('seguimiento/consultar')); ?>" style="font-size: 14px;">Seguimiento por corte</a>
                                                <a href="<?php echo e(route('seguimiento/consultar_informe_final')); ?>"  style="font-size: 14px;">Informe final</a>
                                            </li>
                                        </ul>
                                    </li>

                                    <?php
                                        $total_actividades_pendientes =  \Illuminate\Support\Facades\DB::table('actividades_complementarias')
                                                            ->leftJoin('terceros', 'terceros.id_tercero', '=', 'actividades_complementarias.id_tercero')
                                                            ->where('actividades_complementarias.estado', 'Enviado')
                                                            ->where('id_licencia', session('id_licencia'))
                                                            ->count();
                                        
                                    ?>
                                    <li>
                                        <a class="has-arrow " style="display: flex !important;" href="#" aria-expanded="false"><span style="font-size:14px;" class="hide-menu">Actividades complementarias  
                                            
                                        </span></a>
                                        <ul aria-expanded="false" class="collapse">
                                            <li class="">
                                                <a href="<?php echo e(route('actividades_complementarias/consultar')); ?>">Informe por corte  <?php if($total_actividades_pendientes > 0): ?>
                                                    <span class="label label-rounded label-warning" title="<?php echo e($total_actividades_pendientes); ?> sin revisar"><?php echo e($total_actividades_pendientes); ?></span>
                                                <?php endif; ?>
                                                </a>
                                            </li>
                                        </ul>                            
                                    </li>
                                </ul>
                            </li>
                           
                            <li class="">
                                <a class="has-arrow waves-effect" style="display: flex !important;" href="#" aria-expanded="false"><i data-feather="calendar" class="m-r-10" aria-hidden="true"></i> Ajuste de fechas</a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?php echo e(route('fechas/plazo_extra_por_docente')); ?>">Plazo por docente</a></li>
                                    <li><a href="<?php echo e(route('fechas/fechas_de_entrega')); ?>">Fechas Generales</a></li>
                                </ul>
                            </li>
                        </ul>

                    </ul>
                    
                </nav>
            </div>

        </aside>

        <?php echo $__env->yieldContent('menu',''); ?>
        <div class="page-wrapper">
            <div class="container-fluid">
                
                 <?php echo $__env->yieldContent('header_content',''); ?>
                 <?php echo $__env->yieldContent('content',''); ?>

            </div>
            <footer class="footer text-center">
                © 2018 Luis Aponte y Ever Lazo
            </footer>
        </div>
    </div>
   
   <script>
      feather.replace()
      $('.clockpicker').clockpicker();
    </script>
    <script src=" <?php echo e(asset('assets/plugins/bootstrap/js/tether.min.js')); ?> "></script>
    <script src="<?php echo e(asset('assets/plugins/bootstrap/js/bootstrap.min.js')); ?>"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="<?php echo e(asset('assets/js/jquery.slimscroll.js')); ?>"></script>
    <!--Wave Effects -->
    <script src="<?php echo e(asset('assets/js/waves.js')); ?>"></script>

    <!--Menu sidebar -->
    <script src="<?php echo e(asset('assets/js/sidebarmenu.js')); ?>"></script>
    <!--stickey kit -->
    <script src="<?php echo e(asset('assets/plugins/sticky-kit-master/dist/sticky-kit.min.js')); ?>"></script>
    <!--Custom JavaScript -->
    <script src="<?php echo e(asset('assets/js/custom.min.js')); ?>"></script>
    

</body>

</html>


<?php /**PATH C:\xampp\htdocs\RepoUnicesar\resources\views/layouts/main.blade.php ENDPATH**/ ?>