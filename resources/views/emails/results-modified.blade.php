@component('mail::message')

    <p>This {{$results->id}} with course code {{$results->user_id}} Was  </p>
    <p></p>


    @component('mail::button', ['url' => ''])
        Button Text
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
