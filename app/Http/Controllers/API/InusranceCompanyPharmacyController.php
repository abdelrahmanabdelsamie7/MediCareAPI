<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InusranceCompanyPharmacyController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'insurance_company_id' => 'required|exists:insurance_companies,id',
            'pharmacy_id' => 'required|exists:pharmacies,id',
        ]);
        $exists = DB::table('insurance_company_pharmacy')
            ->where('insurance_company_id', $validated['insurance_company_id'])
            ->where('pharmacy_id', $validated['pharmacy_id'])
            ->exists();
        if ($exists) {
            return response()->json(['message' => 'This relationship already exists.'], 400);
        }
        DB::table('insurance_company_pharmacy')->insert([
            'insurance_company_id' => $validated['insurance_company_id'],
            'pharmacy_id' => $validated['pharmacy_id'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['message' => 'Relationship created successfully.'], 201);
    }
    public function destroy(string $id)
    {
        $deleted = DB::table('insurance_company_pharmacy')->where('id', $id)->delete();
        if ($deleted) {
            return response()->json(['message' => 'Relationship deleted successfully.']);
        }
        return response()->json(['message' => 'Relationship not found.'], 404);
    }
}