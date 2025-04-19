<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InusranceCompanyLaboratoryController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'insurance_company_id' => 'required|exists:insurance_companies,id',
            'laboratory_id' => 'required|exists:pharmacies,id',
        ]);
        $exists = DB::table('insurance_company_pharmacy')
            ->where('insurance_company_id', $validated['insurance_company_id'])
            ->where('laboratory_id', $validated['laboratory_id'])
            ->exists();
        if ($exists) {
            return response()->json(['message' => 'This relationship already exists.'], 400);
        }
        DB::table('insurance_company_pharmacy')->insert([
            'insurance_company_id' => $validated['insurance_company_id'],
            'laboratory_id' => $validated['laboratory_id'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['message' => 'Relationship created successfully.'], 201);
    }
    public function destroy(string $id)
    {
        $deleted = DB::table('insurance_company_laboratory')->where('id', $id)->delete();
        if ($deleted) {
            return response()->json(['message' => 'Relationship deleted successfully.']);
        }
        return response()->json(['message' => 'Relationship not found.'], 404);
    }
}
