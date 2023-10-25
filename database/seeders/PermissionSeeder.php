<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'customers.index', 'description' => 'Ver lista de clientes'])->syncRoles('Administrador', 'Usuario');
        Permission::create(['name' => 'customers.store', 'description' => 'Crear cliente'])->syncRoles('Administrador', 'Usuario');
        Permission::create(['name' => 'customers.show', 'description' => 'Mostrar cliente'])->syncRoles('Administrador', 'Usuario');
        Permission::create(['name' => 'customers.update', 'description' => 'Actualizar cliente'])->syncRoles('Administrador', 'Usuario');
        Permission::create(['name' => 'customers.destroy', 'description' => 'Eliminar cliente'])->syncRoles('Administrador', 'Usuario');
        Permission::create(['name' => 'customers.attach', 'description' => 'Agregar servicios al cliente'])->syncRoles('Administrador', 'Usuario');
        Permission::create(['name' => 'customers.detach', 'description' => 'Quitar servicios al cliente'])->syncRoles('Administrador', 'Usuario');

        Permission::create(['name' => 'services.index', 'description' => 'Ver lista de servicios'])->syncRoles('Administrador', 'Usuario');
        Permission::create(['name' => 'services.store', 'description' => 'Crear servicio'])->syncRoles('Administrador');
        Permission::create(['name' => 'services.show', 'description' => 'Mostrar servicio'])->syncRoles('Administrador');
        Permission::create(['name' => 'services.update', 'description' => 'Actualizar servicio'])->syncRoles('Administrador');
        Permission::create(['name' => 'services.destroy', 'description' => 'Eliminar servicio'])->syncRoles('Administrador');
        Permission::create(['name' => 'services.customers', 'description' => 'Listar clientes de un servicio'])->syncRoles('Administrador');
    }
}
