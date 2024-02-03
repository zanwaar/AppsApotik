<?php

namespace App\Livewire;

use App\Models\DataObat;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;

class ListObat extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $queryString = ['searchTerm' => ['except' => '']];
    public $searchTerm = null;
    public $state = [];
    public $trow = 10;
    public $showEditModal = false;
    public $idBeingRemoved = null;
    public $mobat;
    public function addNew()
    {
        $this->reset();
        $this->showEditModal = false;
        $this->dispatch('show-form');
    }
    public function create()
    {
        Validator::make(
            $this->state,
            [
                'kode' => 'required',
                'jenis_obat' => 'required',
                'nama_obat' => 'required',
                'harga' => 'required',
                'stok' => 'required',
                'expired' => 'required',
            ],
           
        )->validate();
        DataObat::create([
            'kode' => $this->state['kode'],
            'jenis_obat' => $this->state['jenis_obat'],
            'nama_obat' => $this->state['nama_obat'],
            'harga' => $this->state['harga'],
            'stok' => $this->state['stok'],
            'expired' => $this->state['expired'],
        ]);
        $this->dispatch('hide-form', ['message' => 'added successfully!']);
    }
    public function edit(DataObat $obat)
    {
        $this->reset();
        $this->showEditModal = true;
        $this->mobat = $obat;
        $this->state = $obat->toArray();
        $this->dispatch('show-form');
    }
  
    public function update()
    {
        $validatedData = Validator::make(
            $this->state,
            [
                'kode' => 'required',
                'jenis_obat' => 'required',
                'nama_obat' => 'required',
                'harga' => 'required',
                'stok' => 'required',
                'expired' => 'required',
            ],
        )->validate();

        $this->mobat->update($validatedData);

        $this->dispatch('hide-form', ['message' => 'updated successfully!']);
    }
    public function confirmRemoval($id)
    {
        $this->idBeingRemoved = $id['id'];

        $this->dispatch('show-delete-modal');
    }
    public function delete()
    {
        $obat = DataObat::findOrFail($this->idBeingRemoved);
        $obat->delete();
        $this->dispatch('hide-form', ['message' => 'deleted successfully!']);
        $this->reset();
    }
    public function getDataObatProperty()
    {
        return DataObat::latest()
            ->where(function ($query) {
                $query->where('kode', 'like', '%' . $this->searchTerm . '%');
            })
            ->paginate($this->trow);
    }
    public function render()
    {
        return view('livewire.list-obat', ['dataobat' => $this->data_obat]);
    }
}
