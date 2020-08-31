
@extends((session("is_admin") == true ? 'layouts.main' : 'layouts.main_docente'))
<style type="text/css">
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
    .tab_header{
        color: black;
    }
</style>
@section('header_content')

	<div class="row page-titles">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Tabla</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Docentes</a></li>
                            <li class="hidden-sm-down breadcrumb-item active">Ver docente</li>
                        </ol>
                    </div>
                    <div class="col-md-6 col-4 align-self-center">
                        <br>
                    
                 </div>
                    
    </div>
@endsection
@section('content')

 <div class="row">

                    <!-- Column -->
                    <div class="col-lg-4 col-xlg-3 col-md-5">
                        <div class="card">
                            <div class="card-block">

                                <center class="m-t-30">
                                    <div id="iconedit" class="img-circle" style="cursor: pointer;">

                                    <a href="{{ route('docente/update_image', $docente->id_tercero) }}" title="Editar Imagen" ><i class="icon-pencil"></i> <font class="font-medium"></font></a>
                                    </div>
                                    @php
                                    $imagen = 'assets/images/users/sin_foto.jpg';
                                    if ($docente->foto)$imagen = 'files/'.$docente->cedula.'/'.$docente->foto;
                                    @endphp
                                 <a> <img id="fotico" target="Ver imagen" src="{{ asset($imagen) }}" class="img-circle" width="200" height="200" /></a> 
                                    
                                    
                                    <h4 class="card-title m-t-10">{{ $docente->tipo->dominio }}</h4>
                                    <h6 class="card-subtitle"><a title="Ver sus asignaturas y grupos" href="javascript:void(0)" class="link"><i class="icon-people"></i> <font class="font-medium"></font></a></h6>
                                    
                                </center>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <div class="card-block">

                                <form class="form-horizontal form-material">
                                    <div class="form-group">
                                        <label class="col-md-12"><b>Identificacion</b></label>
                                        <div class="col-md-12">
                                            <input disabled="" type="text" value="{{ $docente->cedula }}"  class="form-control form-control-line " data-validate="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12"><b>Nombre Completo</b></label>
                                        <div class="col-md-12">
                                            <input disabled="" id="nom" type="text"  value="{{ $docente->nombre }}"  class="form-control form-control-line ">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12"><b>Apellidos</b></label>
                                        <div class="col-md-12">
                                            <input disabled="" id="ape" type="text"  value="{{ $docente->apellido }}" class="form-control form-control-line ">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label  class="col-md-12"><b>Email</b></label>
                                        <div class="col-md-12">
                                            <input disabled="" id="ema"  value="{{ $docente->email }}" type="email" placeholder="@unicesar.edu.co" class="form-control form-control-line " >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-12"><b>Tipo de vinculacion</b></label>
                                        <div class="col-md-12">
                                            <input disabled="" id="ema"  value="{{ $docente->servicio }}" type="email" class="form-control form-control-line " >
                                        </div>
                                    </div>                                    
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <!--<a style="color: white;" class="btn btn-success">Ver carga academica</a>-->
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                    <!-- Column -->
                </div>




@endsection