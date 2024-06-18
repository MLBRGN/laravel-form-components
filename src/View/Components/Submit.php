<?php

namespace Mlbrgn\LaravelFormComponents\View\Components;

use Mlbrgn\LaravelFormComponents\View\FormBaseComponent;

class Submit extends FormBaseComponent
{
    public function __construct(
        public string $type = 'button',
        public string $classButton = 'btn-primary',
        public string $name = '',
        public bool $hidden = false
    ) {

    }
}
