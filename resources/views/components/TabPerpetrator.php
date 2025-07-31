<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class TabPerpetrator extends Component
{
    public $oldData;

    public function __construct($oldData = [])
    {
        $this->oldData = $oldData;
    }

    public function render()
    {
        return view('components.form.tab-perpetrator');
    }
}
