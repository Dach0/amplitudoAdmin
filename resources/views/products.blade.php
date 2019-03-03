@extends('adminlte::page')

@section('title', 'Produkti')

@section('content_header')

    <h1>Naši proizvodi</h1>
@stop

@section('content')


<div class="container">
    {{-- Add new product modal trigger --}}
    <div class="d-flex justify-content-end">         
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addNewProduct">Dodaj novi produkt</button>         
    </div>    

    {{-- Data table products --}}
    <table class="table table-dark table-bordered table-hover mt-3">
            
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Naziv proizvoda</th>
                            <th>Datium unosa proizvoda</th>
                            <th>Izmijeni</th>
                            <th>Deaktiviraj</th>
                            <th>Izbriši</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
                
</div>


{{-- Add new produt modal --}}

 <div class="modal fade" id="addNewProduct">
   <div class="modal-dialog modal-xl">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title">Dodaj novi proizvod</h5>
         <button class="close" data-dismiss="modal">&times;</button>
       </div>
       <div class="modal-body">
         <form>
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="productName" class="col-form-label">Naziv proizvoda</label>
                    <input type="text" class="form-control-sm" name="productName" id="productName">          
                </div>
                <div class="col-md-6 form-group">
                    <label for="productName" class="col-form-label">Product name</label>
                    <input type="text" class="form-control-sm" name="productName" id="productNameEn">          
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="product-desc" class="col-form-label">Opis proizvoda</label>
                    <textarea class="form-control" id="product-desc"></textarea>
                </div>
                <div class="col-md-6 form-group">
                    <label for="product-desc" class="col-form-label">Product description</label>
                    <textarea class="form-control" id="product-desc"></textarea>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="product-desc" class="col-form-label">Uvodni tekst</label>
                    <textarea class="form-control" id="product-desc"></textarea>
                </div>
                <div class="col-md-6 form-group">
                    <label for="product-desc" class="col-form-label">Introduction text</label>
                    <textarea class="form-control" id="product-desc"></textarea>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="product-desc" class="col-form-label">Tekst proizvoda</label>
                    <textarea class="form-control" id="product-desc" rows="5"></textarea>
                </div>
                <div class="col-md-6 form-group">
                    <label for="product-desc" class="col-form-label">Product text</label>
                    <textarea class="form-control" id="product-desc" rows="5"></textarea>
                </div>
                <div class="w-100 d-flex justify-content-center">
                    <div>
                        <p>Select <b>images:</b></p> <input class="no-border" type="file" name="img" multiple>
                    </div>
                    <div>
                        <p>Select <b>video:</b></p> <input class="no-border" type="file" name="video">
                    </div>
                </div>
            </div>

         </form>
       </div>
       <div class="modal-footer">
         <button class="btn btn-primary" data-dismiss="modal">Sačuvaj</button>
       </div>
     </div>
   </div>
 </div>
</div>


@stop

@section('css')
    <link rel="stylesheet" href="/css/custom_damjan.css">
@stop
