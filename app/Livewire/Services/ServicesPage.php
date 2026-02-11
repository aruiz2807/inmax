<?php

namespace App\Livewire\Services;

use App\Livewire\Forms\ServicesForm;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class ServicesPage extends Component
{
    public ServicesForm $form;
    public ?int $serviceId = null;

    public function render()
    {
        $layout = '';

        //passing layout according to business logic
        if(Auth::user())
        {
            $layout = 'layouts.app';
        }

        return view('livewire.services.services-page')->layout($layout);
    }

    #[On('editService')]
    public function edit($serviceId)
    {
        $service = Service::find($serviceId);

        $this->form->set($service);
        $this->serviceId = $serviceId;

        //open modal
        $this->dispatch('open-service-modal');
    }

    public function save()
    {
        if($this->serviceId)
        {
            $this->form->update($this->serviceId);
        }
        else
        {
            $this->form->store();
        }

        // Show success toast
        $this->dispatch('notify',
            type: 'success',
            content:'Servicio almacenado exitosamente!',
            duration: 4000
        );

        //close modal
        $this->dispatch('close-service-modal');

        //refresh table data
        $this->dispatch('pg:eventRefresh-servicesTable');

        //clear form
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->form->reset();
        $this->serviceId = null;
    }
}
