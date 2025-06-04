<?php

namespace App\Http\Controllers;

use App\Models\Proposta;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function index()
    {
        $statusCounts = Proposta::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');

        return view('dashboard.index', [
            'statusCounts' => $statusCounts
        ]);
    }
}
