<?php

namespace App\Http\Controllers\Enterprises;

use App\DataTables\Enterprises\EnterpriseDataTable;
use App\Http\Requests\Enterprises;
use App\Http\Requests\Enterprises\CreateEnterpriseRequest;
use App\Http\Requests\Enterprises\UpdateEnterpriseRequest;
use App\Repositories\Enterprises\EnterpriseRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class EnterpriseController extends AppBaseController
{
    /** @var  EnterpriseRepository */
    private $enterpriseRepository;

    public function __construct(EnterpriseRepository $enterpriseRepo)
    {
        $this->enterpriseRepository = $enterpriseRepo;
    }

    /**
     * Display a listing of the Enterprise.
     *
     * @param EnterpriseDataTable $enterpriseDataTable
     * @return Response
     */
    public function index(EnterpriseDataTable $enterpriseDataTable)
    {
        return $enterpriseDataTable->render('enterprises.enterprises.index');
    }

    /**
     * Show the form for creating a new Enterprise.
     *
     * @return Response
     */
    public function create()
    {
        return view('enterprises.enterprises.create');
    }

    /**
     * Store a newly created Enterprise in storage.
     *
     * @param CreateEnterpriseRequest $request
     *
     * @return Response
     */
    public function store(CreateEnterpriseRequest $request)
    {
       $request->validate([                   
            'name'     =>  'required',
            'tel' => 'required',
            'is_active' => 'required'
        ]);

       $input = $request->all();

       $enterprise = $this->enterpriseRepository->create($input);

       Flash::success('Enterprise saved successfully.');

       return redirect(route('enterprises.enterprises.index'));
   }

    /**
     * Display the specified Enterprise.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $enterprise = $this->enterpriseRepository->find($id);

        if (empty($enterprise)) {
            Flash::error('Enterprise not found');

            return redirect(route('enterprises.enterprises.index'));
        }

        return view('enterprises.enterprises.show')->with('enterprise', $enterprise);
    }

    /**
     * Show the form for editing the specified Enterprise.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $enterprise = $this->enterpriseRepository->find($id);

        if (empty($enterprise)) {
            Flash::error('Enterprise not found');

            return redirect(route('enterprises.enterprises.index'));
        }

        return view('enterprises.enterprises.edit')->with('enterprise', $enterprise);
    }

    /**
     * Update the specified Enterprise in storage.
     *
     * @param  int              $id
     * @param UpdateEnterpriseRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEnterpriseRequest $request)
    {
        $enterprise = $this->enterpriseRepository->find($id);

        if (empty($enterprise)) {
            Flash::error('Enterprise not found');

            return redirect(route('enterprises.enterprises.index'));
        }

        $enterprise = $this->enterpriseRepository->update($request->all(), $id);

        Flash::success('Enterprise updated successfully.');

        return redirect(route('enterprises.enterprises.index'));
    }

    /**
     * Remove the specified Enterprise from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /*$enterprise = $this->enterpriseRepository->find($id);

        if (empty($enterprise)) {
            Flash::error('Enterprise not found');

            return redirect(route('enterprises.enterprises.index'));
        }

        $this->enterpriseRepository->delete($id);*/

        Flash::success('No es posible eliminar empresa.');

        return redirect(route('enterprises.enterprises.index'));
    }
}
