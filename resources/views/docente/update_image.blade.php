@extends((session("is_admin") == true ? 'layouts.main' : 'layouts.main_docente'))
<style type="text/css">
	
	input[type="file"]#imagen_file {
	 width: 0.1px;
	 height: 0.1px;
	 opacity: 0;
	 overflow: hidden;
	 position: absolute;
	 z-index: -1;
	 }
	 label[for="imagen_file"] , #btnguardar {
	  display: block;
	 font-size: 14px;
	 font-weight: 600;
	 color: #fff;
	 background-color: #9bbf4c;
	 display: inline-block;
	 transition: all .5s;
	 cursor: pointer;
	 padding: 15px 40px !important;
	 text-transform: uppercase;
	 width: 230px;
	 text-align: center;
	 opacity: 0.9;
	 border-radius: 25px;
	 }
	 label[for="imagen_file"]:hover , #btnguardar:hover{
	  opacity: 1;
	 }

</style>

<script>

</script>
@section('header_content')

	<div class="row page-titles">
        <div class="col-md-6 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Docentes</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Docente Editar</a></li>
                <li class="hidden-sm-down breadcrumb-item active">Actualizar foto</li>
            </ol>
        </div>
        <div class="col-md-6 col-4 align-self-center">
            <a href="javascript:history.back(1)" class="btn pull-right hidden-sm-down btn-success"> Volver</a>
        </div>     
    </div>
@endsection
@section('content')
		
		 <div class="row">
                  <div class="col-sm-2">
                </div>
                    <!-- column -->
                    <div class="col-sm-8">
                        <div class="card">
                            <div class="card-block">
                              <center>
                                <h4 class="card-title">{{ $docente->getNameFull() }}</h4>
                                <h4 class="card-title">{{ $docente->cedula }}</h4></center>
                               
                                <div class="row">
                 				<div class="col-sm-12">
                                        <div class="card" style="margin-bottom: 0px">
                                            <div class="card-block">

                                                <center class="m-t-30">
                                                <img id="imagen_update" src="{{ asset('files/'.$docente->cedula.'/'.$docente->foto) }}" class="img-circle" width="200" height="200" />
                                                    
                                                    <h4 class="card-title m-t-10">{{ $docente->tipo->dominio }}</h4>
                                                    <h6 class="card-subtitle"></h6>
                                                    <div class="row text-center justify-content-md-center">    
                                                    </div>
                                                </center>
                                            </div>
                                        </div>
                    			</div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                            <div class="form-group">
                            <center class="m-t-30">
                            	{{ Form::open(array('route' => array('docente/update_image', $docente->id_tercero), 'method' => 'post' , 'files' => true)) }}
								    
								<input type="hidden" value="{{ $docente->id_tercero }}" name="id_tercero">
                         <span class="imagen_file">
                            <input id="imagen_file" name="imagen_file" type="file" data-max-size="2048" class="form-control-file">
                        </span>
                        <label for="imagen_file">
                          <span id="labelfile"><i class="fa fa-upload"></i> Cargar Archivo</span>
              
                        </label>
                        <span id="labelfile"><input  style="text-align: center; font-size: 13; font-family: 'Arial Black', Gadget, sans-serif; border: 0;" id="btnguardar" type="submit" value=" &#9998; Guardar Cambios"></span>
                            {{ Form::close() }}
                            </center>
                            </div>
                    </div>
                    </div>

                            </div>
                        </div>
                    </div>
                </div>
@endsection