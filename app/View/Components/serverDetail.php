<?php

namespace App\View\Components;

use Illuminate\View\Component;

class serverDetail extends Component
{
    public $server;
    public int $index;

    public function __construct($server, int $index)
    {
        $this->server = $server;
        $this->index = $index;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.server-detail');
    }
}
