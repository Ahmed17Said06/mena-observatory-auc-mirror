@if($show)
    <div class="subscribe-popup" id="subscribe-popup">
    <a href="javascript:void(0)" class="closebtn" wire:click="close">&times;</a>
    <h3>
        RECEIVE NEWS AND UPDATES
    </h3>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <form wire:submit.prevent="subscribe" style="display: flex;gap: 20px;">
        <input type="email" placeholder="Your email" wire:model="email_sub">
        @error('email_sub') <span class="error">{{ $message }}</span> @enderror
        <button type="submit" class="btn btn-mena-2">SUBSCRIBE</button>
    </form>
</div>
@endif
@push('scripts')
    <script>
        window.addEventListener('formClosed', () =>  {
            document.getElementById("subscribe-popup").style.display = "none";

        })
    </script>
@endpush
