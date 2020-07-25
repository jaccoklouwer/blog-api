<?php


namespace App\Repositories;


use App\Blog;
use App\Contracts\RepositoryContract;
use Exception;

class BlogRepository implements RepositoryContract
{
    public function getAll()
    {
        try {
            return Blog::latest()->get();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getById($id)
    {
        try {
            return Blog::find($id);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function create(Blog $blog)
    {

        return Blog::create([
            'title' => $blog->title,
            'slug' => $blog->slug,
            'summary' => $blog->summary,
            'content' => $blog->content
        ]);
    }

    public function update(Blog $oldblog, $newBlog)
    {

        if(array_key_exists('title', $newBlog)) {
            $oldblog->title = $newBlog['title'];
        }
        if(array_key_exists('summary', $newBlog)) {
            $oldblog->summary = $newBlog['summary'];
        }
        if(array_key_exists('content', $newBlog)) {
            $oldblog->content = $newBlog['content'];
        }

        return $oldblog->save();
    }

    public function delete($id)
    {
        return Blog::destroy($id);
    }
}