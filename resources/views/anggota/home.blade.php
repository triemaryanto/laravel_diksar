@extends('anggota.dashboard')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="col-md-12">
                <div class="card">
                    <!-- ./card-body -->
                    <div class="card-body">
                        <div class="row">
                            <p>Hallo <b>{{Session::get('nama')}}</b>, Absensi telah terekap, selamat mengikuti Pendidikan Dasar Koperasi Secara Online atapun ONSITE.</p>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <div class="col-md-12">
                <div class="card">
                    <!-- ./card-body -->
                    <div class="card-body">
                        <div class="row">
                            <img src="{{ asset('gambar/kspi.png') }}" class="img-responsive rounded mx-auto d-block" width="307" height="240">

                        </div>
                        <br>
                        <div class="row">
                            <img src="{{ asset('gambar/ksp.png') }}" class="img-responsive rounded mx-auto d-block" width="307" height="240">

                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection