<?php

namespace App\Services;

use App\Models\Transaction;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class TenantLifecycleService
{
    public function handleTransactionCreated(Transaction $transaction)
    {
        if ($transaction->periode_selesai <= Carbon::today()) {
            return;
        }

        DB::transaction(function () use ($transaction) {
            $tenant = $transaction->tenant;
            $user = $tenant->user;

            $tenant->update([
                'tanggal_keluar' => $transaction->periode_selesai,
                'status' => 'active',
            ]);

            $user->update(['status' => 'active']);
        });
    }
}
