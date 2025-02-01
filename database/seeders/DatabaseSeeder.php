<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder {
    public function run() {
      $this->call([
        AdminSeeder::class,
        DepartmentSeeder::class,
        HospitalSeeder::class,
        CareCenterSeeder::class,
        ChainPharmaciesSeeder::class,
        PharmacySeeder::class,
        ChainLaboratoriesSeeder::class,
        LaboratorySeeder::class,
        DoctorSeeder::class,
        ClinicSeeder::class,
        ClinicImageSeeder::class,
        SpecializationSeeder::class,
        DoctorSpecializationSeeder::class,
        DeliveryServiceSeeder::class,
        DoctorOfferSeeder::class,
        DoctorOfferImageSeeder::class,
        BlogSeeder::class,
        UserSeeder::class,
        UserPharmacySeeder::class,
        UserLaboratoryRatingSeeder::class,
        UserDoctorRatingSeeder::class,
        AppointmentSeeder::class,
        ReservationSeeder::class,
        DepartmentTipSeeder::class,
        DepartmentHospitalSeeder::class,
        DoctorClinicSeeder::class,
      ]);
    }
  }
