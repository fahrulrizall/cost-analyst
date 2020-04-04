@extends('layouts.template')
@section('title',$plant.' MAC')
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
            <h1>{{$plant}} Moving Average Cost</h1>
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
              <h3 class="card-title">{{$plant}} Moving Average Cost</h3>
            </div>
          <div class="card-body"> 
            <div>
              <a href="#" type="button" class="btn btn-default float-right tombolTambahDataMacs" 
              data-toggle="modal" data-target="#modal-default">Add Item</a>
            </div> 
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Code</th>
                  <th>Descriptions</th>
                  <th>MACs</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($macs as $macs)
                <tr>
                  <td>{{$macs->sap_code}}</td>
                  <td>{{$macs->material_desc}}</td>
                  <td>{{$macs->mac}}</td>
                  <td>
                    <form action="/macs/{{$macs->id}}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                    <a href="{{$macs->id}}/edit" class="btn btn-primary tampilModalUbahMacs" 
                      data-toggle="modal" data-target="#modal-default" data-id="{{$macs->id}}" >Edit</a>
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
        <form  method="POST" action="/macs3770" >
        @csrf
        <div class="card-body">
            <input type="hidden" class="form-control " id="id" name="id">
            <div class="form-group">
                <label for="sap_code">SAP Code</label>
                <input type="number" class="form-control @error('sap_code') is-invalid @enderror" id="sap_code" 
                name="sap_code" placeholder="SAP Code" value="{{old('sap_code')}}">
                @error('sap_code')
                    <div class="invalid-feedback">{{$message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="material_desc">Material Descriptions</label>
                <input type="text" class="form-control @error('material_desc') is-invalid @enderror" id="material_desc" 
                name="material_desc" placeholder="Material Descriptions" value="{{old('material_desc')}}">
                @error('material_desc')
                    <div class="invalid-feedback">{{$message }}</div>
                @enderror
            </div>
            <input type="hidden" name="plant" id="plant" value="{{$plant}}">
            <div class="form-group">
                <label for="mac">Macs</label>
                <input type="text" class="form-control @error('lbs') is-invalid @enderror" id="mac" 
                name="mac" placeholder="Price Per/Lbs" value="{{old('macs')}}">
                @error('macs')
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
<!-- /.modal-dialog -->
@endsection