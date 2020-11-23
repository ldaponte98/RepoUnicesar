
@extends('layouts.main_docente')

@section('header_content')

	<div class="row page-titles">
        <div class="col-md-6 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Tabla</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Clases</a></li>
                <li class="hidden-sm-down breadcrumb-item active">Nueva clase</li>
            </ol>
        </div>
        <div class="col-md-6 col-4 align-self-center">
        </div>
    </div>
@endsection
@section('content')

<div class="row">
<div class="col-sm-12">
    <div class="card">
        <div class="card-block">
            <h4 class="card-title">Clases</h4>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th><center><b>#</b></center></th>
                            <th><b>Nombre</b></th>
                            <th><b>Cedula</b></th>
                            <th><b>Email</b></th>
                            <th><b>Tipo de vinculacion</b></th>
                        </tr>
                    </thead>
                    <style type="text/css"> 
                    	.fil td{
                    		color: black !important;
                    	}
                    </style>
                    <tbody id="bodytable">

                    	
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>

@endsection