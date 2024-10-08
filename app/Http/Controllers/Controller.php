<?php

namespace App\Http\Controllers;

use App\Models\Server;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\App;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    static public function setLocale($request)
    {
        App::setlocale($request);
    }

    public function getServers()
    {
        $servers = Server::where('status', 'okay')->get();
        foreach ($servers as $server) {
            $server->votesCount = $server->getVotesCount();
            if ($server->class == 0) {
                $server->class = 'Oldschool';
            } elseif ($server->class == 1) {
                $server->class = 'Middleschool';
            } elseif ($server->class == 2) {
                $server->class = 'Newschool';
            } elseif ($server->class == 3) {
                $server->class = 'PvP';
            }
        }
        $servers = $servers->sortByDesc('votesCount');
        return view('element.servers', ['servers' => $servers]);
    }
}
