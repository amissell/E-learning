<?php

namespace App\Http\Controllers;

use App\Services\TagService;
use Illuminate\Http\Request;

class TagController extends Controller
{
    protected $tagService;

    public function __construct(TagService $tagService)
    {
        // Inject the TagService into the controller
        $this->tagService = $tagService;
    }

    // Show all tags
    public function index()
    {
        try {
            $tags = $this->tagService->getAllTags();
            return response()->json($tags);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    // Show details of a specific tag
    public function show($id)
    {
        try {
            $tag = $this->tagService->getTagDetails($id);  // Use the service method to fetch tag by ID
            return response()->json($tag);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    // Create a new tag
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',  // Add validation rules here
            ]);

            $tag = $this->tagService->createTag($request->all());  // Use the service method to create a new tag
            return response()->json($tag, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    // Update an existing tag
    public function update($id, Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',  // Add validation rules here
            ]);

            $tag = $this->tagService->updateTag($id, $request->all());  // Use the service method to update the tag
            return response()->json($tag);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    // Delete a tag
    public function destroy($id)
    {
        try {
            $this->tagService->deleteTag($id);  // Use the service method to delete the tag
            return response()->json(['message' => 'Tag deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
