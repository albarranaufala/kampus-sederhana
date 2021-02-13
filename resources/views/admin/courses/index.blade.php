@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading" style="display: flex; justify-content: space-between;">
          Mata Kuliah <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
            data-target="#modalCreate">+ Tambah</button>
          <!-- Modal -->
          <div class="modal fade" id="modalCreate" tabindex="-1" role="dialog"
            aria-labelledby="modalCreateLabel">
            <div class="modal-dialog" role="document">
              <form class="modal-content" action="{{ route('admin.courses.store') }}" method="POST">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                      aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="modalCreateLabel">Tambah Mata Kuliah</h4>
                </div>
                <div class="modal-body">
                  {{ csrf_field() }}
                  <div class="form-group">
                    <label for="name">Nama Mata Kuliah</label>
                    <input name="name" type="text" class="form-control{{ $errors->has('name') ? ' has-error' : '' }}"
                      id="name" placeholder="Nama Mata Kuliah" value="{{ old('name') }}" required>
                    @if ($errors->has('name'))
                    <span class="help-block">
                      <strong>{{ $errors->first('name') }}</strong>
                    </span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="lecture">Dosen</label>
                    <select name="lecture"
                      class="form-control{{ $errors->has('lecture') ? ' has-error' : '' }}" id="lecture"
                      placeholder="Dosen" value="{{ old('lecture') }}" required>
                      <option value="" disabled selected>Pilih Dosen</option>
                      @foreach ($lectures as $lecture)
                      <option value="{{ $lecture->id }}">{{ $lecture->name }}</option>
                      @endforeach
                    </select>
                    @if ($errors->has('lecture'))
                    <span class="help-block">
                      <strong>{{ $errors->first('lecture') }}</strong>
                    </span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="credit">SKS</label>
                    <input name="credit" type="number"
                      class="form-control{{ $errors->has('credit') ? ' has-error' : '' }}" id="credit"
                      placeholder="SKS" value="{{ old('credit') }}" required>
                    @if ($errors->has('credit'))
                    <span class="help-block">
                      <strong>{{ $errors->first('credit') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-primary">Tambah Mata Kuliah</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <table class="table table-bordered">
          <tr>
            <th>No.</th>
            <th>Mata Kuliah</th>
            <th>Dosen</th>
            <th>SKS</th>
            <th>Aksi</th>
          </tr>
          @forelse ($courses as $course)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $course->name }}</td>
            <td>{{ $course->user->name }}</td>
            <td>{{ $course->credit }}</td>
            <td>
              <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modalUpdate{{$course->id}}">
                Sunting
              </button>
              <!-- Modal -->
              <div class="modal fade" id="modalUpdate{{$course->id}}" tabindex="-1" role="dialog"
                aria-labelledby="modalUpdate{{$course->id}}Label">
                <div class="modal-dialog" role="document">
                  <form class="modal-content" action="{{ route('admin.courses.update', $course->id) }}" method="POST">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                          aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="modalUpdate{{$course->id}}Label">Sunting Mata Kuliah</h4>
                    </div>
                    <div class="modal-body">
                      {{ csrf_field() }}
                      {{ method_field('PUT') }}
                      <div class="form-group">
                        <label for="name">Nama Mata Kuliah</label>
                        <input name="name" type="text"
                          class="form-control{{ $errors->has('name') ? ' has-error' : '' }}" id="name"
                          placeholder="Nama Lengkap" value="{{ old('name') ?? $course->name }}" required>
                        @if ($errors->has('name'))
                        <span class="help-block">
                          <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                      </div>
                      <div class="form-group">
                        <label for="lecture">Dosen</label>
                        <select name="lecture"
                          class="form-control{{ $errors->has('lecture') ? ' has-error' : '' }}" id="lecture"
                          placeholder="Dosen" value="{{ old('lecture') }}" required>
                          <option value="" disabled selected>Pilih Dosen</option>
                          @foreach ($lectures as $lecture)
                          <option value="{{ $lecture->id }}" @if(old('lecture') === $lecture->id) selected @elseif($lecture->id === $course->user->id) selected @endif>{{ $lecture->name }}</option>
                          @endforeach
                        </select>
                        @if ($errors->has('lecture'))
                        <span class="help-block">
                          <strong>{{ $errors->first('lecture') }}</strong>
                        </span>
                        @endif
                      </div>
                      <div class="form-group">
                        <label for="credit">SKS</label>
                        <input name="credit" type="number"
                          class="form-control{{ $errors->has('credit') ? ' has-error' : '' }}" id="credit"
                          placeholder="SKS" value="{{ old('credit') ?? $course->credit }}" required>
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
              <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modalDelete{{$course->id}}">
                Hapus
              </button>
              <!-- Modal -->
              <div class="modal fade" id="modalDelete{{$course->id}}" tabindex="-1" role="dialog"
                aria-labelledby="modalDelete{{$course->id}}Label">
                <div class="modal-dialog" role="document">
                  <form class="modal-content" action="{{ route('admin.courses.update', $course->id) }}" method="POST">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                          aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="modalDelete{{$course->id}}Label">Anda yakin?</h4>
                    </div>
                    <div class="modal-body">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                      Anda yakin ingin menghapus mata kuliah?
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