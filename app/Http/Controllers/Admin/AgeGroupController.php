<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\AgeGroup;
use Auth;

class AgeGroupController extends Controller
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
        return view('admin.age_group');
    }
    
    /**
     * Create age group 
     */
    public function create()
    {
        $age_group = null;
        return view('admin.create_group',compact('age_group'));
    }
    
    /**
     * age group edit
     */
    public function edit($id)
    {
        $age_group = AgeGroup::getGroupById($id);
        return view('admin.create_group',compact('age_group'));
    }
    
    /**
     * Get all age Groups
     */
    public function data()
    {
        $group_data = AgeGroup::getAgeGroups();
        
        return Datatables::of($group_data)
            
            ->addColumn('action', function ( $group_data) {
               return   '<a href="' .route('age.edit', $group_data->id)
                       . '" class="btn btn-xs btn-primary" data-toggle="edit"><i class="fa fa-edit"></i> Edit</a>&nbsp;'
                       .'<button type="button" class="btn btn-xs btn-danger" data-toggle="delete" data-url="' 
                       . route('age.delete', $group_data->id) 
                       . '"><i class="fa fa-trash"></i> Delete</button>&nbsp;'
                       ;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    
    /**
     * Store Age group
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'group_name' => 'required',
            'age_from' => 'required|numeric|between:4,18',
            'age_to' => 'required|numeric|between:4,18'
        ]);
        
        $ageGroupData = array(
            'group_name' => $request->group_name,
            'age_from' => $request->age_from,
            'age_to' => $request->age_to,
            'user_id' => Auth::user()->id );
        AgeGroup::create($ageGroupData);
        
        return redirect()->route('age.group')->with('alert', ['type' => 'success', 'message' => trans('messages.created', ['item' => 'Age Group'])]);
    }
    
    /**
     * Update age group
     */
    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'group_name' => 'required',
            'age_from' => 'required|numeric|between:4,18',
            'age_to' => 'required|numeric|between:4,18'
        ]);
        
        $ageGroup = AgeGroup::find($id);
        $ageGroup->update($request->all());
        
        return redirect()->route('age.group')->with('alert', ['type' => 'success', 'message' => trans('messages.updated', ['item' => 'Age Group'])]);
    }
    
    /**
     * Delete age group
     */
    public function destroy($id)
    {
        $ageGroup = AgeGroup::find($id);
        if (!$ageGroup) {
            return response()->json(['type' => 'danger', 'message' => trans('messages.notexist', ['item' => 'Age Group'])]);
        }
        
        $ageGroup->delete();
        
        return response()->json(['type' => 'success', 'message' => trans('messages.deleted', ['item' => 'Age Group'])]);
    }
}