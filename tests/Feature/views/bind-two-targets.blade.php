@php
    $targetA = [
        'input' => 'a',
        'textarea' => 'b',
        'select' => 'c',
        'checkbox' => true,
        'radio' => true
    ];

    $targetB = [
        'input' => 'd',
        'textarea' => 'e',
        'select' => 'f',
        'checkbox' => false,
        'radio' => false
    ];
@endphp

<x-form-form>
    @bind($targetA)
        <x-form-input name="input" />

        @bind($targetB)
            <x-form-textarea name="textarea" />
            <x-form-select name="select" :options="['c' => 'c', 'f' => 'f']" />
            <x-form-checkbox name="checkbox" />
        @endbind

        <x-form-radio name="radio" />

        <x-form-submit />
    @endbind
</x-form-form>
