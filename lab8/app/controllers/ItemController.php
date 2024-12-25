<?php
namespace App\Controllers;

use App\Models\{Item, ItemFactory, ItemRepository};
use App\Validation\ItemValidator;

class ItemController {
    private ItemRepository $repository;
    private ItemValidator $validator;

    public function __construct() {
        $this->repository = new ItemRepository();
        $this->validator = new ItemValidator();
    }

    public function index(): void {
        $sortBy = $_GET['sort'] ?? 'created_at';
        $sortOrder = $_GET['order'] ?? 'DESC';
        $items = $this->repository->findAll($sortBy, $sortOrder);
        require __DIR__ . '/../views/items/list.php';
    }

    public function create(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $item = ItemFactory::createFromArray($_POST);
            $errors = $this->validator->validate($item);
            if (empty($errors)) {
                $this->repository->save($item);
                header('Location: index.php?success=1');
                exit;
            }
        }
        require __DIR__ . '/../views/items/form.php';
    }

    public function edit(int $id): void {
        $item = $this->repository->findById($id);
        if (!$item) {
            header('Location: index.php');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $newItem = ItemFactory::createFromArray(array_merge($_POST, ['id' => $id]));
            $errors = $this->validator->validate($newItem);
            if (empty($errors)) {
                $this->repository->save($newItem);
                header('Location: index.php?success=1');
                exit;
            }
        }
        require __DIR__ . '/../views/items/form.php';
    }

    public function delete(int $id): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->repository->delete($id);
            header('Location: index.php?success=1');
            exit;
        }
    }
}