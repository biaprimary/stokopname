<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $role_admin = [
          "slug" => "admin",
          "name" => "Admin",
          "permissions" => [
            "admin" => true
          ]
        ];

        Sentinel::getRoleRepository()->createModel()->fill($role_admin)->save();
        $adminrole = Sentinel::findRoleByName('Admin');
        $user_admin = ["name"=>"Administrator", "phone"=>"01234567890","address"=>"Admin Street", "email"=>"admin@gmail.com", "password"=>'admin123'];
        $adminuser = Sentinel::registerAndActivate($user_admin);
        $adminuser->roles()->attach($adminrole);

         $role_supplier = [
         "slug" => "supplier",
         "name" => "Supplier",
         "permissions" => [
         "admin.supplier" => true
          ]
          ];
          Sentinel::getRoleRepository()->createModel()->fill($role_supplier)->save();
          $supplierrole = Sentinel::findRoleByName('Supplier');
          $user_supplier = ["name"=>"Supplier", "phone"=>"01234567890","address"=>"Supplier Address", "email"=>"supplier@gmail.com", "password"=>'supplier123'];
          $supplieruser = Sentinel::registerAndActivate($user_supplier);
          $supplieruser->roles()->attach($supplierrole);

          $role_buyer = [
          "slug" => "buyer",
          "name" => "Buyer",
          "permissions" => [
          "admin.belanja" => true
           ]
           ];
           Sentinel::getRoleRepository()->createModel()->fill($role_buyer)->save();
           $buyerrole = Sentinel::findRoleByName('Buyer');
           $user_buyer = ["name"=>"Buyer", "phone"=>"01234567890","address"=>"Buyer Address", "email"=>"buyer@gmail.com", "password"=>'buyer123'];
           $buyeruser = Sentinel::registerAndActivate($user_buyer);
           $buyeruser->roles()->attach($buyerrole);
    }
}
