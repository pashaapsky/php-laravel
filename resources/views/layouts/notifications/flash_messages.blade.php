@if(session()->has('message'))
    <div class="alert alert-{{ session()->get('message_type') }}">
        {{ session()->get('message') }}
    </div>
@endif
