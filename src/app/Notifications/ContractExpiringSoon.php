<?php

namespace App\Notifications;

use App\Models\EmployeeContract;
use Filament\Notifications\Notification as FilamentNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ContractExpiringSoon extends Notification
{
    use Queueable;

    public EmployeeContract $contract;

    /**
     * Create a new notification instance.
     */
    public function __construct(EmployeeContract $contract)
    {
        $this->contract = $contract;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $employeeName = $this->contract->employee->name;
        $endDate = $this->contract->end_date;

        return (new MailMessage)
            ->error() // Gives it a red "alert" theme
            ->subject('Pemberitahuan: Kontrak Karyawan Segera Berakhir')
            ->greeting('Halo Tim HRD,')
            ->line("Kontrak kerja untuk karyawan atas nama **{$employeeName}** akan segera berakhir pada tanggal **{$endDate}**.")
            ->line('Mohon untuk segera mempersiapkan proses perpanjangan kontrak atau prosedur off-boarding.')
            ->action('Lihat Detail Kontrak', url(config('app.url').'/hrd/employee-contracts/'.$this->contract->id.'/edit'))
            ->line('Terima kasih atas perhatian Anda.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $employeeName = $this->contract->employee->name;
        $endDate = $this->contract->end_date;

        return [
            'title' => 'Kontrak Segera Berakhir',
            'body' => "Kontrak untuk {$employeeName} akan berakhir pada {$endDate}.",
            'url' => '/hrd/employee-contracts/'.$this->contract->id.'/edit',
        ];
    }

    public function toDatabase(object $notifiable): array
    {
        $employeeName = $this->contract->employee->name;
        $endDate = $this->contract->end_date;

        return FilamentNotification::make()
            ->title('Kontrak Segera Berakhir')
            ->body("Kontrak untuk {$employeeName} akan berakhir pada {$endDate}.")
            ->icon('heroicon-o-document-text')
            ->danger()
            ->getDatabaseMessage();
    }
}
