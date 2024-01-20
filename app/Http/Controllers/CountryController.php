<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use App\Models\Country;
use App\Repositories\CountryRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class CountryController extends AppBaseController
{
    /** @var  CountryRepository */
    private $countryRepository;

    public function __construct(CountryRepository $countryRepo)
    {
        $this->countryRepository = $countryRepo;
    }

    /**
     * Display a listing of the Country.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {

        $countries = $this->countryRepository->all();
        $session_filter = session('country_filter');
        if (!isset($session_filter)) {
            $filter['per_page'] = 20;
        } else {
            $filter['per_page'] = $session_filter[0]['per_page'];
        }
        return view('countries.index',compact('filter'))
            ->with('countries', $countries);
    }

    /**
     * Show the form for creating a new Country.
     *
     * @return Response
     */
    public function create()
    {
        return view('countries.create');
    }

    /**
     * Store a newly created Country in storage.
     *
     * @param CreateCountryRequest $request
     *
     * @return Response
     */
    public function store(CreateCountryRequest $request)
    {
        $input = $request->all();

        $country = $this->countryRepository->create($input);

        Flash::success('Country saved successfully.');

        return redirect(route('countries.index'));
    }

    /**
     * Display the specified Country.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $country = $this->countryRepository->find($id);

        if (empty($country)) {
            Flash::error('Country not found');

            return redirect(route('countries.index'));
        }

        return view('countries.show')->with('country', $country);
    }

    /**
     * Show the form for editing the specified Country.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $country = $this->countryRepository->find($id);

        if (empty($country)) {
            Flash::error('Country not found');

            return redirect(route('countries.index'));
        }

        return view('countries.edit')->with('country', $country);
    }

    /**
     * Update the specified Country in storage.
     *
     * @param int $id
     * @param UpdateCountryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCountryRequest $request)
    {
        $country = $this->countryRepository->find($id);

        if (empty($country)) {
            Flash::error('Country not found');

            return redirect(route('countries.index'));
        }

        $country = $this->countryRepository->update($request->all(), $id);

        Flash::success('Country updated successfully.');

        return redirect(route('countries.index'));
    }

    /**
     * Remove the specified Country from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $country = $this->countryRepository->find($id);

        if (empty($country)) {
            Flash::error('Country not found');

            return redirect(route('countries.index'));
        }

        $this->countryRepository->delete($id);

        Flash::success('Country deleted successfully.');

        return redirect(route('countries.index'));
    }

    public function fetch_data(Request $request){
        $countries = Country::orderBy('id');
        if (isset($request->search) && $request->search != '') {
            $q = $request->search;
            $countries->where('name', 'LIKE', '%' . $q . '%');
        }

        $filter = array();
        $filter['per_page'] = $request->per_page;
        session(['country_filter' => array($filter)]);
        $countries = $countries->paginate($request->per_page);

        return view('countries.table')
            ->with('countries', $countries)->render();


    }
}
