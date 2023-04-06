@extends('welcome')

@section('content')
    <div style="color: whitesmoke; backdrop-filter: blur(20px); min-height: 100%">
        <h3>How To implement Metin2Toplist:</h3><br>
        <span>
            <h4>API:</h4>
            The API for verifying a vote is controlled with the following parameters:<br>
        <b>URL:</b> https://api.metin2toplist.eu/QpeoTymspwObUz5dlG1D44<br>
        <b>Data:</b> apiToken & accountId<br>
            Each server has its own unique API token. It is located in the
            <a style="text-decoration: none" href="{{route('dashboard')}}">dashboard</a><br>
            <b>Example (Laravel):</b>
            <p>
            <details>
            <pre>
 public static function checkVoteToplist() {
        if (Auth::check()) {
            $url = 'https://api.metin2toplist.eu/QpeoTymspwObUz5dlG1D44';
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_HEADER, 0);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query([
                'apiToken' => '<span style="color: coral">YOUR API-TOKEN</span>',
                'accountId' => Auth::user()->id]));
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.64 Safari/537.11');
            $data = curl_exec($curl);
            $info = curl_getinfo($curl);
            $coins = 100;
            if (!curl_errno($curl)) {
                if ($info['http_code'] == 200) {
                    $data_json = json_decode($data, true);
                    if ((isset($data_json['count']) && $data_json['count'] != '0') && isset($data_json['lastVote'])) {
                        $account = \App\Models\Account::find(Auth::user()->id);
                        $account->itemshop_coins += $coins;
                        $account->save();
                        $message = [
                            "message" => "Thanks for voting, you were credited $coins Coins.",
                            "coins" => $coins];
                    } else {
                        if (isset($data_json['lastVote'])) {
                            $message = [
                                "message" => "You have already voted! You can only vote every 24 hours. Last vote: $data_json['lastVote']" ];
                        } else {
                            $message = ["message" => $data_json['error']];
                        }
                    }
                } else {
                    $message = ["message" => "Error: API URL cannot be reached."];
                }
            } else {
                $message = ["message" => "Error: cURL does not appear to be installed or functioning properly."];
            }
        } else {
            $message = ["message" => "Please login again"];
        }
        return $message;
    }
                </pre>
                </details>
            </p>
            <b>Return parameter API:</b>
            <p>
            <details>
            <ul>
                <li><b>count: </b>null || number of votes for this account</li>
                <li><b>error: </b>error message <span style="color: coral">(optional)</span></li>
                <li><b>lastVote: </b>timestamp of the last vote <span style="color: coral">(optional)</span></li>
            </ul>
                </details>
            </p>
    </span>
        <br> <br>
        <span>
            <h4>Vote:</h4>
            The voting page has some security mechanisms. <br>
            It checks if the request has been checked by the DDOS protection or if you come directly from the URL of the server you want to vote for.<br>
            <span
                style="color: coral">That is why it is important that you specify the correct url in the dashboard!</span><br>
              <b>Example (Laravel):</b>
            <p>
            <details>
            <pre>
