<div>
    <!-- Filters and Add Buttons -->
    @include('totaa-team::livewire.support.filters')

    <!-- Incluce các modal -->
    @include('totaa-team::livewire.modal.add_edit_modal')
    @include('totaa-team::livewire.modal.delete_modal')

    <!-- Scripts -->
    @push('livewires')
        @include('totaa-team::livewire.support.script')
    @endpush
</div>
