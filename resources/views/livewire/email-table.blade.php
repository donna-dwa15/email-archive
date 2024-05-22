@props(['emails'])

<div class="flex-col mt-1 mb-1">
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
                <x-table-cell><a href="/emails/{{ $email->id }}" target="_blank">View{{ svg('zondicon-view-show') }}</a></x-table-cell>
            </x-table-row>
        @endforeach
        </tbody>
    </table>
    <div>{{ $emails->links() }}</div>
</div>