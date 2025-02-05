<?php

namespace App\View\Components;

use Illuminate\View\Component;

class InputFile extends Component
{
    public $label, $name, $type, $placeholder, $value, $required;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label, $name, $placeholder="", $value=null, $required=true)
    {
        $this->label = $label;
        $this->name = $name;
        $this->placeholder = $placeholder;
        $this->value = $value;
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.input-file');
    }
}
