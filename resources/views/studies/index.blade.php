@extends('layouts.app')

@section('content')
@php
  $isGetStudiesPeriod = Carbon\Carbon::now()->between(Carbon\Carbon::parse($currentPeriode->register_start), Carbon\Carbon::parse($currentPeriode->register_end.' 23:59:59'));
@endphp
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <form action="{{ route('studies.index') }}" class="form-group">
        <label for="periode">Periode</label>
        <select name="periode_id" id="periode" class="form-control" onchange="this.form.submit()">
          @foreach ($periodes as $periode)
            <option value="{{ $periode->id }}" @if($periode->id === $currentPeriode->id) selected @endif>Tahun {{ $periode->year }} - Semester {{ $periode->semester }}</option> 
          @endforeach
        </select>
      </form>
      <div class="panel panel-default">
        <div class="panel-heading" style="display: flex; justify-content: space-between;">
          Studi 
          @if ($isGetStudiesPeriod)
          <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalCreate">+ Tambah</button>
          <!-- Modal -->
          <div class="modal fade" id="modalCreate" tabindex="-1" role="dialog"
            aria-labelledby="modalCreateLabel">
            <div class="modal-dialog" role="document">
              <form class="modal-content" action="{{ route('studies.store') }}" method="POST">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                      aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="modalCreateLabel">Tambah Mata Kuliah</h4>
                </div>
                <div class="modal-body">
                  {{ csrf_field() }}
                  <input type="hidden" name="periode" value="{{ $currentPeriode->id }}">
                  <div class="form-group">
                    <label for="course">Mata Kuliah</label>
                    <select name="course"
                      class="form-control{{ $errors->has('course') ? ' has-error' : '' }}" id="course"
                      placeholder="Mata Kuliah" value="{{ old('course') }}" required>
                      <option value="" disabled selected>Pilih Mata Kuliah</option>
                      @foreach ($courses as $course)
                      <option value="{{ $course->id }}">{{ $course->name }} - {{ $course->user->name }}</option>
                      @endforeach
                    </select>
                    @if ($errors->has('course'))
                    <span class="help-block">
                      <strong>{{ $errors->first('course') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
              </form>
            </div>
          </div>
          @endif
        </div>

        <table class="table table-bordered">
          <tr>
            <th>No.</th>
            <th>Mata Kuliah</th>
            <th>Dosen</th>
            <th>SKS</th>
            <th>Nilai</th>
            @if ($isGetStudiesPeriod)
            <th>Aksi</th>   
            @endif
          </tr>
          @forelse ($studies as $study)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $study->course->name }}</td>
            <td>{{ $study->course->user->name }}</td>
            <td>{{ $study->course->credit }}</td>
            <td>{{ $study->grade ?? '-' }}</td>
            @if ($isGetStudiesPeriod)
            <td>
              <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modalDelete{{$study->id}}">
                Hapus
              </button>
              <!-- Modal -->
              <div class="modal fade" id="modalDelete{{$study->id}}" tabindex="-1" role="dialog"
                aria-labelledby="modalDelete{{$study->id}}Label">
                <div class="modal-dialog" role="document">
                  <form class="modal-content" action="{{ route('studies.destroy', $study->id) }}" method="POST">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                          aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="modalDelete{{$study->id}}Label">Anda yakin?</h4>
                    </div>
                    <div class="modal-body">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                      <input type="hidden" name="periode" value="{{ $currentPeriode->id }}">
                      Anda yakin ingin menghapus mata kuliah ini?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                      <button type="submit" class="btn btn-primary">Hapus</button>
                    </div>
                  </form>
                </div>
              </div>
            </td>
            @endif
          </tr>
          @empty
          <tr>
            <td colspan="{{ $isGetStudiesPeriod ? 6 : 5 }}">Tidak ada</td>
          </tr>
          @endforelse
        </table>
      </div>
    </div>
  </div>
</div>
@endsection