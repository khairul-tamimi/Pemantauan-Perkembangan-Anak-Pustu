<?php

namespace App\Livewire\Pustu\StandarPertumbuhan;

use Livewire\Component;
use App\Models\StandarPertumbuhan;

class SpCreate extends Component
{
    public $jenis_kelamin, $usia_bulan, $bb_min, $bb_max, $tb_min, $tb_max, $lk_min, $lk_max, $ll_min, $ll_max;

    protected $rules = [
        'jenis_kelamin' => 'required|in:L,P',
        'usia_bulan' => 'required|integer|min:0',
        'bb_min' => 'nullable|numeric',
        'bb_max' => 'nullable|numeric',
        'tb_min' => 'nullable|numeric',
        'tb_max' => 'nullable|numeric',
        'lk_min' => 'nullable|numeric',
        'lk_max' => 'nullable|numeric',
        'll_min' => 'nullable|numeric',
        'll_max' => 'nullable|numeric',
    ];

    public function store()
    {
        $this->validate();

        StandarPertumbuhan::create($this->only([
            'jenis_kelamin','usia_bulan',
            'bb_min','bb_max','tb_min','tb_max',
            'lk_min','lk_max','ll_min','ll_max'
        ]));

        session()->flash('success','Data berhasil ditambahkan!');
        return redirect()->route('standar-pertumbuhan.index');
    }

    public function render()
    {
        return view('livewire.pustu.standar-pertumbuhan.sp-create');
    }
}
