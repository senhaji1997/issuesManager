@component('mail::message')

Dear <strong>{{$customerName}}</strong>,

The admin <strong>{{$adminName}}</strong> has changed the status of your issue by the title <strong>{{$issueTitle}}</strong> to <strong>{{$newStatus}}</strong>.

<a href="{{ URL::route('list') }}">Click here to see all issues</a>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
