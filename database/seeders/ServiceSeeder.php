<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Service::create([
            'name' => 'Mantenimiento de computadoras',
            'description' => 'Limpieza, cambio de pasta termica y optimización del sistema operativo',
            'price' => 60
        ]);

        Service::create([
            'name' => 'Recarga de tinta',
            'description' => 'Se recargan cartuchos y tintas de impresoras',
            'price' => 30
        ]);

        Service::create([
            'name' => 'Formateo de sistema operativo',
            'description' => 'Se formatea y se instalan programas para PC y laptops',
            'price' => 50
        ]);
    }
}
