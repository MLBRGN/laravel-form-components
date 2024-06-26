<div {{ $attributes->onlyWrapperClasses()->class([
    'form-group',
    'is-invalid' => $hasError($name),
    'show-errors' => $showErrors,
    'required' => $attributes->has('required')
    ]) }}
>

    <x-mlbrgn-form-label
        :required="$attributes->has('required')"
{{--        @class([--}}
{{--            'col-4' => empty($attributes->get('class-label', '')),--}}
{{--            $attributes->get('class-label', '')--}}
{{--         ])--}}
{{--        :for="$id">--}}
    >{{ $label }}</x-mlbrgn-form-label>

{{--    @if(config('form-components.detect_validation_classes_in_group'))--}}
{{--        @php--}}
{{--            // Modify the slot content if it has a label or labels add class input-group-text--}}
{{--            $isValidated = Str::contains(trim($slot), ['is-invalid', 'is-valid']);--}}
{{--        @endphp--}}
{{--        detected {{ $isValidated ? 'Yes' : 'No' }}--}}
{{--    @endif--}}

{{--    <div @class([--}}
{{--        'd-flex flex-row flex-wrap inline-space' => $inline,--}}
{{--        'show-errors' => $showErrors,--}}
{{--        'required' => $attributes->has('required')--}}
{{--    ])>{{ $slot }}</div>--}}

    @if($inline)
    <div
        {{ $attributes->exceptWrapperClasses()->only('class')->class(['d-flex flex-row flex-wrap inline-space', $attributes->get('class-inline-wrapper', '')]) }}
    >{{ $slot }}</div>
    @else
        {{ $slot }}
    @endif

    {{-- Client side feedback messages --}}
    @if($showErrors)
        @if(!empty($validFeedback))
            <div @class([
                        'valid-feedback' => !$tooltipFeedback,
                        'valid-tooltip' => $tooltipFeedback,
                    ])>
                {{ $validFeedback }}
            </div>
        @endif

        @if(!empty($invalidFeedback))
            <div @class([
                        'invalid-feedback' => !$tooltipFeedback,
                        'invalid-tooltip' => $tooltipFeedback,
                    ])>
                {{ $invalidFeedback }}
            </div>
        @endif
    @endif

    {{-- Help text --}}
    @isset($help)
        <x-mlbrgn-form-text :id="$id">{{ $help }}</x-mlbrgn-form-text>
    @endif

    @if(!empty($helpText) && !isset($help))
        <x-mlbrgn-form-text :id="$id">{{ $helpText }}</x-mlbrgn-form-text>
    @endif

    {{-- server side feedback messages --}}
    @if($shouldShowError($name))
        <x-mlbrgn-form-errors :name="$name" />
    @endif
</div>

{{-- TODO only  import when client side form validation--}}
@once
    <link rel="stylesheet" href="{{ package_asset('form-validation.css') }}">
@endonce
