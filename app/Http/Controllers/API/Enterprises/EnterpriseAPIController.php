<?php

namespace App\Http\Controllers\API\Enterprises;

use App\Http\Requests\API\Enterprises\CreateEnterpriseAPIRequest;
use App\Http\Requests\API\Enterprises\UpdateEnterpriseAPIRequest;
use App\Models\Enterprises\Enterprise;
use App\Repositories\Enterprises\EnterpriseRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class EnterpriseController
 * @package App\Http\Controllers\API\Enterprises
 */

class EnterpriseAPIController extends AppBaseController
{
    /** @var  EnterpriseRepository */
    private $enterpriseRepository;

    public function __construct(EnterpriseRepository $enterpriseRepo)
    {
        $this->enterpriseRepository = $enterpriseRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/enterprises",
     *      summary="Get a listing of the Enterprises.",
     *      tags={"Enterprise"},
     *      description="Get all Enterprises",
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
     *                  @SWG\Items(ref="#/definitions/Enterprise")
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
        $enterprises = $this->enterpriseRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($enterprises->toArray(), 'Enterprises retrieved successfully');
    }

    /**
     * @param CreateEnterpriseAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/enterprises",
     *      summary="Store a newly created Enterprise in storage",
     *      tags={"Enterprise"},
     *      description="Store Enterprise",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Enterprise that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Enterprise")
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
     *                  ref="#/definitions/Enterprise"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateEnterpriseAPIRequest $request)
    {
        $input = $request->all();

        $enterprise = $this->enterpriseRepository->create($input);

        return $this->sendResponse($enterprise->toArray(), 'Enterprise saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/enterprises/{id}",
     *      summary="Display the specified Enterprise",
     *      tags={"Enterprise"},
     *      description="Get Enterprise",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Enterprise",
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
     *                  ref="#/definitions/Enterprise"
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
        /** @var Enterprise $enterprise */
        $enterprise = $this->enterpriseRepository->find($id);

        if (empty($enterprise)) {
            return $this->sendError('Enterprise not found');
        }

        return $this->sendResponse($enterprise->toArray(), 'Enterprise retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateEnterpriseAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/enterprises/{id}",
     *      summary="Update the specified Enterprise in storage",
     *      tags={"Enterprise"},
     *      description="Update Enterprise",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Enterprise",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Enterprise that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Enterprise")
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
     *                  ref="#/definitions/Enterprise"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateEnterpriseAPIRequest $request)
    {
        $input = $request->all();

        /** @var Enterprise $enterprise */
        $enterprise = $this->enterpriseRepository->find($id);

        if (empty($enterprise)) {
            return $this->sendError('Enterprise not found');
        }

        $enterprise = $this->enterpriseRepository->update($input, $id);

        return $this->sendResponse($enterprise->toArray(), 'Enterprise updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/enterprises/{id}",
     *      summary="Remove the specified Enterprise from storage",
     *      tags={"Enterprise"},
     *      description="Delete Enterprise",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Enterprise",
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
        /** @var Enterprise $enterprise */
        $enterprise = $this->enterpriseRepository->find($id);

        if (empty($enterprise)) {
            return $this->sendError('Enterprise not found');
        }

        $enterprise->delete();

        return $this->sendResponse($id, 'Enterprise deleted successfully');
    }
}
