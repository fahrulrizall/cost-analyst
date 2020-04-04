    @extends('layout.main')
    @section('title','Students List')
    @section('container')
    <div class="container">
        <div class="row">
            <div class="col-4">
             <h1 class="mt-2" >Daftar Students </h1>
             @if (session('status'))
             <div class="alert alert-success">
                 {{session('status')}}
             </div>
             @endif
             <a href="/students/create" class="btn btn-primary my-3">Tambah</a>
             <ul class="list-group">
                @foreach ($students as $students)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{$students->nama}}
                    <a href="/students/{{$students->id}}" class="badge badge-info" >Detail</a>
                </li>
                @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endsection

