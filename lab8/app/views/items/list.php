<?php require __DIR__ . '/../layout/header.php'; ?>

<main class="container mx-auto mt-8">
    <?php if (isset($_GET['success'])): ?>
        <div class="mb-4 bg-green-100 border-green-500 text-green-700 p-4 rounded">
            Операцію успішно виконано!
        </div>
    <?php endif; ?>

    <div class="bg-white p-6 rounded-lg shadow-lg">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">Список покупок</h2>
            <a href="create.php" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Додати покупку
            </a>
        </div>

        <table class="w-full">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-2 text-left">
                        <a href="?sort=name&order=<?php echo $sortBy === 'name' && $sortOrder === 'ASC' ? 'DESC' : 'ASC'; ?>">
                            Назва <?php echo $sortBy === 'name' ? ($sortOrder === 'ASC' ? '↑' : '↓') : ''; ?>
                        </a>
                    </th>
                    <th class="p-2 text-left">
                        <a href="?sort=price&order=<?php echo $sortBy === 'price' && $sortOrder === 'ASC' ? 'DESC' : 'ASC'; ?>">
                            Вартість <?php echo $sortBy === 'price' ? ($sortOrder === 'ASC' ? '↑' : '↓') : ''; ?>
                        </a>
                    </th>
                    <th class="p-2 text-left">
                        <a href="?sort=category&order=<?php echo $sortBy === 'category' && $sortOrder === 'ASC' ? 'DESC' : 'ASC'; ?>">
                            Категорія <?php echo $sortBy === 'category' ? ($sortOrder === 'ASC' ? '↑' : '↓') : ''; ?>
                        </a>
                    </th>
                    <th class="p-2 text-left">Email</th>
                    <th class="p-2 text-left">
                        <a href="?sort=created_at&order=<?php echo $sortBy === 'created_at' && $sortOrder === 'ASC' ? 'DESC' : 'ASC'; ?>">
                            Дата <?php echo $sortBy === 'created_at' ? ($sortOrder === 'ASC' ? '↑' : '↓') : ''; ?>
                        </a>
                    </th>
                    <th class="p-2 text-left">Дії</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                <tr class="border-t">
                    <td class="p-2"><?php echo htmlspecialchars($item->getName()); ?></td>
                    <td class="p-2"><?php echo number_format($item->getPrice(), 2); ?> грн</td>
                    <td class="p-2"><?php echo htmlspecialchars($item->getCategory()); ?></td>
                    <td class="p-2"><?php echo htmlspecialchars($item->getEmail()); ?></td>
                    <td class="p-2"><?php echo date('d.m.Y H:i', strtotime($item->getCreatedAt())); ?></td>
                    <td class="p-2">
                        <div class="flex space-x-2">
                            <a href="edit.php?id=<?php echo $item->getId(); ?>" 
                               class="text-blue-500 hover:underline">Редагувати</a>
                            <form method="POST" action="delete.php" class="inline" 
                                  onsubmit="return confirm('Видалити цей запис?');">
                                <input type="hidden" name="id" value="<?php echo $item->getId(); ?>">
                                <button type="submit" class="text-red-500 hover:underline">Видалити</button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>

<?php require __DIR__ . '/../layout/footer.php'; ?>