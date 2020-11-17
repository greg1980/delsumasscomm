{{--@if(session()->has('success'))--}}

{{--    <div class="alert alert-success">--}}
{{--        {!! session()->get('success')!!}--}}
{{--    </div>--}}

{{--@endif--}}


{{--@if(session()->has('error'))--}}

{{--    <div class="alert alert-danger">--}}
{{--        {!! session()->get('error')!!}--}}
{{--    </div>--}}

{{--@endif--}}

@if (Session::has('message'))
    <div  class="balert balert-success ">
        <h4 class="mt-5 mb-5 ml-5">
            <span><i class="fas fa-check-circle"></i></span>
            {{ Session::get('message') }}
        </h4>
    </div>
@endif
