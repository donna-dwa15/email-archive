<div>
<form wire:submit.prevent="save">
    @csrf
    <div wire:loading.delay wire:target="save" class="bg-orange-100 font-bold px-5 py-1 rounded-lg">Uploading...</div>
    <div>
        @if (session()->has('message'))
            <div class="bg-green-100 font-bold px-5 py-1 rounded-lg alert alert-success">{{ session('message') }}</div>
        @elseif (session()->has('error'))
            <div class="bg-red-100 font-bold px-5 py-1 rounded-lg alert alert-success">{{ session('error') }}</div>
        @endif
    </div>
    <x-forms.input input label="Email File (.eml only):" name="file" type="file" wire:model.blur="file" />

    <x-forms.input label="Tags (optional, comma separated):" name="tag" type="text" placeholder="phishing, new" wire:model="tag" />

    <div class="mt-3">
        <x-forms.button type="submit">Upload</x-forms.button>
    </div>
</form>
</div>