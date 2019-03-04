@extends('adminlte::page')

@section('title', 'Produkti')

@section('content_header')

    <h1>Naši proizvodi</h1>
@stop

@section('content')


<div class="container">
    {{-- Add new product modal trigger --}}
    <div class="d-flex justify-content-end">         
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addNewProductModal">Dodaj novi produkt</button>         
    </div>    

    {{-- Data table products --}}
    <table class="table table-dark table-bordered table-hover mt-3">
            
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Naziv proizvoda</th>
                            <th>Datum unosa proizvoda</th>
                            <th class="bg-success">Izmijeni</th>
                            <th class="bg-warning">Deaktiviraj</th>
                            <th class="bg-danger">Izbriši</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
                
</div>


{{-- Add new produt modal --}}

@include('partials/modalProducts')


@stop

@section('css')
    <link rel="stylesheet" href="/css/custom_damjan.css">
@stop

@section('js')
    <script src="/js/custom_js_damjan.js"></script>
@stop
