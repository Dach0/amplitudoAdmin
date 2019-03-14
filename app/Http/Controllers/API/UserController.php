<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // return User::latest()->paginate(10);

        return User::orderBy('created_at','desc')->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'username' => 'required|max:191',
            'first_name' => 'required|max:191',
            'last_name' => 'required|max:191',
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required'
        ]);

        return User::create([
          //  'user_image' => $request['user_image'],
            'username' => $request['username'],
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'role' => $request['role']
        ]);
    }

    //ovaj ce nam izabrati autentifikovanog usera i njega cemo updatovati
    public function updateProfile(Request $request)
    {
        $user = auth('api')->user();

        $this->validate($request,[
            'username' => 'required|max:191',
            'first_name' => 'required|max:191',
            'last_name' => 'required|max:191',
            'email' => 'required|string|email|max:191|unique:users,email,'.$user->id,
            'password' => 'sometimes|string|min:6',
            'role' => 'required'
        ]);
        
        $currentImage = $user->user_image;

        if($request->user_image != $currentImage){

            $name = time().'.' . explode('/', explode(':', substr($request->user_image, 0, strpos($request->user_image,';')))[1])[1];

            \Image::make($request->user_image)->save(public_path('img/profile/').$name);
            
            $request->merge(['user_image' => $name]);

            //find old photo
            $userImage = public_path('img/profile/').$currentImage;
            if (file_exists($userImage)) {
                @unlink($userImage);
            }
        }

        if(!empty($request->password)){
            $request->merge(['password' => Hash::make($request['password'])]);
        }

        $user->update($request->all());
        return ['message' => "Aj sa srecom je updatovan"];

    }

    //ovaj ce nam vratiti podatke za autentifikovanog usera
    public function profile()
    {
        return auth('api')->user();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $this->validate($request,[
            'username' => 'required|max:191',
            'first_name' => 'required|max:191',
            'last_name' => 'required|max:191',
            'email' => 'required|string|email|max:191|unique:users,email,'.$user->id,
            'password' => 'sometimes|string|min:6',
            'role' => 'required'
        ]);

        $user->update($request->all());

        return ['message' => 'Updated user info'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $this->authorize('isAdmin');

        $user = User::findOrFail($id);
        $user->delete();
        return ['message' => 'Korisnik je obrisan'];
    }
}
