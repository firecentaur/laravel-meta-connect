<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateSlObjectAPIRequest;
use App\Http\Requests\API\UpdateSlObjectAPIRequest;
use App\Models\SlObject;
use App\Repositories\SlObjectRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class SlObjectController
 * @package App\Http\Controllers\API
 */

class SlObjectAPIController extends AppBaseController
{
    /** @var  SlObjectRepository */
    private $slObjectRepository;

    public function __construct(SlObjectRepository $slObjectRepo)
    {
        $this->slObjectRepository = $slObjectRepo;
    }

    /**
     * Display a listing of the SlObject.
     * GET|HEAD /slObjects
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $slObjects = $this->slObjectRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($slObjects->toArray(), 'Sl Objects retrieved successfully');
    }

    /**
     * Store a newly created SlObject in storage.
     * POST /slObjects
     *
     * @param CreateSlObjectAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateSlObjectAPIRequest $request)
    {
        $input = $request->all();

        $slObject = $this->slObjectRepository->create($input);

        return $this->sendResponse($slObject->toArray(), 'Sl Object saved successfully');
    }

    /**
     * Display the specified SlObject.
     * GET|HEAD /slObjects/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var SlObject $slObject */
        $slObject = $this->slObjectRepository->find($id);

        if (empty($slObject)) {
            return $this->sendError('Sl Object not found');
        }

        return $this->sendResponse($slObject->toArray(), 'Sl Object retrieved successfully');
    }

    /**
     * Update the specified SlObject in storage.
     * PUT/PATCH /slObjects/{id}
     *
     * @param int $id
     * @param UpdateSlObjectAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSlObjectAPIRequest $request)
    {
        $input = $request->all();

        /** @var SlObject $slObject */
        $slObject = $this->slObjectRepository->find($id);

        if (empty($slObject)) {
            return $this->sendError('Sl Object not found');
        }

        $slObject = $this->slObjectRepository->update($input, $id);

        return $this->sendResponse($slObject->toArray(), 'SlObject updated successfully');
    }

    /**
     * Remove the specified SlObject from storage.
     * DELETE /slObjects/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var SlObject $slObject */
        $slObject = $this->slObjectRepository->find($id);

        if (empty($slObject)) {
            return $this->sendError('Sl Object not found');
        }

        $slObject->delete();

        return $this->sendSuccess('Sl Object deleted successfully');
    }
}
