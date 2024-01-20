<div class="table-responsive">
    <table class="table" id="userReviews-table" style="-ms-scroll-snap-x: a">
        <thead>
        <tr>
            <th>Review By</th>
            <th>User</th>
            {{--            <th>To User Id</th>--}}
            <th>Rate</th>
            <th>Comment</th>
            <th>DateTime</th>
            {{--            <th colspan="3">Action</th>--}}
        </tr>
        </thead>
        <tbody>
        @foreach($userReviews as $userReview)
            <tr>
                <td>{{ $userReview->Fdriver }} {{ $userReview->Ldriver }}</td>
                <td>{{ $userReview->User }} {{ $userReview->LUser }}</td>
                {{--                <td>{{ $userReview->to_user_id }}</td>--}}
                <td><div class="rateYo" data-rateyo-rating="{{ $userReview->rate }}"></div></td>
                <td>{{ $userReview->comment }}</td>
                {{--                <td>--}}
                {{--                    {!! Form::open(['route' => ['userReviews.destroy', $userReview->id], 'method' => 'delete']) !!}--}}
                {{--                    <div class='btn-group'>--}}
                {{--                        <a href="{{ route('userReviews.show', [$userReview->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>--}}
                {{--                        <a href="{{ route('userReviews.edit', [$userReview->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>--}}
                {{--                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}--}}
                {{--                    </div>--}}
                {{--                    {!! Form::close() !!}--}}
                {{--                </td>--}}
                <td>{{ $userReview->created_at }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<div class="text-center">
    {!! $userReviews->links() !!}
</div>
