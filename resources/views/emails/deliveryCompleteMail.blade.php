{{--@component('mail::message')--}}
{{--# Introduction--}}

{{--The body of your message.--}}

<p>Package of {{$details['name']}} has been delivered.</p>
<div style="display: block">
    Address: {{$details['address']}} <br>
    Contact No.: {{$details['contact_no']}}
</div>

{{--@component('mail::button', ['url' => ''])--}}
{{--Button Text--}}
{{--@endcomponent--}}

{{--Thanks,<br>--}}
{{--{{ config('app.name') }}--}}
{{--@endcomponent--}}
