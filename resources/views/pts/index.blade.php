@extends('layouts.template')
@section('title',$plant.' PTs')
@section('container')
<div class="content-wrapper">
    <section class="content-header">
    @if (session('status'))
    <div class="card card-success float-right">
    <div class="btn btn-success card-tools">
        {{session('status')}}
        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
        </button>
    </div>
    </div>
    @endif
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{$plant}} Productions Target</h1>
          </div>
        </div>
      </div>            
    </section>

    <div class="row-1">
        <form action="/pts" method="POST">
        @csrf
        <div class="card-body">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
            <span class="input-group-text">PT#</span>
            </div>
            <input type="number" class="form-control @error('pt_name') is-invalid @enderror" placeholder="Masukan No PT" id="pt_name" name="pt_name" required>
            <input type="hidden" id="plant" name="plant" value="{{$plant}}">
            <input type="hidden" id="validatept" name="validatept" value="">
            <button type="submit" class="btn btn-info float-right">Create</button>
            @error('pt_name')
              <div class="invalid-feedback">{{$message }}</div>
            @enderror
        </div>
        </div>
        </form>
    </div>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">{{$plant}} Productions Target</h3>
            </div>
          <div class="card-body"> 
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Productions Target</th>
                  <th>Plant</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($pts as $pts)
                <tr>
                  <td>PT#{{$pts->pt_name}}</td>
                  <td>{{$pts->plant}}</td>
                  <td>
                    <a href="/pts/{{$pts->plant}}/edit/{{$pts->pt_name}}" class="btn btn-primary" >Edit</a>
                    <form action="/pts/{{$pts->pt_name}}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                    <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                  </td>
                </tr>
                @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
<!-- /.modal-dialog -->
@endsection