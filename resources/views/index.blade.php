@props(['header_text' => 'Dashboard', 'content_component' => '', 'emails'])

<x-layout>
    <x-slot:header>{{ $header_text }}</x-slot:header>
    <x-slot:content_component>
        @if( $content_component === "upload" )
            <livewire:upload-email></livewire:upload-email>
        @elseif( $content_component === "email-table" )
            <livewire:email-table :$emails></livewire:email-table>
        @endif
    </x-slot:content_component>
</x-layout>