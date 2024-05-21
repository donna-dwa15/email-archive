@props(['tag', 'size' => 'base'])

@php

    $classes = "inline-flex items-center rounded-md bg-indigo-50 px-2 py-1 font-medium text-indigo-700 ring-1 ring-inset ring-indigo-700/10";

    
    if ( $size === 'base' ) {
    
        $classes .= " px-5 py-1 text-sm";
    
    }
    
    if ( $size === 'small' ) {
    
        $classes .= " px-3 py-1 text-xs";
    
    }

@endphp

<span class="{{ $classes }}">{{ $tag->name }}</span>
