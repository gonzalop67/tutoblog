<?php

namespace App\Console\Commands;

use App\Models\Rol;
use App\Models\Usuario;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class Instalador extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tutoblog:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Este comando ejecuta el instalador inicial del proyecto';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if (!$this->verificar()) {
            $rol = $this->crearRolSuperAdmin();
            $usuario = $this->crearUsuarioSuperAdmin();
            //Relacionarlo
            $usuario->roles()->attach($rol);
            $this->line('El Rol y Usuario Administrador se instalaron correctamente');
        } else {
            $this->error('No se puede ejecutar el instalador, porque ya hay un rol creado');
        }
    }

    private function verificar()
    {
        return Rol::find(1);
    }

    private function crearRolSuperAdmin()
    {
        $rol = "Super Administrador";
        return Rol::create([
            'nombre' => $rol,
            'slug' => Str::slug($rol, '_')
        ]);
    }

    private function crearUsuarioSuperAdmin()
    {
        return Usuario::create([
            'nombre' => 'tuto_admin',
            'email' => 'chalo_quito@hotmail.com',
            'password' => Hash::make('Gp67M24e$')
        ]);
    }
}
