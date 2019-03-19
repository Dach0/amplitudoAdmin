<template>
    <div class="container">

     <!-- Add new product modal trigger  -->
    <div class="d-flex justify-content-end">         
        <button class="btn btn-primary" @click="newProductModal">Dodaj novi proizvod</button>         
    </div>    

    <!-- Data table products  -->
    <div class="row mt-2">
        <div class="col-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Proizvodi</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody><tr>
                    <th>Id</th>
                    <th>Naziv proizvoda</th>
                    <th>Datum unosa proizvoda</th>
                    <th class="text-center">Izmijeni</th>
                    <th class="text-center">Deaktiviraj</th>
                    <th class="text-center">Izbriši</th>
                </tr>
                <tr v-for="product in products" :key="product.id">
                  <td> {{ product.id}} </td>
                  <td> {{ product.productName }}</td>
                  <td> {{ product.created_at }} </td>
                  <td class="text-center"> 
                      <a href="#" @click="editProductModal(product)">
                        <i class="fa fa-edit green"></i>
                      </a>
                  </td>
                  <td class="text-center"><span class="label" :class="product.active==0 ? 'label-warning' : 'label-success'"  @click="product.active==0 ? activateProduct(product.id) : deactivateProduct(product.id)"> {{ product.active==0 ? 'Aktiviraj' : 'Deaktiviraj' }} </span></td>
                  <td class="text-center">
                      <a href="#" @click="deleteProduct(product.id)">
                        <i class="fa fa-trash red"></i>
                      </a>
                  </td>
                </tr>
              </tbody></table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>

    <!-- /. Data table products  -->

    
 <div class="modal fade" id="addNewProductModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 v-show="!editmode" class="modal-title">Dodaj novi proizvod</h5>
          <h5 v-show="editmode" class="modal-title">Ažuriranje proizvoda</h5>
          <button class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form @submit.prevent="editmode ? updateProduct() : addNewProduct()">
             
             <div class="row">
                 <div class="col-md-6 form-group">
                     <label for="productName" class="col-form-label">Naziv proizvoda</label>
                     <input v-model="productName" type="text" name="productName"
                        class="form-control">
                          <div class="invalide-feedback text-danger">
                                        {{ errors.get('productName')}}
                                </div>
                         
                 </div>
                 <div class="col-md-6 form-group">
                     <label for="productNameEn" class="col-form-label">Product Name</label>
                     <input v-model="productNameEn" type="text" name="productNameEn"
                        class="form-control">
                    <div class="invalide-feedback text-danger">
                                        {{ errors.get('productNameEn')}}
                                </div> 
                 </div>
             </div>
             
             <div class="row">
                 <div class="col-md-6 form-group">
                     <label for="productDesc" class="col-form-label">Opis proizvoda</label>
                     <textarea v-model="productDesc" name="productDesc"
                        class="form-control" ></textarea>
                    <div class="invalide-feedback text-danger">
                                        {{ errors.get('productDesc')}}
                                </div>
                 </div>
                 <div class="col-md-6 form-group">
                     <label for="productDescEn" class="col-form-label">Product Description</label>
                     <textarea v-model="productDescEn" name="productDescEn"
                        class="form-control"></textarea>
                   <div class="invalide-feedback text-danger">
                                        {{ errors.get('productDescEn')}}
                                </div>
                 </div>
             </div>
             
             <div class="row">
                 <div class="col-md-6 form-group">
                     <label for="introText" class="col-form-label">Uvodni tekst</label>
                     <textarea v-model="introText" name="introText"
                        class="form-control"></textarea>
                    <div class="invalide-feedback text-danger">
                                        {{ errors.get('introText')}}
                                </div>
                 </div>
                 <div class="col-md-6 form-group">
                     <label for="introTextEn" class="col-form-label">Introduction text</label>
                     <textarea v-model="introTextEn" name="introTextEn"
                        class="form-control"></textarea>
                    <div class="invalide-feedback text-danger">
                                        {{ errors.get('introTextEn')}}
                                </div>
                 </div>
             </div>
             
             <div class="row">
                 <div class="col-md-6 form-group">
                     <label for="productText" class="col-form-label">Tekst proizvoda</label>
                     <textarea v-model="productText" name="productText" rows="5"
                        class="form-control"></textarea>
                    <div class="invalide-feedback text-danger">
                                        {{ errors.get('productText')}}
                                </div>
                 </div>
                 <div class="col-md-6 form-group">
                     <label for="productTextEn" class="col-form-label">Product text</label>
                     <textarea v-model="productTextEn" name="productTextEn" rows="5"
                        class="form-control"></textarea>
                    <div class="invalide-feedback text-danger">
                                        {{ errors.get('productTextEn')}}
                                </div>
                 </div>
          
                     <!-- upload fotografija -->
                 <div class="w-100 d-flex justify-content-center">
                     <div class="uploader"
                            @dragenter="OnDragEnter"
                            @dragleave="OnDragLeave"
                            @dragover.prevent
                            @drop="onDrop"
                            :class="{ dragging: isDragging}">

                            <div class="upload-control" v-show="images.length">
                                <label for="imagesFile"><i class="fas fa-plus"></i></label>
                            </div>

                            <div v-show="editmode" class="d-flex mb-3">
                                <div class="img_edit_wrapper" v-for="(imageName, index) in imagesNamesForEdit" :key="index">
                                    <img :src="'/img/productImgs/'+imageName" alt="Cover Image">    
                                 </div>
                             </div>

                        <div v-show="!images.length"> 
                            <i class="fas fa-images fa-upload-image"></i>
                            <p>Prevuci slike ovdje</p>
                            <div>ILI</div>
                            <div class="file-input">
                                <label for="imagesFile" class="uploader-label-input">Izaberi sliku(e)</label>
                                <input class="uploader-label-input" type="file" id="imagesFile" @change="onImagesFileInputChange" multiple>
                            </div>
                                <div class="invalide-feedback text-danger">
                                        {{ errors.get('images')}}
                                </div>
                         </div>

                        
                         <div class="images-preview" v-show="images.length">
                             <div class="img-wrapper" v-for="(image, index) in images" :key="index">
                                 <img :src="image" alt="Image Uploader ${index}">
                                 <div class="details">
                                     <span class="name" v-text="files[index].name"></span>
                                     <span class="size" v-text="files[index].size"></span>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
                     <!-- /. Upload fotografija -->

                 <!-- Upload videa -->
                 <div class="w-50 d-flex justify-content-center mt-2 mx-auto">
                     <div class="uploader"
                        @dragenter="OnDragEnterVideo"
                                @dragleave="OnDragLeaveVideo"
                                @dragover.prevent
                                @drop="onDropVideo"
                                :class="{ dragging: isDraggingVideo}">
                         <i class="fas fa-video fa-upload-image"></i>
                         <p>Prevuci video ovdje</p>
                         <div>ILI</div>
                         <div class="file-input">
                             <label for="videoFile" class="uploader-label-input">Izaberi video</label>
                             <input class="uploader-label-input" type="file" id="videoFile" @change="onVideoFileInputChange">
                         </div>
                     </div> 
                 </div>
                     <!-- /. Upload videa -->
             </div>
 
            <!-- Upload cover fotografije -->
                 <div class="w-100 d-flex justify-content-center fieldset mt-4">
                     <div class="uploader w-75"
                            @dragenter="OnDragEnterCoverImg"
                            @dragleave="OnDragLeaveCoverImg"
                            @dragover.prevent
                            @drop="onDropCoverImg"
                            :class="{ dragging: isDraggingCoverImg}">
                     
                        <legend>Upload <b>cover</b> fotografije</legend>

                            <i v-show="!editmode" class="fas fa-images fa-upload-image"></i>
                            <div v-show="editmode" class="img_edit_wrapper">
                                <img :src="getCoverImage()" alt="Cover Image">    
                             </div>
                            <p>Prevuci sliku ovdje</p>
                            <div>ILI</div>
                            <div class="file-input">
                                <label for="coverImgFile" class="uploader-label-input">Izaberi sliku</label>
                                <input class="uploader-label-input" type="file" id="coverImgFile" @change="onCoverImageInputChange">
                            </div>
                             <div>
                                         <input v-model="coverImgName" class="form-control" type="text" name="coverImgName" 
                                        readonly>
                                        <div class="invalide-feedback text-danger">
                                            {{ errors.get('cover_image')}}
                                        </div>
                            </div>
                     </div>
                 </div>
                     <!-- /. Upload cover fotografija -->
 
            
            <!-- Upload intro fotografije -->
                 <div class="w-100 d-flex justify-content-center fieldset mt-4">
                     <div class="uploader w-75"
                            @dragenter="OnDragEnterIntroImg"
                            @dragleave="OnDragLeaveIntroImg"
                            @dragover.prevent
                            @drop="onDropIntroImg"
                            :class="{ dragging: isDraggingIntroImg}">
                     
                        <legend>Upload <b>intro</b> fotografije</legend>

                            <i v-show="!editmode" class="fas fa-images fa-upload-image"></i>
                            <div v-show="editmode" class="img_edit_wrapper">
                                <img  :src="getIntroImage()" alt="Intro Image">    
                             </div>
                            <p>Prevuci sliku ovdje</p>
                            <div>ILI</div>
                            <div class="file-input">
                                <label for="introImgFile" class="uploader-label-input">Izaberi sliku</label>
                                <input class="uploader-label-input" type="file" id="introImgFile" @change="onIntroImageInputChange">
                            </div>
                             <div>
                                         <input v-model="introImgName" class="form-control" type="text" name="introImgName" 
                                         readonly>
                                         <div class="invalide-feedback text-danger">
                                        {{ errors.get('intro_image')}}
                                </div>
                            </div>
                     </div>
                 </div>
                     <!-- /. Upload intro fotografija -->
 
            
            <div class="row">
                 <div class="col-md-6 form-group">
                     <label for="altTag" class="col-form-label">Alt tag</label>
                     <input type="text" v-model="altTag" name="altTag"
                        class="form-control">
                            <div class="invalide-feedback text-danger">
                                        {{ errors.get('altTag')}}
                                </div>
                 </div>
                 <div class="col-md-6 form-group">
                     <label for="altTagEn" class="col-form-label">Alt tag <small class="text-muted">(en)</small></label>
                     <input type="text" v-model="altTagEn" name="altTagEn"
                        class="form-control">
                        <div class="invalide-feedback text-danger">
                                        {{ errors.get('altTagEn')}}
                        </div>
                 </div>
             </div>

                 <button id="addNewProduct" hidden></button>
          </form>
        </div>
        <div class="modal-footer">
         <button class="btn btn-primary" data-dismiss="modal">Otkaži</button>
         <label v-show="!editmode" for="addNewProduct" class="btn btn-success mb-0">Sačuvaj</label>
         <label v-show="editmode" for="addNewProduct" class="btn btn-success mb-0">Ažuriraj</label>
        </div>
      </div>
    </div>
  </div>

