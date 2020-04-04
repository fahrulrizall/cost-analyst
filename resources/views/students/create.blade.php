@extends('layout/main')
    @section('title','Tambah Data Students')

    @section('container')
    <div class="container">
        <div class="row">
            <div class="col-8">
             <h1 class="mt-2" >Tambah Students </h1>
             <form method="POST" action="/students">
             @csrf
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror " id="nama" name="nama"
                    value="{{old('nama')}}">
                    @error('nama')
                    <div class="invalid-feedback">{{$message }}</div>
                    @enderror
                </div> 
                <div class="form-group">
                    <label for="nim">NIM</label>
                    <input type="number" class="form-control @error('nim') is-invalid @enderror" id="nim" name="nim"
                    value="{{old('nim')}}">
                    @error('nim')
                    <div class="invalid-feedback">{{$message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                    value="{{old('email')}}" >
                    @error('email')
                    <div class="invalid-feedback">{{$message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="jurusan">Jurusan</label>
                    <input type="text" class="form-control @error('jurusan') is-invalid @enderror" id="jurusan" name="jurusan"
                    value="{{old('jurusan')}}">
                    @error('jurusan')
                    <div class="invalid-feedback">{{$message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Tambah Data</button>
            </form>
            </div>
        </div>
    </div>
    @endsection

