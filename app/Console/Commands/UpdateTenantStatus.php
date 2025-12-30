<?php

namespace App\Console\Commands;

use App\Models\Tenant;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UpdateTenantStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-tenant-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update tenant status berdasarkan periode_akhir';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::today();

        // Process tenants in chunks to avoid memory spikes
        $query = Tenant::with('user')
            ->where('tanggal_keluar', '<', $today)
            ->where('status', 'active')
            ->whereHas('user', function ($q) {
                $q->where('role', 'penghuni');
            });

        $found = false;

        $query->chunkById(100, function ($tenants) use (&$found) {
            foreach ($tenants as $tenant) {
                $found = true;

                try {
                    DB::transaction(function () use ($tenant) {
                        // set tenant inactive
                        $tenant->status = 'inactive';
                        $tenant->save();

                        // set related user inactive if exists
                        if ($tenant->user) {
                            $tenant->user->status = 'inactive';
                            $tenant->user->save();
                        }
                    });

                    if ($tenant->user) {
                        $this->info("User ID {$tenant->user->id} set to inactive (tenant ID {$tenant->id}).");
                    } else {
                        $this->info("Tenant ID {$tenant->id} set to inactive (no related user).{}");
                    }
                } catch (\Throwable $e) {
                    Log::error("Failed to update tenant {$tenant->id}: {$e->getMessage()}", ['exception' => $e]);
                    $this->error("Failed updating tenant ID {$tenant->id}; see log for details.");
                    // continue with next tenant
                }
            }
        });

        if (! $found) {
            $this->info('No tenants to update.');
            return 0;
        }

        $this->info('Tenant status update completed.');
    }
}
