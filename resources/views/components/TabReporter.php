<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class TabReporter extends Component
{
    public $oldData;

    public function __construct($oldData = [])
    {
        $this->oldData = $oldData;
    }

    public function render()
    {
        return view('components.form.tab-reporter');
    }
}
