@props(['textColor', 'bgColor'])


@php
    $textColor = match($textColor){
        'gray' => 'text-gray-800',
        'blue' => 'text-blue-800',
        'red' => 'text-red-800',
        'yellow' => 'text-yellow-800',
        'green' => 'text-green-800',
        'purple' => 'text-purple-800',
        deafult => 'text-gray-100',
    };
    $bgColor = match($bgColor){
        'gray' => 'bg-gray-100',
        'blue' => 'bg-blue-100',
        'red' => 'bg-red-100',
        'yellow' => 'bg-yellow-100',
        'green' => 'bg-green-100',
        'purple' => 'bg-purple-100',
        deafult => 'bg-gray-100',
    };
@endphp

<button {{ $attributes }} class="{{ $textColor }} {{ $bgColor }} rounded-xl px-3 py-1 text-base">
    {{ $slot }}
</button>
