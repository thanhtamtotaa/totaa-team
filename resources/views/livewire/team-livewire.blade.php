<div>
    <!-- Filters and Add Buttons -->
    @include('totaa-team::livewire.team.support.filters')

    <!-- Incluce các modal -->
    @include('totaa-team::livewire.team.modal.add_edit')
    @include('totaa-team::livewire.team.modal.delete_modal')

    <!-- Scripts -->
    @push('livewires')
        @include('totaa-team::livewire.team.support.script')
    @endpush
</div>
