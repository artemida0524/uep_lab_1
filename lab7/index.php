<?php
require_once 'database.php';
require_once 'header.php';

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['itemName'] ?? '');
    $price = filter_var($_POST['itemPrice'] ?? 0, FILTER_VALIDATE_FLOAT);
    $category = htmlspecialchars($_POST['itemCategory'] ?? '');
    $email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
    
    if (!$name || !$price || !$category || !$email) {
        $message = '<div class="bg-red-100 border-red-500 text-red-700 p-4 my-4 rounded">Будь ласка, заповніть усі поля коректно.</div>';
    } else {
        if (addItem($name, $price, $category, $email)) {
            $message = '<div class="bg-green-100 border-green-500 text-green-700 p-4 my-4 rounded">Покупку успішно додано!</div>';
        }
    }
}
?>

<main class="container mx-auto mt-8">
    <?php echo $message; ?>
    
    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-xl font-semibold mb-4">Додати покупку</h2>
        <form method="POST" id="shoppingForm">
            <div class="mb-4">
                <label class="block text-gray-700">Назва:</label>
                <input type="text" name="itemName" class="w-full p-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Вартість:</label>
                <input type="number" name="itemPrice" step="0.01" class="w-full p-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Категорія:</label>
                <select name="itemCategory" class="w-full p-2 border rounded" required>
                    <option value="food">Їжа</option>
                    <option value="clothes">Одяг</option>
                    <option value="electronics">Електроніка</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Email:</label>
                <input type="email" name="email" class="w-full p-2 border rounded" required>
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">Додати</button>
        </form>
    </div>
</main>

<?php require_once 'footer.php'; ?>
