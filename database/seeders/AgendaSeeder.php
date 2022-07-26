<?php

namespace Database\Seeders;

use App\Models\Agenda;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AgendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $agendas = ["Publik", "Politikal", "Birokrasi", "Media", "Pemerintahan", "Organisasi Sendiri"];

        foreach($agendas as $agenda)
            Agenda::create(["name" => $agenda]);

    }
}
