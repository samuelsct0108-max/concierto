<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function createUser(Request $request){
        DB::beginTransaction();

        try {
            // Check if the user already exists in users_gmos
            $userExist = DB::select('select * from users_gmos where email = ?',[$request->email]);

            if(empty($userExist)){
                // Insert into users table
                DB::insert('insert into users (name, email, password) values (?, ?, ?)', [
                    $request['name'],
                    $request['email'],
                    sha1($request['password'])
                ]);

                // Get the newly created user id
                $userId = DB::getPdo()->lastInsertId();

                // Insert into users_gmos table
                DB::insert('insert into users_gmos (name, email, password, id_rol, user_id) values (?, ?, ?, CAST(? AS SIGNED), ?)', [
                    $request['name'],
                    $request['email'],
                    sha1($request['password']),
                    $request['id_rol'],
                    $userId
                ]);

                DB::commit();

                return back()->with('success', 'Item successfully created');
            } else {
                return back()->with('error', 'A employee already exists with the entered email address.');
            }
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'There was an error creating the user. Please try again.');
        }
    }


    public function getUsers(Request $request){
       $data =  DB::select('select users_gmos.id,users_gmos.name,roles_gmos.rol_name role_name, users_gmos.created_at  from users_gmos left join roles_gmos on users_gmos.id_rol = roles_gmos.id');
       return response()->json([
           'data' => $data
       ]);
    }

    public function updateUser(Request $request){
            $password_exist = DB::select('select * from users_gmos where email = ? and password = ?',
            [
                $request['email'],
                $request['password']
            ]);
            if(empty($password_exist)){
                DB::update('update users_gmos set name = ?,email = ?, password = ?, id_rol = ? where id = CAST(? AS SIGNED)',
                [
                    $request['name'],
                    $request['email'],
                    sha1($request['password']),
                    $request['id_rol'],
                    $request['id']
                ]);
                return back()->with('success','Item successfully updated');
            }else{
                DB::update('update users_gmos set name = ?,email = ?, id_rol = ? where id = CAST(? AS SIGNED)',
                [
                    $request['name'],
                    $request['email'],
                    $request['id_rol'],
                    $request['id']
                ]);
                return back()->with('success','Item successfully updated');
            }
    }

    public function deleteUser($id){
        DB::delete('delete from users_gmos where id = CAST(? AS SIGNED)', [$id]);
    }

    public function login(Request $request){
        $user = DB::select('select * from users_gmos where email = ? and password = ?', [$request['email'],sha1($request['password'])]);
        if(empty($user)){
            return back()->with('error','There is no user or employee with the email and password ');
        }else{
            session([
                'userId' => $user[0]->id,
                'userName' => $user[0]->name,
                'userEmail' => $user[0]->email,
                'userRol' => $user[0]->id_rol
            ]);
            if( $user[0]->id_rol == 2 ||  $user[0]->id_rol == '2'){
                return redirect('/system/sales');
            }else{
                return redirect('/system');
            }
        }
    }

    function logout(){
        session()->flush();
        return redirect('/form-login');
    }

    function changePassword($email = ''){
        return view('change-password',compact('email'));
    }

    function makeChangePassword(Request $request){
        $userCanChange = DB::select('select * from temporal_user where temp_email = ? and change_password = 0',[$request->email]);
        if($request->pass1 !== $request->pass2){
            return redirect('/change-password/'.$request->email)->with('error','Passwords do not match');
        }
        if(empty($userCanChange)){
            return redirect('/change-password')->with('error','Incorrect or expired link 1');
        }
        if(is_null($request->email)){
            return redirect('/change-password')->with('error','Incorrect or expired link 2');
        }
        $isUser = DB::select('select * from users_gmos where email = ?',[$request->email]);
        if(empty($isUser)){
            $isEmployee = DB::select('select * from employees_gmos where email = ?',[$request->email]);
            if(empty($isEmployee)){
                return redirect('/forgot-password')->with('error','There is no user or employee registered with this email address.');
            }else{
                DB::update('update employees_gmos set password = ? where email = ?',[sha1($request->pass1),$request->email]);
                DB::update('update temporal_user set change_password = 1 where temp_email = ?',[$request->email]);
                return redirect('/forgot-password')->with('success','Your password has been successfully changed');
            }
        }else{
            DB::update('update users_gmos set password = ? where email = ?',[sha1($request->pass1),$request->email]);
            DB::update('update temporal_user set change_password = 1 where temp_email = ?',[$request->email]);
            return redirect('/forgot-password')->with('success','Your password has been successfully changed');
        }
    }
}
