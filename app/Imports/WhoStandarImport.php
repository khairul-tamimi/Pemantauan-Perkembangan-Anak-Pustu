<?php

namespace App\Imports;

use App\Models\StandarPertumbuhan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class WhoStandarImport implements ToModel, WithHeadingRow
{
    protected $jenis;
    protected $parameter;

    /**
     * @param string $parameter (bb/tb/lk/ll)
     * @param string $jenis (L/P)
     */
    public function __construct($parameter, $jenis)
    {
        $this->parameter = $parameter;
        $this->jenis = $jenis;
    }

    /**
     * Mapping tiap row Excel ke Model
     *
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // WHO data pakai titik/koma bisa beda → kita pastikan float
        $usia = (int) $row['month'] ?? 0;

        // Mapping sesuai parameter yg dipilih
        $data = [
            'jenis_kelamin' => $this->jenis,
            'usia_bulan'    => $usia,
        ];

        switch ($this->parameter) {
            case 'bb': // berat badan
                $data['bb_min'] = (float) ($row['sd2neg'] ?? null);
                $data['bb_max'] = (float) ($row['sd2'] ?? null);
                break;

            case 'tb': // tinggi badan
                $data['tb_min'] = (float) ($row['sd2neg'] ?? null);
                $data['tb_max'] = (float) ($row['sd2'] ?? null);
                break;

            case 'lk': // lingkar kepala
                $data['lk_min'] = (float) ($row['sd2neg'] ?? null);
                $data['lk_max'] = (float) ($row['sd2'] ?? null);
                break;

            case 'll': // lingkar lengan
                $data['ll_min'] = (float) ($row['sd2neg'] ?? null);
                $data['ll_max'] = (float) ($row['sd2'] ?? null);
                break;
        }

        return new StandarPertumbuhan($data);
    }
}
