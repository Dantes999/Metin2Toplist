<?php

namespace App\Http\Controllers;

use App\Models\Server;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public static function getAdminPage()
    {
        if (Auth::user()->isAdmin()) {
            $serversCheck = Server::where('status', 'check')->get();
            $serversBlock = Server::where('status', 'block')->get();
            $serversOkay = Server::where('status', 'okay')->get();
            foreach ($serversCheck as $server) {
                $server->votesCount = $server->getVotesCount();
            }
            foreach ($serversBlock as $server) {
                $server->votesCount = $server->getVotesCount();
            }
            foreach ($serversOkay as $server) {
                $server->votesCount = $server->getVotesCount();
            }
            return view('admin', [
                'serversCheck' => $serversCheck,
                'serversBlock' => $serversBlock,
                'serversOkay' => $serversOkay,
                'users' => User::all()
            ]);
        }
        return redirect()->route("login")->withErrors('Opps! You do not have access');
    }

    public static function ServerStatus(Request $request)
    {
        if (Auth::user()->isAdmin()) {
            $serverId = $request->serverId;
            $server = Server::find($serverId);
            if (isset($server)) {
                if (isset($request->block)) {
                    if ($request->block) {
                        $server->status = 'block';
                    } else {
                        $server->status = 'okay';
                    }
                    $server->save();
                }
                return self::getAdminPage();
            }
            return redirect()->route("login")->withErrors('No Server found');
        }
        return redirect()->route("login")->withErrors('Opps! You do not have access');
    }
}
