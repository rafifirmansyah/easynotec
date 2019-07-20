<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 *  Call Auth, Validator, User model, Note model, and DataTables
 * 
 */
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Note;
use DataTables;


class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // Get Id from Auth User Login
            $id = Auth::id();
            $user = User::findOrFail($id);

            // Get data notes from User Model
            $notes = $user->notes()->orderBy('name', 'asc')->get();
        
            //check data
            $check = json_decode($notes, true);
            if(count($check) > 0){
                foreach($notes as $note)
                {
                    $result[] = [
                        'id' => $note->id,
                        'name' => $note->name,
                        'username' => $note->username,
                        'note' => $note->note,
                        'created_at' => $note->created_at->format('D, d-M-Y  h:i:s A'), 
                        'updated_at' => 
                        $note->updated_at->format('D, d-M-Y  h:i:s A')
                    ];    
                }
            }else{
                $result = [];
            }

            return Datatables::of($result)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row['id'].'" data-original-title="Detail" class="detail btn btn-success btn-sm mr-1 detailNote">Detail</a>';

                        $btn .= '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row['id'].'" data-original-title="Edit" class="edit btn btn-primary btn-sm mr-1 editNote">Edit</a>';

                        $btn .= '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row['id'].'" data-original-title="Delete" class="btn btn-danger btn-sm deleteNote">Delete</a>';
                        
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);            
        }

        return view('note.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Set rules validation
        $rules = [
            'name' => 'required',
            'username' => 'required',
            'password' => 'required',
            'note' => 'required' 
        ];

        //Validation
        $request->validate($rules);


        // Get user_id from Auth user login
        $id = Auth::id(); 
        $data = $request->all();

        // Create Note from Model User
        $user = User::findOrFail($id);
        $create_note = $user->notes()->create($data);
        
        return response()->json(['success' => 'Note successfully created.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Get data
        $data = Note::findOrFail($id);

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Get Data
        $id = $request->notes_idEdit;
        $data = [
            'name' => $request->nameEdit,
            'username' => $request->usernameEdit,
            'password' => $request->passwordEdit,
            'website' => $request->websiteEdit,
            'note' => $request->noteEdit
        ];

        // Set rules validation
        $rules = [
            'name' => 'required',
            'username' => 'required',
            'password' => 'required',
            'note' => 'required' 
        ];

        //Validation
        $valid = Validator::make($data, $rules);
        if ($valid->fails()) {
            return response()->json([
                'success' => false,
                'message' => $valid->errors()
            ], 400);
        }

        Note::findOrFail($id)->update($data);
    
        return response()->json(['success' => 'Note successfully updated.']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Note::findOrFail($id)->delete();
        return response()->json(['success' => 'Note successfully deleted.']);
    }
}
