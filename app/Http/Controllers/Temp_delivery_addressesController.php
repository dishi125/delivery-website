<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTemp_delivery_addressesRequest;
use App\Http\Requests\UpdateTemp_delivery_addressesRequest;
use App\Repositories\Temp_delivery_addressesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class Temp_delivery_addressesController extends AppBaseController
{
    /** @var  Temp_delivery_addressesRepository */
    private $tempDeliveryAddressesRepository;

    public function __construct(Temp_delivery_addressesRepository $tempDeliveryAddressesRepo)
    {
        $this->tempDeliveryAddressesRepository = $tempDeliveryAddressesRepo;
    }

    /**
     * Display a listing of the Temp_delivery_addresses.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $tempDeliveryAddresses = $this->tempDeliveryAddressesRepository->all();

        return view('temp_delivery_addresses.index')
            ->with('tempDeliveryAddresses', $tempDeliveryAddresses);
    }

    /**
     * Show the form for creating a new Temp_delivery_addresses.
     *
     * @return Response
     */
    public function create()
    {
        return view('temp_delivery_addresses.create');
    }

    /**
     * Store a newly created Temp_delivery_addresses in storage.
     *
     * @param CreateTemp_delivery_addressesRequest $request
     *
     * @return Response
     */
    public function store(CreateTemp_delivery_addressesRequest $request)
    {
        $input = $request->all();

        $tempDeliveryAddresses = $this->tempDeliveryAddressesRepository->create($input);

        Flash::success('Temp Delivery Addresses saved successfully.');

        return redirect(route('tempDeliveryAddresses.index'));
    }

    /**
     * Display the specified Temp_delivery_addresses.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tempDeliveryAddresses = $this->tempDeliveryAddressesRepository->find($id);

        if (empty($tempDeliveryAddresses)) {
            Flash::error('Temp Delivery Addresses not found');

            return redirect(route('tempDeliveryAddresses.index'));
        }

        return view('temp_delivery_addresses.show')->with('tempDeliveryAddresses', $tempDeliveryAddresses);
    }

    /**
     * Show the form for editing the specified Temp_delivery_addresses.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tempDeliveryAddresses = $this->tempDeliveryAddressesRepository->find($id);

        if (empty($tempDeliveryAddresses)) {
            Flash::error('Temp Delivery Addresses not found');

            return redirect(route('tempDeliveryAddresses.index'));
        }

        return view('temp_delivery_addresses.edit')->with('tempDeliveryAddresses', $tempDeliveryAddresses);
    }

    /**
     * Update the specified Temp_delivery_addresses in storage.
     *
     * @param int $id
     * @param UpdateTemp_delivery_addressesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTemp_delivery_addressesRequest $request)
    {
        $tempDeliveryAddresses = $this->tempDeliveryAddressesRepository->find($id);

        if (empty($tempDeliveryAddresses)) {
            Flash::error('Temp Delivery Addresses not found');

            return redirect(route('tempDeliveryAddresses.index'));
        }

        $tempDeliveryAddresses = $this->tempDeliveryAddressesRepository->update($request->all(), $id);

        Flash::success('Temp Delivery Addresses updated successfully.');

        return redirect(route('tempDeliveryAddresses.index'));
    }

    /**
     * Remove the specified Temp_delivery_addresses from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tempDeliveryAddresses = $this->tempDeliveryAddressesRepository->find($id);

        if (empty($tempDeliveryAddresses)) {
            Flash::error('Temp Delivery Addresses not found');

            return redirect(route('tempDeliveryAddresses.index'));
        }

        $this->tempDeliveryAddressesRepository->delete($id);

        Flash::success('Temp Delivery Addresses deleted successfully.');

        return redirect(route('tempDeliveryAddresses.index'));
    }
}
