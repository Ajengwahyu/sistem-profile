@extends('../master.master')

@section('title', 'Tambah Detail')

@section('sidebar')
    <li class="nav-item">
        <a href="/" class="nav-link">
            <i class="nav-icon fas fa-home"></i>
            <p>Dashboard</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="/detail10" class="nav-link">
            <i class="nav-icon fas fa-user"></i>
            <p>Detail Data</p>
        </a>
    </li>
@endsection 

@section('profil')
    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
        @if (Auth::user()->foto == null)
            <img src="{{URL('./dist/img/user.png')}}" class="user-image img-circle elevation-2" alt="User Image">
        @else
            <img src="{{URL('./photo/' . Auth::user()->foto)}}"class="user-image img-circle elevation-2" alt="User Image">
        @endif
    </a>
    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <!-- User image -->
        <li class="user-header bg-dark">
            @if (Auth::user()->photo == null)
                <img src="{{URL('./dist/img/user.png')}}" class="img-circle elevation-2" alt="User Image">
            @else
                <img src="{{URL('./photo/' . Auth::user()->foto)}}" class="img-circle elevation-2" alt="User Image">
            @endif
            <p>
                {{(Auth::user()->name)}}
                <small>{{Auth::user()->role}}</small>
            </p>
        </li>
        <!-- Menu Footer-->
        <li class="user-footer">
            <a href="/profil10" class="btn btn-dark">Profil</a>
            <a href="/logout10" class="btn btn-danger float-right">Logout</a>
        </li>
    </ul>
@endsection

@section('content-header', 'Sistem Profil')

@section('content')
    @if (Session::has('success_message'))
        <div class="modal fade" id="success-message">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            <i class="fas fa-check text-info"></i>&nbsp;
                            {{ session('success_message') }}
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    @endif

    <div class="row">
        <div class="col-md-8">
            <div class="card card-outline card-info">
                <div class="card-header border-transparent">
                    <div class="card-title"><h3>Detail Data</h3></div>
                    @if ($status == 1)
                        <div class="card-tools">
                            <input type="hidden" name="id" id="id" value="{{$data['id']}}" />
                            <a href="/detail10/{{$data['id']}}" type="button" class="btn btn-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a type="button" class="btn btn-danger" id="btn-modal" onclick="showDelete({{$data['id']}})">
                                <i class="fas fa-trash"></i>
                            </a>
                            <div class="modal fade" id="modal-default">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">
                                                <i class="fas fa-trash text-danger"></i>&nbsp;
                                                Ingin menghapus data ini?
                                            </h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="post" action="/detail10/{{$data['id']}}/delete">
                                            @csrf
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                <input type="hidden" name="id" id="id" />
                                                <input type="submit" value="Hapus" class="btn btn-danger">
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                        </div>
                    @endif
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    @if ($status == 0)
                        <div class="row pt-lg-5">
                            <div class="col-md-2"></div>
                            <div class="col-md-8 text-center"><h4>Belum ada data</h4></div>
                            <div class="col-md-2"></div>
                        </div>
                        <div class="row  mb-5 pb-lg-5">
                            <div class="col-md-2"></div>
                            <div class="col-md-8 text-center mb-3"><a class="btn btn-primary" href="/detail10/create">Tambah sekarang</a></div>
                            <div class="col-md-2"></div>
                        </div> 
                    @else
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input type="text" class="form-control" value="{{Auth::user()->name}}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="tempat_lahir">Tempat Lahir</label>
                                    <input type="text" class="form-control" value="{{$data['tempat_lahir']}}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <input type="text" class="form-control" value="{{date('j F Y', strtotime($data['tanggal_lahir']))}}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="agama">Agama</label>
                                    <input type="text" class="form-control" value="{{$data['agama']}}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea class="form-control" rows="4" disabled>{{$data['alamat']}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="foto-ktp">Foto KTP</label><br>
                                    <img src="{{URL('./photo/' . $data['foto_ktp'])}}" class="img rounded" alt="Foto KTP" width="243" height="153">
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    @if (Session::has('success_message'))
        <script>
            $(document).ready(function(){
                $("#success-message").modal();
            }); 
        </script>
    @endif
    <script>
        function showDelete(par) {
            document.getElementById("id").value = par;
            $("#modal-default").modal();
        }
    </script>
@endsection
