@if(session()->has('message'))
    <div class="notify position-fixed d-flex m-0 m-1 alert alert-{{ session()->get('message_type') }}" style="top: 0; right: 0; ">
        {{ session()->get('message') }}
    </div>
@endif
