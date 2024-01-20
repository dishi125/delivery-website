<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDriver_reviewRequest;
use App\Http\Requests\UpdateDriver_reviewRequest;
use App\Models\Driver_review;
use App\Repositories\Driver_reviewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class Driver_reviewController extends AppBaseController
{
    /** @var  Driver_reviewRepository */
    private $driverReviewRepository;

    public function __construct(Driver_reviewRepository $driverReviewRepo)
    {
        $this->driverReviewRepository = $driverReviewRepo;
    }

    /**
     * Display a listing of the Driver_review.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $driverReviews = $this->driverReviewRepository->all();
        $session_filter = session('driverreview_filter');
        if (!isset($session_filter)) {
            $filter['per_page'] = 20;
        } else {
            $filter['per_page'] = $session_filter[0]['per_page'];
        }
        return view('driver_reviews.index',compact('filter'))
            ->with('driverReviews', $driverReviews);
    }

    /**
     * Show the form for creating a new Driver_review.
     *
     * @return Response
     */
    public function create()
    {
        return view('driver_reviews.create');
    }

    /**
     * Store a newly created Driver_review in storage.
     *
     * @param CreateDriver_reviewRequest $request
     *
     * @return Response
     */
    public function store(CreateDriver_reviewRequest $request)
    {
        $input = $request->all();

        $driverReview = $this->driverReviewRepository->create($input);

        Flash::success('Driver Review saved successfully.');

        return redirect(route('driverReviews.index'));
    }

    /**
     * Display the specified Driver_review.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $driverReview = $this->driverReviewRepository->find($id);

        if (empty($driverReview)) {
            Flash::error('Driver Review not found');

            return redirect(route('driverReviews.index'));
        }

        return view('driver_reviews.show')->with('driverReview', $driverReview);
    }

    /**
     * Show the form for editing the specified Driver_review.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $driverReview = $this->driverReviewRepository->find($id);

        if (empty($driverReview)) {
            Flash::error('Driver Review not found');

            return redirect(route('driverReviews.index'));
        }

        return view('driver_reviews.edit')->with('driverReview', $driverReview);
    }

    /**
     * Update the specified Driver_review in storage.
     *
     * @param int $id
     * @param UpdateDriver_reviewRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDriver_reviewRequest $request)
    {
        $driverReview = $this->driverReviewRepository->find($id);

        if (empty($driverReview)) {
            Flash::error('Driver Review not found');

            return redirect(route('driverReviews.index'));
        }

        $driverReview = $this->driverReviewRepository->update($request->all(), $id);

        Flash::success('Driver Review updated successfully.');

        return redirect(route('driverReviews.index'));
    }

    /**
     * Remove the specified Driver_review from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $driverReview = $this->driverReviewRepository->find($id);

        if (empty($driverReview)) {
            Flash::error('Driver Review not found');

            return redirect(route('driverReviews.index'));
        }

        $this->driverReviewRepository->delete($id);

        Flash::success('Driver Review deleted successfully.');

        return redirect(route('driverReviews.index'));
    }
    public function fetch_data(Request $request){
        $driverReviews = Driver_review::orderBy('id');
        $filter = array();
        $filter['per_page'] = $request->per_page;
        session(['driverreview_filter' => array($filter)]);
        $driverReviews = $driverReviews->paginate($request->per_page);
        return view('driver_reviews.table')
            ->with('driverReviews', $driverReviews)->render();
    }
}
