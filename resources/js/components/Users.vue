<template>
    <div class="container">
        <div class="row">
        <div class="col-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Tabela korisnika</h3>

              <div class="box-tools">
                <div class="input-group input-group-sm">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">
                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addUserModal">Dodaj korisnika</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody><tr>
                  <th>ID</th>
                  <th>Korisničko ime</th>
                  <th>Slika</th>
                  <th>Ime</th>
                  <th>Prezime</th>
                  <th>E-mail</th>
                  <th>Uloga</th>
                  <th>Modifikuj</th>
                </tr>
                <tr>
                  <td>183</td>
                  <td>Johndoe</td>
                  <td><img src="" alt=""></td>
                  <td>John</td>
                  <td>Doe</td>
                  <td>Doe@jd.jd</td>
                  <td><span class="label label-success">Admin</span></td>
                  <td>
                      <a href="">
                          <i class="fa fa-edit"></i>
                      </a>
                      /
                      <a href="">
                          <i class="fa fa-trash"></i>
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

<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addUserModalLabel">Novi korisnik</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

        <form @submit.prevent="createUser">
            <div class="modal-body">
                <div class="form-group">
                    <!-- pogledati kako za image -->
                    <input type="file" name="user_image"
                        class="form-control">
                </div>

                <div class="form-group">
                    <input v-model="form.username" type="text" name="username" placeholder="Korisničko ime"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('username') }">
                    <has-error :form="form" field="username"></has-error>
                </div>

        <div class="form-group">
            <input v-model="form.first_name" type="text" name="first_name" placeholder="Ime"
                class="form-control" :class="{ 'is-invalid': form.errors.has('first_name') }">
            <has-error :form="form" field="first_name"></has-error>
        </div>

        <div class="form-group">
            <input v-model="form.last_name" type="text" name="last_name" placeholder="Prezime"
                class="form-control" :class="{ 'is-invalid': form.errors.has('last_name') }">
            <has-error :form="form" field="last_name"></has-error>
        </div>

        <div class="form-group">
            <input v-model="form.email" type="text" name="email"
                placeholder="email"
                class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
            <has-error :form="form" field="email"></has-error>
        </div>

        <div class="form-group">
            <input v-model="form.password" type="password" name="password" placeholder="Lozinka"
                class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
            <has-error :form="form" field="password"></has-error>
        </div>
       
        <div class="form-group">
            <select v-model="form.role" type="text" name="role"
                class="form-control" :class="{ 'is-invalid': form.errors.has('role') }">
                <option value="">Izaberi ulogu</option>
                <option value="admin">Administrator</option>
                <option value="user">Standardni korisnik</option>
                <option value="autor">Autor</option>
            </select>
            <has-error :form="form" field="password"></has-error>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Odustani</button>
        <button type="submit" class="btn btn-primary">Sačuvaj</button>
      </div>

      </form>
    </div>
  </div>
</div>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                form: new Form({
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
        methods:{
            createUser(){
                this.form.post('/api/user');
            }
        },

        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
