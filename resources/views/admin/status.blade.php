@extends('../master.master')

@section('title', 'Status User')

@section('sidebar')
    <li class="nav-item">
        <a href="/" class="nav-link">
            <i class="nav-icon fas fa-home"></i>
            <p>Dashboard</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="/agama10" class="nav-link">
            <i class="nav-icon fas fa-pray"></i>
            <p>Agama</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="/status10" class="nav-link">
            <i class="nav-icon fas fa-user-check"></i>
            <p>Status User</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="/admindetail10" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>Detail User</p>
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
            @if (Auth::user()->foto == null)
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
            <a href="/profil10" class="btn btn-dark">Profile</a>
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
                    <div class="card-title"><h3>Status User</h3></div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <div class="table-responsive table-hover" id="tablePenduduk">
                        <table class="table m-0 align-middle">
                            <thead> 
                                <tr>
                                    <th>No</th>
                                    <th>Nama User</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{$item['name']}}</td>
                                    <td>{{$item['email']}}</td>
                                    <td>{{$item['role']}}</td>
                                    <td>
                                        @if ($item['is_active'] == 1)
                                            <span class="badge badge-success">Aktif</span>
                                        @else
                                            <span class="badge badge-secondary">NonAktif</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item['is_active'] == 1)
                                            <a class="btn btn-danger" id="btn-modal" onclick="changeApprovalStatus({{$item['id']}})"><i class="fa fa-sync"></i>&nbsp; NonAktif</a>
                                        @else
                                            <a class="btn btn-danger" id="btn-modal" onclick="changeApprovalStatus({{$item['id']}})"><i class="fa fa-sync"></i>&nbsp; Aktif</a>
                                        @endif
                                        <div class="modal fade" id="modal-default">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">
                                                            <i class="fas fa-exclamation text-danger"></i>&nbsp;
                                                            Ingin mengubah status user?
                                                        </h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form method="post" action="/status10">
                                                            @csrf
                                                            <div class="modal-footer justify-content-between">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                                <input type="hidden" name="id" id="id" />
                                                                <input type="submit" value="Edit" class="btn btn-danger">
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
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
        function changeApprovalStatus(par) {
            document.getElementById("id").value = par;
            $("#modal-default").modal();
        }
    </script>
@endsection
