<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\{Department, Doctor, Blog, Hospital, CareCenter, ChainPharmacies, ChainLaboratories, Laboratory, Pharmacy , User , Clinic , DoctorOffer,Contact};

class StatisticsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admins')->only('getStatistics');
    }
    public function getStatistics()
    {
        return response()->json([
            'success' => true,
            'data' => [
                'departmentsCount' => Department::count(),
                'doctorsCount' => Doctor::count(),
                'usersCount' => User::count(),
                'clinicsCount' => Clinic::count(),
                'offersCount' => DoctorOffer::count(),
                'doctorBlogsCount' => Blog::count(),
                'hospitalsCount' => Hospital::count(),
                'careCentersCount' => CareCenter::count(),
                'chainPharmaciesCount' => ChainPharmacies::count(),
                'chainLaboratoriesCount' => ChainLaboratories::count(),
                'pharmaciesCount' => Pharmacy::count(),
                'laboratoriesCount' => Laboratory::count(),
                'contactsCount' => Contact::count(),
            ]
        ]);
    }
}
