@if (Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show message" role="alert">
        <span>{{ Session::get('success') }}</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if (Session::has('error'))
    <div class="alert alert-danger alert-dismissible fade show message" role="alert">
        <span>{{ Session::get('error') }}</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if (Session::has('warning'))
    <div class="alert alert-warning alert-dismissible fade show message" role="alert">
        <span>{{ Session::get('warning') }}</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if (Session::has('info'))
    <div class="alert alert-info alert-dismissible fade show message" role="alert">
        <span>{{ Session::get('success') }}</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show message" role="alert">
        <span>Terjadi Kesalahan. Silahkan cek kolom dibawah.</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif