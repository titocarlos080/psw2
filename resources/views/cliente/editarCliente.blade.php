@extends('layouts.app')

@section('title','Editar Cliente')

@section('content')
<nav class="bg-blue-500 py-6">
    <a href="{{route('admin.listarcliente')}}" class="text-white mx-16 font-semibold border-2 border-white py-3 px-5 pt-1 h-10 rounded-md hover:bg-white hover:text-blue-700">Atras</a>
</nav>

<div class="block mx-auto my-12 p-8 bg-white w-1/3 borderr border-gray-200 rounded-lg shadow-lg">
<h1 class="text-3xl text-center font-bold">Editar Cliente {{$user->name}}</h1>

<form action="{{route('admin.updateclientes',$user->id)}}" method="POST" >
    @csrf

    <h1 class="h3 mb-0 text-gray-800">CI</h1>
    <input type="text" class="border border-gray-200 rounded-md bg-gray-200 w-full text-lg placeholder-gray-900 p-2 my-2 focus:bg-white" placeholder="ci" id="ci" name="ci" value="{{$user->ci}}">

    <h1 class="h3 mb-0 text-gray-800">Nombre</h1>
    <input type="text" class="border border-gray-200 rounded-md bg-gray-200 w-full text-lg placeholder-gray-900 p-2 my-2 focus:bg-white" placeholder="nombre" id="nombre" name="nombre" value="{{$user->nombre}}">

 
    <h1 class="h3 mb-0 text-gray-800">A Paterno</h1>
    <input type="text" class="border border-gray-200 rounded-md bg-gray-200 w-full text-lg placeholder-gray-900 p-2 my-2 focus:bg-white" placeholder="a_paterno" id="a_paterno" name="a_paterno" value="{{$user->a_paterno}}">

 
    <h1 class="h3 mb-0 text-gray-800">A Materno</h1>
    <input type="text" class="border border-gray-200 rounded-md bg-gray-200 w-full text-lg placeholder-gray-900 p-2 my-2 focus:bg-white" placeholder="a_materno" id="a_materno" name="a_materno" value="{{$user->a_materno}}">

    <h1 class="h3 mb-0 text-gray-800">Sexo</h1>
    <input type="text" class="border border-gray-200 rounded-md bg-gray-200 w-full text-lg placeholder-gray-900 p-2 my-2 focus:bg-white" placeholder="sexo" id="sexo" name="sexo" value="{{$user->sexo}}">

  
    <h1 class="h3 mb-0 text-gray-800">Telefono</h1>
    <input type="text" class="border border-gray-200 rounded-md bg-gray-200 w-full text-lg placeholder-gray-900 p-2 my-2 focus:bg-white" placeholder="telefono" id="telefono" name="telefono" value="{{$user->telefono}}">


    <h1 class="h3 mb-0 text-gray-800">Direccion</h1>
    <input type="text" class="border border-gray-200 rounded-md bg-gray-200 w-full text-lg placeholder-gray-900 p-2 my-2 focus:bg-white" placeholder="direccion" id="direccion" name="direccion" value="{{$user->direccion}}">

    <h1 class="h3 mb-0 text-gray-800">Estado  h  o  d </h1>
    <input type="text" class="border border-gray-200 rounded-md bg-gray-200 w-full text-lg placeholder-gray-900 p-2 my-2 focus:bg-white" placeholder="estado h o d" id="estado" name="estado" value="{{$user->estado}}">

 
    <button type="sudmit" class="rounded-md bg-blue-500 w-full text-lg text-white font-semibold p-2 my-3 hover:bg-blue-600">Editar</button>

</form>





</div>
@endsection