&#64;if(Auth::check())
    &lt;script type=&quot;text/javascript&quot;&gt;
        function votePopup(url) {
            let popup = window.open(url, &quot;Vote4Coins&quot;, &quot;width=1150,height=750,status=yes,scrollbars=yes,resizable=yes&quot;);
            popup.focus();
        }

        function checkVote(url) {
            $.ajax({
                type: &apos;GET&apos;, url: url, data: &apos;_token = &lt;?php echo csrf_token() ?&gt;&apos;, success: function (result) {
                    document.getElementById(&apos;infoText&apos;).innerText = result[&apos;message&apos;]
                }
            })
        }
    &lt;/script&gt;
    &lt;div id=&quot;infoText&quot;&gt;&lt;/div&gt;
    &lt;div&gt;
        &lt;h4&gt;Metin2Toplist.eu&lt;/h4&gt;
        &lt;div&gt;
            &lt;button onclick=&quot;votePopup(&apos;https://www.metin2toplist.eu/myUnKHdjFHypUqthVZZmE?serverToken=<span
                    style="color: coral">YOUR SERVER-TOKEN</span>&accountId=&#123;&#123;Auth::user()->id&#125;&#125;&apos;)&quot;&gt;
                vote
            &lt;/button&gt;
            &lt;button class=&quot;btn btn-dark&quot; onclick=&quot;checkVote(&apos;&#123;&#123;route(&apos;checkVoteToplist&apos;)&#125;&#125;&apos;)&quot;&gt;
                check vote
            &lt;/button&gt;
        &lt;/div&gt;
    &lt;/div&gt;
&#64;endif
                </pre>
                </details>
            </p>
        </span>
        <br> <br>
        <span>
            <h4>Example PHP (no Framework):</h4>
            Create a .PHP file and add this code. <span style="color: coral">Don't forget to change the Data.</span><br>
            <span style="color: coral">Check <b>$_SESSION['id']</b>, on some websites it's e.g. <b>$_SESSION['user_id']</b></span>
            <details>
            <pre>

&lt;?php
class Vote
{
    private $user = '<span style="color: coral">user</span>';
    private $password = '<span style="color: coral">password</span>';
    private $accountDb = '<span style="color: coral">account</span>';
    private $playerDb = '<span style="color: coral">player</span>';
    private $host = '<span style="color: coral">localhost</span>';
    private $port = <span style="color: coral">3306</span>;

    var $config = array(
        'coins' => <span style="color: coral">100</span>,
        'serverToken' => '<span style="color: coral">YOUR SERVER-TOKEN</span>',
        'apiToken' => '<span style="color: coral">YOUR API-TOKEN</span>',
    );
    public function checkVoteToplist()
    {
        $url = 'https://api.metin2toplist.eu/QpeoTymspwObUz5dlG1D44';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query([
            'apiToken' => $this->config['apiToken'],
            'accountId' => $_SESSION['id']]));
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.64 Safari/537.11');
        $data = curl_exec($curl);
        $info = curl_getinfo($curl);
        if (!curl_errno($curl)) {
            if ($info['http_code'] == 200) {
                $data_json = json_decode($data, true);
                if ((isset($data_json['count']) && $data_json['count'] != '0') && isset($data_json['lastVote'])) {
                    $connection = mysqli_connect($this->host, $this->user, $this->password, $this->accountDb);
                    if (mysqli_connect_errno()) {
                        echo "Failed to connect to MySQL: " . mysqli_connect_error();
                        exit();
                    }
                    mysqli_query($connection, "UPDATE account SET `coins` = (`coins` + " . $this->config['coins'] . ") WHERE `id` = '" . $_SESSION['id'] . "' LIMIT 1;");
                    mysqli_close($connection);
                    echo "Thanks for voting, you were credited " . $this->config['coins'] . " Coins.";
                } else {
                    if (isset($data_json['lastVote'])) {
                        echo "You have already voted! You can only vote every 24 hours. Last vote: " . date('Y-M-d H:i:s', $data_json['lastVote']);
                    } else {
                        echo $data_json['error'];
                    }
                }
            } else {
                echo "Error: API URL cannot be reached.";
            }
        }
        curl_close($curl);
    }
}

$vote = new Vote();

if (isset($_POST['checkVote']) && isset($_SESSION['id'])) {
    $vote->checkVoteToplist();
}
$connection = mysqli_connect($this->host, $this->user, $this->password, $this->playerDb);
if (mysqli_connect_errno()) {
    echo("Failed to connect to MySQL: " . mysqli_connect_error());
} else {
    $player = mysqli_query($connection, "SELECT name,ip FROM player WHERE `account_id` = '" . $_SESSION['id'] . "' LIMIT 1;");
    mysqli_close($connection);
}
 ?&gt;
&lt;div class="container"&gt;
	&lt;h2&gt;Vote 4 Coins&lt;/h2&gt;
	&lt;script type="text/javascript"&gt;
        function votepopup(url) {
            let popup = window.open(url, "Vote4Coins", "width=1150,height=750,status=yes,scrollbars=yes,resizable=yes");
            popup.focus();
        }
	&lt;/script&gt;
	&lt;?php if(isset($_SESSION['id'])){?&gt;
		&lt;h4&gt;Metin2Toplist.eu&lt;/h4&gt;
		&lt;div style="display: flex;justify-content:space-evenly;"&gt;
			&lt;button class="btn btn-dark"
                    onclick="votepopup('https://www.metin2toplist.eu/myUnKHdjFHypUqthVZZmE?serverToken=c0a63abdecb0f571056bfc2c48435e37f266dd02889d939b51d92e2ebf67fb8a&accountId=&lt;?= $_SESSION['id']?&gt;'&playerIp=&lt;?= $player['ip'] ?&gt;&playerName=&lt;?= $player['name'] ?&gt;)" &gt;
				vote
			&lt;/button&gt;
			&lt;form action="?" method="POST"&gt;
				&lt;input class="btn btn-dark" type="submit" name="checkVote" id="button" value="Check vote" /&gt;
			&lt;/form&gt;
		&lt;/div&gt;
	&lt;?php }?&gt;
&lt;/div&gt;

            </pre>
                </details>
            </p>
        </span>
    </div>
@endsection
