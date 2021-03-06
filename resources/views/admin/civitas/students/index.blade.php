@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading" style="display: flex; justify-content: space-between;">
          Mahasiswa <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
            data-target="#modalCreate">+ Tambah</button>
          <!-- Modal -->
          <div class="modal fade" id="modalCreate" tabindex="-1" role="dialog"
            aria-labelledby="modalCreateLabel">
            <div class="modal-dialog" role="document">
              <form class="modal-content" action="{{ route('admin.students.store') }}" method="POST">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                      aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="modalCreateLabel">Tambah Mahasiswa</h4>
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
                    <label for="credit">Jatah SKS</label>
                    <input name="credit" type="number"
                      class="form-control{{ $errors->has('credit') ? ' has-error' : '' }}" id="credit"
                      placeholder="Jatah SKS" value="{{ old('credit') }}" required>
                    @if ($errors->has('credit'))
                    <span class="help-block">
                      <strong>{{ $errors->first('credit') }}</strong>
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
                  <button type="submit" class="btn btn-primary">Tambah Mahasiswa</button>
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
            <th>Jatah SKS</th>
            <th>Aksi</th>
          </tr>
          @forelse ($students as $student)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $student->name }}</td>
            <td>{{ $student->username }}</td>
            <td>{{ $student->credit->credit }}</td>
            <td>
              <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modalUpdate{{$student->id}}">
                Sunting
              </button>
              <!-- Modal -->
              <div class="modal fade" id="modalUpdate{{$student->id}}" tabindex="-1" role="dialog"
                aria-labelledby="modalUpdate{{$student->id}}Label">
                <div class="modal-dialog" role="document">
                  <form class="modal-content" action="{{ route('admin.students.update', $student->id) }}" method="POST">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                          aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="modalUpdate{{$student->id}}Label">Sunting Mahasiswa</h4>
                    </div>
                    <div class="modal-body">
                      {{ csrf_field() }}
                      {{ method_field('PUT') }}
                      <div class="form-group">
                        <label for="name">Nama Lengkap</label>
                        <input name="name" type="text"
                          class="form-control{{ $errors->has('name') ? ' has-error' : '' }}" id="name"
                          placeholder="Nama Lengkap" value="{{ old('name') ?? $student->name }}" required>
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
                          placeholder="Username" value="{{ old('username') ?? $student->username }}" required>
                        @if ($errors->has('username'))
                        <span class="help-block">
                          <strong>{{ $errors->first('username') }}</strong>
                        </span>
                        @endif
                      </div>
                      <div class="form-group">
                        <label for="credit">Jatah SKS</label>
                        <input name="credit" type="number"
                          class="form-control{{ $errors->has('credit') ? ' has-error' : '' }}" id="credit"
                          placeholder="Jatah SKS" value="{{ old('credit') ?? $student->credit->credit }}" required>
                        @if ($errors->has('credit'))
                        <span class="help-block">
                          <strong>{{ $errors->first('credit') }}</strong>
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
              <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modalDelete{{$student->id}}">
                Hapus
              </button>
              <!-- Modal -->
              <div class="modal fade" id="modalDelete{{$student->id}}" tabindex="-1" role="dialog"
                aria-labelledby="modalDelete{{$student->id}}Label">
                <div class="modal-dialog" role="document">
                  <form class="modal-content" action="{{ route('admin.students.destroy', $student->id) }}" method="POST">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                          aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="modalDelete{{$student->id}}Label">Anda yakin?</h4>
                    </div>
                    <div class="modal-body">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                      Anda yakin ingin menghapus mahasiswa?
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
            <td colspan="5">Tidak ada</td>
          </tr>
          @endforelse
        </table>
      </div>
    </div>
  </div>
</div>
@endsection