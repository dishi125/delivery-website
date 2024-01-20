<?php

namespace App\Http\Controllers;

use App\Helpers\CommonHelper;
use App\Http\Requests\CreateDriverRequest;
use App\Http\Requests\UpdateDriverRequest;
use App\Models\Driver;
use App\Repositories\DriverRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Hash;
use Response;

class DriverController extends AppBaseController
{
    /** @var  DriverRepository */
    private $driverRepository;

    public function __construct(DriverRepository $driverRepo)
    {
        $this->driverRepository = $driverRepo;
    }

    /**
     * Display a listing of the Driver.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $drivers = $this->driverRepository->all();
        $session_filter = session('driver_filter');
        if (!isset($session_filter)) {
            $filter['per_page'] = 20;
        } else {
            $filter['per_page'] = $session_filter[0]['per_page'];
        }

        return view('drivers.index',compact('filter'))
            ->with('drivers', $drivers);
    }

    /**
     * Show the form for creating a new Driver.
     *
     * @return Response
     */
    public function create()
    {
        return view('drivers.create');
    }

    /**
     * Store a newly created Driver in storage.
     *
     * @param CreateDriverRequest $request
     *
     * @return Response
     */
    public function store(CreateDriverRequest $request)
    {
        $input = $request->all();
        $input['password'] = Hash::make($request['password']);
        if ($request->hasFile('image')) {
            $imagePath = CommonHelper::uploadImage($request->file('image'), 'images/profile');
            $input['profile_pic'] = $imagePath;
        }
        if ($request->hasFile('car_images')) {
            $imagePath = CommonHelper::uploadImage($request->file('car_images'), 'images/car_images');
            $input['car_image'] = $imagePath;
        }
        $driver = $this->driverRepository->create($input);

        Flash::success('Driver saved successfully.');

        return redirect(route('drivers.index'));
    }

    /**
     * Display the specified Driver.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $driver = $this->driverRepository->find($id);

        if (empty($driver)) {
            Flash::error('Driver not found');

            return redirect(route('drivers.index'));
        }

        return view('drivers.show')->with('driver', $driver);
    }

    /**
     * Show the form for editing the specified Driver.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $driver = $this->driverRepository->find($id);

        if (empty($driver)) {
            Flash::error('Driver not found');

            return redirect(route('drivers.index'));
        }

        return view('drivers.edit')->with('driver', $driver);
    }

    /**
     * Update the specified Driver in storage.
     *
     * @param int $id
     * @param UpdateDriverRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDriverRequest $request)
    {
        $input = $request->all();
        $driver = $this->driverRepository->find($id);
        if ($request->hasFile('image')) {
            $imagePath = CommonHelper::uploadImage($request->file('image'), 'images/profile');
            $input['profile_pic'] = $imagePath;
        }
        if ($request->hasFile('car_images')) {
            $imagePath = CommonHelper::uploadImage($request->file('car_images'), 'images/car_images');
            $input['car_image'] = $imagePath;
        }
        if (empty($driver)) {
            Flash::error('Driver not found');

            return redirect(route('drivers.index'));
        }

        $driver = $this->driverRepository->update($input, $id);

        Flash::success('Driver updated successfully.');

        return redirect(route('drivers.index'));
    }

    /**
     * Remove the specified Driver from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $driver = $this->driverRepository->find($id);

        if (empty($driver)) {
            Flash::error('Driver not found');

            return redirect(route('drivers.index'));
        }

        $this->driverRepository->delete($id);

        Flash::success('Driver deleted successfully.');

        return redirect(route('drivers.index'));
    }
    public function fetch_data(Request $request){
        $drivers = Driver::orderBy('id');
        if (isset($request->search) && $request->search != '') {
            $q = $request->search;
            $drivers->where(function ($query) use ($q) {
                $query->orwhere('fname', 'LIKE', '%' . $q . '%');
                $query->orwhere('lname', 'LIKE', '%' . $q . '%');
                $query->orwhere('email', 'LIKE', '%' . $q . '%');
                $query->orwhere('mobile', 'LIKE', '%' . $q . '%');
                $query->orwhere('address', 'LIKE', '%' . $q . '%');
                $query->orwhere('car_make', 'LIKE', '%' . $q . '%');
                $query->orwhere('car_model', 'LIKE', '%' . $q . '%');
                $query->orwhere('year', 'LIKE', '%' . $q . '%');
            });
        }

        $filter = array();
        $filter['per_page'] = $request->per_page;
        session(['driver_filter' => array($filter)]);
        $drivers = $drivers->paginate($request->per_page);

        return view('drivers.table',compact('drivers'))->render();

    }
}
