@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading" style="display: flex; justify-content: space-between;">
          Mata Kuliah: {{ $course->name }} <br>
          SKS: {{ $course->credit }}
        </div>

        <table class="table table-bordered">
          <tr>
            <th>No.</th>
            <th>Mahasiswa</th>
            <th>Nilai</th>
            <th>Aksi</th>
          </tr>
          @forelse ($course->studies as $study)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $study->user->name }}</td>
            <td>{{ $study->grade ?? '-' }}</td>
            <td>
              <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modalGrade{{$study->id}}">
                Nilai
              </button>
              <!-- Modal -->
              <div class="modal fade" id="modalGrade{{$study->id}}" tabindex="-1" role="dialog"
                aria-labelledby="modalGrade{{$study->id}}Label">
                <div class="modal-dialog" role="document">
                  <form class="modal-content" action="{{ route('lecture.studies.grade', $study->id) }}" method="POST">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                          aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="modalGrade{{$study->id}}Label">Anda yakin?</h4>
                    </div>
                    <div class="modal-body">
                      {{ csrf_field() }}
                      <div class="form-group">
                        <label for="grade">Nilai</label>
                        <input name="grade" type="number" class="form-control{{ $errors->has('grade') ? ' has-error' : '' }}"
                          id="grade" placeholder="Nilai" value="{{ old('grade') ?? $study->grade ?? '-' }}" required>
                        @if ($errors->has('grade'))
                        <span class="help-block">
                          <strong>{{ $errors->first('grade') }}</strong>
                        </span>
                        @endif
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                      <button type="submit" class="btn btn-primary">Nilai</button>
                    </div>
                  </form>
                </div>
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="3">Tidak ada</td>
          </tr>
          @endforelse
        </table>
      </div>
    </div>
  </div>
</div>
@endsection