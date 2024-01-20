{{--@component('mail::message')--}}
{{--# Introduction--}}

{{--The body of your message.--}}

<div style="display: block">
<p>Requested By,</p>
<div style="display: block;text-align: left;">
    @foreach($details['fromdata'] as $from)
        Name: {{ $from['name'] }} <br>
        Address: {{ $from['street_add'] }} <br>
        Contact No.: {{ $from['mobile'] }}<br>
    @endforeach
</div>
</div>

<br>
<div style="display: block">
<p>Take package from here,</p>
<table border="1" style="border-collapse: collapse;" cellpadding="5px;">
    <tr><td style="alignment: center">Name</td><td style="alignment: center">Address</td><td style="alignment: center">Contact No.</td><td style="alignment: center">Email</td></tr>
@foreach($details['todata'] as $to)
<tr>
    <td style="alignment: center">{{ $to['name'] }}</td>
    <td style="alignment: left">{{ $to['street_add'] }}</td>
    <td style="alignment: center">{{ $to['mobile'] }}</td>
    <td style="alignment: center">{{ $to['email'] }}</td>
</tr>
@endforeach
</table>
</div>

{{--@component('mail::button', ['url' => ''])--}}
{{--Button Text--}}
{{--@endcomponent--}}

{{--Thanks,<br>--}}
{{--{{ config('app.name') }}--}}
{{--@endcomponent--}}
