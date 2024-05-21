@props(['emails'])

<x-layout>
<div>
    <x-slot:header>Archived Emails</x-slot>
    <x-slot:content_component>
        <table class="text-xs">
            <tr class="mt-1 mb-1 px-2 py-2 "><th>Sender</th><th>Recipient</th><th>Subject</th><th>Tags</th><th></th></tr>
            @foreach( $emails as $email )
                <tr class="mt-1 mb-1 px-2 py-2">
                    <td class="px-5 py-5 border">{{ $email->sender }}</td>
                    <td class="px-5 py-5 border">{{ $email->recipient }}</td>
                    <td class="px-5 py-5 border">{{ $email->subject }}</td>
                    <td class="px-5 py-5 border">
                        @foreach ($email->tags as $tag)
                            <x-tag :$tag size="small"/>
                        @endforeach
                    </td>
                    <td class="px-5 py-5 border"><a href="/emails/{{ $email->id }}" target="_blank">View{{ svg('zondicon-view-show') }}</a></td>
                </tr>
            @endforeach
        </table>
    </x-slot>
</div>
</x-layout>       