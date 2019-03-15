@extends('adminlte::page')

@section('title', 'Korisnički profil')

@section('content_header')

    <h1>Svi korisnici</h1>
@stop

@section('content')

<div id="app">

    <div class="container">
        <div class="col-3 pl-0 mb-2">
            <div class="input-group">
                <input v-model='search' @keyup.enter='searchit' type="text" name="q" class="form-control" placeholder="Search..." id="search-input">
                <span class="input-group-btn">
                    <button @click='searchit' name="search" id="search-btn" class="btn btn-flat">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </div>
    </div>
    <!-- component will render here -->
   <users-component></users-component>
   
</div>

@stop

