<?php

namespace App\Http\Controllers;

use App\DataTables\rolDataTable;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\CreaterolRequest;
use App\Http\Requests\UpdaterolRequest;
use App\Repositories\rolRepository;
use App\Permission;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use vendor\laravel\framework\src\Illuminate\Routing;

class rolController extends AppBaseController
{
    /** @var  rolRepository */
    private $rolRepository;

    public function __construct(rolRepository $rolRepo)
    {
        $this->rolRepository = $rolRepo;
    }

    /**
     * Display a listing of the rol.
     *
     * @param rolDataTable $rolDataTable
     * @return Response
     */
    public function index(rolDataTable $rolDataTable)
    {
        return $rolDataTable->render('rols.index');
    }

    /**
     * Show the form for creating a new rol.
     *
     * @return Response
     */
    public function create()
    {
        return view('rols.create');
    }

    /**
     * Store a newly created rol in storage.
     *
     * @param CreaterolRequest $request
     *
     * @return Response
     */
    public function store(CreaterolRequest $request)
    {
        $input = $request->all();

        $rol = $this->rolRepository->create($input);

        Flash::success('Rol saved successfully.');
        
        return redirect(route('rols.show', $rol));
        
    }

    /**
     * Display the specified rol.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $rol = $this->rolRepository->find($id);

        if (empty($rol)) {
            Flash::error('Rol not found');

            return redirect(route('rols.index'));
        }

        return view('rols.show')->with('rol', $rol);
    }

    /**
     * Show the form for editing the specified rol.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $rol = $this->rolRepository->find($id);

        if (empty($rol)) {
            Flash::error('Rol not found');

            return redirect(route('rols.index'));
        }

        return view('rols.edit')->with('rol', $rol);
    }

    /**
     * Update the specified rol in storage.
     *
     * @param  int              $id
     * @param UpdaterolRequest $request
     *
     * @return Response
     */
    public function update($id, UpdaterolRequest $request)
    {
        $rol = $this->rolRepository->find($id);

        if (empty($rol)) {
            Flash::error('Rol not found');

            return redirect(route('rols.index'));
        }

        $rol = $this->rolRepository->update($request->all(), $id);

        Flash::success('Rol updated successfully.');

        return redirect(route('rols.show', $rol));
    }

    /**
     * Remove the specified rol from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /*$rol = $this->rolRepository->find($id);

        if (empty($rol)) {
            Flash::error('Rol not found');

            return redirect(route('rols.index'));
        }

        $this->rolRepository->delete($id);*/

        Flash::error('No es posible borrar Rol.');

        return redirect(route('rols.index'));
    }


    /**
    *Permisos para los usuarios en páginas
    */
    public function permissions($id)
    {
        $rol = $this->rolRepository->find($id);  
        $permissions = Permission::where('rol_id', '=', $id)->orderBy('page')->get();
        
        return view('rols.permissions')->with('rol', $rol)->with('permissions', $permissions);
    }

    public function submitted($id, Request $request)
    {

        $rol = $this->rolRepository->find($id);    
        $check_permission = Permission::where('page', '=', $request['page'])->where('rol_id', '=', $id)->count();

        if($check_permission > 0){
            Flash::warning('Permiso ya ha fue agregado anteriormente al Rol.');
            return redirect(route('rols.permissions', $rol));        
        }else{
            $permission = Permission::create(['page' => $request['page'], 'rol_id' => $id]);
            Flash::success('Permiso agregado a Rol con éxito.');
            return redirect(route('rols.permissions', $rol));        

        }
    }

    public function submitted_delete($id, $permission)
    {
        $rol = $this->rolRepository->find($id);
        $per = Permission::find($permission);

        if(empty($per)){
            Flash::error('No se pudo eliminar Permiso por que no se encontró.');
            return redirect(route('rols.permissions', $rol));        
        }else{
            $per->delete();            
            Flash::warning('Permiso eliminado con éxito.');
            return redirect(route('rols.permissions', $rol));        

        }
    }



}
