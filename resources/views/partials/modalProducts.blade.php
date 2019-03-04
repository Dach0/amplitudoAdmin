
 <div class="modal fade" id="addNewProductModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Dodaj novi proizvod</h5>
          <button class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form method="POST" action="/admin/products" enctype="multipart/form-data">
             @csrf
             <div class="row">
                 <div class="col-md-6 form-group">
                     <label for="productName" class="col-form-label">Naziv proizvoda</label>
                     <input type="text" class="form-control-sm" name="productName" id="productName">          
                 </div>
                 <div class="col-md-6 form-group">
                     <label for="productNameEn" class="col-form-label">Product name</label>
                     <input type="text" class="form-control-sm" name="productNameEn" id="productNameEn">          
                 </div>
             </div>
             
             <div class="row">
                 <div class="col-md-6 form-group">
                     <label for="product-desc" class="col-form-label">Opis proizvoda</label>
                     <textarea class="form-control" id="product-desc" name="product-desc"></textarea>
                 </div>
                 <div class="col-md-6 form-group">
                     <label for="product-descEn" class="col-form-label">Product description</label>
                     <textarea class="form-control" id="product-descEn" name="product-descEn"></textarea>
                 </div>
             </div>
 
             <div class="row">
                 <div class="col-md-6 form-group">
                     <label for="intro-text" class="col-form-label">Uvodni tekst</label>
                     <textarea class="form-control" id="intro-text" name="intro-text"></textarea>
                 </div>
                 <div class="col-md-6 form-group">
                     <label for="intro-textEn" class="col-form-label">Introduction text</label>
                     <textarea class="form-control" id="intro-textEn" name="intro-textEn"></textarea>
                 </div>
             </div>
 
             <div class="row">
                 <div class="col-md-6 form-group">
                     <label for="product-text" class="col-form-label">Tekst proizvoda</label>
                     <textarea class="form-control" id="product-text" name="product-text" rows="5"></textarea>
                 </div>
                 <div class="col-md-6 form-group">
                     <label for="product-textEn" class="col-form-label">Product text</label>
                     <textarea class="form-control" id="product-textEn" name="product-textEn" rows="5"></textarea>
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
                             <legend>Upload <b>cover</b> fotografije</legend>
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
                             <legend>Upload <b>intro</b> fotografije</legend>
                             
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
                 <button id="addNewProd-form" type="submit" hidden></button>
          </form>
        </div>
        <div class="modal-footer">
         <button class="btn btn-primary" data-dismiss="modal">Otkaži</button>
         <label for="addNewProd-form" class="btn btn-success mb-0">Sačuvaj</label>
        </div>
      </div>
    </div>
  </div>
