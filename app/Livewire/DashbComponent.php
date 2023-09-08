<?php

namespace App\Livewire;

use App\Models\Emails;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Component;
use App\Models\Proyecto;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class DashbComponent extends Component
{
    use WithPagination, WithFileUploads;
    public $postId;
    public $isOpen = 0;

    #[Rule('required|min:3')]
    public $titulo;

    #[Rule('required|min:3')]
    public $descripcion;

    #[Rule('required|min:1')]
    public $publico;

    #[Rule('nullable|image|max:1024')] // 1MB Max
    public $imagen;

    public function create()
    {
        $this->reset('titulo','descripcion','postId','publico');
        $this->openModal();
    }

    public function store()
    {
        $this->validate();
        $new = Proyecto::create([
            'titulo' => $this->titulo,
            'descripcion' => $this->descripcion,
            'publico' => $this->publico,
            'user_id' => Auth::id(),
        ]);
        if($this->imagen)$new->saveUpImg($this->imagen);
        session()->flash('success', '¡Agregado Exitosamente!');
        $this->reset('titulo','descripcion','publico');
        $this->closeModal();
        Emails::programarCorreo();
    }

    public function edit($id)
    {
        $proye = Proyecto::findOrFail($id);
        $this->postId = $id;
        $this->titulo = $proye->titulo;
        $this->descripcion = $proye->descripcion;
        $this->publico = $proye->publico;
        $this->imagen = $proye->imagen;
        $this->openModal();
    }

    public function update()
    {
        if ($this->postId) {
            $proye = Proyecto::findOrFail($this->postId);
            $proye->update([
                'titulo' => $this->titulo,
                'descripcion' => $this->descripcion,
                'publico' => $this->publico,
            ]);
            if($this->imagen)$proye->saveUpImg($this->imagen);
            session()->flash('success', '¡Modificado Exitosamente!');
            $this->closeModal();
            $this->reset('titulo','descripcion','postId','publico');
            Emails::programarCorreo();
        }
    }

    public function delete($id)
    {
        Proyecto::find($id)->delUpImg();
        session()->flash('success', '¡Eliminado Exitosamente!');
        $this->reset('titulo','descripcion','postId','publico');
    }

    public function openModal()
    {
        $this->isOpen = true;
        $this->resetValidation();
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function render()
    {
        return view('livewire.dashboard',[
            'posts' => Proyecto::where('publico','!=','')->paginate(5)
        ]);
    }
}
