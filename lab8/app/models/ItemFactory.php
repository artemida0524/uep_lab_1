<?php
namespace App\Models;

class ItemFactory {
    public static function createFromArray(array $data): Item {
        return new Item(
            $data['name'],
            (float)$data['price'],
            $data['category'],
            $data['email'],
            $data['id'] ?? null,
            $data['created_at'] ?? ''
        );
    }
}
?>