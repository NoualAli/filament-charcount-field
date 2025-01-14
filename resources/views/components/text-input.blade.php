@php
    $datalistOptions = $getDatalistOptions();

    $sideLabelClasses = [
        'whitespace-nowrap group-focus-within:text-primary-500',
        'text-gray-400' => ! $errors->has($getStatePath()),
        'text-danger-400' => $errors->has($getStatePath()),
    ];
@endphp

<x-forms::field-wrapper
    :id="$getId()"
    :label="$getLabel()"
    :label-sr-only="$isLabelHidden()"
    :helper-text="$getHelperText()"
    :hint="$getHint()"
    :hint-icon="$getHintIcon()"
    :required="$isRequired()"
    :state-path="$getStatePath()"
>
    <div {{ $attributes->merge($getExtraAttributes())->class(['flex items-center space-x-1 rtl:space-x-reverse group filament-forms-text-input-component']) }}>
        @if ($label = $getPrefixLabel())
            <span @class($sideLabelClasses)>
                {{ $label }}
            </span>
        @endif


        <x-filament-charcount-field::wrapper :min="$getMinCharactersValue()" :max="$getMaxCharactersValue()">
            <input
                x-ref="countInput"
                x-on:keyup="count = $refs.countInput.value.length"
            @unless ($hasMask())
                {{ $applyStateBindingModifiers('wire:model') }}="{{ $getStatePath() }}"
                type="{{ $getType() }}"
            @else
                x-data="textInputFormComponent({
                        {{ $hasMask() ? "getMaskOptionsUsing: (IMask) => ({$getJsonMaskConfiguration()})," : null }}
                state: $wire.{{ $applyStateBindingModifiers('entangle(\'' . $getStatePath() . '\')') }},
                    })"
                type="text"
                wire:ignore
                {{ $getExtraAlpineAttributeBag() }}
            @endunless
            {!! ($autocapitalize = $getAutocapitalize()) ? "autocapitalize=\"{$autocapitalize}\"" : null !!}
            {!! ($autocomplete = $getAutocomplete()) ? "autocomplete=\"{$autocomplete}\"" : null !!}
            {!! $isAutofocused() ? 'autofocus' : null !!}
            {!! $isDisabled() ? 'disabled' : null !!}
            id="{{ $getId() }}"
            {!! ($inputMode = $getInputMode()) ? "inputmode=\"{$inputMode}\"" : null !!}
            {!! $datalistOptions ? "list=\"{$getId()}-list\"" : null !!}
            {!! filled($length = $getMaxLength()) ? "maxlength=\"{$length}\"" : null !!}
            {!! filled($value = $getMaxValue()) ? "max=\"{$value}\"" : null !!}
            {!! filled($length = $getMinLength()) ? "minlength=\"{$length}\"" : null !!}
            {!! filled($value = $getMinValue()) ? "min=\"{$value}\"" : null !!}
            {!! ($placeholder = $getPlaceholder()) ? "placeholder=\"{$placeholder}\"" : null !!}
            {!! ($interval = $getStep()) ? "step=\"{$interval}\"" : null !!}
            {!! $isRequired() ? 'required' : null !!}
            {{ $getExtraInputAttributeBag()->class([
                'block w-full transition duration-75 rounded-lg shadow-sm focus:border-primary-600 focus:ring-1 focus:ring-inset focus:ring-primary-600 disabled:opacity-70',
                'dark:bg-gray-700 dark:text-white' => config('forms.dark_mode'),
                'border-gray-300' => ! $errors->has($getStatePath()),
                'dark:border-gray-600' => (! $errors->has($getStatePath())) && config('forms.dark_mode'),
                'border-danger-600 ring-danger-600' => $errors->has($getStatePath()),
            ]) }}
            />
        </x-filament-charcount-field::wrapper>

        @if ($label = $getPostfixLabel())
            <span @class($sideLabelClasses)>
                {{ $label }}
            </span>
        @endif
    </div>

    @if ($datalistOptions)
        <datalist id="{{ $getId() }}-list">
            @foreach ($datalistOptions as $option)
                <option value="{{ $option }}" />
            @endforeach
        </datalist>
    @endif
</x-forms::field-wrapper>


{{--@php--}}
{{--    $datalistOptions = $getDatalistOptions();--}}

{{--    $sideLabelClasses = [--}}
{{--        'whitespace-nowrap group-focus-within:text-primary-500',--}}
{{--        'text-gray-400' => ! $errors->has($getStatePath()),--}}
{{--        'text-danger-400' => $errors->has($getStatePath()),--}}
{{--    ];--}}
{{--@endphp--}}

{{--<x-forms::field-wrapper--}}
{{--    :id="$getId()"--}}
{{--    :label="$getLabel()"--}}
{{--    :label-sr-only="$isLabelHidden()"--}}
{{--    :helper-text="$getHelperText()"--}}
{{--    :hint="$getHint()"--}}
{{--    :hint-icon="$getHintIcon()"--}}
{{--    :required="$isRequired()"--}}
{{--    :state-path="$getStatePath()"--}}
{{-->--}}
{{--    <div {{ $attributes->merge($getExtraAttributes())->class(['flex items-center space-x-1 rtl:space-x-reverse group filament-forms-text-input-component']) }}>--}}
{{--        @if ($label = $getPrefixLabel())--}}
{{--            <span @class($sideLabelClasses)>--}}
{{--                {{ $label }}--}}
{{--            </span>--}}
{{--        @endif--}}

