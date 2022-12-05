@extends('admin.dashboard')
@push('datatablecss')
<!-- DataTables -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Absensi Anggota KSP DIAN MANDIRI</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Absensi</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="container-fluid">
            <div class="row g-3 align-items-center mt-2">
                <form action="#" method="get">
                    <div class="col-auto">
                        <p> Cari Berdasarkan</p>
                        <select class="form-select" aria-label="Default select example" name="cari">
                            <option value="anggotas.nama">Nama</option>
                            <option value="anggotas.kelompok">Kelompok</option>
                            <option value="anggotas.po">Petugas</option>
                            <option value="cabangs.nama_cabang">Cabang</option>
                        </select>
                    </div>
                    <div class="col-auto">
                        <input type="Search" name="search" value="{{ request('search')}}" class="form-control" aria-describedby="passwordHelpInline" placeholder="Search Data" />
                    </div>

                </form>
                <div class="col-auto">
                    <a href="/admin/pdfabsensi" class="btn btn-danger">Export PDF</a>
                </div>
                <div class="col-auto">
                    <a href="/admin/excelabsensi" class="btn btn-success">Export Excel</a>
                </div>
                <div class="col-auto">
                    <a href="/admin/datacsv" class="btn btn-success">Format CSV</a>
                </div>

            </div>
            <br>
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered table-hover" id="example2">

                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Anggota</th>
                                <th>Kelompok</th>
                                <th>Petugas</th>
                                <th>Cabang</th>
                                <th>Waktu</th>
                                <th>Maps</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($data as $index => $row)
                            <tr>
                                <td>{{ $index + $data->firstItem() }}</td>
                                <td>{{ $row->nama }}</td>
                                <td>{{ $row->kelompok }}</td>
                                <td>{{ $row->petugas }}</td>
                                <td>{{ $row->namacab }}</td>
                                <td>{{ \Carbon\Carbon::parse($row->createdat)->diffForHumans() }}</td>
                                <td><a href="/liatmaps/{{ $row->id }}">Lihat Peta</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Nama Anggota</th>
                                <th>Kelompok</th>
                                <th>Petugas</th>
                                <th>Cabang</th>
                                <th>Waktu</th>
                                <th>Maps</th>
                            </tr>
                        </tfoot>
                    </table>
                    <br>
                    {{ $data->onEachSide(0)->links() }}
                </div>
                <!-- /.card-body -->
            </div>
            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>
            <!-- /.col -->
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection
@push('datatablejs')
<!-- DataTables  & Plugins -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- DataTables  & Plugins -->
<script src="{{ asset('template/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('template/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('template/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('template/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('template/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('template/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('template/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('template/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('template/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('template/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script>
    $(function() {
        $('#example2').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>

@endpush