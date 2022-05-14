@extends('layouts.app')

@section('content')
    @include('account.parts.nav')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <br>
                <h3 class="text-center">{{ __('Clients') }}</h3>
                <br>
            </div>
            <div class="col-md-12">
                @foreach($clients as $client)
                    <div class="py-3 text-gray-900">
                        <h3 class="text-lg text-grey-500">{{ $client->name }}</h3>
                        <p>{{ $client->id }}</p>
                        <p>{{ $client->redirect }}</p>
                        <p>{{ $client->secret }}</p>
                    </div>
                @endforeach
            </div>
            <div class="col-12">
                <form action="{{ route('passport.clients.store') }}" method="POST">
                    @csrf
                    <div>
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Client Name" />
                    </div>
                    <div>
                        <label for="redirect">Redirect</label>
                        <input type="text" name="redirect" id="redirect" class="form-control" placeholder="http://smth.com/callback" />
                    </div>
                    <input type="submit" class="btn btn-primary" value="Create Client">
                </form>
            </div>
        </div>
    </div>
@endsection
