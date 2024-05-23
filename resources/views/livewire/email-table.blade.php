@props(['emails'])

<div class="flex flex-col mt-1 mb-1">
    <div class="w-1/3 mb-2">
        <form wire:submit="search">
            <x-forms.input label="Search By Tag" name="search_text" type="text" wire:model="searchText" placeholder="phishing" />
        </form>
    </div>
    <table class="divide-y divide-gray-200">
        <thead>
            <x-table-row>
                <x-table-header>Sender</x-table-header>
                <x-table-header>Recipient</x-table-header>
                <x-table-header>Subject</x-table-header>
                <x-table-header>Tags</x-table-header>
                <x-table-header></x-table-header>
            </x-table-row>
        </thead>
        <tbody class="divide-y divide-gray-200 text-xs">
        @if ( count($emails) > 0 )
            @foreach( $emails as $email )
                <x-table-row>
                    <x-table-cell>{{ $email->sender }}</x-table-cell>
                    <x-table-cell>{{ $email->recipient }}</x-table-cell>
                    <x-table-cell>{{ $email->subject }}</x-table-cell>
                    <x-table-cell>
                        @foreach ($email->tags as $tag)
                            <x-tag :$tag size="small"/>
                        @endforeach
                    </x-table-cell>
                    <x-table-cell>
                        <a href="/emails/{{ $email->id }}" target="_blank">
                            View 
                            @svg('zondicon-view-show', 'w-7 h-7')
                        </a>
                    </x-table-cell>
                </x-table-row>
            @endforeach
        @else
            <x-table-row>
                <x-table-cell colspan="6" class="text-sm font-bold">0 emails found.</x-table-cell>
            </x-table-row>
        @endif    
        </tbody>
    </table>
    <div class="mt-3">{{ $emails->links() }}</div>
</div>