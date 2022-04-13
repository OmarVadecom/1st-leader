<?php
namespace App\Imports;

use App\Models\Products;
use App\Models\Stock;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

class SuppliesImport implements ToCollection, WithStartRow, WithHeadingRow
{
    protected $supply_entry;
    public function __construct($supply_entry)
    {
        $this->supply_entry = $supply_entry;
    }
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $stock = null;
            $warehouse = null;
            if (isset($row['stock']) && $row['stock'] != '') {
                $stock = Stock::firstOrCreate(['name' => $row['stock']]);
            }

            if (isset($row['warehouse']) && $row['warehouse'] != '' && $stock) {
                $warehouse = $stock->warehouses()->firstOrCreate(['name' => $row['warehouse']]);
            }

            if (isset($row['product_number'])) {
                $product = Products::where('code', $row['product_number'])->first();
                if ($product) {
                    $this->supply_entry->supplies()->create([
                        'product_id' => $product->id,
                        'warehouse_id' => $warehouse ? $warehouse->id : 0,
                        'stock_id' => $stock ? $stock->id : 0,
                        'quantity' => isset($row['quantity']) ? $row['quantity'] : 0,
                        'cost' => isset($row['cost']) ? round($row['cost'], 2) : 0,
                        'price' => isset($row['price']) ? round($row['price'], 2) : 0,
                    ]);
                }

            }
        }
    }

    public function startRow(): int
    {
        return 4;
    }

    public function headingRow(): int
    {
        return 2;
    }
}
