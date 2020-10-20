<?php

namespace App\View\Components;

use Illuminate\View\Component;

class NewForm extends Component
{
    public $new;

    public function __construct($new)
    {
        $this->new = $new;
    }

    public function render()
    {
        return view('components.new-form', ['new' => $this->new]);
    }
}
