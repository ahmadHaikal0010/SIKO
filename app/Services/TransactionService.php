<?php

namespace App\Services;

use App\Models\Tenant;
use App\Models\Transaction;

class TransactionService
{
    public function getAll()
    {
        return Transaction::with('tenant')->latest()->paginate(10);
    }

    public function read(Transaction $transaction)
    {
        return $transaction->load('tenant');
    }

    public function create(array $data)
    {
        return Transaction::create($data);
    }

    public function update(Transaction $transaction, array $data)
    {
        $transaction->update($data);
        return $transaction;
    }

    public function delete(Transaction $transaction)
    {
        $transaction->delete();
    }

    public function getTenants()
    {
        return Tenant::all();
    }
}
