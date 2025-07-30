<?php

namespace App\Console\Commands;

use App\Models\Usuario;
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
        $usuario = $this->crearUsuarioSuperAdmin();
        //Relacionarlo
        $usuario->roles()->attach(1);
        $this->line('El Usuario Administrador se instaló correctamente');
    }

    private function crearUsuarioSuperAdmin()
    {
        return Usuario::create([
            'nombre' => 'tuto_admin',
            'email' => 'chalo_quito@hotmail.com',
            'password' => Hash::make('Gp67M24e$'),
            'estado' => 1,
        ]);
    }
}
