<?php
namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Subscription;
use App\Models\Task;
use App\Models\User;
use App\Models\Workspace;
use Barryvdh\DomPDF\Facade\Pdf;

use SimpleSoftwareIO\QrCode\Facades\QrCode;


class AdminController extends Controller
{
    //
    public function dashboard()
    {

        // Stat generale
        $stats = [
            "users"                => User::count(),
            "workspaces"           => Workspace::count(),
            "boards"               => Board::count(),
            "tasks"                => Task::count(),
            "active_subscriptions" => Subscription::where("status", "active")->count(),
        ];

        //Derniers utilisateurs inscrit
        $recentUsers = User::latest()->take(5)->get();

        //Derniers workspaces crééé
        $recentWorkspaces = Workspace::with('owner')->latest()->take(5)->get();

        //Répartitions des tache par état
        $taskStatusDistribution = Task::selectRaw('state, count(*) as count')
            ->groupBy('state')
            ->get()
            ->pluck('count', 'state');

        // Plans de souscription
        $subscriptionPlans = Subscription::selectRaw('plan, count(*) as count')
            ->groupBy('plan')
            ->get()
            ->pluck('count', 'plan');

        // dd($taskStatusDistribution);

        return view('admin', compact(
            "stats",
            "recentUsers",
            "recentWorkspaces",
            'taskStatusDistribution',
            'subscriptionPlans'
        ));

    }

    public function exportPDF()
    {
        $data = [
            'users'         => User::all(),
            'workspaces'    => Workspace::with('owner')->get(),
            'boards'        => Board::with('workspace')->get(),
            'tasks'         => Task::with(['board', 'assignedUser'])->get(),
            'subscriptions' => Subscription::with('user')->get(),
            'generated_at'  => now()->format('d/m/Y H:i'),
        ];

        $pdf = Pdf::loadView('pdf.rapport', $data);

        return $pdf->download('rapport-admin-' . now()->format('Y-m-d') . '.pdf');

    }

    public function generateQrCode()
    {
        // Configuration allégée et compatible sans Imagick
        $qrConfig = [
            'content'          => 'https://elegance-en-voile.com/shop?promo=VIP',
            'size'             => 300,
            'color'            => [255, 20, 147],
            'bg_color'         => [255, 255, 255], // fond blanc au lieu de noir
            'margin'           => 1,
            'format'           => 'svg', // ✅ SVG ne nécessite pas imagick
            'error_correction' => 'H',
            'style'            => 'round', 
             'eye_style'        => 'circle',  
        ];

        // Création du QR code avec une config allégée
        $qrCode = QrCode::size($qrConfig['size'])
            ->color($qrConfig['color'][0], $qrConfig['color'][1], $qrConfig['color'][2])
            ->backgroundColor(
                $qrConfig['bg_color'][0],
                $qrConfig['bg_color'][1],
                $qrConfig['bg_color'][2]
            )
            ->margin($qrConfig['margin'])
            ->format($qrConfig['format'])
            ->errorCorrection($qrConfig['error_correction']);

        // Génération finale
        $generatedQrCode = $qrCode->generate($qrConfig['content']);

        return view('qr-code', [
            'qrCode' => $generatedQrCode,
            'config' => $qrConfig,
        ]);
    }

}
