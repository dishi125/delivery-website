<?php

namespace App\Http\Controllers;

use App\Helpers\CommonHelper;
use App\Http\Requests\CreateWeb_UserRequest;
use App\Http\Requests\UpdateWeb_UserRequest;
use App\Models\Category;
use App\Models\Web_User;
use App\Repositories\Web_UserRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Response;

class Web_UserController extends AppBaseController
{
    /** @var  Web_UserRepository */
    private $webUserRepository;

    public function __construct(Web_UserRepository $webUserRepo)
    {
        $this->webUserRepository = $webUserRepo;
    }

    /**
     * Display a listing of the Web_User.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $webUsers = $this->webUserRepository->all();
        $session_filter = session('user_filter');

        if (!isset($session_filter)) {
            $filter['per_page'] = 20;
            $filter['search']=(isset($request->search))?$request->search:'';
        } else {
            $filter['per_page'] = $session_filter[0]['per_page'];
            $filter['search']=(isset($request->search))?$request->search:'';
        }


        return view('web__users.index',compact('filter'))->with('webUsers', $webUsers);
    }

    /**
     * Show the form for creating a new Web_User.
     *
     * @return Response
     */
    public function create()
    {
        return view('web__users.create');
    }

    /**
     * Store a newly created Web_User in storage.
     *
     * @param CreateWeb_UserRequest $request
     *
     * @return Response
     */
    public function store(CreateWeb_UserRequest $request)
    {
        $input = $request->all();
        $input['password'] = Hash::make($request['password']);
        if ($request->hasFile('image')) {
            $imagePath = CommonHelper::uploadImage($request->file('image'), 'images/profile');
            $input['profile_pic'] = $imagePath;
        }
        $webUser = $this->webUserRepository->create($input);

        Flash::success('Web  User saved successfully.');

        return redirect(route('webUsers.index'));
    }

    /**
     * Display the specified Web_User.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $webUser = $this->webUserRepository->find($id);

        if (empty($webUser)) {
            Flash::error('Web  User not found');

            return redirect(route('webUsers.index'));
        }

        return view('web__users.show')->with('webUser', $webUser);
    }

    /**
     * Show the form for editing the specified Web_User.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $webUser = $this->webUserRepository->find($id);

        if (empty($webUser)) {
            Flash::error('Web  User not found');

            return redirect(route('webUsers.index'));
        }

        return view('web__users.edit')->with('webUser', $webUser);
    }

    /**
     * Update the specified Web_User in storage.
     *
     * @param int $id
     * @param UpdateWeb_UserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateWeb_UserRequest $request)
    {
        $webUser = $this->webUserRepository->find($id);
        if ($request->hasFile('image')) {
            $imagePath = CommonHelper::uploadImage($request->file('image'), 'images/profile');
            $input['image'] = $imagePath;
        }
        if (empty($webUser)) {
            Flash::error('Web  User not found');

            return redirect(route('webUsers.index'));
        }

        $webUser = $this->webUserRepository->update($request->all(), $id);

        Flash::success('Web  User updated successfully.');

        return redirect(route('webUsers.index'));
    }

    /**
     * Remove the specified Web_User from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $webUser = $this->webUserRepository->find($id);

        if (empty($webUser)) {
            Flash::error('Web  User not found');

            return redirect(route('webUsers.index'));
        }

        $this->webUserRepository->delete($id);

        Flash::success('Web  User deleted successfully.');

        return redirect(route('webUsers.index'));
    }

    public function fetch_data(Request $request){
        $webUsers = Web_User::orderBy('id');
        if (isset($request->search) && $request->search != '') {
            $q = $request->search;

            $webUsers->where(function ($query) use ($q) {
                $query->orwhere(DB::raw("CONCAT(`fname`, ' ', `lname`)"), 'LIKE', "%".$q."%");
                $query->orwhere('fname', 'LIKE', '%' . $q . '%');
                $query->orwhere('lname', 'LIKE', '%' . $q . '%');
                $query->orwhere('email', 'LIKE', '%' . $q . '%');
                $query->orwhere('mobile', 'LIKE', '%' . $q . '%');
                $query->orwhere('address', 'LIKE', '%' . $q . '%');
            });
        }

        $filter = array();
        $filter['per_page'] = $request->per_page;
        session(['user_filter' => array($filter)]);
        $webUsers = $webUsers->paginate($request->per_page);

        return view('web__users.table',compact('webUsers'))->render();

    }
}
