<?php

namespace App\Livewire\Pustu\StandarPertumbuhan;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\StandarPertumbuhan;
use App\Imports\WhoStandarImport;
use Maatwebsite\Excel\Facades\Excel;

class SpIndex extends Component
{
    use WithFileUploads;

    public $delete_id;
    public $excelFile;   // untuk menampung file upload
    public $parameter = 'bb';
    public $jenis = 'L';

    protected $listeners = ['delete' => 'destroyData'];

    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatch('konfirmDelete'); // trigger modal JS
    }

    public function destroyData()
    {
        $riwayat = StandarPertumbuhan::findOrFail($this->delete_id);
        $riwayat->delete();

        session()->flash('success', 'Data berhasil dihapus!');
    }

    public function importExcel()
    {
        $this->validate([
            'excelFile' => 'required|mimes:xlsx,xls,csv',
            'parameter' => 'required|in:bb,tb,lk,ll',
            'jenis'     => 'required|in:L,P'
        ]);

        Excel::import(
            new WhoStandarImport($this->parameter, $this->jenis),
            $this->excelFile->getRealPath()
        );

        session()->flash('success', 'Data WHO berhasil diimport!');
        $this->reset('excelFile');
    }

    public function render()
    {
        return view('livewire.pustu.standar-pertumbuhan.sp-index', [
            'standarList' => StandarPertumbuhan::orderBy('usia_bulan')->get()
        ]);
    }
}
