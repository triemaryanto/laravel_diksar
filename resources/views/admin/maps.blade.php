@extends('admin.dashboard')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Maps Absen Kehadiran Anggota</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Maps</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="container">
            <div class="card">
                <!-- /.card-header -->

                <div class="card-body">
                    <span> {{ $dataMaps->anggotas->nama }}</span>
                    <iframe width="100%" height="1000" src="https://maps.google.com/maps?q={{ $dataMaps->latitude }},{{ $dataMaps->longitude }}&output=embed"></iframe>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection