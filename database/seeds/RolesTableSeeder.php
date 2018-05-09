<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert(array(
           'name' => 'root',
           'display_name'  => 'Super Admin',
           'description' => 'Dios del sistema',
           'created_at' => date('Y-m-d H:m:s'),
           'updated_at' => date('Y-m-d H:m:s')
           
        ));
        
        DB::table('roles')->insert(array(
           'name' => 'director',
           'display_name'  => 'Director',
           'description' => 'Director del dadsa',
           'created_at' => date('Y-m-d H:m:s'),
           'updated_at' => date('Y-m-d H:m:s')
           
        ));
        
        DB::table('roles')->insert(array(
           'name' => 'recepcionista',
           'display_name'  => 'Recepcionista',
           'description' => 'Recepcionista dadsa',
           'created_at' => date('Y-m-d H:m:s'),
           'updated_at' => date('Y-m-d H:m:s')
           
        ));
        
        DB::table('roles')->insert(array(
           'name' => 'liderarea',
           'display_name'  => 'Lider de Area',
           'description' => '',
           'created_at' => date('Y-m-d H:m:s'),
           'updated_at' => date('Y-m-d H:m:s')
           
        ));
        
        DB::table('roles')->insert(array(
           'name' => 'auditor',
           'display_name'  => 'Auditor del dadsa',
           'description' => 'Encargado de auditar los procesos',
           'created_at' => date('Y-m-d H:m:s'),
           'updated_at' => date('Y-m-d H:m:s')
           
        ));
        
        DB::table('roles')->insert(array(
           'name' => 'agente',
           'display_name'  => 'Agente Dadsa',
           'description' => '',
           'created_at' => date('Y-m-d H:m:s'),
           'updated_at' => date('Y-m-d H:m:s')
           
        ));
    }
}
