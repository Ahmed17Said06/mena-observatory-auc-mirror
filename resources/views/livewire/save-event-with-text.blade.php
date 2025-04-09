<div>
    <button class="save_to_calandar btn btn-mena @if($alreadySaved) active @endif" wire:click="toggleEvent" wire:loading.attr="disabled" >
        <i class="far fa-bookmark"></i>        {{ $alreadySaved ? 'Remove FROM MY CALANDAR' : ' SAVE TO MY CALANDAR' }}
    </button>
</div>
