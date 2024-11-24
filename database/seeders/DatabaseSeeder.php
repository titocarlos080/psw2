<?php

namespace Database\Seeders;

use App\Models\Cliente;
use Illuminate\Database\Seeder;


use App\Models\User;
use App\Models\Medico;

use App\Models\Subscription;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $user = new User;
        $user->name = 'admin';
        $user->email = 'admin@gmail.com';
        $user->password = '1234';
        $user->role = 'admin';
        $user->save();

        $user = new User;
        $user->name = 'Recepcionista';
        $user->email = 'recepcionista1@gmail.com';
        $user->password = '1234';
        $user->role = 'admin';
        $user->save();

        $user = new User;
        $user->name = 'medico';
        $user->email = 'medico@gmail.com';
        $user->password = '1234';
        $user->role = 'medico';
        $user->save();

        $medico1 = Medico::create([
            'ci' => '123456',
            'nombre' => 'Médico1',
            'a_paterno' => 'Apellido1',
            'a_materno' => 'Apellido2',
            'especialidad' => 'Especialidad1',
            'sexo'=>'f',
            'telefono'=>'5432543',
            'direccion'=> 'av 67 calle 4',
            'estado'=>'h',
            'user_id' => $user->id,
        ]);

        $user = new User;
        $user->name = 'Pedro';
        $user->email =  'pedro@gmail.com';
        $user->password = '1234';
        $user->role = 'medico';
        $user->save();

        $user = new User;
        $user->name = 'cliente';
        $user->email = 'cliente@gmail.com';
        $user->password = '1234';
        $user->role = 'cliente';
        $user->save();

        $cliente1 = Cliente::create([
            'ci' => '125436',
            'nombre' => 'cliente1',
            'a_paterno' => 'Apellido1',
            'a_materno' => 'Apellido2',
            'sexo'=>'f',
            'telefono'=>'5432543',
            'direccion'=> 'av 67 calle 4',
            'estado'=>'h',
            'user_id' => $user->id,
        ]);

        $user = new User;
        $user->name = 'cliente2';
        $user->email = 'cliente2@gmail.com';
        $user->password = '1234';
        $user->role = 'cliente';
        $user->save();

        $cliente1 = Cliente::create([
            'ci' => '125436789',
            'nombre' => 'cliente2',
            'a_paterno' => 'Apellido2',
            'a_materno' => 'Apellido2',
            'sexo'=>'f',
            'telefono'=>'5432543',
            'direccion'=> 'av 67 calle 4df',
            'estado'=>'h',
            'user_id' => $user->id,
        ]);
        // Agregar suscripcion al cliente
        $subscription = new Subscription;
        $subscription->user_id = 3;
        $subscription->paypal_plan_id = 'P-4JU64663JX8791442L5ZQZ7I';
        $subscription->paypal_agreement_id = 'I-0YJ9XJ1XJXJX';
        $subscription->status = 'active';
        $subscription->start_date = date('Y-m-d');
        $subscription->end_date = date('Y-m-d', strtotime('+1 month'));
        $subscription->save();

        $user = new User;
        $user->name = 'cliente dos';
        $user->email = 'cliente22@gmail.com';
        $user->password = '1234';
        $user->role = 'cliente';
        $user->save();

        $user = new User;
        $user->name = 'yamil';
        $user->email =  'yamil@gmail.com';
        $user->password = '1234';
        $user->role = 'cliente';
        $user->save();
        

    }




}
