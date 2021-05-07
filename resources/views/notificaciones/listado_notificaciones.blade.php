
@extends((session("is_admin") == true ? 'layouts.main' : 'layouts.main_docente'))

@section('header_content')

	<div class="row page-titles">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Tabla</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Notificaciones</a></li>
                            <li class="hidden-sm-down breadcrumb-item active">Listado</li>
                        </ol>
                    </div>
                    <div class="col-md-6 col-4 align-self-center">
                        <br>
                        <input title="Consulta cualquier campo" id="txtfiltro" type="text" class="pull-right search" name="" placeholder="Consulta Aqui">
                 </div>
                    
    </div>
@endsection
@section('content')


<div class="row">
            <div class="col-lg-12 col-xlg-12 col-md-12">
                        <div class="card">
                            <div class="card-block">
                              <div class="table-responsive">
                               <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                      <a class="nav-link tab_header active" id="notificaciones-tab" data-toggle="tab" href="#notificaciones" role="tab" aria-controls="notificaciones"
                                        aria-selected="true"><b>Notificaciones</b></a>
                                    </li>
                                    <li class="nav-item">
                                      <a class="nav-link tab_header" id="peticiones-tab" data-toggle="tab" href="#peticiones" role="tab" aria-controls="peticiones"
                                        aria-selected="false"><b>
                                        @if (session('is_docente'))
                                            Peticiones y extra-plazos
                                        @else
                                            Enviadas
                                        @endif
                                    </b></a>
                                    </li>
                                   
                                  </ul>

                                  

                                  <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="notificaciones" role="tabpanel" aria-labelledby="notificaciones-tab">
                                    
                                        <!--CONTENIDO DE LAS NOTIFICACIONES-->
                                        <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th><center><b><i class="fa fa-user"></i></b></center></th>
                                                    <th><center><b>Emisor</b></center></th>
                                                    <th><center><b>Asunto</b></center></th>
                                                    <th><center><b>Fecha</b></center></th>
                                                    <th><center><b>Hora</b></center></th>
                                                    <th><center><b>Mensaje</b></center></th>
                                                    <th><center><b>Estado</b></center></th>
                                                    <th><center><b>Acciones</b></center></th>
                                                </tr>
                                            </thead>
                                            <style type="text/css"> 
                                                .fil td{
                                                    color: black !important;
                                                }
                                            </style>
                                            <tbody id="bodytable">

                                                @foreach ($notificaciones_recibidas as $notificacion)
                                                @php
                                                    $tercero_envia = \App\Tercero::find($notificacion->id_tercero_envia);
                                                    $tipo = \App\Dominio::find($notificacion->id_dominio_tipo);
                                                @endphp
                                                  <tr class="fil">
                                                    <td>
                                                        <center>
                                                        @php
                                                            $imagen = 'assets/images/users/sin_foto.jpg';
                                                            if ($tercero_envia->foto)$imagen = 'files/'.$tercero_envia->cedula.'/'.$tercero_envia->foto;
                                                        @endphp
                                                        <img src="{{ asset($imagen) }}" class="img-circle" width="35" height="35" />
                                                        </center>
                                                    </td>
                                                    <td>{{ $tercero_envia->getNameFull() }}</td>
                                                    <td>{{ $tipo->dominio }}</td>
                                                    <td>{{ date('d-m-Y', strtotime($notificacion->fecha)) }}</td>
                                                    <td>{{ date('H:i', strtotime($notificacion->fecha)) }}</td>
                                                    
                                                    <td><center>
                                                    <a type="button" data-container="body" data-toggle="popover" data-placement="top" title="{{ $tipo->dominio }}" data-content="{{ $notificacion->notificacion }}">
                                                      <i class="fa fa-comment"></i>
                                                    </a>
                                                    </center></td> 
                                                    <td><center>
                                                        @if ($notificacion->estado == 0)
                                                         <b style="color: #f62d51">Pendiente</b>
                                                        @else
                                                            Leida
                                                        @endif
                                                    </center>
                                                    </td> 

                                                    @if ($notificacion->id_dominio_tipo == 8)
                                                    <td><center>
                                                    <a href="{{ route('notificacion/ver_notificacion', $notificacion->id_notificacion) }}">Revisar</a>
                                                    </center></td>
                                                    @endif  

                                                    @if ($notificacion->id_dominio_tipo == 9)
                                                    <td><center>
                                                    <a href="{{ route('notificacion/ver_notificacion', $notificacion->id_notificacion) }}">Ir</a>
                                                    </center></td>
                                                    @endif 

                                                    @if ($notificacion->id_dominio_tipo == 32)
                                                    <td><center>
                                                    <a href="{{ route('notificacion/ver_notificacion', $notificacion->id_notificacion) }}">Revisar</a>
                                                    </center></td>
                                                    @endif 
                                                    </tr>

                                                @endforeach
                                            </tbody>
                                        </table>
                                        {{ $notificaciones_recibidas->links() }}
                                    </div>

                                    </div>
                                    <div class="tab-pane fade" id="peticiones" role="tabpanel" aria-labelledby="peticiones-tab">
                                   

                                         <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th><center><b><i class="fa fa-user"></i></b></center></th>
                                                    <th><center><b>Dirigido</b></center></th>
                                                    <th><center><b>Asunto</b></center></th>
                                                    <th><center><b>Fecha</b></center></th>
                                                    <th><center><b>Hora</b></center></th>
                                                    <th><center><b>Mensaje</b></center></th>
                                                    <th><center><b>Estado</b></center></th>
                                                </tr>
                                            </thead>
                                            <style type="text/css"> 
                                                .fil td{
                                                    color: black !important;
                                                }
                                            </style>
                                            <tbody id="bodytable">

                                                @foreach ($notificaciones_enviadas as $notificacion)
                                                @php
                                                    $tercero_recibe = \App\Tercero::find($notificacion->id_tercero_recibe);
                                                    $tipo = \App\Dominio::find($notificacion->id_dominio_tipo);
                                                @endphp
                                                  <tr class="fil">
                                                    <td>
                                                        <center>
                                                        @php
                                                            $imagen = 'assets/images/users/sin_foto.jpg';
                                                            if ($tercero_recibe->foto)$imagen = 'files/'.$tercero_recibe->cedula.'/'.$tercero_recibe->foto;
                                                        @endphp
                                                        <img src="{{ asset($imagen) }}" class="img-circle" width="35" height="35" />
                                                        </center>
                                                    </td>
                                                    <td>{{ $tercero_recibe->getNameFull() }}</td>
                                                    <td>{{ $tipo->dominio }}</td>
                                                    <td><center>{{ date('d-m-Y', strtotime($notificacion->fecha)) }}</center></td>
                                                    <td><center>{{ date('H:i', strtotime($notificacion->fecha)) }}</center></td>
                                                    
                                                    <td><center>
                                                    <a type="button" data-container="body" data-toggle="popover" data-placement="top" title="{{ $tipo->dominio }}" data-content="{{ $notificacion->notificacion }}">
                                                      <i class="fa fa-comment"></i>
                                                    </a>
                                                    </center></td>    
                                                    <td><center>
                                                        @if ($notificacion->estado == 0)
                                                         <b style="color: #f62d51">Sin ver</b>
                                                        @else
                                                            Vista
                                                        @endif
                                                    </center>
                                                    </td> 
                                                    </tr>

                                                @endforeach
                                            </tbody>
                                        </table>
                                        {{ $notificaciones_enviadas->links() }}
                                    </div>

                                    </div>
                                    
                                  </div>
                                  </div>
                            </div>
                        </div>
                    </div>


            
</div>

<script>
    $(document).ready(function () {
        $('[data-toggle="popover"]').popover()
    })
</script>
@endsection