<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class TabClient extends Component
{
    public $oldData;

    public function __construct($oldData = [])
    {
        $this->oldData = $oldData;
    }

    public function render()
    {
        return view('components.form.tab-client');
    }
}
