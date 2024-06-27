<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Business;
use App\Models\View;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ViewsSeeder extends Seeder
{
    public function run()
    {
        $businesses = Business::all();

        foreach ($businesses as $business) {
            for ($i = 0; $i < 7; $i++) {
                $date = Carbon::now()->subDays($i);
                
                // Seed multiple views per day
                for ($j = 0; $j < rand(5, 20); $j++) {
                    View::create([
                        'business_id' => $business->id,
                        'user_id' => null, // or set a specific user_id if needed
                        'ip_address' => '127.0.0.' . rand(1, 255),
                        'created_at' => $date->copy()->addMinutes(rand(0, 1440)),
                        'updated_at' => $date->copy()->addMinutes(rand(0, 1440)),
                    ]);
                }

                // Seed unique views per day
                $uniqueIps = collect();
                for ($j = 0; $j < rand(2, 10); $j++) {
                    $ip = '127.0.0.' . rand(1, 255);
                    if (!$uniqueIps->contains($ip)) {
                        $uniqueIps->push($ip);
                        View::create([
                            'business_id' => $business->id,
                            'user_id' => null, // or set a specific user_id if needed
                            'ip_address' => $ip,
                            'created_at' => $date->copy()->addMinutes(rand(0, 1440)),
                            'updated_at' => $date->copy()->addMinutes(rand(0, 1440)),
                        ]);
                    }
                }
            }
        }
    }
}
