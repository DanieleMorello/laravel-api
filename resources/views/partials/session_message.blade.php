@if (session('message'))
    <div class="alert alert-info my-3" role="alert">
        <strong>
            <i class="fa-solid fa-thumbs-up"></i>
        </strong> {{ session('message') }}
    </div>
@endif
