<?php

namespace App\View\Components;

use App\Models\Server;
use Illuminate\View\Component;

class serverDetail extends Component
{
    public Server $server;
    public int $index;

    public function __construct(Server $server, int $index)
    {
        $this->server = $server;
        $this->index = $index;
    }

    public function render()
    {
        return view('components.server-detail');
    }
}
