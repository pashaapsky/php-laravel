<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PostForm extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $item;
    public $method;

    public function __construct($item = null, $method = 'post')
    {
        $this->item = $item;
        $this->method = $method;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.post-form', ['item' => $this->item, 'method' => $this->method]);
    }
}
