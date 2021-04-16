<?php

namespace App\Http\Livewire;

use App\Http\Middleware\PreventRequestsDuringMaintenance;
use App\Models\VehicileEntry;
use App\Models\VehicileType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class EntryGateKeeper extends Component
{
    public VehicileEntry $vehicileEntry;
    public $vehicileType, $entry_vehicile_type, $license_plate, $gatekeeper_code, $entry_time, $lamaParkir, $price;
    public $viewEntryModal, $viewTapOutModal;

    public function render()
    {
        $this->vehicileType = VehicileType::get()->pluck('vehicile_name', 'id');

        return view('livewire.gatekeeper.index');
    }

    public function createEntry()
    {
        $this->openEntryModal();
    }

    public function exitGate()
    {
        $this->openTapOutModal();
    }

    public function closeEntry()
    {
        $this->closeEntryModal();
    }

    public function closeExitGate()
    {
        $this->closeTapOutModal();
    }

    public function storeEntry()
    {
        $this->validate([
            'license_plate' => 'required|string|min:3',
            'entry_vehicile_type' => 'required|exists:vehicile_types,id'
        ]);

        $this->vehicileEntry = VehicileEntry::create([
            'gatekeeper_code' => 'xxx',
            'vehicile_license_plate' => $this->license_plate,
            'vehicile_type' => $this->entry_vehicile_type
        ]);

        $this->gatekeeper_code = $this->vehicileEntry->gatekeeper_code;

        session()->flash('message', 'Sukses membuat tiket parkir');
    }

    public function storeTapOut()
    {
        $this->vehicileEntry->exit_time = Carbon::now();
        $this->vehicileEntry->save();

        session()->flash('message', 'Berhasil Tap Out Parkir');
    }

    public function setGetKeeperCode($code)
    {
        $entry = VehicileEntry::where('gatekeeper_code', $code)->whereNull('exit_time')->first();

        if (!empty($entry)) {
            $this->vehicileEntry = $entry;
            $this->license_plate = $this->vehicileEntry->vehicile_license_plate;
            $this->entry_vehicile_type = $this->vehicileEntry->vehicile_type;
            $this->entry_time = $this->vehicileEntry->entry_time->format('H:i');

            $now = Carbon::now();
            $this->lamaParkir = ceil($now->diffInSeconds($this->vehicileEntry->entry_time) / 3600);

            $jamPertama = $this->vehicileEntry->vehicileType->first_hour_price;
            $jamBerikut = $this->vehicileEntry->vehicileType->next_hour_price;

            $this->price = $jamPertama + (ceil(($now->diffInSeconds($this->vehicileEntry->entry_time) / 3600) - 1) * $jamBerikut);
        } else {
            session()->flash('message', 'Kode Gatekeeper tidak valid atau telah di tapout');
        }
    }

    protected function openEntryModal()
    {
        $this->viewEntryModal = true;
    }

    protected function openTapOutModal()
    {
        $this->viewTapOutModal = true;
    }

    protected function closeTapOutModal()
    {
        $this->viewTapOutModal = false;
        $this->clearMemoryData();
    }

    protected function closeEntryModal()
    {
        $this->viewEntryModal = false;
        $this->clearMemoryData();
    }

    protected function clearMemoryData()
    {
        $this->vehicileEntry = new VehicileEntry();
        $this->entry_vehicile_type = null;
        $this->license_plate = null;
        $this->gatekeeper_code = null;
        $this->entry_time = null;
        $this->lamaParkir = null;
        $this->price = null;
    }
}
