{{--@component('mail::message')--}}
{{--# Introduction--}}

{{--The body of your message.--}}

<p>Price for Your delivery package is <b>{{$details['price']}}</b>.</p><br>
<p>Please pay soon...</p>

{{--@component('mail::button', ['url' => ''])--}}
{{--Button Text--}}
{{--@endcomponent--}}

{{--Thanks,<br>--}}
{{--{{ config('app.name') }}--}}
{{--@endcomponent--}}
