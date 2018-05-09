<?php

use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert(array(
           'name' => 'create-area',
           'display_name'  => '',
           'description' => ' ',
           'created_at' => date('Y-m-d H:m:s'),
           'updated_at' => date('Y-m-d H:m:s')
           
        ));
        
        DB::table('permissions')->insert(array(
           'name' => 'read-area',
           'display_name'  => '',
           'description' => ' ',
           'created_at' => date('Y-m-d H:m:s'),
           'updated_at' => date('Y-m-d H:m:s')
           
        ));
        
        DB::table('permissions')->insert(array(
           'name' => 'readlist-area',
           'display_name'  => '',
           'description' => ' ',
           'created_at' => date('Y-m-d H:m:s'),
           'updated_at' => date('Y-m-d H:m:s')
           
        ));
        
        DB::table('permissions')->insert(array(
           'name' => 'update-area',
           'display_name'  => '',
           'description' => ' ',
           'created_at' => date('Y-m-d H:m:s'),
           'updated_at' => date('Y-m-d H:m:s')
           
        ));
        
        DB::table('permissions')->insert(array(
           'name' => 'delete-area',
           'display_name'  => '',
           'description' => ' ',
           'created_at' => date('Y-m-d H:m:s'),
           'updated_at' => date('Y-m-d H:m:s')
           
        ));
        
        //Persons
        DB::table('permissions')->insert(array(
           'name' => 'create-person',
           'display_name'  => '',
           'description' => ' ',
           'created_at' => date('Y-m-d H:m:s'),
           'updated_at' => date('Y-m-d H:m:s')
           
        ));
        
        DB::table('permissions')->insert(array(
           'name' => 'read-person',
           'display_name'  => '',
           'description' => ' ',
           'created_at' => date('Y-m-d H:m:s'),
           'updated_at' => date('Y-m-d H:m:s')
           
        ));
        
        DB::table('permissions')->insert(array(
           'name' => 'readlist-person',
           'display_name'  => '',
           'description' => ' ',
           'created_at' => date('Y-m-d H:m:s'),
           'updated_at' => date('Y-m-d H:m:s')
           
        ));
        
        DB::table('permissions')->insert(array(
           'name' => 'update-person',
           'display_name'  => '',
           'description' => ' ',
           'created_at' => date('Y-m-d H:m:s'),
           'updated_at' => date('Y-m-d H:m:s')
           
        ));
        
        DB::table('permissions')->insert(array(
           'name' => 'delete-person',
           'display_name'  => '',
           'description' => ' ',
           'created_at' => date('Y-m-d H:m:s'),
           'updated_at' => date('Y-m-d H:m:s')
           
        ));
        
        //Tickets
        DB::table('permissions')->insert(array(
           'name' => 'create-tickets',
           'display_name'  => '',
           'description' => ' ',
           'created_at' => date('Y-m-d H:m:s'),
           'updated_at' => date('Y-m-d H:m:s')
           
        ));
        
        DB::table('permissions')->insert(array(
           'name' => 'read-tickets',
           'display_name'  => '',
           'description' => ' ',
           'created_at' => date('Y-m-d H:m:s'),
           'updated_at' => date('Y-m-d H:m:s')
           
        ));
        
        DB::table('permissions')->insert(array(
           'name' => 'readlist-tickets',
           'display_name'  => '',
           'description' => ' ',
           'created_at' => date('Y-m-d H:m:s'),
           'updated_at' => date('Y-m-d H:m:s')
           
        ));
        
        DB::table('permissions')->insert(array(
           'name' => 'update-tickets',
           'display_name'  => '',
           'description' => ' ',
           'created_at' => date('Y-m-d H:m:s'),
           'updated_at' => date('Y-m-d H:m:s')
           
        ));
        
        DB::table('permissions')->insert(array(
           'name' => 'delete-tickets',
           'display_name'  => '',
           'description' => ' ',
           'created_at' => date('Y-m-d H:m:s'),
           'updated_at' => date('Y-m-d H:m:s')
           
        ));
        
        //Subject
        DB::table('permissions')->insert(array(
           'name' => 'create-subject',
           'display_name'  => '',
           'description' => ' ',
           'created_at' => date('Y-m-d H:m:s'),
           'updated_at' => date('Y-m-d H:m:s')
           
        ));
        
        DB::table('permissions')->insert(array(
           'name' => 'read-subject',
           'display_name'  => '',
           'description' => ' ',
           'created_at' => date('Y-m-d H:m:s'),
           'updated_at' => date('Y-m-d H:m:s')
           
        ));
        
        DB::table('permissions')->insert(array(
           'name' => 'readlist-subject',
           'display_name'  => '',
           'description' => ' ',
           'created_at' => date('Y-m-d H:m:s'),
           'updated_at' => date('Y-m-d H:m:s')
           
        ));
        
        DB::table('permissions')->insert(array(
           'name' => 'update-subject',
           'display_name'  => '',
           'description' => ' ',
           'created_at' => date('Y-m-d H:m:s'),
           'updated_at' => date('Y-m-d H:m:s')
           
        ));
        
        DB::table('permissions')->insert(array(
           'name' => 'delete-subject',
           'display_name'  => '',
           'description' => ' ',
           'created_at' => date('Y-m-d H:m:s'),
           'updated_at' => date('Y-m-d H:m:s')
           
        ));
        
        //Assignment
        DB::table('permissions')->insert(array(
           'name' => 'create-assignment',
           'display_name'  => '',
           'description' => ' ',
           'created_at' => date('Y-m-d H:m:s'),
           'updated_at' => date('Y-m-d H:m:s')
           
        ));
        
        DB::table('permissions')->insert(array(
           'name' => 'read-assignment',
           'display_name'  => '',
           'description' => ' ',
           'created_at' => date('Y-m-d H:m:s'),
           'updated_at' => date('Y-m-d H:m:s')
           
        ));
        
        DB::table('permissions')->insert(array(
           'name' => 'readlist-assignment',
           'display_name'  => '',
           'description' => ' ',
           'created_at' => date('Y-m-d H:m:s'),
           'updated_at' => date('Y-m-d H:m:s')
           
        ));
        
        DB::table('permissions')->insert(array(
           'name' => 'update-assignment',
           'display_name'  => '',
           'description' => ' ',
           'created_at' => date('Y-m-d H:m:s'),
           'updated_at' => date('Y-m-d H:m:s')
           
        ));
        
        DB::table('permissions')->insert(array(
           'name' => 'delete-assignment',
           'display_name'  => '',
           'description' => ' ',
           'created_at' => date('Y-m-d H:m:s'),
           'updated_at' => date('Y-m-d H:m:s')
           
        ));
        
        //Users
        DB::table('permissions')->insert(array(
           'name' => 'create-user',
           'display_name'  => '',
           'description' => ' ',
           'created_at' => date('Y-m-d H:m:s'),
           'updated_at' => date('Y-m-d H:m:s')
           
        ));
        
        DB::table('permissions')->insert(array(
           'name' => 'read-user',
           'display_name'  => '',
           'description' => ' ',
           'created_at' => date('Y-m-d H:m:s'),
           'updated_at' => date('Y-m-d H:m:s')
           
        ));
        
        DB::table('permissions')->insert(array(
           'name' => 'readlist-user',
           'display_name'  => '',
           'description' => ' ',
           'created_at' => date('Y-m-d H:m:s'),
           'updated_at' => date('Y-m-d H:m:s')
           
        ));
        
        DB::table('permissions')->insert(array(
           'name' => 'update-user',
           'display_name'  => '',
           'description' => ' ',
           'created_at' => date('Y-m-d H:m:s'),
           'updated_at' => date('Y-m-d H:m:s')
           
        ));
        
        DB::table('permissions')->insert(array(
           'name' => 'delete-user',
           'display_name'  => '',
           'description' => ' ',
           'created_at' => date('Y-m-d H:m:s'),
           'updated_at' => date('Y-m-d H:m:s')
           
        ));
        
        //Notification
        DB::table('permissions')->insert(array(
           'name' => 'create-notification',
           'display_name'  => '',
           'description' => ' ',
           'created_at' => date('Y-m-d H:m:s'),
           'updated_at' => date('Y-m-d H:m:s')
           
        ));
        
        DB::table('permissions')->insert(array(
           'name' => 'read-notification',
           'display_name'  => '',
           'description' => ' ',
           'created_at' => date('Y-m-d H:m:s'),
           'updated_at' => date('Y-m-d H:m:s')
           
        ));
        
        DB::table('permissions')->insert(array(
           'name' => 'readlist-notification',
           'display_name'  => '',
           'description' => ' ',
           'created_at' => date('Y-m-d H:m:s'),
           'updated_at' => date('Y-m-d H:m:s')
           
        ));
        
        DB::table('permissions')->insert(array(
           'name' => 'update-notification',
           'display_name'  => '',
           'description' => ' ',
           'created_at' => date('Y-m-d H:m:s'),
           'updated_at' => date('Y-m-d H:m:s')
           
        ));
        
        DB::table('permissions')->insert(array(
           'name' => 'delete-notification',
           'display_name'  => '',
           'description' => ' ',
           'created_at' => date('Y-m-d H:m:s'),
           'updated_at' => date('Y-m-d H:m:s')
           
        ));
        
        //Form
        DB::table('permissions')->insert(array(
           'name' => 'create-form',
           'display_name'  => '',
           'description' => ' ',
           'created_at' => date('Y-m-d H:m:s'),
           'updated_at' => date('Y-m-d H:m:s')
           
        ));
        
        DB::table('permissions')->insert(array(
           'name' => 'read-form',
           'display_name'  => '',
           'description' => ' ',
           'created_at' => date('Y-m-d H:m:s'),
           'updated_at' => date('Y-m-d H:m:s')
           
        ));
        
        DB::table('permissions')->insert(array(
           'name' => 'readlist-form',
           'display_name'  => '',
           'description' => ' ',
           'created_at' => date('Y-m-d H:m:s'),
           'updated_at' => date('Y-m-d H:m:s')
           
        ));
        
        DB::table('permissions')->insert(array(
           'name' => 'update-form',
           'display_name'  => '',
           'description' => ' ',
           'created_at' => date('Y-m-d H:m:s'),
           'updated_at' => date('Y-m-d H:m:s')
           
        ));
        
        DB::table('permissions')->insert(array(
           'name' => 'delete-form',
           'display_name'  => '',
           'description' => ' ',
           'created_at' => date('Y-m-d H:m:s'),
           'updated_at' => date('Y-m-d H:m:s')
           
        ));
        
    }
}
