@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading" style="display: flex; justify-content: space-between;">
          Mata Kuliah
        </div>

        <table class="table table-bordered">
          <tr>
            <th>No.</th>
            <th>Mata Kuliah</th>
            <th>SKS</th>
            <th>Aksi</th>
          </tr>
          @forelse ($courses as $course)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $course->name }}</td>
            <td>{{ $course->credit }}</td>
            <td>
              <a href="{{ route('lecture.courses.show', $course->id) }}" type="button" class="btn btn-primary btn-xs">
                Lihat
              </a>
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