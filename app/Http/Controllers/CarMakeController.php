<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCarMakeRequest;
use App\Http\Requests\UpdateCarMakeRequest;
use App\Models\CarMake;
use App\Repositories\CarMakeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class CarMakeController extends AppBaseController
{
    /** @var  CarMakeRepository */
    private $carMakeRepository;

    public function __construct(CarMakeRepository $carMakeRepo)
    {
        $this->carMakeRepository = $carMakeRepo;
    }

    /**
     * Display a listing of the CarMake.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $carMakes = CarMake::orderBy('id');
        $filter['per_page']=20;
        if($request->ajax()) {
            if (isset($request->search) && $request->search != '') {
                $q = $request->search;
                $carMakes = $carMakes->where('name', 'LIKE', '%' . $q . '%');
            }

            $filter['per_page'] = $request->per_page;
            $carMakes = $carMakes->paginate($filter['per_page']);
            return view('car_makes.table',compact('filter'))
                ->with('carMakes', $carMakes)->render();

        }
            $carMakes = $carMakes->paginate($filter['per_page']);
        return view('car_makes.index',compact('filter'))
            ->with('carMakes', $carMakes);
    }

    /**
     * Show the form for creating a new CarMake.
     *
     * @return Response
     */
    public function create()
    {
        return view('car_makes.create');
    }

    /**
     * Store a newly created CarMake in storage.
     *
     * @param CreateCarMakeRequest $request
     *
     * @return Response
     */
    public function store(CreateCarMakeRequest $request)
    {
        $input = $request->all();

        $carMake = $this->carMakeRepository->create($input);

        Flash::success('Car Make saved successfully.');

        return redirect(route('carMakes.index'));
    }

    /**
     * Display the specified CarMake.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $carMake = $this->carMakeRepository->find($id);

        if (empty($carMake)) {
            Flash::error('Car Make not found');

            return redirect(route('carMakes.index'));
        }

        return view('car_makes.show')->with('carMake', $carMake);
    }

    /**
     * Show the form for editing the specified CarMake.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $carMake = $this->carMakeRepository->find($id);

        if (empty($carMake)) {
            Flash::error('Car Make not found');

            return redirect(route('carMakes.index'));
        }

        return view('car_makes.edit')->with('carMake', $carMake);
    }

    /**
     * Update the specified CarMake in storage.
     *
     * @param int $id
     * @param UpdateCarMakeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCarMakeRequest $request)
    {
        $carMake = $this->carMakeRepository->find($id);

        if (empty($carMake)) {
            Flash::error('Car Make not found');

            return redirect(route('carMakes.index'));
        }

        $carMake = $this->carMakeRepository->update($request->all(), $id);

        Flash::success('Car Make updated successfully.');

        return redirect(route('carMakes.index'));
    }

    /**
     * Remove the specified CarMake from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $carMake = $this->carMakeRepository->find($id);

        if (empty($carMake)) {
            Flash::error('Car Make not found');

            return redirect(route('carMakes.index'));
        }

        $this->carMakeRepository->delete($id);

        Flash::success('Car Make deleted successfully.');

        return redirect(route('carMakes.index'));
    }
}
