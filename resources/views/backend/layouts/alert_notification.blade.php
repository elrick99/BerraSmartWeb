@if (\Illuminate\Support\Facades\Session::get('message'))
    <div class="alert {{ \Illuminate\Support\Facades\Session::get('alert-class') }} alert-dismissible"
         role="alert">
        {{ \Illuminate\Support\Facades\Session::get('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
