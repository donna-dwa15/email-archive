@extends('layouts.base')

@props( ['active' => false, 'header' => 'Dashboard'] )

@section('body')
<div>
<div class="min-h-full">
  <nav class="bg-gray-800">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="flex h-16 items-center justify-between">
        <div class="flex items-center">
          <div class="flex-shrink-0">
            <img src="{{ Vite::asset('resources/images/letter.png') }}" alt="The Email Archive" width="50" />
          </div>
          <div class="hidden md:block">
            <div class="ml-10 flex items-baseline space-x-4">
              <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
              <x-nav-link href="/index"  wire:navigate :active="request()->is('index')">Dashboard</x-nav-link>
              <x-nav-link href="/emails" wire:navigate :active="request()->is('emails')">View</x-nav-link>
              <x-nav-link href="/upload" wire:navigate :active="request()->is('upload')">Upload</x-nav-link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>

<header class="bg-white shadow">
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
      <h1 class="text-3xl font-bold tracking-tight text-gray-900">
          @if( isset( $header ) )
            {{ $header }}
          @endif
      </h1>
    </div>
</header>
  <main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <div class="border-2 px-10 py-10 rounded-lg">
            @yield('content')
        </div>
    </div>
  </main>
</div>
</div>
@endsection