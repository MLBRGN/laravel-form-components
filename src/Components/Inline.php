<?php

namespace Mlbrgn\LaravelFormComponents\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Inline extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $action,
        public string $tooltip,
        public string $method = 'POST',
    ) {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $buttonType = Str::lower($this->method) === 'delete' ? 'danger' : 'primary';

        return view('components.form.inline', [
            'buttonType' => $buttonType,
        ]);
    }
}
