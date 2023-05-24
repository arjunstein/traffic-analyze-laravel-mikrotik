@extends('layouts.master')

@section('content')
    <div class="panel-header bg-primary-gradient">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h2 class="text-white pb-2 fw-bold">{{ $title }}</h2>
                    <h4 class="text-white op-2 mb-2">{{ $title }} => {{ $user['name'] }}</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="page-inner mt--5">
        <div class="row mt--2 justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <p><a href="{{ route('hotspot.index') }}" class="btn btn-success"><i class="fas fa-backward"></i></a></p>
                    <form action="{{ route('hotspot.update') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="user">User</label>
                                <input type="hidden" value="{{ $user['.id'] }}" name="id">
                                <input type="text" name="user"
                                    class="form-control @error('user') is-invalid @enderror" autocomplete="off"
                                    value="{{ $user['name'] ?? '' }}" id="user">
                                @error('user')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="text" name="password"
                                    class="form-control"
                                    value="{{ $user['password'] ?? '' }}" id="password">
                            </div>
                            <div class="form-group">
                                <label for="server">Server</label>
                                <select name="server" id="server"
                                    class="form-control @error('server') is-invalid @enderror">
                                    <option disabled selected>Pilih server</option>
                                    <option selected>{{ $user['server'] ?? '' }}</option>
                                    @foreach ($server as $data)
                                        <option>{{ $data['name'] }}</option>
                                    @endforeach
                                </select>
                                @error('server')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="profile">Profile</label>
                                <select name="profile" id="profile"
                                    class="form-control @error('profile') is-invalid @enderror">
                                    <option selected>{{ $user['profile'] ?? '' }}</option>
                                    @foreach ($profile as $data)
                                        <option>{{ $data['name'] }}</option>
                                    @endforeach
                                </select>
                                @error('profile')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="timelimit">Time Limit</label>
                                <input type="text" name="timelimit" value="{{ $user['uptime'] ?? '' }}"
                                    class="form-control @error('timelimit') is-invalid @enderror" id="timelimit">
                                @error('timelimit')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="disabled" id="disabled"
                                    class="form-control @error('disabled') is-invalid @enderror">
                                    @if ($user['disabled'] == 'false')
                                        <option disabled selected>Enable</option>
                                    @else
                                        <option disabled selected>Disable</option>
                                    @endif
                                    <option value="false">Enable</option>
                                    <option value="true">Disable</option>
                                </select>
                                @error('disabled')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="comment">Comment</label>
                                <input type="text" name="comment"
                                    class="form-control @error('comment') is-invalid @enderror"
                                    value="{{ $user['comment'] ?? '' }}" id="comment">
                                @error('comment')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

<?php function formatBytes($bytes, $decimal = null)
{
    $satuan = ['Bytes', 'Kb', 'Mb', 'Gb', 'Tb'];
    $i = 0;
    while ($bytes > 1024) {
        $bytes /= 1024;
        $i++;
    }
    return round($bytes, $decimal) . '-' . $satuan[$i];
}
?>