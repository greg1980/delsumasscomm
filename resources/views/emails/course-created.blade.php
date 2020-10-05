@component('mail::message')

<p>This {{$course->course_name}} with course code {{$course->course_code}} Was created and assigned to {{$user->name}} </p>
<p></p>


@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
