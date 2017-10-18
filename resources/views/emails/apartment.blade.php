{{--@formatter:off--}}
@component('mail::message')
# Apartment Posted

Your new apartment has been saved and publish. Here are details.

Apartment Id: {{$apartment->id}}

Apartment Title: {{$apartment->title}}

@php
$editUrl =   config('app.frontendUrl').'apartments/'.$apartment->id.'/edit/'.$apartment->token;
$delUrl =  config('app.frontendUrl').'apartments/'.$apartment->id.'/delete/'.$apartment->token;
@endphp

@component('mail::button', ['url' => $editUrl])
Edit Apartment
@endcomponent

Want to delete this apartment? click following url?
<a href="{{$delUrl}}">{{$delUrl}}</a>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
{{--@formatter:on--}}