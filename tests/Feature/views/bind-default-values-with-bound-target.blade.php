@php
    $target = [
        'input' => 'a',
        'textarea' => 'b',
        'select' => 'c',
        'checkbox' => false,
        'radio' => false
    ];
@endphp

<x-form-form>
    @bind($target)
        <x-form-input default="d" name="input" />
        <x-form-textarea default="e" name="textarea" />
        <x-form-select default="f" name="select" :options="['' => '', 'c' => 'c', 'f' => 'f']" />
        <x-form-checkbox :default="true" name="checkbox" />
        <x-form-radio :default="true" name="radio" />
    @endbind
</x-form-form>
