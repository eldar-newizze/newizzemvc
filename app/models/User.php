<?php

namespace Models;

use Core\Model;

class User extends Model
{
    public static function one()
    {
        $sql = "
            SELECT entity_id, sku, created_at, IFNULL(value, 'NULL') AS value, attribute_code
                
            FROM catalog_product_entity_text catalog
            JOIN catalog_product_entity product on catalog.row_id = product.row_id
            JOIN eav_attribute eav on eav.attribute_id = catalog.attribute_id
            WHERE attribute_code = 'page_layout'
            LIMIT 100;
        ";
        return self::queryTable($sql);
    }
    public static function two()
    {
        $sql = "
            SELECT value_id, sku, created_at FROM catalog_product_entity_text catalog
            JOIN catalog_product_entity product on catalog.row_id = product.row_id
            WHERE created_at > '2017-09-20 16:03:28'  
        ";
        return self::queryTable($sql);
    }
    public static function three()
    {
        $sql = "
              SELECT entity_id, sku, created_at, IFNULL(value, 'NULL') AS value FROM catalog_product_entity_text catalog
              JOIN catalog_product_entity product on catalog.row_id = product.row_id
              JOIN eav_attribute eav on eav.attribute_id = catalog.attribute_id
              WHERE sku REGEXP '11'
        ";
        return self::queryTable($sql);
    }
}
