@extends('adminlte::page')

@section('title', 'Korisnički profil')

@section('content_header')

    <h1>Svi korisnici</h1>
@stop

@section('content')

<div id="app">

    <!-- component matched by the route will render here -->
   <users-component></users-component>
   
</div>

@stop

