<?php

use App\Model\Product;
use Illuminate\Database\Seeder;
// use App\Model\ProductStatus;
class ProductStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $statuses = ["Đã Xóa","Còn Hàng","Hàng sắp về","Liên hệ","Hết hàng"];
        ProductStatus::truncate();
        foreach($statuses as $status){
            $statusModel = new ProductStatus();
            $statusModel->name=$status;
            $statusModel->save();
        }
    }
}
