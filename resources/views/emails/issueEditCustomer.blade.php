@component('mail::message')
Dear Admin,

The customer <strong>{{$customerName}}</strong> has submitted a new issue by the title <strong>{{$issueTitle}}</strong>.

<a href="{{ URL::route('list') }}">Click here to see all issues</a>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
