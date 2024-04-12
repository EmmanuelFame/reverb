<div>
    {{-- Do your work, then step back. --}}
    <ul class="chat-thread">
        @foreach ($convo as $convoItem)
            <li>{{ $convoItem['username'] }}: {{ $convoItem['message'] }}</li>
        @endforeach
    </ul>

    <form wire:submit.prevent="submitMessage" id="messageForm">
        <x-text-input id="message" wire:model="message" />
        <button type="submit" id="click">Send</button>
    </form>
    <script>
        document.getElementById('click').addEventListener('click', function() {
            let messageInput = document.getElementById('message');
        let message = messageInput.value;
        
        // Clear the input field value
        messageInput.value = "";
        });
    </script>
   
    
</div>


