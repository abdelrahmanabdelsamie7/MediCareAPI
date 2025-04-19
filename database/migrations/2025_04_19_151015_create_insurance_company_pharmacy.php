 <?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('insurance_company_pharmacy', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('insurance_company_id')
                ->constrained('insurance_companies')->unique()
                ->cascadeOnDelete()->cascadeOnUpdate() ;
            $table->foreignUuid('pharmacy_id')
                ->constrained('pharmacies')->unique()
                ->cascadeOnDelete()->cascadeOnUpdate() ;
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('insurance_company_pharmacy');
    }
};
