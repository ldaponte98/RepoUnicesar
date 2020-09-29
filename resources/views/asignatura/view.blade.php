@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-lg-4 col-xlg-12 col-md-7">
        <div class="card">
            <div class="card-block">
                <form class="form-horizontal form-material">
                    <div class="form-group">
                        <label class="col-md-12"><b>Codigo </b></label>
                        <div class="col-md-12">
                            <input disabled="" id="cod" type="text" value="{{ $asignatura->codigo }}"  class="form-control form-control-line " data-validate="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12"><b>Nombre </b></label>
                        <div class="col-md-12">
                            <input disabled="" id="nom" type="text" value="{{ $asignatura->nombre }}"  class="form-control form-control-line " data-validate="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12"><b>Numero de creditos</b></label>
                        <div class="col-md-12">
                            <input disabled="" id="cre" type="number" min="1" max="5" maxlength="1" minlength="1"  value="{{ $asignatura->num_creditos }}"  class="form-control form-control-line ">
                        </div>
                    </div> 
                    <div class="form-group">
                        <div class="col-md-12">
                            <a href="{{ route('plan_asignatura/view',[
                            'id_periodo_academico' => $periodo_academico->id_periodo_academico,
                            'id_asignatura' => $asignatura->id_asignatura
                            ]) }}" class="btn btn-info">Plan de asignatura</a>
                        </div>
                    </div>           
                </form>
            </div>
        </div>
    </div>
    <!-- Column -->

          <div class="col-lg-8 col-xlg-12 col-md-12">
              <div class="card">
                  <div class="card-block">
                     <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link tab_header active" id="grupos-tab" data-toggle="tab" href="#grupos" role="tab" aria-controls="grupos"
            aria-selected="true"><b>Grupos</b></a>
        </li>
        <li class="nav-item">
          <a class="nav-link tab_header" id="programas-tab" data-toggle="tab" href="#programas" role="tab" aria-controls="programas"
            aria-selected="false"><b>Programas academicos</b></a>
        </li>

        <li class="nav-item">
          <a class="nav-link tab_header" id="unidades-tab" data-toggle="tab" href="#unidades" role="tab" aria-controls="unidades"
            aria-selected="false"><b>Unidades</b></a>
        </li>
        
      </ul>
      <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="grupos" role="tabpanel" aria-labelledby="grupos-tab">
            {{ view('asignatura.listado_grupos',compact('asignatura')) }}     
                              
          </div>

          <div class="tab-pane fade" id="programas" role="tabpanel" aria-labelledby="programas-tab">
            {{ view('asignatura.listado_programas_academicos',compact('asignatura')) }}     
                              
          </div>
       
      </div>
            </div>
        </div>
    </div>
</div>
                
@endsection