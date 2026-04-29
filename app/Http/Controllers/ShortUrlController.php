<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Url;
use App\Models\UrlClick;
use Illuminate\Http\Request;

class ShortUrlController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(string $shortCode)
    {
        $url = Url::where('short_code', $shortCode)->firstOrFail();
        $redirect = $url->original_url;
        $urlClicks = UrlClick::where('url_id', $url->id)
            ->where('clicked_at', now()->toDateString())
            ->first();
        if (is_null($urlClicks)){
            UrlClick::create([
                'user_id' => $url->user_id,
                'company_id' => $url->company_id,
                'url_id' => $url->id,
                'clicked_at' => now()->toDateString(),
                'count' => 1
            ]);
        }else{
            $urlClicks->increment('count');
        }
        return redirect()->to($redirect);
    }
}
