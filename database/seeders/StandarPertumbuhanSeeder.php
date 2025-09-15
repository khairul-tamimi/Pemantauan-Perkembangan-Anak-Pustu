<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StandarPertumbuhan;

class StandarPertumbuhanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            // === LAKI-LAKI (L) ===
            ['jenis_kelamin'=>'L','usia_bulan'=>0, 'bb_min'=>2.5,'bb_max'=>4.4,'tb_min'=>46.1,'tb_max'=>55.6,'lk_min'=>32.1,'lk_max'=>37.0,'ll_min'=>null,'ll_max'=>null],
            ['jenis_kelamin'=>'L','usia_bulan'=>1, 'bb_min'=>3.4,'bb_max'=>5.7,'tb_min'=>50.8,'tb_max'=>60.6,'lk_min'=>34.0,'lk_max'=>39.5,'ll_min'=>null,'ll_max'=>null],
            ['jenis_kelamin'=>'L','usia_bulan'=>2, 'bb_min'=>4.3,'bb_max'=>7.0,'tb_min'=>54.4,'tb_max'=>64.4,'lk_min'=>36.0,'lk_max'=>41.0,'ll_min'=>null,'ll_max'=>null],
            ['jenis_kelamin'=>'L','usia_bulan'=>3, 'bb_min'=>5.0,'bb_max'=>7.9,'tb_min'=>57.3,'tb_max'=>67.6,'lk_min'=>37.0,'lk_max'=>42.5,'ll_min'=>null,'ll_max'=>null],
            ['jenis_kelamin'=>'L','usia_bulan'=>6, 'bb_min'=>6.4,'bb_max'=>9.7,'tb_min'=>63.0,'tb_max'=>74.0,'lk_min'=>39.0,'lk_max'=>45.0,'ll_min'=>11.0,'ll_max'=>13.5],
            ['jenis_kelamin'=>'L','usia_bulan'=>12,'bb_min'=>8.0,'bb_max'=>11.8,'tb_min'=>71.0,'tb_max'=>84.0,'lk_min'=>42.0,'lk_max'=>47.5,'ll_min'=>12.0,'ll_max'=>14.0],
            ['jenis_kelamin'=>'L','usia_bulan'=>24,'bb_min'=>9.7,'bb_max'=>14.8,'tb_min'=>82.0,'tb_max'=>95.0,'lk_min'=>46.0,'lk_max'=>50.0,'ll_min'=>13.0,'ll_max'=>15.0],
            ['jenis_kelamin'=>'L','usia_bulan'=>36,'bb_min'=>11.3,'bb_max'=>17.4,'tb_min'=>91.0,'tb_max'=>105.0,'lk_min'=>48.0,'lk_max'=>51.5,'ll_min'=>13.5,'ll_max'=>16.0],
            ['jenis_kelamin'=>'L','usia_bulan'=>48,'bb_min'=>12.7,'bb_max'=>20.3,'tb_min'=>99.0,'tb_max'=>113.0,'lk_min'=>49.0,'lk_max'=>52.0,'ll_min'=>14.0,'ll_max'=>16.5],
            ['jenis_kelamin'=>'L','usia_bulan'=>60,'bb_min'=>14.1,'bb_max'=>23.2,'tb_min'=>106.0,'tb_max'=>120.0,'lk_min'=>49.5,'lk_max'=>52.5,'ll_min'=>14.0,'ll_max'=>17.0],

            // === PEREMPUAN (P) ===
            ['jenis_kelamin'=>'P','usia_bulan'=>0, 'bb_min'=>2.4,'bb_max'=>4.2,'tb_min'=>45.4,'tb_max'=>54.7,'lk_min'=>31.5,'lk_max'=>36.0,'ll_min'=>null,'ll_max'=>null],
            ['jenis_kelamin'=>'P','usia_bulan'=>1, 'bb_min'=>3.2,'bb_max'=>5.4,'tb_min'=>49.8,'tb_max'=>59.8,'lk_min'=>33.5,'lk_max'=>38.5,'ll_min'=>null,'ll_max'=>null],
            ['jenis_kelamin'=>'P','usia_bulan'=>2, 'bb_min'=>4.0,'bb_max'=>6.6,'tb_min'=>53.0,'tb_max'=>63.2,'lk_min'=>35.0,'lk_max'=>40.0,'ll_min'=>null,'ll_max'=>null],
            ['jenis_kelamin'=>'P','usia_bulan'=>3, 'bb_min'=>4.6,'bb_max'=>7.5,'tb_min'=>55.6,'tb_max'=>66.1,'lk_min'=>36.0,'lk_max'=>41.0,'ll_min'=>null,'ll_max'=>null],
            ['jenis_kelamin'=>'P','usia_bulan'=>6, 'bb_min'=>5.8,'bb_max'=>9.2,'tb_min'=>61.2,'tb_max'=>72.8,'lk_min'=>38.5,'lk_max'=>44.0,'ll_min'=>11.0,'ll_max'=>13.0],
            ['jenis_kelamin'=>'P','usia_bulan'=>12,'bb_min'=>7.3,'bb_max'=>11.3,'tb_min'=>69.0,'tb_max'=>82.9,'lk_min'=>41.5,'lk_max'=>47.0,'ll_min'=>12.0,'ll_max'=>14.0],
            ['jenis_kelamin'=>'P','usia_bulan'=>24,'bb_min'=>8.9,'bb_max'=>14.2,'tb_min'=>80.0,'tb_max'=>94.0,'lk_min'=>45.5,'lk_max'=>49.5,'ll_min'=>13.0,'ll_max'=>15.0],
            ['jenis_kelamin'=>'P','usia_bulan'=>36,'bb_min'=>10.5,'bb_max'=>16.9,'tb_min'=>89.0,'tb_max'=>104.0,'lk_min'=>47.5,'lk_max'=>50.5,'ll_min'=>13.5,'ll_max'=>16.0],
            ['jenis_kelamin'=>'P','usia_bulan'=>48,'bb_min'=>12.0,'bb_max'=>19.8,'tb_min'=>97.0,'tb_max'=>111.0,'lk_min'=>48.5,'lk_max'=>51.5,'ll_min'=>14.0,'ll_max'=>16.5],
            ['jenis_kelamin'=>'P','usia_bulan'=>60,'bb_min'=>13.5,'bb_max'=>22.5,'tb_min'=>104.0,'tb_max'=>117.0,'lk_min'=>49.0,'lk_max'=>52.0,'ll_min'=>14.0,'ll_max'=>17.0],
        ];

        foreach ($data as $row) {
            StandarPertumbuhan::create($row);
        }
    }
}
