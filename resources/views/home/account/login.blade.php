@extends(env('APP_VIEW_PATH_HOME').'.account.layout')

@section('content')
    <div class="row">
        @foreach ($accounts as $account)
            <div class="col-md-6 mb-4">
                <a href="{{ route($account->route) }}" class="a-link-login border-primary text-primary">
                    <img src="{{ asset($account->image) }}" alt="image" class="img-150">
                    <h3 class="text-uppercase mb-0">{{ __('app.'.$account->name) }}</h3>
                </a>
            </div>
        @endforeach
    </div>
@endsection
