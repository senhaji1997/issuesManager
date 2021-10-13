@component('mail::message')
# Introduction

Dear <strong>{{$customorName}}</strong>,

you have submitted an issue by the title <strong>{{$issueTitle}}</strong>. An admin will review it soon.

{{ config('app.name') }}
@endcomponent
