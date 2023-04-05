<?php

namespace App\Http\Controllers;

use App\Models\BlockIps;
use App\Models\Server;
use App\Models\Votes;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class VoteController extends Controller
{

    public function cleanUpURL($url): string
    {
        $url = str_replace("www.", "", $url);
        $url = str_replace("http://", "", $url);
        $url = str_replace("https://", "", $url);
        return rtrim($url, "/");
    }

    public function getVotePage(Request $request)
    {
        $referer = $request->headers->get('referer');
        $domainList = Server::all()->pluck('url')->toArray();
        $referer = self::cleanUpURL($referer);
        foreach ($domainList as &$domain) {
            $domain = self::cleanUpURL($domain);
        }
        if (($referer != null && in_array($referer, $domainList)) || str_contains($referer, "https://www.metin2toplist.eu")) {
            $serverToken = $request->serverToken;
            $accountId = $request->accountId;
            if (isset($serverToken) && isset($accountId)) {
                $server = Server::where('server_token', $serverToken)->first();
                if (isset($server)) {
                    $clientIP = $this->getIp();
                    if ($server->checkIp == 1 && !isset($request->accountIp)) {
                        return view('error')->withErrors('Wrong settings');
                    } else if ($server->checkIp == 1 && $clientIP != trim($request->accountIp)) {
                        return view('error')->withErrors('Wrong ip');
                    }
                    return view('vote', ['serverToken' => $serverToken ?? null, 'accountId' => $accountId ?? null]);
                }
                return view('error')->withErrors('Unknown server');
            }
            return view('error')->withErrors('Unknown server');
        }
        return view('error')->withErrors('Unknown server');
    }

    public function getIp()
    {
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    $ip = trim($ip);
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                        return $ip;
                    }
                }
            }
        }
    }

    public function checkVote(Request $request): array
    {
        $apiToken = $request->apiToken;
        $accountId = $request->accountId;
        if (isset($apiToken) && isset($accountId)) {
            $validator = Validator::make(['apiToken' => $apiToken, 'accountId' => $accountId], [
                'apiToken' => 'required|alpha_num',
                'accountId' => 'required|numeric'
            ]);
            if ($validator->fails()) {
                return ['count' => null, 'error' => "Wrong Data"];
            } else {
                $server = Server::where('api_token', $apiToken)->first();
                if (isset($server)) {
                    $vote = Votes::where(['serverId' => $server->id, 'accountId' => $accountId])->first();
                    if (isset($vote)) {
                        if (!$vote->checked) {
                            $vote->checked = true;
                            $vote->save();
                        } else {
                            $updated_at = new DateTime($vote->updated_at);
                            return ['count' => null, 'error' => "Already Checked", 'lastVote' => $updated_at->getTimestamp()];
                        }
                        return ['count' => $vote->votes, 'lastVote' => $vote->updated_at];
                    }
                    return ['count' => null, 'error' => "No Account"];
                } else {
                    return ['count' => null, 'error' => "No Server"];
                }
            }
        } else {
            return ['count' => null, 'error' => "Wrong Data"];
        }
    }

    public function vote(Request $request)
    {
        if (isset($request->name) || isset($request->email) || isset($request->serverId) || isset($request->accountId)) {
            $blockIp = new BlockIps();
            $blockIp->ip = $request->ip();
            $blockIp->save();
            return view('error', ['msg' => 'Blocked because of Spam']);
        }

        $hCaptcha = $request->get('h-captcha-response');
        $params = [
            "secret" => env('HCAPTCHA_SECRET_KEY'),
            "response" => $hCaptcha
        ];
        $verify = curl_init();
        curl_setopt($verify, CURLOPT_URL, "https://hcaptcha.com/siteverify");
        curl_setopt($verify, CURLOPT_POST, true);
        curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($params));
        curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
        $hCaptchaResponse = curl_exec($verify);
        $responseData = json_decode($hCaptchaResponse);
        if ($responseData->success) {
            /*$captcha = $request->get('g-recaptcha-response');
            if ($captcha != null) {
                $response = file_get_contents(
                    "https://www.google.com/recaptcha/api/siteverify?secret=" . env('RECAPTCHA_SECRET_KEY') . "&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']
                );
                $response = json_decode($response);
                if ($response->success && $response->score >= 0.5) {
            */
            $serverToken = $request->Q5bHgjeKWUTRzVMLYNYfR;
            $accountId = $request->w3vQTdZHqpAvFvbj76zDv;

            if (isset($serverToken) && isset($accountId)) {

                $validator = Validator::make(['serverToken' => $serverToken, 'accountId' => $accountId], [
                    'serverToken' => 'required | alpha_num',
                    'accountId' => 'required | numeric'
                ]);

                if ($validator->fails()) {
                    return view('error')->withErrors('Wrong Data');
                } else {
                    $server = Server::where('server_token', $serverToken)->first();
                    if (isset($server)) {
                        $vote = Votes::firstOrNew(['serverId' => $server->id, 'accountId' => $accountId]);
                        if (strtotime($vote->updated_at) > strtotime(' - 24 hours')) {
                            try {
                                $nextVoteTime = date('Y - m - d H:i:s', strtotime(' + 24 hours', strtotime($vote->updated_at)));
                                $now = new DateTime("now");
                                $interval = $now->diff(new DateTime($nextVoteTime));
                                return view('error')->withErrors("Last vote was $vote->updated_at. You have to wait $interval->h hours and $interval->i minutes");
                            } catch (\Exception $e) {
                                return view('error')->withErrors("Last vote was $vote->updated_at");
                            }
                        }
                        $vote->votes = $vote->votes + 1;
                        $vote->checked = false;
                        $vote->save();
                        return view('error', ['success' => "You voted successfully. Your Votes: $vote->votes"]);
                    } else {
                        return view('error')->withErrors('No Server');
                    }
                }
            } else {
                return view('error')->withErrors('Wrong Data');
            }
        }
        return view('error')->withErrors('Captcha error ');
    }

}
