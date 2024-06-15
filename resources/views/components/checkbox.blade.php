@if(!$toggle)
<div @class([
    'form-check',
    'form-switch' => $attributes->get('switch'),
    'form-check-inline' => $attributes->get('inline'),
    ])>
@endif

    <input
        {{ $attributes->class([
            'form-check-input' => !$toggle,
            'btn-check' => $toggle,
            'is-invalid' => $hasError($name)
        ]) }}
        type="checkbox"
        value="{{ $value }}"
        name="{{ $name }}"
        @if($label)
            id="{{ $getId() }}"
        @endif
        @if($checked)
            checked="checked"
        @endif
        @if(isset($help))
            aria-describedby="{{ $getId() }}-help-text"
        @endif
    >

    <x-form-label
        :parentClasses="$attributes->get('class')"
        @class([
            'form-check-label' => !$toggle,
            'btn' => $toggle,
            $classButton,
            $classLabel
        ])
        :for="$getId()">
        {{ $label }}
    </x-form-label>

    @if(isset($help))
        <x-form-text :id="$getId()">{{ $help }}</x-form-text>
    @endif

    @if($shouldShowError($name))
        <x-form-errors :name="$name" />
    @endif

@if(!$toggle)
</div>
@endif
