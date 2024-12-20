@props(['name','label','placeholder','required'=>false,'autofocus'=>'','disabled'=>false])

@php
    $errorClass = $errors->has($name) ? 'border-red-500' : '';
@endphp

<div {{ $attributes }}>
    <x-forms.label :for="$name">{{ $label }}</x-forms.label>
    <x-forms.select
        :$autofocus
        :$name
        :$placeholder
        :class="$errorClass"
        :$disabled
        :$required>
        {{ $slot }}
    </x-forms.select>
    @error($name)
        <x-forms.error>{{ $message }}</x-forms.error>
    @enderror
</div>
