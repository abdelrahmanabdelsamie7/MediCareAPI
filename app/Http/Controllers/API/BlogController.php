<?php
namespace App\Http\Controllers\API;
use App\Models\Blog;
use App\Traits\ResponseJsonTrait;
use App\Http\Requests\BlogRequest;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    use ResponseJsonTrait;
    public function __construct()
    {
        $this->middleware('auth:doctors')->only(['index', 'store', 'show', 'update', 'destroy']);
    }
    public function index()
    {
        $blogs = Blog::where('doctor_id', auth('doctors')->id())->get();
        return $this->sendSuccess('Doctor Blogs Retrieved Successfully', $blogs);
    }
    public function store(BlogRequest $request)
    {
        $blog = Blog::create(array_merge(
            $request->validated(),
            ['doctor_id' => auth('doctors')->id()]
        ));
        return $this->sendSuccess('Doctor Blog Added Successfully', $blog, 201);
    }
    public function show(string $id)
    {
        $blog = Blog::where('id', $id)
            ->where('doctor_id', auth('doctors')->id())
            ->with(['doctor'])
            ->firstOrFail();

        return $this->sendSuccess('Doctor Blog Retrieved Successfully', $blog);
    }
    public function update(BlogRequest $request, string $id)
    {
        $blog = Blog::where('id', $id)
            ->where('doctor_id', auth('doctors')->id())
            ->firstOrFail();
        $blog->update($request->validated());
        return $this->sendSuccess('Doctor Blog Updated Successfully', $blog);
    }
    public function destroy(string $id)
    {
        $blog = Blog::where('id', $id)
            ->where('doctor_id', auth('doctors')->id())
            ->firstOrFail();
        $blog->delete();
        return $this->sendSuccess('Doctor Blog Deleted Successfully');
    }
}
