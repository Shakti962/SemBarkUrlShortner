<?php

namespace App\Livewire;

use App\Models\Company;
use App\Models\Invite;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ManageInvite extends Component
{
    public Collection $companies;
    #[Validate('required|email|exists:users,email')]
    public string $email;
    #[Validate('required|integer|exists:companies,id')]
    public string $company_id;
    #[Validate('required|in:admin,member')]
    public string $role = 'member';
    public function mount(){
        $authUser = Auth::user();
        $this->companies = Company::select(['id', 'name'])
            ->when(!$authUser->isSuperAdmin(), fn($q) => $q->where('id', $authUser->company_id))
            ->get();
        $this->company_id = $authUser->company_id ?? $this->companies->first()?->id;
    }
    public function invite(){
        $authUser = Auth::user();
        $this->validate();
        $sendTo = User::where('email', $this->email)->first();
        if (is_null($sendTo->company_id)){
            $sendTo->update([
                'company_id' => $this->company_id,
                'role' => $this->role
            ]);
        }else{
            Invite::create([
                'send_by' => $authUser->id,
                'send_to' => $sendTo->id,
                'company_id' => $this->company_id,
                'role' => $this->role
            ]);
        }
        $this->reset(['email']);
    }
    public function accept($id){
        try{
            $invite = Invite::findOrFail($id);
            Auth::user()->update([
                'company_id' => $invite->company_id,
                'role' => $invite->role
            ]);
            $invite->delete();
            return redirect(request()->header('Referer'));
        }catch(Exception $e){
            throw $e;
        }
    }
    public function reject($id){
        try{
            $invite = Invite::findOrFail($id);
            $invite->delete();
        }catch(Exception $e){
            throw $e;
        }
    }
    public function render()
    {
        $authUser = Auth::user();
        $invites = Invite::with(['sendBy', 'company'])->where('send_to', $authUser->id)->get();
        return view('livewire.manage-invite', ['invites' => $invites]);
    }
}
