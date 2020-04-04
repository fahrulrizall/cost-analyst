@extends('layouts.template')
@section('title',$planttitle.' | PT '.$pt)
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
            <h1><a href="#" style="color: black">PT#{{$pt}}-{{$planttitle}}</a></h1>
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
              <h3 class="card-title">Detail Item</h3>
            </div>
          <div class="card-body "> 
              <table id="" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th style="width: 8%">
                    SAP Code
                  </th>
                  <th style="width: 20%">
                    Description
                  </th>
                  <th style="width: 5%">
                    Fee
                  </th>
                  <th style="width: 5%">
                    Price/Lbs
                  </th>
                  <th style="width: 8%">
                    Category
                  </th>
                  <th style="width: 5%">
                    Lbs
                  </th>
                  <th style="width: 5%">
                    Mac
                  </th>
                  <th style="width: 8%">
                    Hasil
                  </th>
                  <th style="width: 14%">
                    Action
                  </th>
                </tr>
                </thead>
                <tbody>
                @foreach ($pts as $pts)
                <tr>
                  <td>{{$pts->sap_code}}</td>
                  <td>{{$pts->material_desc}}</td>
                  <td>{{$pts->price_lbs}}</td>
                  <td>{{$pts->processing_fee}}</td>
                  <td>{{$pts->category}}</td>
                  <td>{{$pts->lbs}}</td>
                  <td>{{$pts->mac}}</td>
                  <td>{{$pts->result}}</td>
                  <td>
                    <form action="/pts/{{$pts->id}}/delete" method="post" class="d-inline">
                    @method('delete')
                        @csrf
                    <a href="/pts/{{$pts->id}}/update" class="btn btn-primary tampilModalUbahPts" 
                    data-toggle="modal" data-target="#modal-default" data-id="{{$pts->id}}" >Edit</a>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                  </td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th>Total</th>
                  <th>{{$sum}}</th>
                  <th></th>
                </tr>
              </tfoot>
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

<div class="content-wrapper">
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Finish Good List</h3>
              <div class="card-tools">
             </div>
            </div>
          <div class="card-body"> 
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Code</th>
                  <th>Descriptions</th>
                  <th>Price</th>
                  <th>Lbs</th>
                  <th>Std Price</th>
                  <th>Fee</th>
                  <th>Category</th>
                  <th>Actions</th>
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
                    <form 
                    action="/pts/{{$fgs->id}}/add/{{$pt}}" method="post">
                    @csrf
                    <input type="hidden" id="pt_name" name="pt_name" value="{{$pt}}" >
                    <input type="hidden" id="sap_code" name="sap_code" value="{{$fgs->sap_code}}" >
                    <input type="hidden" id="validate" name="validate" value="{{$fgs->sap_code.$fgs->plant.$pt}}" >
                    <input type="hidden" id="material_desc" name="material_desc" value="{{$fgs->material_desc}}" >
                    <input type="hidden" id="plant" name="plant" value="{{$fgs->plant}}" >
                    <input type="hidden" id="price_lbs" name="price_lbs" value="{{$fgs->price_lbs}}" >
                    <input type="hidden" id="std_price" name="std_price" value="{{$fgs->std_price}}" >
                    <input type="hidden" id="processing_fee" name="processing_fee" value="{{$fgs->processing_fee}}" >
                    <input type="hidden" id="category" name="category" value="{{$fgs->category}}" >
                    <button type="submit" class="btn btn-primary" >Add</a>
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
        <form  method="POST" action="#" >
        @csrf
        <div class="card-body">
            <input type="hidden" class="form-control " id="id" name="id">
            <div class="form-group">
                <label for="lbs">Lbs</label>
                <input type="number" class="form-control @error('lbs') is-invalid @enderror" id="lbs" 
                name="lbs" placeholder="SAP Code" value="{{old('lbs')}}">
                @error('lbs')
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="loin">Raw Material</label>
                @foreach ($loin as $loin)
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="{{$loin->sap_code}}" name="a{{$loin->sap_code}}" value="{{$loin->mac}}">
                  <label for="{{$loin->sap_code}}" class="custom-control-label">{{$loin->material_desc}}</label>
                </div>
                @endforeach
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