<div class="row">
    <div class="col-12">
        @if(@session('info'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <strong><i class="fa fa-info-circle"></i> Success!</strong> {!! @session('info') !!}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        @if(@session('error'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong><i class="fa fa-exclamation-circle"></i> Warning!</strong> {{ @session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        @if(count($errors) > 0)
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong><i class="fa fa-exclamation-circle"></i> Please correct your input data :</strong>
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
    </div>
</div>
