<?php

namespace Mlbrgn\LaravelFormComponents\View;

use Illuminate\Support\Str;
use Illuminate\View\Component;

abstract class FormBaseComponent extends Component
{
    /**
     * ID for this component.
     *
     * @var string
     */
    private $id;

    /**
     * {@inheritDoc}
     */
    public function render()
    {
        return view(config('form-components.view_namespace') . "::" . Str::kebab(class_basename($this)));
    }

    /**
     * Generates an ID, once, for this component.
     *
     * @return string
     */
    public function id(): string
    {
        if ($this->id) {
            return $this->id;
        }

        if ($this->name) {
            return $this->id = $this->generateIdByName();
        }

        return $this->id = Str::random(4);
    }

    /**
     * Generates an ID by the name attribute.
     *
     * @return string
     */
    protected function generateIdByName(): string
    {
        return "auto_id_" . $this->name;
    }

    /**
     * Converts a bracket-notation to a dotted-notation
     *
     * @param string $name
     * @return string
     */
    protected static function convertBracketsToDots($name): string
    {
        return str_replace(['[', ']'], ['.', ''], $name);
    }
}