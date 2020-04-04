@extends('layouts.template')
@section('title',$plant.' Finished Goods')
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
            <h1>3770 Finished Good Item</h1>
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
             </div>
            </div>
          <div class="card-body"> 
            <div>
              <a href="#" type="button" class="btn btn-default float-right tombolTambahDataFgs" 
              data-toggle="modal" data-target="#modal-default">Add Item</a>
            </div> 
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th style="width: 8%">
                      SAP Code
                    </th>
                    <th style="width: 25%">
                      Description
                    </th>
                    <th style="width: 5%">
                      Price/Lbs
                    </th>
                    <th style="width: 8%">
                      Lbs
                    </th>
                    <th style="width: 5%">
                      StdPrice
                    </th>
                    <th style="width: 5%">
                      Fee
                    </th>
                    <th style="width: 8%">
                      Category
                    </th>
                    <th style="width: 14%">
                      Action
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach ($fgs as $fgs)
                <tr>
                  <td>{{$fgs->sap_code}}</td>
                  <td>{{$fgs->material_desc}}</td>
                  <td>{{$fgs->price_lbs}}</td>
                  <td>{{$fgs->lbs}}</td>
                  <td>{{$fgs->std_price}}</td>
                  <td>{{$fgs->processing_fee}}</td>
                  <td>{{$fgs->category}}</td>
                  <td>
                    <form action="/fgs/{{$fgs->id}}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                    <a href="{{$fgs->id}}/edit" class="btn btn-primary tampilModalUbahFgs" 
                      data-toggle="modal" data-target="#modal-default" data-id="{{$fgs->id}}" >Edit</a>
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
                <label for="sap_code">SAP Code</label>
                <input type="number" class="form-control @error('sap_code') is-invalid @enderror" id="sap_code" 
                name="sap_code" placeholder="SAP Code" value="{{old('sap_code')}}" required>
                @error('sap_code')
                    <div class="invalid-feedback">{{$message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="material_desc">Material Descriptions</label>
                <input type="text" class="form-control @error('material_desc') is-invalid @enderror" id="material_desc" 
                name="material_desc" placeholder="Material Descriptions" value="{{old('material_desc')}}" required>
                @error('material_desc')
                    <div class="invalid-feedback">{{$message }}</div>
                @enderror
            </div>
            <input type="hidden" id="plant" name="plant" value={{$plant}}>
            <div class="form-group">
                <label for="price_lbs">Price Per/Lbs</label>
                <input type="text" class="form-control @error('lbs') is-invalid @enderror" id="price_lbs" 
                name="price_lbs" placeholder="Price Per/Lbs" value="{{old('price_lbs')}}" required>
                @error('price_lbs')
                    <div class="invalid-feedback">{{$message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="lbs">Lbs</label>
                <input type="text" class="form-control @error('lbs') is-invalid @enderror" id="lbs" 
                name="lbs" placeholder="Lbs" value="{{old('lbs')}}" required>
                @error('lbs')
                    <div class="invalid-feedback">{{$message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="std_price">Standard Price</label>
                <input type="text" class="form-control @error('std_price') is-invalid @enderror" id="std_price" 
                name="std_price" placeholder="Standard Price" value="{{old('std_price')}}" required>
                @error('std_price')
                    <div class="invalid-feedback">{{$message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="processing_fee">Processing Fee</label>
                <input type="text" class="form-control @error('processing_fee') is-invalid @enderror" id="processing_fee" 
                name="processing_fee" placeholder="Processing Fee" value="{{old('processing_fee')}}" required>
                @error('processing_fee')
                    <div class="invalid-feedback">{{$message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <select class="form-control @error('category') is-invalid @enderror" id="category" 
                name="category" value="{{old('category')}}">
                  <option>Steak</option>
                  <option>Saku</option>
                  <option>By Product</option>
                  <option>Loin</option>
                </select>
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





