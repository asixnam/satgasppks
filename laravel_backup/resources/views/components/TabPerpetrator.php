<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class TabPerpetrator extends Component
{
    public $oldData;
    public $editData;

    /**
     * Create a new component instance.
     *
     * @param array $oldData
     * @param mixed $editData
     */
    public function __construct($oldData = [], $editData = null)
    {
        $this->oldData = $oldData;
        $this->editData = $editData;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.tab-perpetrator');
    }
}