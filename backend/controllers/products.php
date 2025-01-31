<?php
class Product {
    public static function listProducts() {
        $products = DB::query(
            'SELECT * FROM products',
            []
        );

        return $products;
    }

    public static function getProductById(int $id) {
        $product = DB::query(
            'SELECT * FROM products WHERE id=?',
            [$id]
        );

        if($product) {
            return $product;
        }
        return array(404, 'Product Does Not Exist');
    }

    public static function createProduct(string $name, $price, $cost) {
        DB::query(
            'INSERT INTO products (name, unit_price, unit_cost) VALUES(?,?,?)',
            [$name, $price, $cost]
        );
        return array(200, 'Product Added Successfully');
    }

    public static function updateProduct($product_id, $name=null, $price=null, $cost=null) {
        if(!isset($product_id)){
            return array(404, 'Product not found');
        }
        if(isset($name)){
            DB::query(
                'UPDATE product SET name = ? WHERE id= ?',
                [$name, $product_id]
            );
        }
        if(isset($price)){
            DB::query(
                'UPDATE product SET unit_price = ? WHERE id= ?',
                [$price, $product_id]
            );
        }
        if(isset($cost)){
            DB::query(
                'UPDATE product SET unit_cost = ? WHERE id= ?',
                [$cost, $product_id]
            );
        }

        return array(200, 'Product data updated');
    }

    public static function deleteProduct($product_id) {
        DB::query(
            'DELETE FROM products WHERE id=?',
            [$product_id]
        );
        return array(204, 'Product Removed From Database');
    }

}

?>