<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSlObjectRequest;
use App\Http\Requests\UpdateSlObjectRequest;
use App\Repositories\SlObjectRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class SlObjectController extends AppBaseController
{
    /** @var SlObjectRepository $slObjectRepository*/
    private $slObjectRepository;

    public function __construct(SlObjectRepository $slObjectRepo)
    {
        $this->slObjectRepository = $slObjectRepo;
    }

    /**
     * Display a listing of the SlObject.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $slObjects = $this->slObjectRepository->all();

        return view('sl_objects.index')
            ->with('slObjects', $slObjects);
    }

    /**
     * Show the form for creating a new SlObject.
     *
     * @return Response
     */
    public function create()
    {
        return view('sl_objects.create');
    }

    /**
     * Store a newly created SlObject in storage.
     *
     * @param CreateSlObjectRequest $request
     *
     * @return Response
     */
    public function store(CreateSlObjectRequest $request)
    {
        $input = $request->all();

        $slObject = $this->slObjectRepository->create($input);

        Flash::success('Sl Object saved successfully.');

        return redirect(route('slObjects.index'));
    }

    /**
     * Display the specified SlObject.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $slObject = $this->slObjectRepository->find($id);

        if (empty($slObject)) {
            Flash::error('Sl Object not found');

            return redirect(route('slObjects.index'));
        }

        return view('sl_objects.show')->with('slObject', $slObject);
    }

    /**
     * Show the form for editing the specified SlObject.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $slObject = $this->slObjectRepository->find($id);

        if (empty($slObject)) {
            Flash::error('Sl Object not found');

            return redirect(route('slObjects.index'));
        }

        return view('sl_objects.edit')->with('slObject', $slObject);
    }

    /**
     * Update the specified SlObject in storage.
     *
     * @param int $id
     * @param UpdateSlObjectRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSlObjectRequest $request)
    {
        $slObject = $this->slObjectRepository->find($id);

        if (empty($slObject)) {
            Flash::error('Sl Object not found');

            return redirect(route('slObjects.index'));
        }

        $slObject = $this->slObjectRepository->update($request->all(), $id);

        Flash::success('Sl Object updated successfully.');

        return redirect(route('slObjects.index'));
    }

    /**
     * Remove the specified SlObject from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $slObject = $this->slObjectRepository->find($id);

        if (empty($slObject)) {
            Flash::error('Sl Object not found');

            return redirect(route('slObjects.index'));
        }

        $this->slObjectRepository->delete($id);

        Flash::success('Sl Object deleted successfully.');

        return redirect(route('slObjects.index'));
    }
}
