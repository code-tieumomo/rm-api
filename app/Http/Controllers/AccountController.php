<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Traits\APIResponse;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    use APIResponse;

    /**
     * Get a list of accounts.
     */
    public function index()
    {
        $accounts = Account::all();

        return $this->success($accounts);
    }

    /**
     * Store a newly created account in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:accounts',
            'password' => 'required',
            'full_name' => 'required',
            'sdt' => 'nullable',
            'role' => 'required|in:1,2,3',
        ]);

        $account = Account::create($request->except(['image_url', 'password']));
        $account->image_url = "https://api.dicebear.com/9.x/avataaars-neutral/svg/?seed={$account->id}";
        $account->password = bcrypt($request->password);

        return $this->success($account, 'Account created successfully', 201);
    }

    /**
     * Display the specified account.
     */
    public function show(int $id)
    {
        $account = Account::find($id);

        if (! $account) {
            return $this->error('Account not found', 404);
        }

        return $this->success($account);
    }

    /**
     * Update the specified account in storage.
     */
    public function update(Request $request, string $id)
    {
        $account = Account::find($id);

        if (! $account) {
            return $this->error('Account not found', 404);
        }

        $request->validate([
            'email' => 'required|email|unique:accounts,email,' . $id,
            'password' => 'nullable',
            'full_name' => 'required',
            'sdt' => 'nullable',
            'role' => 'required|in:1,2,3',
        ]);

        $account->update($request->except(['image_url', 'password']));
        if ($request->password) {
            $account->password = bcrypt($request->password);
        }

        return $this->success($account, 'Account updated successfully');
    }

    /**
     * Remove the specified account from storage.
     */
    public function destroy(string $id)
    {
        $account = Account::find($id);

        if (! $account) {
            return $this->error('Account not found', 404);
        }

        $account->delete();

        return $this->success(null, 'Account deleted successfully');
    }

    /**
     * Update role of the specified account in storage.
     */
    public function updateRole(Request $request, string $id)
    {
        $account = Account::find($id);

        if (! $account) {
            return $this->error('Account not found', 404);
        }

        $request->validate([
            'role' => 'required|integer|in:1,2,3',
        ]);

        $account->update($request->only('role'));

        return $this->success($account, 'Account role updated successfully');
    }
}
