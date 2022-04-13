<?php
namespace App\Imports;

use App\Models\City;
use App\Models\TempClients;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ClientsImport implements ToCollection, WithStartRow, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            if (isset($row['part_nnumber']) && $row['part_nnumber'] != "") {

                $city = City::where('name', $row['city'])->first();
                if ($city) {
                    $region = $city->region->name;
                } else {
                    City::create([
                        'name' => $row['city'],
                    ]);
                    $region = '';
                }
                $client = TempClients::updateOrCreate(['code' => $row['part_nnumber']], [
                    'center_name' => $row['customer_name'],
                    'old_center' => $row['customer_name'],
                    'responsable' => $row['personal_contact'],
                    'old_responsable' => $row['personal_contact'],
                    'phone' => $row['mobil_number'],
                    'old_phone' => $row['mobil_number'],
                    'postal_code' => $row['zip_code'],
                    'city' => $row['city'],
                    'old_city' => $row['city'],
                    'region' => $region,
                    'old_region' => $region,
                    'code' => $row['part_nnumber'],
                    'type' => $row['type'],
                ]);
            }
        }
    }

    public function startRow(): int
    {
        return 3;
    }

    public function headingRow(): int
    {
        return 2;
    }
}
