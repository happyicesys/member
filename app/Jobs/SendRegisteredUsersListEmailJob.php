<?php

namespace App\Jobs;

use App\Models\User;
use App\Mail\RegisteredUsers;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Rap2hpoutre\FastExcel\FastExcel;

class SendRegisteredUsersListEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $remotePath;

    public function handle(): void
    {
        // 1. Get users
        $users = User::with('phoneCountry')->oldest()->get();

        // 2. Map export data
        $exportData = $users->map(function ($user) {
            return [
                'Name' => $user->name,
                'Email' => $user->email,
                'Date of Birth' => $user->dob ? \Carbon\Carbon::parse($user->dob)->format('Y-m-d') : '',
                'Country Code' => $user->phoneCountry->phone_code ?? 'N/A',
                'Phone Number' => $user->phone_number,
                'Created At' => $user->created_at->format('Y-m-d H:i:s'),
                'Reference ID' => $user->ref_id,
                'Member ID' => $user->id,
                'Is Claim Free Ice Cream' => $user->is_one_time_voucher_used ? 'Yes' : 'No',
            ];
        });

        // 3. Export to local temp path
        $tempPath = storage_path('app/temp_registered_users.xlsx');
        (new FastExcel($exportData))->export($tempPath);

        // 4. Upload to DigitalOcean Spaces
        $this->remotePath = 'exports/excels/registered/' . now()->format('Ymd_His') . '.xlsx';
        Storage::disk('digitaloceanspaces')->put($this->remotePath, fopen($tempPath, 'r+'), 'public');

        // 5. Delete temp file
        unlink($tempPath);

        // 6. Send email with attachment from Spaces
        Mail::to([
            'sean_lee@foodleague.com.sg',
            'daniel.ma@happyice.com.sg',
            'kent@happyice.com.sg',
            'brianlee@happyice.com.my',
            // 'leehongjie91@gmail.com'
        ])->send(new RegisteredUsers($this->remotePath));
    }
}
