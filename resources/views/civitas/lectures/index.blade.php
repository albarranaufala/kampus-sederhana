@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading" style="display: flex; justify-content: space-between;">
          Dosen <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
            data-target="#modalCreate">+ Tambah</button>
          <!-- Modal -->
          <div class="modal fade" id="modalCreate" tabindex="-1" role="dialog"
            aria-labelledby="modalCreateLabel">
            <div class="modal-dialog" role="document">
              <form class="modal-content" action="{{ route('lectures.store') }}" method="POST">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                      aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="modalCreateLabel">Tambah Dosen</h4>
                </div>
                <div class="modal-body">
                  {{ csrf_field() }}
                  <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input name="name" type="text" class="form-control{{ $errors->has('name') ? ' has-error' : '' }}"
                      id="name" placeholder="Nama Lengkap" value="{{ old('name') }}" required>
                    @if ($errors->has('name'))
                    <span class="help-block">
                      <strong>{{ $errors->first('name') }}</strong>
                    </span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="username">Username</label>
                    <input name="username" type="text"
                      class="form-control{{ $errors->has('username') ? ' has-error' : '' }}" id="username"
                      placeholder="Username" value="{{ old('username') }}" required>
                    @if ($errors->has('username'))
                    <span class="help-block">
                      <strong>{{ $errors->first('username') }}</strong>
                    </span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input name="password" type="password"
                      class="form-control{{ $errors->has('password') ? ' has-error' : '' }}" id="password"
                      placeholder="Password" value="{{ old('password') }}" required>
                    @if ($errors->has('password'))
                    <span class="help-block">
                      <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <input name="password_confirmation" type="password" class="form-control" id="password_confirmation"
                      placeholder="Konfirmasi Password" required>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-primary">Tambah Dosen</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <table class="table table-bordered">
          <tr>
            <th>No.</th>
            <th>Nama</th>
            <th>Username</th>
            <th>Aksi</th>
          </tr>
          @forelse ($lectures as $lecture)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $lecture->name }}</td>
            <td>{{ $lecture->username }}</td>
            <td>
              <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modalUpdate{{$lecture->id}}">
                Sunting
              </button>
              <!-- Modal -->
              <div class="modal fade" id="modalUpdate{{$lecture->id}}" tabindex="-1" role="dialog"
                aria-labelledby="modalUpdate{{$lecture->id}}Label">
                <div class="modal-dialog" role="document">
                  <form class="modal-content" action="{{ route('lectures.update', $lecture->id) }}" method="POST">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                          aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="modalUpdate{{$lecture->id}}Label">Sunting Dosen</h4>
                    </div>
                    <div class="modal-body">
                      {{ csrf_field() }}
                      {{ method_field('PUT') }}
                      <div class="form-group">
                        <label for="name">Nama Lengkap</label>
                        <input name="name" type="text"
                          class="form-control{{ $errors->has('name') ? ' has-error' : '' }}" id="name"
                          placeholder="Nama Lengkap" value="{{ old('name') ?? $lecture->name }}" required>
                        @if ($errors->has('name'))
                        <span class="help-block">
                          <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                      </div>
                      <div class="form-group">
                        <label for="username">Username</label>
                        <input name="username" type="text"
                          class="form-control{{ $errors->has('username') ? ' has-error' : '' }}" id="username"
                          placeholder="Username" value="{{ old('username') ?? $lecture->username }}" required>
                        @if ($errors->has('username'))
                        <span class="help-block">
                          <strong>{{ $errors->first('username') }}</strong>
                        </span>
                        @endif
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                      <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                  </form>
                </div>
              </div>
              <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modalDelete{{$lecture->id}}">
                Hapus
              </button>
              <!-- Modal -->
              <div class="modal fade" id="modalDelete{{$lecture->id}}" tabindex="-1" role="dialog"
                aria-labelledby="modalDelete{{$lecture->id}}Label">
                <div class="modal-dialog" role="document">
                  <form class="modal-content" action="{{ route('lectures.destroy', $lecture->id) }}" method="POST">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                          aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="modalDelete{{$lecture->id}}Label">Anda yakin?</h4>
                    </div>
                    <div class="modal-body">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                      Anda yakin ingin menghapus dosen?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                      <button type="submit" class="btn btn-primary">Hapus</button>
                    </div>
                  </form>
                </div>
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="4">Tidak ada</td>
          </tr>
          @endforelse
        </table>
      </div>
    </div>
  </div>
</div>
@endsection