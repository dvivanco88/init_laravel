<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreaterolAPIRequest;
use App\Http\Requests\API\UpdaterolAPIRequest;
use App\Models\rol;
use App\Repositories\rolRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class rolController
 * @package App\Http\Controllers\API
 */

class rolAPIController extends AppBaseController
{
    /** @var  rolRepository */
    private $rolRepository;

    public function __construct(rolRepository $rolRepo)
    {
        $this->rolRepository = $rolRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/rols",
     *      summary="Get a listing of the rols.",
     *      tags={"rol"},
     *      description="Get all rols",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/rol")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $rols = $this->rolRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($rols->toArray(), 'Rols retrieved successfully');
    }

    /**
     * @param CreaterolAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/rols",
     *      summary="Store a newly created rol in storage",
     *      tags={"rol"},
     *      description="Store rol",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="rol that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/rol")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/rol"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreaterolAPIRequest $request)
    {
        $input = $request->all();

        $rol = $this->rolRepository->create($input);

        return $this->sendResponse($rol->toArray(), 'Rol saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/rols/{id}",
     *      summary="Display the specified rol",
     *      tags={"rol"},
     *      description="Get rol",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of rol",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/rol"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var rol $rol */
        $rol = $this->rolRepository->find($id);

        if (empty($rol)) {
            return $this->sendError('Rol not found');
        }

        return $this->sendResponse($rol->toArray(), 'Rol retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdaterolAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/rols/{id}",
     *      summary="Update the specified rol in storage",
     *      tags={"rol"},
     *      description="Update rol",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of rol",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="rol that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/rol")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/rol"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdaterolAPIRequest $request)
    {
        $input = $request->all();

        /** @var rol $rol */
        $rol = $this->rolRepository->find($id);

        if (empty($rol)) {
            return $this->sendError('Rol not found');
        }

        $rol = $this->rolRepository->update($input, $id);

        return $this->sendResponse($rol->toArray(), 'rol updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/rols/{id}",
     *      summary="Remove the specified rol from storage",
     *      tags={"rol"},
     *      description="Delete rol",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of rol",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var rol $rol */
        $rol = $this->rolRepository->find($id);

        if (empty($rol)) {
            return $this->sendError('Rol not found');
        }

        $rol->delete();

        return $this->sendResponse($id, 'Rol deleted successfully');
    }
}
