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
   <div class="modal-dialog modal-lg">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title">Dodaj novi proizvod</h5>
         <button class="close" data-dismiss="modal">&times;</button>
       </div>
       <div class="modal-body">
         <form enctype="multipart/form-data">
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
                        <p class="mb-1">Select <b>images:</b></p> <input class="no-border" type="file" name="img" multiple>
                    </div>
                    <div>
                        <p class="mb-1">Select <b>video:</b></p> <input class="no-border" type="file" name="video">
                    </div>
                </div>
            </div>

            <div class="row mt-4 px-3">
                    <fieldset class="col">
                            <legend>Upload cover fotografije</legend>
                            
                            <input type="hidden" id="MAX_FILE_SIZE" name="MAX_FILE_SIZE" value="300000" />
                            
                            <div>
                                <div class="row">
                                    <div class="col-lg-9">
                                        <input id="filename" class="form-control" type="text" readonly>
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="fileselect" class="btn btn-primary">Upload</label>
                                    </div>
                                </div>
                                <input type="file" id="fileselect" name="fileselect" hidden/>

                                <div id="filedrag">ili prevuci sliku / or drop file here</div>
                            </div> 
                            {{-- <div id="submitbutton">
                                <button type="submit">Upload Files</button>
                            </div> --}}
                     </fieldset>
            </div>

            <div class="row mt-4 px-3">
                    <fieldset class="col">
                            <legend>Upload intro fotografije</legend>
                            
                            <div>
                                <div class="row">
                                    <div class="col-lg-9">
                                        <input id="filename_intro" class="form-control" type="text" readonly>
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="fileselect_intro" class="btn btn-primary">Upload</label>
                                    </div>
                                </div>
                                <input type="file" id="fileselect_intro" name="fileselect_intro" hidden/>

                                <div id="filedrag_intro">ili prevuci sliku / or drop file here</div>
                            </div> 
                            {{-- <div id="submitbutton">
                                <button type="submit">Upload Files</button>
                            </div> --}}
                     </fieldset>
            </div>

            <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="altTag" class="col-form-label">Alt tag</label>
                        <input type="text" class="form-control-sm" name="altTag" id="altTag">          
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="altTagEn" class="col-form-label">Alt tag <small class="text-muted">(en)</small></label>
                        <input type="text" class="form-control-sm" name="altTagEn" id="altTagEn">          
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

@section('js')
    <script src="/js/custom_js_damjan.js"></script>
@stop
