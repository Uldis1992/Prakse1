<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;


class ContactsList extends Component
{
    public $contacts;
    public $name, $email, $phone, $user_id;
    public $contactId = null;
    public $showModal = false;

    public function render()
    {
        $this->contacts = Contact::all();
        return view('livewire.contacts-list');
    }

    public function openModal($id = null)
    {
    $this->resetFields();
        $this->contactId = $id;
        if ($id) {
            $contact = Contact::findOrFail($id);
            $this->name = $contact->name;
            $this->email = $contact->email;
            $this->phone = $contact->phone;
        }
        $this->showModal = true;
    }
    public function delete($id)
    {
        Contact::destroy($id);
    }
    
    public function saveContact()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'user_id' => 'required|int|max:255',
        ]);

        if ($this->contactId) {
            $contact = Contact::findOrFail($this->contactId);
            $contact = Contact::find($this->contactId);
            $contact->update([
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'user_id' => $this->user_id,
            ]);
        } else {
            Contact::create([
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'user_id' => $this->user_id,
            ]);
        }
        $this->resetFields();
        $this->showModal = false;
    }

    private function resetFields()
    {
        $this->name = '';
        $this->email = '';
        $this->phone = '';
        $this->contactId = null;
    }
}
