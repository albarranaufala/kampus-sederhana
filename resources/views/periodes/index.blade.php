@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading" style="display: flex; justify-content: space-between;">
          Periode <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
            data-target="#modalCreate">+ Tambah</button>
          <!-- Modal -->
          <div class="modal fade" id="modalCreate" tabindex="-1" role="dialog"
            aria-labelledby="modalCreateLabel">
            <div class="modal-dialog" role="document">
              <form class="modal-content" action="{{ route('periodes.store') }}" method="POST">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                      aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="modalCreateLabel">Tambah Periode</h4>
                </div>
                <div class="modal-body">
                  {{ csrf_field() }}
                  <div class="form-group">
                    <label for="year">Tahun</label>
                    <input name="year" type="number" class="form-control{{ $errors->has('year') ? ' has-error' : '' }}"
                      id="year" placeholder="Tahun" value="{{ old('year') }}" required>
                    @if ($errors->has('year'))
                    <span class="help-block">
                      <strong>{{ $errors->first('year') }}</strong>
                    </span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="semester">Semester</label>
                    <input name="semester" type="number"
                      class="form-control{{ $errors->has('semester') ? ' has-error' : '' }}" id="semester"
                      placeholder="Semester" value="{{ old('semester') }}" required>
                    @if ($errors->has('semester'))
                    <span class="help-block">
                      <strong>{{ $errors->first('semester') }}</strong>
                    </span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="register_start">Pendaftaran Dimulai</label>
                    <input name="register_start" type="date"
                      class="form-control{{ $errors->has('register_start') ? ' has-error' : '' }}" id="register_start"
                      placeholder="Pendaftaran Dimulai" value="{{ old('register_start') }}" required>
                    @if ($errors->has('register_start'))
                    <span class="help-block">
                      <strong>{{ $errors->first('register_start') }}</strong>
                    </span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="register_end">Pendaftaran Selesai</label>
                    <input name="register_end" type="date"
                      class="form-control{{ $errors->has('register_end') ? ' has-error' : '' }}" id="register_end"
                      placeholder="Pendaftaran Selesai" value="{{ old('register_end') }}" required>
                    @if ($errors->has('register_end'))
                    <span class="help-block">
                      <strong>{{ $errors->first('register_end') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-primary">Tambah Periode</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <table class="table table-bordered">
          <tr>
            <th>No.</th>
            <th>Tahun</th>
            <th>Semester</th>
            <th>Pendaftaran Dimulai</th>
            <th>Pendaftaran Selesai</th>
            <th>Aksi</th>
          </tr>
          @forelse ($periodes as $periode)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $periode->year }}</td>
            <td>{{ $periode->semester }}</td>
            <td>{{ $periode->register_start }}</td>
            <td>{{ $periode->register_end }}</td>
            <td>
              <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modalUpdate{{$periode->id}}">
                Sunting
              </button>
              <!-- Modal -->
              <div class="modal fade" id="modalUpdate{{$periode->id}}" tabindex="-1" role="dialog"
                aria-labelledby="modalUpdate{{$periode->id}}Label">
                <div class="modal-dialog" role="document">
                  <form class="modal-content" action="{{ route('periodes.update', $periode->id) }}" method="POST">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                          aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="modalUpdate{{$periode->id}}Label">Sunting Periode</h4>
                    </div>
                    <div class="modal-body">
                      {{ csrf_field() }}
                      {{ method_field('PUT') }}
                      <div class="form-group">
                        <label for="year">Tahun</label>
                        <input name="year" type="number" class="form-control{{ $errors->has('year') ? ' has-error' : '' }}"
                          id="year" placeholder="Tahun" value="{{ old('year') ?? $periode->year }}" required>
                        @if ($errors->has('year'))
                        <span class="help-block">
                          <strong>{{ $errors->first('year') }}</strong>
                        </span>
                        @endif
                      </div>
                      <div class="form-group">
                        <label for="semester">Semester</label>
                        <input name="semester" type="number"
                          class="form-control{{ $errors->has('semester') ? ' has-error' : '' }}" id="semester"
                          placeholder="Semester" value="{{ old('semester') ?? $periode->semester }}" required>
                        @if ($errors->has('semester'))
                        <span class="help-block">
                          <strong>{{ $errors->first('semester') }}</strong>
                        </span>
                        @endif
                      </div>
                      <div class="form-group">
                        <label for="register_start">Pendaftaran Dimulai</label>
                        <input name="register_start" type="date"
                          class="form-control{{ $errors->has('register_start') ? ' has-error' : '' }}" id="register_start"
                          placeholder="Pendaftaran Dimulai" value="{{ old('register_start') ?? $periode->register_start }}" required>
                        @if ($errors->has('register_start'))
                        <span class="help-block">
                          <strong>{{ $errors->first('register_start') }}</strong>
                        </span>
                        @endif
                      </div>
                      <div class="form-group">
                        <label for="register_end">Pendaftaran Selesai</label>
                        <input name="register_end" type="date"
                          class="form-control{{ $errors->has('register_end') ? ' has-error' : '' }}" id="register_end"
                          placeholder="Pendaftaran Selesai" value="{{ old('register_end') ?? $periode->register_end }}" required>
                        @if ($errors->has('register_end'))
                        <span class="help-block">
                          <strong>{{ $errors->first('register_end') }}</strong>
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
              <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modalDelete{{$periode->id}}">
                Hapus
              </button>
              <!-- Modal -->
              <div class="modal fade" id="modalDelete{{$periode->id}}" tabindex="-1" role="dialog"
                aria-labelledby="modalDelete{{$periode->id}}Label">
                <div class="modal-dialog" role="document">
                  <form class="modal-content" action="{{ route('periodes.destroy', $periode->id) }}" method="POST">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                          aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="modalDelete{{$periode->id}}Label">Anda yakin?</h4>
                    </div>
                    <div class="modal-body">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                      Anda yakin ingin menghapus periode?
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
            <td colspan="6">Tidak ada</td>
          </tr>
          @endforelse
        </table>
      </div>
    </div>
  </div>
</div>
@endsection