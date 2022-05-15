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
                        <input type="text" name="name" id="name" class="form-control" placeholder="Client Name"/>
                    </div>
                    <div>
                        <label for="redirect">Redirect</label>
                        <input type="text" name="redirect" id="redirect" class="form-control"
                               placeholder="http://smth.com/callback"/>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Create Client">
                </form>
            </div>
        </div>
    </div>

    {{--                                    <span class="block"><b>ID: </b>{{ $client->id }}</span>--}}
    {{--                                    <span class="block"><b>Name: </b>{{ $client->name }}</span>--}}
    {{--                                    <span class="block"><b>Secret: </b>{{ $client->secret }}</span>--}}
    {{--                                    <span class="block"><b>Provider: </b>--}}
    {{--                                        @if($client->provider == null )--}}
    {{--                                            Null--}}
    {{--                                        @else--}}
    {{--                                            {{ $client->provider }})--}}
    {{--                                        @endif--}}
    {{--                                    </span>--}}
    {{--                                    <span class="block"><b>Redirect: </b>{{ $client->redirect }}</span>--}}
    {{--                                    <span class="block"><b>Access: </b>{{ $client->personal_access_client }}</span>--}}
    {{--                                    <span class="block"><b>CLient Password: </b>{{ $client->password_client }}</span>--}}
    {{--                                    <span class="block"><b>Revoked: </b>{{ $client->revoked }}</span>--}}
@endsection
