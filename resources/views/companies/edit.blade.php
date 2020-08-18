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
          <li class="breadcrumb-item">Companies</li>
          <li class="breadcrumb-item active">Edit</li>
        </ol>
      </div>
    </div>
</div>
@stop

@section('content')
@section('plugins.toastr', true)
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Companies</h3>
            <div class="float-right">
                <td class="text-right">
                    <a class="btn btn-secondary btn-sm" href="{{ route('companies.index') }}">
                        {{-- <i class="fas fa-folder">
                        </i> --}}
                        Back
                    </a>
                </td>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="card">
                  {{-- <div class="card-header">
                    <h3 class="card-title">Quick Example</h3>
                  </div> --}}
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form role="form" action="{{ route('companies.update', $companies->id) }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      @method('PUT')
                    <div class="card-body">
                      <div class="form-group">
                        <label for="name">Company Name</label>
                      <input type="text" class="form-control" name="name" id="name" placeholder="Enter company name" value="{{ $companies->name }}">
                        <p class="text-danger">{{ $errors->first('name') }}</p>
                      </div>
                      <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" value="{{ $companies->email }}">
                        <p class="text-danger">{{ $errors->first('email') }}</p>
                      </div>
                      <div class="form-group">
                        <label for="logo">Logo</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="logo" name="logo">
                            <label class="custom-file-label" for="logo">Choose file</label>
                          </div>
                        </div>
                        <p class="text-danger">{{ $errors->first('logo') }}</p>
                      </div>
                      <div class="form-group">
                        <label for="website">Website</label>
                        <input type="text" class="form-control" name="website" id="website" placeholder="Enter website name" value="{{ $companies->website }}">
                        <p class="text-danger">{{ $errors->first('website') }}</p>
                      </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.card-body -->
    </div>
@stop

@section('js')
@section('plugins.bsCustomFileInput', true)
<script type="text/javascript">
    $(document).ready(function () {
        bsCustomFileInput.init();
    });
</script>
@endsection
