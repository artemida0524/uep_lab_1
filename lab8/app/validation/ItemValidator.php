<?php
namespace App\Validation;

use App\Models\Item;

class ItemValidator {
    public function validate(Item $item): array {
        $errors = [];
        
        if (empty($item->getName())) {
            $errors['name'] = "Назва є обов'язковою";
        }
        
        if ($item->getPrice() <= 0) {
            $errors['price'] = "Ціна повинна бути більше 0";
        }
        
        if (!filter_var($item->getEmail(), FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Неправильний формат email";
        }
        
        if (!in_array($item->getCategory(), ['food', 'clothes', 'electronics'])) {
            $errors['category'] = "Неправильна категорія";
        }
        
        return $errors;
    }
}