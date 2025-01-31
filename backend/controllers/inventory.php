<?php
class Inventory {
    public static function getInventory() {
        $products = DB::query(
            'SELECT * FROM inventory',
            []
        );
        return $products;
    }

    public static function getInventoryById(int $id) {
        $product = DB::query(
            'SELECT * FROM inventory WHERE id=?',
            [$id]
        );

        if($product) {
            return $product;
        }
        return array(404, 'Inventory Item Does Not Exist');
    }

    public static function addInventoryItem(string $name, $cost, int $count) {
        DB::query(
            'INSERT INTO inventory (item_name, cost, count) VALUES(?,?,?)',
            [$name, $cost, $count]
        );
        return array(200, 'Inventory Item Added Successfully');
    }

    public static function updateInventoryItem($item_id, string $name=null, $cost=null, $count=null) {
        if(!isset($item_id)){
            return array(404, 'Product not found');
        }
        if(isset($name)){
            DB::query(
                'UPDATE inventory SET name = ? WHERE id= ?',
                [$name, $item_id]
            );
        }
        if(isset($cost)){
            DB::query(
                'UPDATE inventory SET cost = ? WHERE id= ?',
                [$cost, $item_id]
            );
        }
        if(isset($count)){
            DB::query(
                'UPDATE inventory SET count = ? WHERE id= ?',
                [$count, $item_id]
            );
        }

        return array(200, 'Inventory Item data updated');
    }

    public static function deleteProduct($item_id) {
        DB::query(
            'DELETE FROM inventory WHERE id=?',
            [$item_id]
        );
        return array(204, 'Inventory Item Removed From Database');
    }

}

?>