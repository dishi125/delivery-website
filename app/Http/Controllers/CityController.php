<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCityRequest;
use App\Http\Requests\UpdateCityRequest;
use App\Models\City;
use App\Models\Province;
use App\Repositories\CityRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class CityController extends AppBaseController
{
    /** @var  CityRepository */
    private $cityRepository;

    public function __construct(CityRepository $cityRepo)
    {
        $this->cityRepository = $cityRepo;
    }

    /**
     * Display a listing of the City.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $cities=City::orderBy('id','desc');
        $filter['per_page']=20;
        if($request->ajax()) {
            if (isset($request->search) && $request->search != '') {
                $q = $request->search;
                $cities = $cities->where('name', 'LIKE', '%' . $q . '%');
                $cities = $cities->orwhere('country_name', 'LIKE', '%' . $q . '%');
                $cities = $cities->orwhere('province_name', 'LIKE', '%' . $q . '%');
            }

            $filter['per_page'] = $request->per_page;
            $cities = $cities->paginate($filter['per_page']);
            return view('cities.table',compact('filter'))
                ->with('cities', $cities)->render();
        }
        $cities = $cities->paginate($filter['per_page']);
        return view('cities.index')
            ->with('cities', $cities);
    }

    /**
     * Show the form for creating a new City.
     *
     * @return Response
     */
    public function create()
    {
        return view('cities.create');
    }

    /**
     * Store a newly created City in storage.
     *
     * @param CreateCityRequest $request
     *
     * @return Response
     */
    public function store(CreateCityRequest $request)
    {
        $input = $request->all();

        $city = $this->cityRepository->create($input);

        Flash::success('City saved successfully.');

        return redirect(route('cities.index'));
    }

    /**
     * Display the specified City.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $city = $this->cityRepository->find($id);

        if (empty($city)) {
            Flash::error('City not found');

            return redirect(route('cities.index'));
        }

        return view('cities.show')->with('city', $city);
    }

    /**
     * Show the form for editing the specified City.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $city = $this->cityRepository->find($id);

        if (empty($city)) {
            Flash::error('City not found');

            return redirect(route('cities.index'));
        }

        return view('cities.edit')->with('city', $city);
    }

    /**
     * Update the specified City in storage.
     *
     * @param int $id
     * @param UpdateCityRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCityRequest $request)
    {
        $city = $this->cityRepository->find($id);

        if (empty($city)) {
            Flash::error('City not found');

            return redirect(route('cities.index'));
        }

        $city = $this->cityRepository->update($request->all(), $id);

        Flash::success('City updated successfully.');

        return redirect(route('cities.index'));
    }

    /**
     * Remove the specified City from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $city = $this->cityRepository->find($id);

        if (empty($city)) {
            Flash::error('City not found');

            return redirect(route('cities.index'));
        }

        $this->cityRepository->delete($id);

        Flash::success('City deleted successfully.');

        return redirect(route('cities.index'));
    }

    public function provincelist(Request $request)
    {
        try {
            $scs=Province::where('country_name',$request->country_name)->get();
//            $new=[NULL=>"Select Sub Category"];
            $cnt=Province::where('country_name',$request->country_name)->count();
            foreach ($scs as $sc)
            {
                $new[$sc->name]=$sc->name;
            }

            if($cnt==0){
                return ['data'=>"","status"=>1];
            }
            else {
                return ['data' => $new, "status" => 1];
            }
        }
        catch(\Exception $e)
        {
            return ["status"=>0,"error"=>$e->getMessage()];
        }
    }

}
