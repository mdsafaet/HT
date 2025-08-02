<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Trait\TraitsApiResponseTrait;
use App\Http\Requests\TagRegisterRequest;

class TagController extends Controller





{
     use TraitsApiResponseTrait;

    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TagRegisterRequest $request)
    {
        
        $data = $request->validated();

        $tag = Tag::create([
            'name' => $data['name']
        ]);

        return $this->success('Tag created successfully', $tag);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag ,$id)
    {
         $tag = Tag::find($id);

        if (!$tag) {
            return $this->error('Tag not found', 404);
        }

        if ($tag->delete()) {
            return $this->success('Tag deleted successfully');
        }

        return $this->error('Failed to delete tag', 500);
    }
}
