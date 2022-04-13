<?php  
namespace App\Imports;

use App\Models\Products;
use App\Models\Parts;
use App\Models\Color;
use App\Models\Country;
use App\Models\Brands;
use App\Models\ProductAddons;
use App\Models\PartsAddons;
use App\Models\ProductCategory;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class ProductImport implements ToCollection, WithStartRow,WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {   
            if(isset($row['color'])&&$row['color']!='')
        	    $color=Color::firstOrCreate(['name'=>$row['color']]);
        	if(isset($row['country_mnf'])&&$row['country_mnf']!='')
        	    $country_mnf=Country::firstOrCreate(['name'=>$row['country_mnf']]);
            
            if(isset($row['origin_country'])&&$row['origin_country']!='')
                $origin_country=Country::firstOrCreate(['name'=>$row['country_mnf']]);

            if(isset($row['company'])&&$row['company']!='')
                $brand=Brands::firstOrCreate(['name'=>$row['company']]);
        
            if(isset($row['brand'])&&$row['brand']!='')
                $brand=Brands::firstOrCreate(['name'=>$row['brand']]);

            if(isset($row['group'])&&$row['group']!='')
                $group=ProductCategory::firstOrCreate(['title'=>$row['group']]);
            
            if(strtoupper(substr($row['part_number'],0,2))=='EE'){
                $product=Products::updateOrCreate(['code' => $row['part_number']],[
                    'name' => $row['arabic_description'],
                    'name_en' => $row['english_description'],
                    'type' => isset($row['product_type'])&&$row['product_type']=='مستودعي'?1:2,
                    'color' =>isset($color)?$color->id:0,
                    'country_id' =>isset($country_mnf)?$country_mnf->id:0,
                    'origin_id' =>isset($origin_country)?$origin_country->id:0,
                    'brand_id' =>isset($brand)?$brand->id:0,
                    'category_id' =>isset($group)?$group->id:0,
                ]);

                ProductAddons::updateOrCreate(['product_id'=>$product->id],[
                    'units'=>$row['unit'],
                    'units_barcode'=>$row['barcode'],
                    'units_cons'=>'',
                    'unit_default'=>'',
                    'prices'=>$row['prices'],
                    'prices_discounts'=>'',
                    'prices_targets'=>'',
                    'gifts_ids'=>'',
                    'gifts_quantities'=>'',
                    'gifts_for'=>'',
                ]);
            }

            else{
                 $product=Parts::updateOrCreate(['code' => $row['part_number']],[
                    'code_type' => substr($row['part_number'],0,2),
                    'name' => $row['arabic_description'],
                    'name_en' => $row['english_description'],
                    'type' => isset($row['product_type'])&&$row['product_type']=='مستودعي'?1:2,
                    'color' =>isset($color)?$color->id:0,
                    'country_id' =>isset($country_mnf)?$country_mnf->id:0,
                    'origin_id' =>isset($origin_country)?$origin_country->id:0,
                    'brand_id' =>isset($brand)?$brand->id:0,
                ]);
                PartsAddons::updateOrCreate(['part_id'=>$product->id],[
                    'units'=>isset($row['unit'])&&$row['unit'],
                    'units_barcode'=>$row['barcode'],
                    'units_cons'=>'',
                    'unit_default'=>'',
                    'prices'=>$row['prices'],
                    'prices_discounts'=>'',
                    'prices_targets'=>'',
                ]);
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