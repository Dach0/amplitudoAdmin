@extends('layouts.app')

@section('content')
<div class="d-flex container vh-100 justify-content-center align-items-center">

    <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div>
                <img src="img/amplitudo_logo.png" alt="">
            </div>
                    <div class="my-2">
                        <input id="name" type="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus placeholder="Korisničko ime">
                      
                        @if ($errors->has('name') || $errors->has('password') )
                        
                            <?php $wrongUserOrPass = 'tacno';?>
                            
                        @else
   
                             <?php $wrongUserOrPass = 'netacno';?>
                            
                        @endif
                    
                        {{-- <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span> --}}
                        

                    </div>
                    
                    <div class="my-2">
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Lozinka">

                    </div>
                    
                    <div class="mt-2 d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Login') }}
                        </button>
                    </div>
                    
                    <div class="d-flex justify-content-center">
                        @if (Route::has('password.request'))
                        <a class="pt-0 btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Zaboravili ste lozinku?') }}
                            </a>
                            @endif
                        </div>
                    </form>
                </div>
  
<div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Obavještenje</h5>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                        Pogrešno ste unijeli korisničko ime ili lozinku! Molimo Vas da pokušate ponovo.
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">U redu</button>
                </div>
            </div>
        </div>
    </div>


    <div class="d-flex justify-content-end">         
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addNewProduct">Dodaj novi produkt</button>         
        </div>    

        <div class="modal fade" id="addNewProduct">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Dodaj novi proizvod</h5>
                      <button class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                      <form>
                         <div class="row">
                             <div class="col-md-6">
                                 
                             </div>
                         </div>
             
             
                      </form>
                    </div>
                    <div class="modal-footer">
                      <button class="btn btn-primary" data-dismiss="modal">Login</button>
                    </div>
                  </div>
                </div>
              </div>
             </div>
             
@endsection
