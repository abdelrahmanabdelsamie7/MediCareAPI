<?php
namespace App\Http\Controllers\API;
use App\Http\Requests\TipRequest;
use App\Models\Tip;
use App\Traits\ResponseJsonTrait;
use App\Http\Controllers\Controller;

class TipController extends Controller
{
    use ResponseJsonTrait;
    public function __construct()
    {
        $this->middleware('auth:admins')->only(['store', 'update', 'destroy']);
    }
    public function index()
    {
        $tips = Tip::all();
        return $this->sendSuccess('Tips Retrieved Successfully', $tips);
    }
    public function store(TipRequest $request)
    {
        $tip = Tip::create($request->validated());
        return $this->sendSuccess('Tip Added Successfully', $tip, 201);
    }
    public function show(string $id)
    {
        $tip = Tip::with('department')->findOrFail($id);
        return $this->sendSuccess('Tip Retrieved Successfully', $tip);
    }
    public function update(TipRequest $request, string $id)
    {
        $tip = Tip::findOrFail($id);
        $tip->update($request->validated());
        return $this->sendSuccess('Tip Updated Successfully', $tip, 201);
    }
    public function destroy(string $id)
    {
        $tip = Tip::findOrFail($id);
        $tip->delete();
        return $this->sendSuccess('Tip Deleted Successfully');
    }
}
