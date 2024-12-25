<?php
namespace App\Models;

class ItemRepository {
    private \PDO $db;

    public function __construct() {
        $this->db = DatabaseConnection::getInstance()->getConnection();
    }

    public function save(Item $item): bool {
        if ($item->getId()) {
            return $this->update($item);
        }
        return $this->insert($item);
    }

    private function insert(Item $item): bool {
        $sql = "INSERT INTO items (name, price, category, email, created_at) 
                VALUES (?, ?, ?, ?, NOW())";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $item->getName(),
            $item->getPrice(),
            $item->getCategory(),
            $item->getEmail()
        ]);
    }

    private function update(Item $item): bool {
        $sql = "UPDATE items SET name = ?, price = ?, category = ?, email = ? 
                WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $item->getName(),
            $item->getPrice(),
            $item->getCategory(),
            $item->getEmail(),
            $item->getId()
        ]);
    }

    public function delete(int $id): bool {
        $sql = "DELETE FROM items WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function findById(int $id): ?Item {
        $sql = "SELECT * FROM items WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        
        if ($data = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            return ItemFactory::createFromArray($data);
        }
        return null;
    }

    public function findAll(string $sortBy = 'created_at', string $sortOrder = 'DESC'): array {
        $allowedColumns = ['name', 'price', 'category', 'created_at'];
        $sortBy = in_array($sortBy, $allowedColumns) ? $sortBy : 'created_at';
        $sortOrder = $sortOrder === 'ASC' ? 'ASC' : 'DESC';
        
        $sql = "SELECT * FROM items ORDER BY $sortBy $sortOrder";
        $stmt = $this->db->query($sql);
        
        $items = [];
        while ($data = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $items[] = ItemFactory::createFromArray($data);
        }
        return $items;
    }
}

?>