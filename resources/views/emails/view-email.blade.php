<x-layout>
    <x-slot:header>{{ $header }}</x-slot:header>
    <div class="border-2 rounded-lg px-10 bg-white" >
        <div class="relative min-h-screen bg-center sm:flex sm:justify-center sm:items-center bg-dots dark:bg-gray-900 selection:bg-indigo-500 selection:text-white">
            <div class="p-6 mx-auto max-w-7xl lg:p-8">
                <div class="mt-8">
                    <div class="mt-6 border-t border-gray-100">
                        <dl class="divide-y divide-gray-100">
                            <x-email-detail label="Sender">{{ $email->sender }}</x-email-detail>
                            <x-email-detail label="Recipient">{{ $email->recipient }}</x-email-detail>
                            <x-email-detail label="Subject">{{ $email->subject }}</x-email-detail>
                            <x-email-detail label="Tags">
                                @foreach( $email->tags as $tag )
                                    <x-tag :tag="$tag" />
                                @endforeach
                            </x-email-detail>
                            <x-email-detail label="Attachments">
                                @if( !empty( $email->attachments ) )
                                <ul role="list" class="divide-y divide-gray-100 rounded-md border border-gray-200">
                                    @foreach( explode( ',', $email->attachments ) as $attachment )
                                    <x-email-attachment :name="$attachment" />
                                    @endforeach
                                </ul>
                                @endif
                            </x-email-detail>
                            <x-email-detail label="Message">
                                <div class="flex justify-right ml-4 mb-5 flex-shrink-0">
                                    <span class="px-10"><button class="font-medium text-indigo-600 hover:text-indigo-500" wire:click="view_html">HTML</button></span>
                                    <span class="px-10"><button class="font-medium text-indigo-600 hover:text-indigo-500" wire:click="view_text">TEXT</button></span>
                                </div>
                                <div>
                                {!! html_entity_decode($email->html_body) !!}
                                </div>
                          </x-email-detail>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>