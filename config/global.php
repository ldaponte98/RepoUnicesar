<?php

return [
    //dominios de los formatos
    'seguimiento_asignatura' => 11,
    'plan_trabajo' => 12,
    'desarrollo_asignatura' => 13,
    'actividades_complementarias' => 14,
    'plan_accion' => 16,
    'plan_asignatura' => 33,



    'notificacion_revision' => 6,
    'notificacion_tiempo' => 7,
    'notificacion_extra_pazo' => 8,
    'notificacion_retraso' => 9,


    'email_general' => 'repounicesar@gmail.com',

    'url_base' => ENV('APP_URL'),
    'ips' => ['127.0.0.1', '179.14.170.8', '168.197.71.161'],
    'services' => (object) [
        'academusoft' => (object) [
            'sync_programas_facultades' => 'http://wwwpruebas.unicesar.edu.co:9000/unicesar/academusoft/academico/integracion/programas.jsp',
            'sync_asignaturas' => 'http://wwwpruebas.unicesar.edu.co:9000/unicesar/academusoft/academico/integracion/asignaturas.jsp',
            'sync_periodo_actual' => 'http://wwwpruebas.unicesar.edu.co:9000/unicesar/academusoft/academico/integracion/periodo.jsp'
        ] 
    ],
]
?>