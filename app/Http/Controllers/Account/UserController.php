<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccountUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Passport\Client;

class UserController extends Controller
{
    public function index()
    {
        return view('account/index', ['user' => auth()->user()]);
    }

    public function edit(User $user)
    {
        return view('account/users/edit', compact('user'));
    }

    public function update(AccountUpdateRequest $request, User $user)
    {
        $user->update($request->validated());

        return redirect(route('account.main'))->with('success', 'Data was updated!');
    }

    public function clients(Request $request)
    {
        $clients = $request->user()->clients;
        return view('account/clients', compact('clients'));
    }

    public function oauthAuthorize(Request $request, Client $client)
    {
        $query = http_build_query([
            'client_id' => $client->id,
            'redirect_uri' => $client->redirect,
            'response_type' => 'code',
            'scope' => '',
            'state' => $client->secret,
        ]);

        return redirect('http://hillel.local/oauth/authorize?' . $query);
    }
}
