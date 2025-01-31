<?php

class SalesRecord{
    public static function getDailySales() {
        # GROUP BY DATE SUM of Amounts
        $data = DB::query(
            'SELECT `date`, SUM(amount) as total FROM daily_sales GROUP BY `date` ORDER BY `date` DESC',
            []
        );
        return $data;
    }

    public static function getProductSales() {
        $data = DB::query(
            'SELECT * FROM daily_sales JOIN products ON product_id=products.id ORDER BY `date` DESC',
            []
        );
        return $data;
    }

    public static function getProductSalesSummary() {
        $data = DB::query(
            'SELECT product_id, products.name, products.unit_price, SUM(amount) as total FROM `daily_sales` JOIN products ON product_id=products.id GROUP BY product_id ',
            []
        );
        return $data;
    }

    public static function createSalesEntry(string $date, array $amounts) {
        # REQUIRE amounts to be a map of (Product : Amount)

        // TABLE STRUCTURE : id, product_id, date, amount 
        // says on DATE this PRODUCT_ID made AMOUNT in sales
        $insert_string = "";
        $pass = 0;
        foreach ($amounts as $product_amount_pair) {
            if ($pass != 0){
                $insert_string .= ", ";
            }
            $insert_string .= "( 2025-01-11, ";
            $insert_string .= $product_amount_pair[0].", ";
            $insert_string .= $product_amount_pair[1].")";
            $pass++; 
        }


        // DB::query(
        //     'INSERT INTO daily_sales (date, product_id, amount) VALUES ?',
        //     [$insert_string]
        // );
        
        return array(200, $input_string);
    }
}

?>