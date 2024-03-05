@extends('../master.master')

@section('title', 'Detail Data')

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
    <div class="card card-outline card-info">
        <div class="card-header border-transparent">
            <div class="card-title"><h3>Detail Data User</h3></div>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <div class="table-responsive table-hover" id="tablePenduduk">
                <table class="table m-0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama User</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Foto</th>
                            <th>Tempat Lahir</th>
                            <th>Umur</th>
                            <th class="text-center">Detail</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($data as $detail)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $detail['name'] }}</td>
                                <td>{{ $detail['email'] }}</td>
                                <td>
                                    @if ($detail['status'] == 1)
                                        <span class="badge badge-success">Aktif</span>
                                    @else
                                        <span class="badge badge-secondary">NonAktif</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($detail['foto'] == null)
                                        <img src="{{URL('./dist/img/user.png')}}" class="img-circle elevation-2" width="30px" height="30px" alt="User Image">
                                    @else
                                        <img src="{{URL('./photo/' . $detail['foto'])}}" class="img-circle elevation-2" width="30px" height="30px" alt="User Image">
                                    @endif
                                </td>
                                <td>{{ $detail['tempat_lahir'] }}</td>
                                <td>{{ $detail['umur'] }}</td>
                                <td class="text-center">
                                    <a href="/admindetail10/{{$detail['id']}}" class="btn btn-link"><i class="fa fa-list text-info"></i></a>
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
@endsection

@section('javascript')
    @if (Session::has('success_message'))
        <script>
            $(document).ready(function(){
                $("#success-message").modal();
            }); 
        </script>
    @endif
@endsection
