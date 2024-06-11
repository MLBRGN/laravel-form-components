<?php

namespace Mlbrgn\LaravelFormComponents\View\Components;

use Mlbrgn\LaravelFormComponents\Traits\HandlesDefaultAndOldValue;
use Mlbrgn\LaravelFormComponents\Traits\HandlesValidationErrors;
use Mlbrgn\LaravelFormComponents\View\FormBaseComponent;

class Input extends FormBaseComponent
{
    use HandlesDefaultAndOldValue;
    use HandlesValidationErrors;

    public $value;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public string $name,
        $bind = null,
        $default = null,
        $language = null,
        public string $label = '',
        public string $type = 'text',
        bool $showErrors = true,
        public bool $horizontal = false,
        public bool $floating = false,
        public bool $required = false,
        public bool $hidden = false
    ) {

        $this->showErrors = $showErrors;

        if ($language) {
            $this->name = "{$name}[{$language}]";
        }

        $this->setValue($name, $bind, $default, $language);
    }
}
