<?php

namespace App\Livewire;

use App\Models\Url;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ManageUrl extends Component
{
    use WithPagination, WithoutUrlPagination;
    public int $filterDays = 0;
    #[Validate('required|min:5')]
    public string $url;
    public function generate(){
        $this->validate();
        $authUser = Auth::user();
        $uuid = Str::random(12);
        $authUser->urls()->create([
            'company_id' => $authUser->company_id,
            'original_url' => $this->url,
            'short_code' => $uuid,
        ]);
        $this->reset(['url']);
    }
    public function render()
    {
        $authUser = Auth::user();
        $date = now()->subDays($this->filterDays)->toDateString();
        if ($authUser->isSuperAdmin()) {
            $data = Url::with(['company', 'clicks' => fn($q) => $q->where('clicked_at', '>=', $date)])
                ->where('created_at', '>=', $date)
                ->orderByDesc('created_at')
                ->paginate(10);
        } elseif ($authUser->isAdmin()) {
            $data = Url::with(['user', 'clicks' => fn($q) => $q->where('clicked_at', '>=', $date)])
                ->where('created_at', '>=', $date)
                ->where('company_id', $authUser->company_id)
                ->orderByDesc('created_at')
                ->paginate(10);
        } else {
            $data = Url::with(['user', 'clicks' => fn($q) => $q->where('clicked_at', '>=', $date)])
                ->where('created_at', '>=', $date)
                ->where('user_id', $authUser->id)
                ->orderByDesc('created_at')
                ->paginate(10);
        }
        return view('livewire.manage-url', ['urls' => $data]);
    }
}
