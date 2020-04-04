@extends('layout/main')
    @section('title','Edit Students')

    @section('container')
    <div class="container">
        <div class="row">
            <div class="col-8">
             <h1 class="mt-2" >Ubah Students </h1>
             <form method="POST" action="/students/{{$student->id}}">
                @method('patch')
             @csrf
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror " id="nama" name="nama"
                    value="{{$student->nama}}">
                    @error('nama')
                    <div class="invalid-feedback">{{$message }}</div>
                    @enderror
                </div> 
                <div class="form-group">
                    <label for="nim">NIM</label>
                    <input type="number" class="form-control @error('nim') is-invalid @enderror" id="nim" name="nim"
                    value="{{$student->nim}}">
                    @error('nim')
                    <div class="invalid-feedback">{{$message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                    value="{{$student->email}}" >
                    @error('email')
                    <div class="invalid-feedback">{{$message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="jurusan">Jurusan</label>
                    <input type="text" class="form-control @error('jurusan') is-invalid @enderror" id="jurusan" name="jurusan"
                    value="{{$student->jurusan}}">
                    @error('jurusan')
                    <div class="invalid-feedback">{{$message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Ubah data</button>
            </form>
            </div>
        </div>
    </div>
    @endsection

