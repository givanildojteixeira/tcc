<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CheckboxConfig extends Component
{
    public string $chave;
    public string $label;

    public function __construct(string $chave, string $label = '')
    {
        $this->chave = $chave;
        $this->label = $label ?: ucfirst(str_replace('_', ' ', $chave));
    }

    public function render(): \Illuminate\View\View
    {
        return view('components.checkbox-config');
    }
}
