<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Http\Requests\InusranceCompanyRequest;
use App\Models\InsuranceCompany;
use App\Traits\ResponseJsonTrait;
class InsuranceCompanyController extends Controller
{
    use ResponseJsonTrait;
    public function __construct()
    {
        $this->middleware('auth:admins')->only(['store', 'update', 'destroy']);
    }
    public function index()
    {
        $insurance_companies = InsuranceCompany::all();
        return $this->sendSuccess('Insurance Companies Retrieved Successfully', $insurance_companies);
    }
    public function store(InusranceCompanyRequest $request)
    {
        $insurance_company = InsuranceCompany::create($request->validated());
        return $this->sendSuccess('Insurance Company Added Successfully', $insurance_company, 201);
    }
    public function show(string $id)
    {
        $insurance_company = InsuranceCompany::findOrFail($id);
        return $this->sendSuccess('Insurance Company Retireved Successfully', $insurance_company);
    }
    public function update(InusranceCompanyRequest $request, string $id)
    {
        $insurance_company = InsuranceCompany::findOrFail($id);
        $insurance_company->update($request->validated());
        return $this->sendSuccess('Insurance Company Updated Successfully', $insurance_company, 201);
    }
    public function destroy(string $id)
    {
        $insurance_company = InsuranceCompany::findOrFail($id);
        $insurance_company->delete();
        return $this->sendSuccess('Insurance Company Deleted Successfully');
    }
}