{{--        <div class="flex-1 relative"--}}
{{--             x-data="{--}}
{{--            count: $refs.countInput.value.length,--}}
{{--            min: $el.dataset.min,--}}
{{--            max: $el.dataset.max,--}}
{{--            get remaining() {--}}
{{--                return this.max - count--}}
{{--            },--}}
{{--            get under() {--}}
{{--                return this.min - this.count--}}
{{--            },--}}
{{--            get color() {--}}
{{--                if(this.count == 0) {--}}
{{--                    return 'text-gray-500'--}}
{{--                }--}}
{{--                else if(this.count < this.min || this.count > this.max) {--}}
{{--                    return 'text-danger-500'--}}
{{--                }--}}
{{--                else if (this.min == null && this.max == null) {--}}
{{--                    return 'text-gray-500'--}}
{{--                }--}}
{{--                else {--}}
{{--                    return 'text-green-500'--}}
{{--                }--}}
{{--            }--}}
{{--         }"--}}
{{--            {!! ($min = $getMinCharactersValue()) ? "data-min=\"{$min}\"" : null !!}--}}
{{--            {!! ($max = $getMaxCharactersValue()) ? "data-max=\"{$max}\"" : null !!}--}}
{{--        >--}}
{{--            <input--}}
{{--            x-ref="countInput"--}}
{{--            x-on:keyup="count = $refs.countInput.value.length"--}}
{{--            @unless ($hasMask())--}}
{{--                {{ $applyStateBindingModifiers('wire:model') }}="{{ $getStatePath() }}"--}}
{{--                type="{{ $getType() }}"--}}
{{--            @else--}}
{{--                x-data="textInputFormComponent({--}}
{{--                        {{ $hasMask() ? "getMaskOptionsUsing: (IMask) => ({$getJsonMaskConfiguration()})," : null }}--}}
{{--                state: $wire.{{ $applyStateBindingModifiers('entangle(\'' . $getStatePath() . '\')') }},--}}
{{--                    })"--}}
{{--                type="text"--}}
{{--                wire:ignore--}}
{{--                {{ $getExtraAlpineAttributeBag() }}--}}
{{--            @endunless--}}
{{--            {!! ($autocapitalize = $getAutocapitalize()) ? "autocapitalize=\"{$autocapitalize}\"" : null !!}--}}
{{--            {!! ($autocomplete = $getAutocomplete()) ? "autocomplete=\"{$autocomplete}\"" : null !!}--}}
{{--            {!! $isAutofocused() ? 'autofocus' : null !!}--}}
{{--            {!! $isDisabled() ? 'disabled' : null !!}--}}
{{--            id="{{ $getId() }}"--}}
{{--            {!! ($inputMode = $getInputMode()) ? "inputmode=\"{$inputMode}\"" : null !!}--}}
{{--            {!! $datalistOptions ? "list=\"{$getId()}-list\"" : null !!}--}}
{{--            {!! filled($length = $getMaxLength()) ? "maxlength=\"{$length}\"" : null !!}--}}
{{--            {!! filled($value = $getMaxValue()) ? "max=\"{$value}\"" : null !!}--}}
{{--            {!! filled($length = $getMinLength()) ? "minlength=\"{$length}\"" : null !!}--}}
{{--            {!! filled($value = $getMinValue()) ? "min=\"{$value}\"" : null !!}--}}
{{--            {!! ($placeholder = $getPlaceholder()) ? "placeholder=\"{$placeholder}\"" : null !!}--}}
{{--            {!! ($interval = $getStep()) ? "step=\"{$interval}\"" : null !!}--}}
{{--            {!! $isRequired() ? 'required' : null !!}--}}
{{--            {{ $getExtraInputAttributeBag()->class([--}}
{{--                'block w-full transition duration-75 rounded-lg shadow-sm focus:border-primary-600 focus:ring-1 focus:ring-inset focus:ring-primary-600 disabled:opacity-70',--}}
{{--                'dark:bg-gray-700 dark:text-white' => config('forms.dark_mode'),--}}
{{--                'border-gray-300' => ! $errors->has($getStatePath()),--}}
{{--                'dark:border-gray-600' => (! $errors->has($getStatePath())) && config('forms.dark_mode'),--}}
{{--                'border-danger-600 ring-danger-600' => $errors->has($getStatePath()),--}}
{{--            ]) }}--}}
{{--            />--}}
{{--            <div class="absolute top-0.5 right-0.5 flex items-center pointer-events-none text-gray-500 text-xs" :class="color">--}}
{{--                <div class="bg-white/50 px-1 rounded-lg">--}}
{{--                    <span x-text="count"></span><span>{{ $getMaxCharactersValue() ? '/'.$getMaxCharactersValue() : null }}</span>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        @if ($label = $getPostfixLabel())--}}
{{--            <span @class($sideLabelClasses)>--}}
{{--                {{ $label }}--}}
{{--            </span>--}}
{{--        @endif--}}
{{--    </div>--}}

{{--    @if ($datalistOptions)--}}
{{--        <datalist id="{{ $getId() }}-list">--}}
{{--            @foreach ($datalistOptions as $option)--}}
{{--                <option value="{{ $option }}" />--}}
{{--            @endforeach--}}
{{--        </datalist>--}}
{{--    @endif--}}
{{--</x-forms::field-wrapper>--}}
