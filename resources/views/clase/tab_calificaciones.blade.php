<div class="row">
    <!-- Column -->
    <div class="col-lg-5 col-xl-3 col-md-6">
        <div class="card-body">
            <h3 class="card-title mb-4">Calificación</h3>
            <span class="mt-5 display-6">{{ $clase->get_calificacion_final() }}</span> Puntos
            <h6 class="card-subtitle mt-1 mb-4">Esta clase la han calificado <b>{{ $clase->cantidad_asistentes_calificaciones() }}</b> estudiantes de <b>{{ count($clase->asistencias) }}</b> asistentes</h6>
            
        </div>
    </div>
    <!-- Column -->
    <div class="col-lg-7 col-xl-9 col-md-6 border-start pl-0">
        <ul class="product-review list-inline p-4" style="display: grid;">
            <li class="py-3">
                <div class="d-flex align-items-center">
                    <span class="text-muted display-5"><i class="mdi mdi-emoticon-cool"></i></span>
                    <div class="dl ms-2 ml-2">
                        <h3 class="card-title">Calificaciones positivas</h3>
                        <h6 class="card-subtitle">{{ $clase->total_calificaciones("positiva") }} calificaciones</h6>
                    </div>
                </div>
                <div class="progress">
                    <div class="progress-bar bg-success" role="progressbar" 
                    style="width: {{ $clase->porcentaje_calificaciones("positiva") }}%; height:6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </li>
            <li class="py-3">
                <div class="d-flex align-items-center">
                    <span class="text-muted display-5"><i class="mdi mdi-emoticon-sad"></i></span>
                    <div class="dl ms-2 ml-2">
                        <h3 class="card-title text-nowrap">Calificaciones negativas</h3>
                        <h6 class="card-subtitle">{{ $clase->total_calificaciones("negativa") }} calificaciones</h6>
                    </div>
                </div>
                <div class="progress">
                    <div class="progress-bar bg-danger" role="progressbar" 
                    style="width: {{ $clase->porcentaje_calificaciones("negativa") }}%; height:6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </li>
            <li class="py-3">
                <div class="d-flex align-items-center">
                    <span class="text-muted display-5"><i class="mdi mdi-emoticon-neutral"></i></span>
                    <div class="dl ms-2 ml-2">
                        <h3 class="card-title">Calificaciones neutrales</h3>
                        <h6 class="card-subtitle">{{ $clase->total_calificaciones("neutral") }} calificaciones</h6>
                    </div>
                </div>
                <div class="progress">
                    <div class="progress-bar bg-warning" role="progressbar" 
                    style="width: {{ $clase->porcentaje_calificaciones("neutral") }}%; height:6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </li>
        </ul>
    </div>
    <!-- Column -->
</div>