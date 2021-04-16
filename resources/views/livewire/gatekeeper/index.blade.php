<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        GateKeeper™
    </h2>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            <div class="grid grid-cols-2 gap-2 place-content-center">
                <button wire:click="createEntry()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Entry Masuk</button>

                <button wire:click="exitGate()" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded my-3">Entry Keluar</button>
            </div>
            @if($viewEntryModal)
                @include('livewire.gatekeeper.create')
            @endif
            @if($viewTapOutModal)
                @include('livewire.gatekeeper.tapout')
            @endif
        </div>
    </div>
</div>
