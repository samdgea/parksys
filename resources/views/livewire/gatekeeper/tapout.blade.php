<div class="fixed z-10 inset-0 overflow-scroll ease-out duration-400">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​

        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <form>
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    @if (session()->has('message'))
                        <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                            <div class="flex">
                                <div>
                                    <p class="text-sm">{{ session('message') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="">
                        <div class="mb-4">
                            <label for="formGateKeeperCode" class="block text-gray-700 text-sm font-bold mb-2">Gatekeeper™ Code:</label>
                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="formGateKeeperCode" wire:model="gatekeeper_code" wire:change="setGetKeeperCode($event.target.value)">
                            @error('gatekeeper_code') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="formLicensePlate" class="block text-gray-700 text-sm font-bold mb-2">License Plate:</label>
                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="formLicensePlate" wire:model="license_plate" disabled>
                            @error('license_plate') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="formRole" class="block text-gray-700 text-sm font-bold mb-2">Vehicile Type:</label>
                            <select class="form-control w-full" wire:model="entry_vehicile_type" disabled>
                                <option value="">Choose vehicile type</option>
                                @foreach($vehicileType as $key => $value)
                                    <option value="{{ $key }}" >{{ $value }}</option>
                                @endforeach
                            </select>
                            @error('entry_vehicile_type') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="formEntryTime" class="block text-gray-700 text-sm font-bold mb-2">Entry Time:</label>
                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="formLicensePlate" wire:model="entry_time" disabled>
                            @if($price)
                                <br>
                                <span class="text-green-500 text-2xl">Lama Parkir: {{ $lamaParkir }} Jam</span><br>
                                <span class="text-green-500 text-2xl">Rp: {{ $price }} ,-</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                        <button wire:click.prevent="storeTapOut()" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5" @if(!$vehicileEntry) disabled @endif>
                        Tap Out
                        </button>
                    </span>
                    <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">

                        <button wire:click="closeExitGate()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                        Close
                        </button>
                    </span>
            </form>
        </div>
    </div>
</div>
</div>
