<?php

namespace Database\Seeders;

use App\Models\Backend\Rol;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'nombre' => 'Super Administrador',
                'slug' => 'superadmin'
            ],
            [
                'id' => 2,
                'nombre' => 'Administrador',
                'slug' => 'admin'
            ],
        ];

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('menu')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        foreach ($data as $item) {
            // DB::table('roles')->insert([
            //     'id' => $item['id'],
            //     'name' => $item['name'],
            //     'slug' => $item['slug'],
            //     'created_at' => now(),
            //     'updated_at' => now()
            // ]);
            Rol::create($item);
        }

    }
}
