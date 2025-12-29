<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\StoreAccountRequest;
use App\Http\Requests\Account\UpdateAccountRequest;
use App\Models\User;
use App\Services\AccountService;
use Illuminate\Support\Facades\Gate;

class AccountController extends Controller
{
    protected AccountService $accountService;

    public function __construct(AccountService $accountService)
    {
        $this->accountService = $accountService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accounts = $this->accountService->getAll();
        return view('admin.account.index', compact('accounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.account.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAccountRequest $request)
    {
        $this->accountService->store($request->validated());
        return redirect()->route('admin.account.index')->with('success', 'Data Akun berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $account)
    {
        $account = $this->accountService->read($account);
        return view('admin.account.show', compact('account'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $account)
    {
        return view('admin.account.edit', compact('account'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAccountRequest $request, User $account)
    {
        $data = $request->validated();
        // jika password kosong atau null, jangan ubah password
        if (array_key_exists('password', $data) && empty($data['password'])) {
            unset($data['password']);
        }

        $this->accountService->update($account, $data);
        return redirect()->route('admin.account.index')->with('success', 'Data Akun berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $account)
    {
        Gate::authorize('delete', $account);
        $this->accountService->delete($account);
        return redirect()->route('admin.account.index')->with('success', 'Data Akun berhasil dihapus.');
    }

    /**
     * Menerima akun yang diajukan.
     */
    public function accept(User $account)
    {
        $this->accountService->accept($account);
        return redirect()->route('admin.account.index')->with('success', 'Akun berhasil diterima.');
    }

    /**
     * Menolak akun yang diajukan.
     */
    public function reject(User $account)
    {
        $this->accountService->reject($account);
        return redirect()->route('admin.account.index')->with('success', 'Akun berhasil ditolak.');
    }


}
