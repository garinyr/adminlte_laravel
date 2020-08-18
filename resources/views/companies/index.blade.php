@extends('adminlte::page')

@section('title', 'Companies')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Companies</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Companies</li>
        </ol>
      </div>
    </div>
</div>
@stop

@section('content')
    @section('plugins.Datatables', true)
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Companies List</h3>
            <div class="float-right">
                <td class="text-right">
                    <a class="btn btn-primary btn-sm" href="{{ route('companies.create') }}">
                        {{-- <i class="fas fa-folder">
                        </i> --}}
                        Create
                    </a>
                </td>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
        @if (session('success'))
        <!-- MAKA TAMPILKAN ALERT SUCCESS -->
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('update'))
        <!-- MAKA TAMPILKAN ALERT SUCCESS -->
            <div class="alert alert-warning ">{{ session('update') }}</div>
        @endif
        @if (session('delete'))
            <!-- MAKA TAMPILKAN ALERT SUCCESS -->
            <div class="alert alert-danger">{{ session('delete') }}</div>
        @endif
        <!-- KETIKA ADA SESSION ERROR  -->
        @if (session('error'))
        <!-- MAKA TAMPILKAN ALERT DANGER -->
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Logo</th>
                    <th>Website</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($companies as $value)
                <tr>
                    <td>{{$value->name}}</td>
                    <td>{{$value->email}}</td>
                    <td>
                        <img src="{{ asset('storage/companies/' . $value->logo) }}" width="100px" height="100px" alt="{{ $value->name }}">
                    </td>
                    <td>{{$value->website}}</td>
                    <td class="project-actions text-right">
                        <a class="btn btn-primary btn-sm" href="{{ route('companies.show', $value->id) }}">
                            <i class="fas fa-folder">
                            </i>
                            View
                        </a>
                        <a class="btn btn-info btn-sm" href="{{ route('companies.edit', $value->id) }}">
                            <i class="fas fa-pencil-alt">
                            </i>
                            Edit
                        </a>
                        <form action="{{ route('companies.destroy', $value->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                <i class="fas fa-trash">
                                </i>
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Logo</th>
                    <th>Website</th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
        </div>
        <!-- /.card-body -->
    </div>
@stop

@section('js')
<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true,
        "autoWidth": false,
      });
    });
  </script>
@endsection
