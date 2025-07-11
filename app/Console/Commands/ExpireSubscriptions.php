<?php
namespace App\Console\Commands;

use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ExpireSubscriptions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:expire-subscriptions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();

        $subscriptions = Subscription::where("status", "active")->get();

        foreach ($subscriptions as $sub) {

            $exp= Carbon::parse($sub->date_expiration);
            
            $diffSeconds = $exp->timestamp - $now->timestamp;

            if ($diffSeconds < 0) {
                info("⛔ Abonnement expiré depuis " . abs($diffSeconds) . " secondes.");
            } elseif ($diffSeconds === 0) {
                $sub->delete();
            } else {
               info("✅ Il reste encore $diffSeconds secondes avant expiration.");
            }

            info($diffSeconds);

        }

        // info($now);

    }
}
