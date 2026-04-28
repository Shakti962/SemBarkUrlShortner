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
                ->limit(5)->get();
            $companies = Company::withCount(['users', 'urls', 'urlClicks'])->limit(5)->get();
        } elseif ($authUser->isAdmin()) {
            $data = Url::with(['user', 'clicks' => fn($q) => $q->where('clicked_at', '>=', $date)])
                ->where('company_id', $authUser->company_id)
                ->limit(5)->get();
            $team = User::withCount(['urls', 'urlClicks'])
                ->where('company_id', $authUser->company_id)
                ->limit(5)->get();
        } else {
            $data = Url::with(['user', 'clicks' => fn($q) => $q->where('clicked_at', '>=', $date)])
                ->where('user_id', $authUser->id)
                ->limit(5)->get();
        }
        return view('livewire.dashboard-data', [
            'urlData' => $data,
            'companies' => $companies ?? null,
            'team' => $team ?? null,
        ]);
    }
}
