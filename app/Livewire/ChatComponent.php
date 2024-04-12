<?php

namespace App\Livewire;

use Livewire\Component;
use App\Events\MessageEvent;
use Livewire\Attributes\On;

use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class ChatComponent extends Component
{
    public $message;
    public $convo = [];

    public function mount()
    {
        $messages = Message::all();
        foreach ($messages as $message) {
            $this->convo[] = [
                'username' => $message->user->name,
                'message' => $message->message,
            ];
        }
    }

    public function submitMessage()
    {
        //dispatch the event in here
        MessageEvent::dispatch(Auth::user()->id, $this->message);
        $this->message = '';
        // Trigger Livewire event to reset input field
        // $this->dispatch('messageSubmitted');
    }
    
    #[On('echo:our-channel,MessageEvent')]
    public function ListenForMessage($data)
    {
        $this->convo[] = [
            'username' => $data['username'],
            'message' => $data['message'],
        ];
    }

    public function render()
    {
        return view('livewire.chat-component');
    }
}
