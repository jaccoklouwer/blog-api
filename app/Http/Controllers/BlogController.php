<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Repositories\BlogRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BlogController extends Controller
{
    private $repository;

    /**
     * BlogController constructor.
     * @param $repository
     */
    public function __construct(BlogRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        try {
            $blogs = $this->repository->getAll();

            $data = [];

            foreach ($blogs as $blog) {
                $data[] = [
                    'title' => $blog['title'],
                    'slug' => $blog['slug'],
                    'summary' => $blog['summary']
                ];
            }

            return \response(['message' => 'succes', 'data' => $data], 200);
        } catch (Exception $e) {
            return response([
                "message" => "something went wrong!",
                "data" => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'title' => 'required|string',
            'summary' => 'required|string',
            'content' => 'required|string',
        ]);

        try {
            $blog = new Blog();
            $blog->title = $attributes['title'];
            $blog->setSlug();
            $blog->summary = $attributes['summary'];
            $blog->content = $attributes['content'];

            $this->repository->create($blog);

            return response(['status' => 'success'], 200);

        } catch (Exception $e) {
            return response([
                "message" => "something went wrong!",
                "data" => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Blog $blog
     * @return Response
     */
    public function show($id)
    {
        $blog = $this->repository->getById($id);
        if($blog){
            return response($blog, 200);
        }
        return \response(['message' => "no_blogs_found"], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Blog $blog
     * @return Response
     */
    public function update(Request $request, Blog $blog)
    {
        if ($this->repository->getById($blog->id) == null) {
            return response(["message" => "the blog was not found"], 404);
        }

        $attributes = $request->validate([
            'title' => 'string',
            'summary' => 'string',
            'content' => 'string',
        ]);

        try {
            $this->repository->update($blog, $attributes);
            return response(['status' => 'success'], 200);
        } catch (Exception $e) {
            return response(["message" => $e->getMessage(), 'error' => $e->getLine()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Blog $blog
     * @return Response
     */
    public function destroy($id)
    {
        try {
            $this->repository->delete($id);

            return response(['status' => 'success'], 200);
        } catch (Exception $e) {
            return response([
                "message" => "something went wrong!",
                "data" => $e->getMessage()
            ], 400);
        }
    }
}
