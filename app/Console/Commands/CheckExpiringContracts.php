<?php

namespace App\Console\Commands;

use App\Models\EmployeeContract;
use App\Models\User;
use App\Notifications\ContractExpiringSoon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;
use Carbon\Carbon;

class CheckExpiringContracts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-expiring-contracts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for employee contracts expiring in the next 30 days and send notifications.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Mengecek kontrak yang akan berakhir...');

        // Calculate the date 30 days from now
        $expirationDate = Carbon::now()->addDays(30)->toDateString();

        // Find all active contracts that will expire on or before that date
        $expiringContracts = EmployeeContract::where('status', 'active')
            ->whereNotNull('end_date')
            ->where('end_date', '<=', $expirationDate)
            ->get();

        if ($expiringContracts->isEmpty()) {
            $this->info('Tidak ada kontrak yang akan berakhir dalam 30 hari ke depan.');
            return;
        }

        // Find the user designated as HRD. You might need to adjust this logic.
        // For this example, we assume the user with email 'hrd@example.com' is the recipient.
        // It's better to get this from a config file.
        $hrdEmail = config('hrd.notification_email', 'hrd@example.com');
        $hrdUser = User::where('email', $hrdEmail)->first();

        if (!$hrdUser) {
            $this->error("Pengguna HRD dengan email {$hrdEmail} tidak ditemukan. Notifikasi tidak dapat dikirim.");
            return;
        }

        foreach ($expiringContracts as $contract) {
            $this->line("-> Menemukan kontrak yang akan berakhir untuk: " . $contract->employee->name);

            // Send the notification to the HRD user
            Notification::send($hrdUser, new ContractExpiringSoon($contract));
        }

        $this->info('Notifikasi untuk ' . $expiringContracts->count() . ' kontrak telah berhasil dikirim.');
    }
}