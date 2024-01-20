<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUser_reviewRequest;
use App\Http\Requests\UpdateUser_reviewRequest;
use App\Models\User_review;
use App\Repositories\User_reviewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class User_reviewController extends AppBaseController
{
    /** @var  User_reviewRepository */
    private $userReviewRepository;

    public function __construct(User_reviewRepository $userReviewRepo)
    {
        $this->userReviewRepository = $userReviewRepo;
    }

    /**
     * Display a listing of the User_review.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $userReviews = $this->userReviewRepository->all();
        $session_filter = session('userreview_filter');
        if (!isset($session_filter)) {
            $filter['per_page'] = 20;
        } else {
            $filter['per_page'] = $session_filter[0]['per_page'];
        }
        return view('user_reviews.index',compact('filter'))
            ->with('userReviews', $userReviews);
    }

    /**
     * Show the form for creating a new User_review.
     *
     * @return Response
     */
    public function create()
    {
        return view('user_reviews.create');
    }

    /**
     * Store a newly created User_review in storage.
     *
     * @param CreateUser_reviewRequest $request
     *
     * @return Response
     */
    public function store(CreateUser_reviewRequest $request)
    {
        $input = $request->all();

        $userReview = $this->userReviewRepository->create($input);

        Flash::success('User Review saved successfully.');

        return redirect(route('userReviews.index'));
    }

    /**
     * Display the specified User_review.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $userReview = $this->userReviewRepository->find($id);

        if (empty($userReview)) {
            Flash::error('User Review not found');

            return redirect(route('userReviews.index'));
        }

        return view('user_reviews.show')->with('userReview', $userReview);
    }

    /**
     * Show the form for editing the specified User_review.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $userReview = $this->userReviewRepository->find($id);

        if (empty($userReview)) {
            Flash::error('User Review not found');

            return redirect(route('userReviews.index'));
        }

        return view('user_reviews.edit')->with('userReview', $userReview);
    }

    /**
     * Update the specified User_review in storage.
     *
     * @param int $id
     * @param UpdateUser_reviewRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUser_reviewRequest $request)
    {
        $userReview = $this->userReviewRepository->find($id);

        if (empty($userReview)) {
            Flash::error('User Review not found');

            return redirect(route('userReviews.index'));
        }

        $userReview = $this->userReviewRepository->update($request->all(), $id);

        Flash::success('User Review updated successfully.');

        return redirect(route('userReviews.index'));
    }

    /**
     * Remove the specified User_review from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $userReview = $this->userReviewRepository->find($id);

        if (empty($userReview)) {
            Flash::error('User Review not found');

            return redirect(route('userReviews.index'));
        }

        $this->userReviewRepository->delete($id);

        Flash::success('User Review deleted successfully.');

        return redirect(route('userReviews.index'));
    }
    public function fetch_data(Request $request){
        $userReviews = User_review::orderBy('id');
        $filter = array();
        $filter['per_page'] = $request->per_page;
        session(['userreview_filter' => array($filter)]);
        $userReviews = $userReviews->paginate($request->per_page);
        return view('user_reviews.table')
            ->with('userReviews', $userReviews);
    }
}
