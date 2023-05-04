<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Softcompany;
use App\Models\Mobile;
use App\Models\User;

class SoftDeleteController extends Controller
{
    // SOFT DELETE PARENT SOFT DELETE ALL CHILD RECORDS
    // Company(Main Parent Model) // has many employees/users
    // User(Parent Company) // has many mobile
    // Mobile(Parent User) // has one user or belongs to user

    public function storeData(){
        $user_id = 2;
        $mobile = new Mobile();
        $mobile->mobile_no = 9876543214;
        $mobile->user_id = $user_id;
        $mobile_id = $mobile->save();

        $company = new Softcompany();
        $company->name = 'Alex info';
        $company->address = 'Mohali';
        $company_id = $company->save();
    }

    public function deleteData(){
        $id = 1;
        $Softcompany = Softcompany::find($id);
        if($Softcompany){
            $res = $Softcompany->delete();
        }else{
            $res = 'No data found!';
        }
        dump($res);
    }
    
    public function listAllDataWithTrashed(){
        $softcompany = Softcompany::withTrashed()->get();
        foreach($softcompany as $company){
            $data['company'] = [
                'id' => $company->id,
                'name' => $company->name,
                'address' => $company->address
            ];
            foreach($company->users as $user){
                $u['id'] = $user->id; 
                $u['name'] = $user->name; 
                $u['email'] = $user->email; 
                $m = [];
                foreach($user->mobiles as $mobile){
                    $m[] = $mobile->mobile_no;
                }   
                $u['mobile'] = $m;              
                $data['company']['users'][] = $u;
            }
            $company_data[] =$data;
        }
        dump($company_data);
    }
    
    public function listAllData(){
        $softcompany = Softcompany::get();
        foreach($softcompany as $company){
            $data['company'] = [
                'id' => $company->id,
                'name' => $company->name,
                'address' => $company->address
            ];
            foreach($company->users as $user){
                $u['id'] = $user->id; 
                $u['name'] = $user->name; 
                $u['email'] = $user->email; 
                $m = [];
                foreach($user->mobiles as $mobile){
                    $m[] = $mobile->mobile_no;
                }   
                $u['mobile'] = $m;              
                $data['company']['users'][] = $u;
            }
            $company_data[] =$data;
        }
        dump($company_data);
    }
    
    
    public function restoreAllData(){
        $id =1;
        Softcompany::withTrashed()->find($id)->restore();
        // Softcompany::onlyTrashed()->restore();
    }

}
