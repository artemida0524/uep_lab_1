<?php
require_once 'database.php';
require_once 'header.php';

$sortBy = $_GET['sort'] ?? 'created_at';
$sortOrder = $_GET['order'] ?? 'DESC';
$items = getItems($sortBy, $sortOrder);

function getSortUrl($column) {
    global $sortBy, $sortOrder;
    $newOrder = ($sortBy === $column && $sortOrder === 'ASC') ? 'DESC' : 'ASC';
    return "?sort={$column}&order={$newOrder}";
}
?>

<main class="container mx-auto mt-8">
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-xl font-semibold mb-4">Список покупок</h2>
        <table class="w-full">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-2 text-left">
                        <a href="<?php echo getSortUrl('name'); ?>" class="hover:underline">
                            Назва <?php echo ($sortBy === 'name') ? ($sortOrder === 'ASC' ? '↑' : '↓') : ''; ?>
                        </a>
                    </th>
                    <th class="p-2 text-left">
                        <a href="<?php echo getSortUrl('price'); ?>" class="hover:underline">
                            Вартість <?php echo ($sortBy === 'price') ? ($sortOrder === 'ASC' ? '↑' : '↓') : ''; ?>
                        </a>
                    </th>
                    <th class="p-2 text-left">
                        <a href="<?php echo getSortUrl('category'); ?>" class="hover:underline">
                            Категорія <?php echo ($sortBy === 'category') ? ($sortOrder === 'ASC' ? '↑' : '↓') : ''; ?>
                        </a>
                    </th>
                    <th class="p-2 text-left">Email</th>
                    <th class="p-2 text-left">
                        <a href="<?php echo getSortUrl('created_at'); ?>" class="hover:underline">
                            Дата <?php echo ($sortBy === 'created_at') ? ($sortOrder === 'ASC' ? '↑' : '↓') : ''; ?>
                        </a>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                <tr class="border-t">
                    <td class="p-2"><?php echo htmlspecialchars($item['name']); ?></td>
                    <td class="p-2"><?php echo number_format($item['price'], 2); ?> грн</td>
                    <td class="p-2"><?php echo htmlspecialchars($item['category']); ?></td>
                    <td class="p-2"><?php echo htmlspecialchars($item['email']); ?></td>
                    <td class="p-2"><?php echo date('d.m.Y H:i', strtotime($item['created_at'])); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>

<?php require_once 'footer.php'; ?>