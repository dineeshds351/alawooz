<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\User;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('isAdmin');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.students');
    }
    
    /**
     * Display the student data table content.
     */
    public function data()
    {
        $query = User::getStudentUsers();
        
        return Datatables::of($query)
            
            ->addColumn('action', function ( $query) {
               return   (!$query->status ? '<button type="button" class="btn btn-xs btn-warning" data-toggle="disable" data-url="' 
                       . route('student.enable', $query->id) 
                       . '"><i class="fa fa-trash"></i> Enable</button>&nbsp;' : '') 
                       .($query->status ? '<button type="button" class="btn btn-xs btn-success" data-toggle="disable" data-url="'
                       . route('student.disable', $query->id) 
                       . '"><i class="fa fa-trash"></i> Disable</button>&nbsp;' : '')
                       .'<button type="button" class="btn btn-xs btn-danger" data-toggle="delete" data-url="' 
                       . route('student.delete', $query->id) 
                       . '"><i class="fa fa-trash"></i> Delete</button>&nbsp;'
                       ;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    
    /**
     * Delete student user
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['type' => 'danger', 'message' => trans('messages.notexist', ['item' => 'User'])]);
        }
        
        $user->delete();
        User::trashRole($id);
        
        return response()->json(['type' => 'success', 'message' => trans('messages.deleted', ['item' => 'User'])]);
    }
    
    /**
     * Active user 
     */
    public function enable($id)
    {
        $user = User::find($id);
        if(!$user){
            return response()->json(['type' => 'danger', 'message' => trans('messages.notexist', ['item' => 'User'])]);
        }
        
        $user->update(['status' => true]);
        
        return response()->json(['type' => 'success', 'message' => trans('messages.enabled', ['item' => 'User'])]);
    }
    
    /**
     * Deactivate User
     */
    public function disable($id)
    {
        $user = User::find($id);
        if(!$user){
            return response()->json(['type' => 'danger', 'message' => trans('messages.notexist', ['item' => 'User'])]);
        }
        
        $user->update(['status' => false]);
       
        return response()->json(['type' => 'success', 'message' => trans('messages.disabled', ['item' => 'User'])]);
    }
}
