<x-filament::page>
    <form wire:submit.prevent="save">
        <x-filament::card>
            {{ $this->form }}

            <div class="mt-6 flex justify-end">
                <x-filament::button type="submit">
                    Save changes
                </x-filament::button>
            </div>
        </x-filament::card>
    </form>
</x-filament::page>
