<?php
namespace Database\Seeders;
use App\Models\DoctorOffer;
use App\Models\DoctorOfferImage;
use Illuminate\Database\Seeder;
class DoctorOfferImageSeeder extends Seeder {
  public function run() {
    $offer = DoctorOffer::first();

    DoctorOfferImage::create([
      'image' => 'offer-image.jpg',
      'doctor_offer_id' => $offer->id
    ]);
  }
}