</div>



</template>

<script>

class Errors{

    constructor(){
        this.errors = {};
    }

    get(field){
        if(this.errors[field]){
            return this.errors[field][0];
        }
    }

    record(errors){
        this.errors = errors.errors;
    }
}
    export default {
        data : () => ({
            id : '',
            editmode : false,
            products : {},
            productName : "",
            productNameEn : "",
            productDesc : "",
            productDescEn : "",
            introText : "",
            introTextEn : "",
            productText : "",
            productTextEn : "",
            cover_image: '',
            intro_image: "",
            altTag : "",
            altTagEn : "",
            isDragging: false,
            dragCount: 0,
            isDraggingVideo: false,
            dragCountVideo: 0,
            isDraggingCoverImg: false,
            dragCountCoverImg: 0,
            isDraggingIntroImg: false,
            dragCountIntroImg: 0,
            files: [],
            images: [],
            video: [],
            coverImgName : '',
            introImgName : '',
            imagesNamesForEdit : [],
            errors: new Errors()
        }),
        methods : {
            activateProduct(id){
                 axios.patch("/api/product/"+id+"/update-status", {'active' : 1})
                .then(() => {
                //success
                $('#addNewProductModal').modal('hide');
                  Fire.$emit('DBinsertSuccessful'); 
              })
              .catch(() => {
                console.log('Nesto nije dobrooo');
              });
            },
            deactivateProduct(id){
                axios.patch("/api/product/"+id+"/update-status", {'active' : 0})
                .then(() => {
                //success
                $('#addNewProductModal').modal('hide');
                  Fire.$emit('DBinsertSuccessful'); 
              })
              .catch(() => {
                console.log('Nesto nije dobrooo');
              });
            },
            updateProduct(){

                if(this.cover_image==undefined){
                    this.cover_image='';
                }
                if(this.intro_image==undefined){
                    this.intro_image='';
                }

                axios.patch("/api/product/"+this.id, {
                'productName' : this.productName,
                'productNameEn' : this.productNameEn,
                'productDesc' : this.productDesc,
                'productDescEn' : this.productDescEn,
                'introText' : this.introText,
                'introTextEn' : this.introTextEn,
                'productText' : this.productText,
                'productTextEn' : this.productTextEn,
                'cover_image' : (this.cover_image.length>100)?this.cover_image:this.coverImgName,
                'intro_image' : (this.intro_image.length>100)?this.intro_image:this.introImgName,
                'altTag' : this.altTag,
                'altTagEn' : this.altTagEn,
                'productImagesList' : this.imagesNamesForEdit,
                    })
              .then(() => {
                //success
                $('#addNewProductModal').modal('hide');
                    Swal.fire(
                    'Ažurirano!',
                    'Podaci su uspješno ažurirani!',
                    'success'
                  )
                  Fire.$emit('DBinsertSuccessful'); 
              })
              .catch(() => {
                console.log('Nesto nije dobrooo');
              });
            },
            getCoverImage(){
                let coverImage = (this.cover_image.length > 100) ? this.cover_image : "/img/"+ this.coverImgName; 
                return coverImage;
            },
            getIntroImage(){
                let introImage = (this.intro_image.length > 100) ? this.intro_image : "/img/"+ this.introImgName; 
                return introImage;
            },
            imagesForEdit(productId){
                axios.get('/api/all-product-images?id='+productId)
                    .then((response) => {
                      //console.log(response.data.productImagesForEditMode);
                      response.data.productImagesForEditMode.forEach(element => {
                          this.imagesNamesForEdit.push(element.image_name);
                      });
                      // console.log(this.imagesNamesForEdit);
                       
                    })
            },
            resetModal(){
                this.productName = '';
                this.productNameEn = '';
                this.productDesc = '';
                this.productDescEn = '';
                this.introText = '';
                this.introTextEn = '';
                this.productText = '';
                this.productTextEn = '';
                this.cover_image = '';
                this.intro_image = '';
                this.altTag = '';
                this.altTagEn = '';
                this.images=[];
                this.files=[];
                this.coverImgName = '';
                this.introImgName = '';
                this.imagesNamesForEdit = [];
            },
            editProductModal(product){
                this.editmode = true;
                this.resetModal();
                $('#addNewProductModal').modal('show');
                this.id = product.id;
                this.productName = product.productName;
                this.productNameEn = product.productNameEn;
                this.productDesc = product.productDesc;
                this.productDescEn = product.productDescEn;
                this.introText = product.introText;
                this.introTextEn = product.introTextEn;
                this.productText = product.productText;
                this.productTextEn = product.productTextEn;
                this.altTag = product.altTag;
                this.altTagEn = product.altTagEn;
                this.coverImgName = product.coverImage;
                this.introImgName = product.introImage;
                this.imagesForEdit(product.id);

            },
            newProductModal(){
                this.editmode = false;
                this.resetModal();
                $('#addNewProductModal').modal('show');
            },
            deleteProduct(id){
                      Swal.fire({
                      title: 'Da li ste sigurni?',
                      text: "Nećete moći da vratite obrisane podatke!",
                      type: 'warning',
                      showCancelButton: true,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Da, Obriši!'
                    }).then((result) => {

                      if (result.value) {
                          axios.delete('/api/product/'+id).then(() => {
                              Swal.fire(
                                'Obrisano!',
                                'Podaci su obrisani!',
                                'success'
                              )
                             Fire.$emit('DBinsertSuccessful'); 
                          }).catch(() => {
                            Swal.fire("Neuspješno!", "Nešto je pošlo do đavola", "warning");
                          });
                        }
                    })

            },
            loadProducts(){
                axios.get("/api/product").then(({data}) => (this.products = data.data));
            },
            addNewProduct(){

                const formData = new FormData();
                this.files.forEach(file => {
                    formData.append('images[]', file, file.name);
                });
                formData.append('productName' , this.productName);
                formData.append('productNameEn' , this.productNameEn);
                formData.append('productDesc' , this.productDesc);
                formData.append('productDescEn' , this.productDescEn);
                formData.append('introText' , this.introText); 
                formData.append('introTextEn' , this.introTextEn);
                formData.append('productText' , this.productText);
                formData.append('productTextEn' , this.productTextEn);
                formData.append('cover_image' , this.cover_image);
                formData.append('intro_image' , this.intro_image);
                formData.append('altTag' , this.altTag);
                formData.append('altTagEn' , this.altTagEn);
               
                
                axios.post('/api/product', formData)
                        .then(() => {
                            Swal.fire({
                                    type: 'success',
                                    text: 'Uspješan unos u bazu',
                                    confirmButtonText : 'U redu, hvala'
                                })

                                this.productName = '';
                                this.productNameEn = '';
                                this.productDesc = '';
                                this.productDescEn = '';
                                this.introText = '';
                                this.introTextEn = '';
                                this.productText = '';
                                this.productTextEn = '';
                                this.cover_image = '';
                                this.intro_image = '';
                                this.altTag = '';
                                this.altTagEn = '';
                                this.images=[];
                                this.files=[];
                                this.coverImgName = '';
                                this.introImgName = '';

                                Fire.$emit('DBinsertSuccessful');
                               
                                $('#addNewProductModal').modal('hide');
                                $('body').removeClass('modal-open');
                                $('.modal-backdrop').remove();


                        })
                        .catch((error => this.errors.record(error.response.data)));
               
            //    stari nacin sa dva poziva
            //     this.form.post('/api/product')
            //                 .then((response) => {
            //                     const formData = new FormData();
            //                     this.files.forEach(file => {
            //                         formData.append('images[]', file, file.name);
            //                     });
            //                     formData.append('products_id', response.data);
            //                     axios.post('/images-upload', formData)
            //                     .then(response => {
            //                                 this.images=[];
            //                                 this.files=[];

                                        
            //                     })
            //                     .catch(error => this.errors.record(error.response.data));

            //                     Fire.$emit('DBinsertSuccessful');
            
            //                 //   $('#addUserModal').modal('hide');
            //                 //   $('body').removeClass('modal-open');
            //                 //   $('.modal-backdrop').remove();
                            
            //                 Swal.fire({
            //                         type: 'success',
            //                         text: 'Uspješan unos u bazu',
            //                         confirmButtonText : 'U redu, hvala'
            //                     })
            //                 })
            //                 .catch(() => {
                            
            //                 })

            },
            OnDragEnter(e){
                e.preventDefault();
                this.dragCount++;
                this.isDragging = true;
            },
            OnDragLeave(e){
                e.preventDefault();
                this.dragCount--;
                if (this.dragCount <= 0){
                    this.isDragging = false;
                }
            },
            OnDragEnterVideo(e){
                e.preventDefault();
                this.dragCountVideo++;
                this.isDraggingVideo = true;
            },
            OnDragLeaveVideo(e){
                e.preventDefault();
                this.dragCountVideo--;
                if (this.dragCountVideo <= 0){
                    this.isDraggingVideo = false;
                }
            },
            OnDragEnterCoverImg(e){
                e.preventDefault();
                this.dragCountCoverImg++;
                this.isDraggingCoverImg = true;
            },
            OnDragLeaveCoverImg(e){
                e.preventDefault();
                this.dragCountCoverImg--;
                if (this.dragCountCoverImg <= 0){
                    this.isDraggingCoverImg = false;
                }
            },
            OnDragEnterIntroImg(e){
                e.preventDefault();
                this.dragCountIntroImg++;
                this.isDraggingIntroImg = true;
            },
            OnDragLeaveIntroImg(e){
                e.preventDefault();
                this.dragCountIntroImg--;
                if (this.dragCountIntroImg <= 0){
                    this.isDraggingIntroImg = false;
                }
            },
            onImagesFileInputChange(e){
                 const files = e.target.files;
                 Array.from(files).forEach(file => this.addImage(file));
            },
            onVideoFileInputChange(){
                console.log('Idemo, video za upload');
            },
            onCoverImageInputChange(e){
                let file = e.target.files[0];
                this.coverImgName = file.name;
                let reader = new FileReader();
                reader.onloadend = () => {
                this.cover_image = reader.result;}
                reader.readAsDataURL(file);
            },
            onIntroImageInputChange(e){
                let file = e.target.files[0];
                this.introImgName = file.name;
                let reader = new FileReader();
                reader.onloadend = () => {
                this.intro_image = reader.result;}
                reader.readAsDataURL(file);
            },
            onDrop(e){
                e.preventDefault();
                e.stopPropagation();
                this.isDragging = false;
                const files = e.dataTransfer.files;
                Array.from(files).forEach(file => this.addImage(file));
            },
            onDropVideo(e){
                e.preventDefault();
                e.stopPropagation();
                this.isDraggingVideo = false;
                const files = e.dataTransfer.files;
                console.log("Drag za video radi");
               // Array.from(files).forEach(file => this.addImage(file));
            },
            onDropCoverImg(e){
                e.preventDefault();
                e.stopPropagation();
                this.isDraggingCoverImg = false;
                let file = e.dataTransfer.files[0];
                this.coverImgName = file.name;
                let reader = new FileReader();

                reader.onloadend = () => {
                this.cover_image = reader.result;}
                reader.readAsDataURL(file);
            },
            onDropIntroImg(e){
                e.preventDefault();
                e.stopPropagation();
                this.isDraggingIntroImg = false;
                let file = e.dataTransfer.files[0];
                this.introImgName = file.name;
                let reader = new FileReader();

                reader.onloadend = () => {
                this.intro_image = reader.result;}
                reader.readAsDataURL(file);
            },
            addImage(file){
                if(!file.type.match('image.*')){
                    console.log('${file:name} is not an image');
                    return
                }

                this.files.push(file);

                const img = new Image(),
                     reader = new FileReader();

                reader.onload = (e) => this.images.push(e.target.result);

                reader.readAsDataURL(file);
            }
        },
        mounted() {
            this.loadProducts();
            Fire.$on('DBinsertSuccessful', () => {
            this.loadProducts();
            });
        }
    }
</script>
