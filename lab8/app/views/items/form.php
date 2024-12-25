<?php require __DIR__ . '/../layout/header.php'; ?>

<main class="container mx-auto mt-8">
    <?php if (!empty($errors)): ?>
        <div class="max-w-md mx-auto mb-4 bg-red-100 border-red-500 text-red-700 p-4 rounded">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo htmlspecialchars($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    
    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-xl font-semibold mb-4">
            <?php echo isset($item) ? 'Редагувати покупку' : 'Додати покупку'; ?>
        </h2>
        
        <form method="POST">
            <?php if (isset($item)): ?>
                <input type="hidden" name="id" value="<?php echo $item->getId(); ?>">
            <?php endif; ?>
            
            <div class="mb-4">
                <label class="block text-gray-700">Назва:</label>
                <input type="text" name="name" value="<?php echo isset($item) ? htmlspecialchars($item->getName()) : ''; ?>" 
                       class="w-full p-2 border rounded" required>
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700">Вартість:</label>
                <input type="number" name="price" step="0.01" 
                       value="<?php echo isset($item) ? $item->getPrice() : ''; ?>"
                       class="w-full p-2 border rounded" required>
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700">Категорія:</label>
                <select name="category" class="w-full p-2 border rounded" required>
                    <?php
                    $categories = ['food' => 'Їжа', 'clothes' => 'Одяг', 'electronics' => 'Електроніка'];
                    foreach ($categories as $value => $label):
                        $selected = isset($item) && $item->getCategory() === $value ? 'selected' : '';
                    ?>
                        <option value="<?php echo $value; ?>" <?php echo $selected; ?>>
                            <?php echo $label; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700">Email:</label>
                <input type="email" name="email" 
                       value="<?php echo isset($item) ? htmlspecialchars($item->getEmail()) : ''; ?>"
                       class="w-full p-2 border rounded" required>
            </div>
            
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">
                <?php echo isset($item) ? 'Оновити' : 'Додати'; ?>
            </button>
        </form>
    </div>
</main>

<?php require __DIR__ . '/../layout/footer.php'; ?>