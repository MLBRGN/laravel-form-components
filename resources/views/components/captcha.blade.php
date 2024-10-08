@props([
    'callback',
    'label',
])

<div {{ $attributes->class('g-recaptcha') }}
     data-sitekey="{{ config('services.recaptcha.site-key') }}"
     data-badge="inline"
     data-size="invisible"
     data-callback="{{ $callback }}">
</div>
<x-mlbrgn-form-submit
    @class([
       $attributes->get('class-button', '') => $attributes->has('class-button')
    ])
>{{ $label }}</x-mlbrgn-form-submit>
