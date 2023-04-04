<?php

namespace App\Http\Controllers;

use App\Models\Server;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

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
        $servers = array_values($servers->sortByDesc('votesCount')->toArray());
        return view('element.servers', ['servers' => $servers]);
    }
}
