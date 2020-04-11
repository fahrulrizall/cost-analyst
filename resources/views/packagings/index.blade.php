@extends('layouts.template')
@section('title',$plant.' Packagings')
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
            <h1>3770 Packaging</h1>
          </div>
        </div>
      </div>            
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Finish Good List</h3>
              <div class="card-tools">
                <!-- <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button> -->
                  <a href="#" type="button" class="btn btn-default float-right tombolTambahDataPackagings" 
              data-toggle="modal" data-target="#modal-default">Add Item</a>
             </div>
            </div>
          <div class="card-body"> 
            <div>
              
            </div> 
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th style="width: 10%">
                      Month
                    </th>
                    <th style="width: 10%">
                      Lab
                    </th>
                    <th style="width: 10%">
                      OFC
                    </th>
                    <th style="width: 10%">
                      Expenses
                    </th>
                    <th style="width: 10%">
                      Packaging
                    </th>
                    <th style="width: 10%">
                      LBS
                    </th>
                    <th style="width: 10%">
                      Other
                    </th>
                    <th style="width: 14%">
                      Action
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach ($packaging as $packaging)
                <tr>
                  <td>{{$packaging->month}}</td>
                  <td>{{$packaging->lab}}</td>
                  <td>{{$packaging->ofc}}</td>
                  <td>{{$packaging->expenses}}</td>
                  <td>{{$packaging->packaging}}</td>
                  <td>{{$packaging->lbs}}</td>
                  <td>{{$packaging->other}}</td>
                  <td>
                    <form action="/packagings/{{$packaging->id}}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                    <a href="" class="btn btn-primary tampilModalUbahPackaging" 
                      data-toggle="modal" data-target="#modal-default" data-id="{{$packaging->id}}" >Edit</a>
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



<div class="modal fade" id="modal-default">
<div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="formModalLabel">Add Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body mb-2"> 
        <form  method="POST" action="/fgs" >
        @csrf
        <div class="card-body">
            <input type="hidden" class="form-control " id="id" name="id">
            <div class="form-group">
                <label for="month">Month</label>
                <input type="month" class="form-control @error('month') is-invalid @enderror" id="month" 
                name="month" value="{{old('month')}}" required>
                @error('month')
                    <div class="invalid-feedback">{{$message }}</div>
                @enderror
            </div>
            <input type="hidden" id="plant" name="plant" value={{$plant}}>
            <div class="form-group">
                <label for="lab">Lab</label>
                <input type="number" class="form-control @error('lab') is-invalid @enderror" id="lab" 
                name="lab" placeholder="Lab Budget" value="{{old('lab')}}" required>
                @error('lab')
                    <div class="invalid-feedback">{{$message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="ofc">OFC</label>
                <input type="number" class="form-control @error('lbs') is-invalid @enderror" id="ofc" 
                name="ofc" placeholder="OFC Budget" value="{{old('ofc')}}" required>
                @error('ofc')
                    <div class="invalid-feedback">{{$message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="expenses">Expenses</label>
                <input type="number" class="form-control @error('expenses') is-invalid @enderror" id="expenses" 
                name="expenses" placeholder="Expenses Budget" value="{{old('expenses')}}" required>
                @error('expenses')
                    <div class="invalid-feedback">{{$message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="packaging">Packaging</label>
                <input type="number" class="form-control @error('packaging') is-invalid @enderror" id="packaging" 
                name="packaging" placeholder="Packaging" value="{{old('packaging')}}" required>
                @error('packaging')
                    <div class="invalid-feedback">{{$message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="lbs">LBS</label>
                <input type="number" class="form-control @error('lbs') is-invalid @enderror" id="lbs" 
                name="lbs" placeholder="Packaging" value="{{old('lbs')}}" required>
                @error('lbs')
                    <div class="invalid-feedback">{{$message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="other">Other</label>
                <input type="number" class="form-control @error('other') is-invalid @enderror" id="other" 
                name="other" placeholder="Other" value="{{old('other')}}" required>
                @error('other')
                    <div class="invalid-feedback">{{$message }}</div>
                @enderror
            </div>
        </div>
        <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Add</button>
        </form>
        </div>
    </div>
    </div>
    <!-- /.modal-content -->
</div>
@endsection
