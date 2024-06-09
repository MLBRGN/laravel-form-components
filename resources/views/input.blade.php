@if($type === 'hidden')
    <div class="d-none"> @endif
        @if($floating)
            <div class="form-floating"> @endif

                @if(!$floating)
                    <x-form-label :label="$label" :for="$attributes->get('id') ?: $id()" :required="$attributes->has('required')"/>
                @endif

                <input
                    {!! $attributes->merge(['class' => 'form-control' . ($type === 'color' ? ' form-control-color' : '') . ($hasError($name) ? ' is-invalid' : '')]) !!}

                    type="{{ $type }}"

                    value="{{ $value ?? ($type === 'color' ? '#000000' : '') }}"

                    name="{{ $name }}"

                    @if($label && !$attributes->get('id'))
                        id="{{ $id() }}"
                    @endif

                    {{--  Placeholder is required as of writing  --}}
                    @if($floating && !$attributes->get('placeholder'))
                        placeholder="&nbsp;"
                    @endif
                >

                @if($floating)
                    <x-form-label :label="$label" :for="$attributes->get('id') ?: $id()" :required="$attributes->has('required')"/>
                @endif

                @if($floating) </div>
        @endif

        {!! $help ?? null !!}

        @if($hasErrorAndShow($name))
            <x-form-errors :name="$name"/>
        @endif

        @if($type === 'hidden') </div>
@endif
