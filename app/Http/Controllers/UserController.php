<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\Permission;
use App\Models\Enterprises\Enterprise;
use App\Models\rol;
use Yajra\Datatables\Datatables;
use App\DataTables\UsersDataTable;
use Flash;
use Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('users.index');
    }

     /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
     
     /*public function anyData()
     {
        return Datatables::of(User::query())->make(true);
    }*/

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view('auth.register');
       $enterprises = Enterprise::where('is_active', '=', true)->orderBy('name');
       if(Auth::user()->rol->name == "Admin"){
        $rols = rol::where('is_active', '=', true)->orderBy('name');
    }else{
        $rols = rol::where('is_active', '=', true)->where('name', '<>', 'Admin')->orderBy('name');
    }


    return view('users.create')->with('enterprises',$enterprises)->with('rols',$rols);
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     $request->validate([
        'name'    =>  'required',
        'email'     =>  'required',
        'rol_id'     =>  'required',
        'password'     =>  'required|min:6',                
    ]);

     $user = User::create([
        'name' => $request['name'],
        'email' => $request['email'],
        'is_active' => $request['is_active'],        
        'password' => Hash::make($request['password']),
        'rol_id' => $request['rol_id']
    ]);

     if (is_null($request['image'])) {                
     }else{         
        $image_name = $request->hidden_image;
        $image = $request->file('image');                                                       
        $image_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads/users/'.$id), $image_name);

        $user->update($request->except(['password'])); 
        $user->image = $image_name;
    }


    $user->save();


    Flash::success('Usuario creado correctamente.');

    return redirect(route('users.show', $user->id));
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user =  User::where('users.id', '=', $id)->leftJoin('enterprises', 'users.enterprise_id', '=', 'enterprises.id')
        ->leftJoin('rols', 'users.rol_id', '=', 'rols.id')
        ->select('users.*', 'enterprises.name as enterprise_name', 'enterprises.tel', 'enterprises.ext_tel', 'enterprises.contact_name',
           'email_contact', 'enterprises.id as enterprise_id', 'rols.name as rol_name')->first();        

        if (empty($id)) {
            Flash::error('Usuario no encontrado');

            return redirect(route('users.index'));
        }

        return view('users.show')->with('user', $user);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        $enterprises = Enterprise::where('is_active', '=', true)->orderBy('name');        
        if(Auth::user()->rol->name == "Admin"){
            $rols = rol::where('is_active', '=', true)->orderBy('name');
        }else{
            $rols = rol::where('is_active', '=', true)->where('name', '<>', 'Admin')->orderBy('name');
        }

        if (empty($id)) {
            Flash::error('Usuario no encontrado');

            return redirect(route('users.index'));
        }

        return view('users.edit')->with('user', $user)->with('enterprises',$enterprises)->with('rols',$rols);
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


        $user = User::find($id);

        if (empty($user)) {
            Flash::error('Usuario no encontrado');
            return redirect(route('users.index'));
        }

        if (is_null($request["password"])){

            if (is_null($request['image'])) {
                $user->update($request->except(['password', 'image']));
            }else{         
                $image_name = $request->hidden_image;
                $image = $request->file('image');                                       
                //$image_name = $image->getClientOriginalName();
                $image_name = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/users/'.$id), $image_name);

                $user->update($request->except(['password'])); 
                $user->image = $image_name;
            }
        } else{     

            if(strlen($request['password']) < 6){
                $request->validate([                   
                    'password'     =>  'required|min:6'                
                ]);
            }   

            if (is_null($request['image'])) {
                $user->update($request->except(['password', 'image']));
            }else{            
                $image_name = $request->hidden_image;
                //$image = $request->file('image');                    
                $image_name = rand() . '.' . $image->getClientOriginalExtension();
                $image_name = $image->getClientOriginalName();
                $image->move(public_path('uploads/users/'.$id), $image_name);

                $user->update($request->except(['password']));        
                $user->image = $image_name;
            }         

            $password = Hash::make($request['password']);
            $user->password = $password;
        }
        
        $user->save();
        

        Flash::success('Usuario actualizado correctamente.');

        return redirect(route('users.show', $user->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Flash::success('No es posible eliminar empresa.');

        return redirect(route('users.index'));
    }




    
}
