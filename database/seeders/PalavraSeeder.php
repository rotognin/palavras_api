<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Palavra;

class PalavraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Palavra::factory()
            ->times(10)
            ->create();
    }
}
