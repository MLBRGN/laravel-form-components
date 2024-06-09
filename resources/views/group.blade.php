<div class="form-group" {!! $attributes->merge(['class' => ($hasError($name) ? 'is-invalid' : '')]) !!}>
    <x-form-label :label="$label" />

    <div class="@if($inline) d-flex flex-row flex-wrap inline-space @endif">
        {!! $slot !!}
    </div>

    {!! $help ?? null !!}

    @if($hasErrorAndShow($name))
        <x-form-rrors :name="$name" class="d-block" />
    @endif
</div>
