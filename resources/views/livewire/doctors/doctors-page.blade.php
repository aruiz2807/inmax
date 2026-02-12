<div>
    <x-slot name="header">
        {{ __('Doctors') }}
    </x-slot>

    <div>
        <x-ui.card size="full">
            <x-ui.heading class="flex items-center justify-between mb-4" level="h3" size="sm">
                <span>Catalogo de medicos</span>

                <x-ui.modal.trigger id="doctors-modal" wire:click="resetForm">
                    <x-ui.button color="teal" icon="plus-circle">
                        Agregar medico
                    </x-ui.button>
                </x-ui.modal.trigger>
            </x-ui.heading>
            <p>Administre los medicos que pueden ser asignados para las interconsultas</p>
        </x-ui.card>
    </div>

    <div class="pt-2">
        <x-ui.card size="full">
            <livewire:doctors.doctors-table />
        </x-ui.card>
    </div>

    <x-ui.modal
        id="doctors-modal"
        animation="fade"
        width="2xl"
        heading="{{$doctorId ? 'Editar medico' : 'Nuevo medico'}}"
        description="Ingrese la siguiente información para registrar un medico"
        x-on:close-doctor-modal.window="$data.close()"
        x-on:open-doctor-modal.window="$data.open()"
    >
        <form wire:submit="save">
            @csrf

            <x-ui.fieldset label="Información del medico">
                <x-ui.field required>
                    <x-ui.label>Nombre</x-ui.label>
                    <x-ui.input wire:model="form.name" name="name" placeholder="Consulta de medico general" />
                    <x-ui.error name="form.name" />
                </x-ui.field>
            </x-ui.fieldset>

            <div class="w-full flex justify-end gap-3 pt-4">
                <x-ui.button x-on:click="$data.close();" icon="x-mark" variant="outline">
                    Cancel
                </x-ui.button>

                <x-ui.button type="submit" icon="check" variant="primary" color="teal">
                    Guardar
                </x-ui.button>
            </div>
        </form>
    </x-ui.modal>
</div>
