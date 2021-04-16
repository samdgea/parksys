<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class UserManagement extends Component
{
    public $roles, $user_id, $user_role, $first_name, $last_name, $email, $password, $phone_number, $employee_id, $is_active;
    public $viewModal = false;


    public function render()
    {
        $this->roles = Role::get();

        return view('livewire.user.index', [
            'users' => User::orderBy('created_at', 'ASC')->paginate(10)
        ]);
    }


    public function create() {
        $this->_resetFields();
        $this->openModal();
    }

    public function store() {
        $this->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'nullable|string|max:50',
            'phone_number' => 'required|string|max:20',
            'is_active' => 'nullable|boolean',
            'email' => 'required|email',
            'password' => 'nullable|string|min:6'
        ]);

        $data = [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'account_status' => (bool)$this->is_active
        ];

        if (!empty($this->password)) {
            $data['password'] = Hash::make($this->password);
        }

        $user = User::updateOrCreate(['id' => $this->user_id], $data);
        $user->syncRoles([$this->user_role]);

        session()->flash('message', $this->user_id ? 'User ' . $this->employee_id . ' telah di update' : 'User baru berhasil ditambahkan');
        $this->closeModal();
        $this->_resetFields();
    }

    public function edit($id) {
        $user = User::find($id);

        $this->user_id = $id;
        $this->first_name  = $user->first_name;
        $this->last_name  = $user->last_name;
        $this->phone_number = $user->phone_number;
        $this->employee_id = $user->employee_number;
        $this->email = $user->email;
        $this->is_active = $user->account_status;
        $this->user_role = $user->getRoleNames()->first();

        $this->openModal();
    }

    public function delete($id) {
        $user = User::find($id);

        if (!empty($user)) {
            $user->delete();
            session()->flash('message', 'User ' . $user->name . ' berhasil dihapus');
        } else {
            session()->flash('message', 'User tidak ditemukan, kemungkinan telah dihapus.');
        }
    }

    public function openModal() {
        $this->viewModal = true;
    }

    public function closeModal() {
        $this->_resetFields();
        $this->viewModal = false;
    }

    private function _resetFields() {
        $this->user_id = null;
        $this->first_name = null;
        $this->last_name = null;
        $this->employee_id = null;
        $this->phone_number = null;
        $this->email = null;
        $this->password = null;
        $this->user_role = null;
    }
}
