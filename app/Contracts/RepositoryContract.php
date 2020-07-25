<?php

namespace App\Contracts;

use App\Blog;

interface RepositoryContract
{
    public function getAll();

    public function getById(Blog $blog);

    public function create(Blog $blog);

    public function update(Blog $oldBlog, $newBlog);

    public function delete(Blog $blog);
}