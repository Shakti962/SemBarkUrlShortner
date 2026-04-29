<?php

namespace App\Livewire;

use App\Models\Company;
use App\Models\Url;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DashboardData extends Component
{
    public int $filterDays = 0;
    public function render()
    {
        $authUser = Auth::user();
        $date = now()->subDays($this->filterDays)->toDateString();
        if ($authUser->isSuperAdmin()) {
            $data = Url::with(['company', 'clicks' => fn($q) => $q->where('clicked_at', '>=', $date)])
                ->where('created_at', '>=', $date)
                ->orderByDesc('created_at')
                ->limit(5)->get();
            $companies = Company::with('urlClicks')->withCount(['users', 'urls'])->get();
        } elseif ($authUser->isAdmin()) {
            $data = Url::with(['user', 'clicks' => fn($q) => $q->where('clicked_at', '>=', $date)])
                ->where('company_id', $authUser->company_id)
                ->orderByDesc('created_at')
                ->limit(5)->get();
            $team = User::with('urlClicks')->withCount('urls')
                ->where('company_id', $authUser->company_id)
                ->get();
        } else {
            $data = Url::with(['user', 'clicks' => fn($q) => $q->where('clicked_at', '>=', $date)])
                ->where('user_id', $authUser->id)
                ->orderByDesc('created_at')
                ->limit(5)->get();
        }
        return view('livewire.dashboard-data', [
            'urls' => $data,
            'companies' => $companies ?? null,
            'team' => $team ?? null,
        ]);
    }
}
