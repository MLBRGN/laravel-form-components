{{-- NOTE: type="file|button|reset|submit|image" inputs do not have support value / setting value --}}

{{-- Handle different input types, by using the right component --}}
@if(in_array($type, ['button', 'reset', 'submit']))
    @include('form-components::button', [
        'type' => $type,
        'slot' => $attributes->get('value')
    ])
@elseif(in_array($type, ['checkbox', 'radio']))
    @include('form-components::' . $type, [
        'toggle' => $attributes->has('toggle'),
        'checked' => $attributes->has('checked'),
        'labelButton' => ''
    ])
@else

    {{-- Wrapper for floating or horizontal controls, classes go on the wrapper, other attributes on control itself --}}
    @if($floating || $horizontal)
        <div
            {{ $attributes->onlyWrapperClasses()->class([
                'row' => $horizontal,
                'form-floating' => $floating
            ]) }}
        >
    @endif

    {{-- label before control --}}
    @if(!$hidden && $type !== 'hidden')
        @if(!$attributes->has('label-end') && (!$floating || $horizontal))
            <x-mlbrgn-form-label
                :parentClasses="$attributes->get('class')"
                :required="$attributes->has('required') && $type !== 'range'"
                @class([
                    $attributes->get('class-label', ''),
                    'col-4' => $horizontal && empty($attributes->get('class-horizontal-cols-label', '')),
                    $attributes->get('class-horizontal-cols-label', '')
                ])
                :for="$id">
                {{ $label }}
            </x-mlbrgn-form-label>
        @endif
    @endif

    {{-- horizontal control wrapper --}}
    @if($horizontal)
        <div
            @class([
                'col-8' => empty($attributes->get('class-horizontal-cols-control', '')),
                $attributes->get('class-horizontal-cols-control', '') => !empty($attributes->get('class-horizontal-cols-control', ''))
            ])
        >
    @endif

            {{-- Input element --}}
            <input
                @if(!$floating && !$horizontal)
                    {{ $attributes->class([
                        'form-control' => $type !== 'range' && $type !== 'image',
                        'form-range' => $type === 'range',
                        'form-control-color' => ($type === 'color'),
                        'is-invalid' => ($hasError($name)),
                    ])->whereDoesntStartWith('class-')->except(['label-end', 'id', 'alt']) }}
                @else
                    {{ $attributes->exceptWrapperClasses()->class([
                        'form-control' => $type !== 'range' && $type !== 'image',
                        'form-range' => $type === 'range',
                        'form-control-color' => ($type === 'color'),
                        'is-invalid' => ($hasError($name)),
                    ])->whereDoesntStartWith('class-')->except(['label-end', 'id', 'alt']) }}
                @endif
                type="{{ $type }}"
                @if(!in_array($type, ['file', 'image']))
                    value="{{ $value ?? ($type === 'color' ? '#000000' : '') }}"
                @endif
                @if($name)
                    name="{{ $name }}"
                @endif
                id="{{ $id }}"
                @if ($hidden)
                    hidden
                @endif
                @if($type === 'image')
                    {{-- image button must have alt attribute --}}
                    alt="{{ $attributes->get('alt', '&nbsp;') }}"
                @endif
                @if((isset($help) || !empty($helpText)) && !$hidden && $type !== 'hidden')
                    aria-describedby="{{ $id }}-help-text"
                @endif
                {{-- floating labels won't work without placeholder, yet they never display placeholder either --}}
                @if($floating && !$attributes->has('placeholder')) placeholder="&nbsp;"@endif
            >

        {{-- client side feedback messages --}}
        @if($showErrors)
                {{-- Feedback messages --}}
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

        {{-- label after control --}}
        @if(!$hidden && $type !== 'hidden')
            @if($attributes->has('label-end') || ($floating && !$horizontal))
                <x-mlbrgn-form-label
                    :parentClasses="$attributes->get('class')"
                    :required="$attributes->has('required')"
                    @class([
                       $attributes->get('class-label', '')
                   ])
                    :for="$id">
                    {{ $label }}
                </x-mlbrgn-form-label>
        @endif
    @endif

    @if(!$hidden && $type !== 'hidden')

        {{-- server side feedback messages --}}
        @if($shouldShowError($name))
            <x-mlbrgn-form-errors :name="$name" />
        @endif

        {{-- Help text --}}
        @isset($help)
            <x-mlbrgn-form-text
                :id="$id"
                @class([
                    $attributes->get('class-help-text', '') => $attributes->has('class-help-text')
                ])
            >{{ $help }}</x-mlbrgn-form-text>
        @endif

        @if(!empty($helpText) && !isset($help))
            <x-mlbrgn-form-text
                :id="$id"
                @class([
                    $attributes->get('class-help-text', '') => $attributes->has('class-help-text')
                ])
            >{{ $helpText }}</x-mlbrgn-form-text>
        @endif
    @endif

    {{-- close horizontal control wrapper --}}
    @if($horizontal)
        </div>
    @endif

    {{-- Close wrapper for floating or horizontal controls --}}
    @if($floating || $horizontal)
    </div>
    @endif
@endif
