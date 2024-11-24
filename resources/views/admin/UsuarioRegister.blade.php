@extends('layouts.app')

@section('title','Lista de Usuarios')

@section('content')

<!-- ########################################################################################## -->


<!--  AQUI INICIA LAS OPCIONES ANTERIORESSS        ######################################################################################### -->
     
<a href="{{route('admin.crearusuario')}}" class="mx-2 font-semibold border-2 border-blue py-2 px-8 pt-1 h-10 rounded-md hover:bg-white hover:text-blue-700">Crear</a>
<h1 class="text-3xl text-center font-bold">Lista de Usuarios</h1>




<div class="container-fluid">



    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Datos</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th>Create</th>
                            <th>Update</th>
                            <th>Actions</th>
                        </tr>
                    </thead>



                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th>Create</th>
                            <th>Update</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>

        <!--############################################33#######-->

        @foreach($user as $row)
  
       
        <tr>
                <td class="py-3 px-6">{{$row->id}}</td>
      
                <td class="p-3 text-center">{{$row->name}}</td>
                <td class="p-3 text-center">{{$row->email}}</td>
                <td class="p-3 text-center">{{$row->role}}</td>
                <td class="p-3 text-center">{{$row->created_at}}</td>
                <td class="p-3 text-center">{{$row->updated_at}}</td>
                <td class="p-3">

                     <a href="{{ route('admin.destroyusuario', $row->id )}}" class="btn btn-danger btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-trash"></i>
                        </span>
                        <span class="text">Borrar</span>
                    </a>
                    <a href="{{ route('admin.editusuario', $row->id )}}" class="btn btn-success btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-check"></i>
                        </span>
                        <span class="text">Editar</span>
                    </a>
                   
                
                </td>
              </tr>
      
      @endforeach

          <!--################################3#######-->              
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->







<!-- AQUI TERMINA LAS OPCIONES ANTEIROESSSSSSSSSSSS########################################################################################## -->
@endsection