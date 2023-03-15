<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // prendo l'array dalla cartella Config
        $technologies = config('technologies');

        foreach ($technologies as $technology) {
            $new_technology = new Technology();

            $new_technology->label = $technology['label'];
            $new_technology->color = $technology['color'];

            // $new_technology->fill($techology);
            $new_technology->save();
        }
    }
}
