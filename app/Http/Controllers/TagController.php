<?php

namespace App\Http\Controllers;

use App\Services\TagService;
use Illuminate\Http\Request;

class TagController extends Controller
{
    protected $tagService;

    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
    }

    public function index()
    {
        try {
            $tags = $this->tagService->getAllTags();
            return response()->json($tags);
        } catch (\Exception $e) {
          dd('error' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function show($id)
    {
        try {
            $tag = $this->tagService->getTagDetails($id);
            return response()->json($tag);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255', 
            ]);

            $tag = $this->tagService->createTag($request->all());
            return response()->json($tag, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function update($id, Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
            ]);

            $tag = $this->tagService->updateTag($id, $request->all());
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function destroy($id)
    {
        try {
            $this->tagService->deleteTag($id);
            return response()->json(['message' => 'Tag deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
