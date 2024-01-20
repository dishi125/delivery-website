<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTemp_packagesRequest;
use App\Http\Requests\UpdateTemp_packagesRequest;
use App\Repositories\Temp_packagesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class Temp_packagesController extends AppBaseController
{
    /** @var  Temp_packagesRepository */
    private $tempPackagesRepository;

    public function __construct(Temp_packagesRepository $tempPackagesRepo)
    {
        $this->tempPackagesRepository = $tempPackagesRepo;
    }

    /**
     * Display a listing of the Temp_packages.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $tempPackages = $this->tempPackagesRepository->all();

        return view('temp_packages.index')
            ->with('tempPackages', $tempPackages);
    }

    /**
     * Show the form for creating a new Temp_packages.
     *
     * @return Response
     */
    public function create()
    {
        return view('temp_packages.create');
    }

    /**
     * Store a newly created Temp_packages in storage.
     *
     * @param CreateTemp_packagesRequest $request
     *
     * @return Response
     */
    public function store(CreateTemp_packagesRequest $request)
    {
        $input = $request->all();

        $tempPackages = $this->tempPackagesRepository->create($input);

        Flash::success('Temp Packages saved successfully.');

        return redirect(route('tempPackages.index'));
    }

    /**
     * Display the specified Temp_packages.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tempPackages = $this->tempPackagesRepository->find($id);

        if (empty($tempPackages)) {
            Flash::error('Temp Packages not found');

            return redirect(route('tempPackages.index'));
        }

        return view('temp_packages.show')->with('tempPackages', $tempPackages);
    }

    /**
     * Show the form for editing the specified Temp_packages.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tempPackages = $this->tempPackagesRepository->find($id);

        if (empty($tempPackages)) {
            Flash::error('Temp Packages not found');

            return redirect(route('tempPackages.index'));
        }

        return view('temp_packages.edit')->with('tempPackages', $tempPackages);
    }

    /**
     * Update the specified Temp_packages in storage.
     *
     * @param int $id
     * @param UpdateTemp_packagesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTemp_packagesRequest $request)
    {
        $tempPackages = $this->tempPackagesRepository->find($id);

        if (empty($tempPackages)) {
            Flash::error('Temp Packages not found');

            return redirect(route('tempPackages.index'));
        }

        $tempPackages = $this->tempPackagesRepository->update($request->all(), $id);

        Flash::success('Temp Packages updated successfully.');

        return redirect(route('tempPackages.index'));
    }

    /**
     * Remove the specified Temp_packages from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tempPackages = $this->tempPackagesRepository->find($id);

        if (empty($tempPackages)) {
            Flash::error('Temp Packages not found');

            return redirect(route('tempPackages.index'));
        }

        $this->tempPackagesRepository->delete($id);

        Flash::success('Temp Packages deleted successfully.');

        return redirect(route('tempPackages.index'));
    }
}
