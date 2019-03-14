<template>
    <div class="container">
        <div class="row justify-content-center">
            <!-- USER CARD -->
            <div class="col-md-12 mt-3">
            <!-- Widget: user widget style 1 -->
            <div class="box box-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-black" style="background: url('/img/user-cover.jpg') center center; height: 200px; 	background-size: cover ; ">
                <h3 class="widget-user-username">{{ form.first_name + ' ' + form.last_name}}</h3>
                <h5 class="widget-user-desc">{{ form.role }}</h5>
                </div>
                <div class="widget-user-image">
                <img class="img-circle" :src="getProfilePhoto()" alt="User Avatar">
                </div>
                <div class="box-footer p-0">
                <div class="row">
                    <div class="col-sm-4 border-right">
                    <div class="description-block">
                        <h5 class="description-header">3,200</h5>
                        <span class="description-text">SALES</span>
                    </div>
                    <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 border-right">
                    <div class="description-block">
                        <h5 class="description-header">13,000</h5>
                        <span class="description-text">FOLLOWERS</span>
                    </div>
                    <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4">
                    <div class="description-block">
                        <h5 class="description-header">35</h5>
                        <span class="description-text">PRODUCTS</span>
                    </div>
                    <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
                </div>
            </div>
                </div>
            </div>
        <!-- USER CARD -->

    <!-- USER INFO -->

        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active p-2"><a href="#activity" data-toggle="tab" aria-expanded="true">Activity</a></li>
              <li class="p-2"><a href="#settings" data-toggle="tab" aria-expanded="false">Settings</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="activity">
               
                <h3 class="p-2">Eventualno neke aktivnosti da se kasnije dodaju</h3>
              
              </div>

              <div class="tab-pane" id="settings">
                <form class="form-horizontal">
                 
                 
                  <div class="form-group">
                    <label for="inputUsername" class="col-sm-2 control-label">Korisničko ime</label>

                    <div class="col-sm-10">
                      <input v-model="form.username" type="text" class="form-control" id="inputUsername" placeholder="Korisničko ime" :class="{ 'is-invalid': form.errors.has('username') }">
                      <has-error :form="form" field="username"></has-error>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="inputFirstName" class="col-sm-2 control-label">Ime</label>

                    <div class="col-sm-10">
                      <input v-model="form.first_name" type="text" class="form-control" id="inputFirstName" placeholder="Ime" :class="{ 'is-invalid': form.errors.has('first_name') }">
                      <has-error :form="form" field="first_name"></has-error>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="inputLastName" class="col-sm-2 control-label">Prezime</label>

                    <div class="col-sm-10">
                      <input v-model="form.last_name" type="text" class="form-control" id="inputLastName" placeholder="Prezime" :class="{ 'is-invalid': form.errors.has('last_name') }">
                      <has-error :form="form" field="last_name"></has-error>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                      <input v-model="form.email" type="email" class="form-control" id="inputEmail" placeholder="Email" :class="{ 'is-invalid': form.errors.has('email') }">
                      <has-error :form="form" field="email"></has-error>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="inputUserImage" class="col-sm-2 control-label">Profilna slika</label>
                    <div class="col-sm-10">
                      <input  type="file" @change="updateProfilePhoto" class="form-control" id="inputUserImage" name="photo">
                    </div>
                  </div>

                 <div class="form-group">
                    <label for="inputPassword" class="col-sm-2 control-label">Lozinka</label>
                    <div class="col-sm-10">
                      <input v-model="form.password" type="password" class="form-control" id="inputPassword" placeholder="Nova lozinka" :class="{ 'is-invalid': form.errors.has('password') }">
                      <has-error :form="form" field="password"></has-error>
                    </div>
                    <small class="pl-3">(Ostaviti prazno ako ne mijenjate lozinku)</small>
                  </div>
                 
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button @click.prevent="updateInfo" type="submit" class="btn btn-success">Ažuriraj</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>

    </div>
</template>

<script>
    export default {
        data(){
            return {
                form: new Form({
                    id : '',
                    user_image : '',
                    username : '',
                    first_name : '',
                    last_name : '',
                    email : '',
                    password : '',
                    role : ''
                })
            }
        },
        mounted() {
            console.log('Component mounted.');
        },

        methods: {
          getProfilePhoto(){
            
            let user_image = (this.form.user_image.length > 100) ? this.form.user_image : "/img/profile/"+ this.form.user_image;
            
            return user_image;
          },

          updateInfo(){
            if(this.form.password == ""){
                this.form.password = undefined;
            }
            this.form.put('/api/profile')
            .then(() =>{
              Swal.fire(
                    'Bravo!',
                    'Uspješno si uploadovao svoje podatke',
                    'success'
                  )
            })
            .catch(() =>{
              
            })
          },

          updateProfilePhoto(e){
            let file = e.target.files[0];
            let reader = new FileReader();

            if(file['size'] < 2111775){
              reader.onloadend = () => {
                this.form.user_image = reader.result;
              }
              reader.readAsDataURL(file);
            }else{
               Swal.fire(
                    'Eheej!',
                    'Fajl ne može biti veći od 2MB!',
                    'error'
                  )
            }
            }
        },

        created() {
            axios.get('/api/profile')
            .then( ({data}) => this.form.fill(data))
        }
    }
</script>
