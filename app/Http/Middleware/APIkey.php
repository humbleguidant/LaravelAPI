<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
/**
 * Author: Aubrey Nickerson
 * Date: May 25th, 2021
 * Program: APIkey.php
 * Project: Global Protection Code Challenge
 */
class APIkey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        /** If the API key from the user request does not equal the
         *  API key in the .env file then return a 401 'Unauthorized'
         *  response in JSON.
        */
         if ($request->api_token != env('API_KEY')) {
            return response()->json('Unauthorized', 401);
        }

        return $next($request);
    }
}
