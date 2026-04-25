<?php

namespace App\Http\Controllers\Api;

use App\Models\Author;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    
    // public function index()
    // {
    // return "test1";
    // }

    public function store(request $request){
        try {
            $newAuthor = new Author;
            $newAuthor->first_name = $request->first_name;
            $newAuthor->middle_name = $request->middle_name;
            $newAuthor->last_name = $request->last_name;
            $newAuthor->save();
            return $newAuthor;

        }catch (\Throwable $e){
            return $e->getMessage();
        
        }
    }

    public function index()
    {
        try{
            $authors = Author::all();
            return response()->json(["data"=>$authors,"status"=>"success"],200);
        }catch(\Throwable $th){
            return response()->json(["Error"=>$th->getMessage()],500);
        }
    }

    public function update(Request $request){
        try {
            $validatedData = $request->validate([
                'id'=>['required'],
                'first_name' => ['required',new AuthorValidationRule('max','The first name must be only 5 characters in length')],
                'middle_name' => [new AuthorValidationRule('AlwaysCapital', 'The middle name should always be capital letter')],
                'last_name' => ['required',new AuthorValidationRule('StartsWithA','The last name should always be capital letter')],
            ]);
        }
        catch(\Throwable $th){
            return response()->json(["Error"=>$th->getMessage()],500);
        }
    }

    public function destroy(Request $request){
        try {
            $existingAuthor = Author::find($request['id']);

            if (!$existingAuthor) {
                return response()->json(["error" => "Author not found", "status" => "error"], 404);
            }

            $existingAuthor->delete();

            return response()->json(["message" => "Successfully deleted!", "status" => "success"], 200);
        } catch (QueryException $e) {
            // Handle database-related exception
        }
    }
}