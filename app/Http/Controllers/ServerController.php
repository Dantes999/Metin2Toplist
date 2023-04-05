<?php

namespace App\Http\Controllers;

use App\Models\Server;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class ServerController extends Controller
{
    public function createServer(Request $request)
    {
        $request->validate([
            'server_name' => 'required|max:100',
            'server_level' => 'numeric|max:9999',
            'server_desc' => 'max:100',
            'server_url' => 'max:50',
        ]);
        if (Auth::check()) {
            $server = new Server;
            $server->userId = Auth::id();
            $server->name = $request->server_name;
            if (isset($request->server_desc)) {
                $server->desc = $request->server_desc;
            }
            if (isset($request->server_url)) {
                $server->url = $request->server_url;
            }
            if (isset($request->server_class)) {
                $server->class = $request->server_class;
            }
            if (isset($request->server_lang)) {
                $server->lang = $request->server_lang;
            }
            if (isset($request->server_level)) {
                $server->level = $request->server_level;
            }
            $token = Str::random(60);
            $api_token = hash('sha256', $token);
            $server->api_token = $api_token;

            $token = Str::random(60);
            $server_token = hash('sha256', $token);
            $server->server_token = $server_token;

            $server->status = 'check';

            if (isset($request->server_banner)) {
                if ($request->server_banner->getSize() > 8000000) {
                    return redirect()->route("dashboard")->withErrors('Banner is too big. Max 8MB.');
                }
                $allowedFileExtension = ['jpg', 'png', 'jpeg', 'gif', 'mp4'];
                if (!in_array($request->server_banner->extension(), $allowedFileExtension)) {
                    return redirect()->route("dashboard")->withErrors('Wrong file extension! Allowed: ' . implode(', ', $allowedFileExtension));
                }
                $name = substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(40 / strlen($x)))), 1, 40);
                $request->server_banner->move(public_path('banners'), $name . $request->server_banner->getClientOriginalName());
                $server->banner = $name . $request->server_banner->getClientOriginalName();
            } else {
                $server->banner = 'example_banner.png';
            }

            $server->save();
            return redirect()->route("dashboard")->withSuccess('Server created');
        }
        return redirect()->route("dashboard")->withErrors('Oppes! Something went wrong');

    }

    public function updateServer(Request $request)
    {
        $request->validate([
            'server_level' => 'numeric|max:9999',
            'server_lang' => 'max:30',
            'server_desc' => 'max:100',
            'server_name' => 'max:100',
            'server_url' => 'max:50',
        ]);

        if (Auth::check()) {
            $server = Server::find($request->serverId);
            if (isset($server)) {
                if (isset($request->server_name)) {
                    $server->name = $request->server_name;
                }
                if (isset($request->server_desc)) {
                    $server->desc = $request->server_desc;
                }
                if (isset($request->server_url)) {
                    $server->url = $request->server_url;
                }
                if (isset($request->api_token)) {
                    $server->api_token = $request->api_token;
                }
                if (isset($request->server_token)) {
                    $server->server_token = $request->server_token;
                }
                if (isset($request->server_lang)) {
                    $server->lang = $request->server_lang;
                }
                if (isset($request->server_level)) {
                    $server->level = $request->server_level;
                }
                if (isset($request->server_class)) {
                    $server->class = $request->server_class;
                }
                if (isset($request->server_banner)) {
                    if ($request->server_banner->getSize() > 8000000) {
                        return redirect()->route("dashboard")->withErrors('Banner is too big. Max 8MB.');
                    }
                    $allowedFileExtension = ['jpg', 'png', 'jpeg', 'gif', 'mp4'];
                    if (!in_array($request->server_banner->extension(), $allowedFileExtension)) {
                        return redirect()->route("dashboard")->withErrors('Wrong file extension! Allowed: ' . implode(', ', $allowedFileExtension));
                    }
                    $name = substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(40 / strlen($x)))), 1, 40);
                    $request->server_banner->move(public_path('banners'), $name . $request->server_banner->getClientOriginalName());
                    $server->banner = $name . $request->server_banner->getClientOriginalName();
                }
                $server->save();
                return redirect()->route("dashboard")->withSuccess('Server updated');
            }
            return redirect()->route("dashboard")->withErrors('Server not found');
        }
        return redirect()->route("dashboard")->withErrors('Oppes! Something went wrong');
    }
}
