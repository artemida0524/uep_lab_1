<?php
namespace App\Models;

class Item {
    private ?int $id;
    private string $name;
    private float $price;
    private string $category;
    private string $email;
    private string $created_at;

    public function __construct(
        string $name,
        float $price,
        string $category,
        string $email,
        ?int $id = null,
        string $created_at = ''
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->category = $category;
        $this->email = $email;
        $this->created_at = $created_at;
    }

    public function getId(): ?int { return $this->id; }
    public function getName(): string { return $this->name; }
    public function getPrice(): float { return $this->price; }
    public function getCategory(): string { return $this->category; }
    public function getEmail(): string { return $this->email; }
    public function getCreatedAt(): string { return $this->created_at; }
}
?>