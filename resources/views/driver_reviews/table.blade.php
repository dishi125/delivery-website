<div class="table-responsive">
    <table class="table" id="driverReviews-table">
        <thead>
        <tr>
            <th>Driver</th>
            <th>Review By</th>
            <th>Rate</th>
            <th>Comment</th>
            <th>DateTime</th>
{{--            <th colspan="3">Action</th>--}}
        </tr>
        </thead>
        <tbody>
        @foreach($driverReviews as $driverReview)
            <tr>
                <td>{{ $driverReview->Fdriver }} {{ $driverReview->Ldriver }}</td>
                <td>{{ $driverReview->User }} {{ $driverReview->LUser }}</td>
                <td><div class="rateYo" data-rateyo-rating="{{$driverReview->rate}}"></div></td>
                <td>{{ $driverReview->comment }}</td>
{{--                <td>--}}
{{--                    {!! Form::open(['route' => ['driverReviews.destroy', $driverReview->id], 'method' => 'delete']) !!}--}}
{{--                    <div class='btn-group'>--}}
{{--                        <a href="{{ route('driverReviews.show', [$driverReview->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>--}}
{{--                        <a href="{{ route('driverReviews.edit', [$driverReview->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>--}}
{{--                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}--}}
{{--                    </div>--}}
{{--                    {!! Form::close() !!}--}}
{{--                </td>--}}
                <td>{{ $driverReview->created_at }}</td>

            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<div class="text-center">
    {!! $driverReviews->links() !!}
</div>
