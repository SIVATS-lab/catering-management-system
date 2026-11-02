<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php?type=admin");
    exit();
}
include 'db.php';
include_once __DIR__ . '/site_settings.php';
$siteSettings = get_site_settings();

// Handle add/edit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $price = (float)$_POST['price'];
    $category = trim($_POST['category']);

    if (empty($name) || empty($category) || $price <= 0) {
        $error = "Please fill all required fields correctly";
    } else {
        if (isset($_POST['id']) && $_POST['id']) {
            $id = (int)$_POST['id'];
            $stmt = $conn->prepare("UPDATE menu SET name = ?, description = ?, price = ?, category = ? WHERE id = ?");
            $stmt->bind_param("ssdsi", $name, $description, $price, $category, $id);
        } else {
            $stmt = $conn->prepare("INSERT INTO menu (name, description, price, category) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssds", $name, $description, $price, $category);
        }

        if ($stmt->execute()) {
            header("Location: manage_menu.php");
            exit();
        } else {
            $error = "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}

// Handle delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $conn->query("DELETE FROM menu WHERE id=$id");
    header("Location: manage_menu.php");
    exit();
}

// Fetch menu items
$sql = "SELECT * FROM menu ORDER BY category, name";
$result = $conn->query($sql);
$menu_items = [];
while ($row = $result->fetch_assoc()) {
    $menu_items[] = $row;
}

$page_title = 'Manage Menu';
$isAdminPage = true;
include 'header.php';
?>
    <style>
        .admin-container { padding: 2rem 0; }
        .menu-card { border: 1px solid #ddd; border-radius: 0.75rem; overflow: hidden; transition: all 0.3s ease; }
        .menu-card:hover { box-shadow: 0 8px 20px rgba(0,0,0,0.15); }
    </style>

    <div class="container admin-container">
        <div class="header-graphic">
            <div class="header-content">
                <h1><i class="fas fa-utensils me-2"></i>Manage Menu</h1>
                <p class="mb-0">Add, edit, and organize your catering menu items</p>
            </div>
            <div class="header-icon"><i class="fas fa-utensils"></i></div>
            <div class="header-actions"><button class="btn btn-add-item" data-bs-toggle="modal" data-bs-target="#menuModal"><i class="fas fa-plus me-2"></i>Add Item</button></div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead><tr><th>Name</th><th>Description</th><th>Price</th><th>Category</th><th>Actions</th></tr></thead>
                <tbody>
                    <?php foreach ($menu_items as $item): ?>
                        <tr>
                            <td><strong><?php echo htmlspecialchars($item['name']); ?></strong></td>
                            <td><?php echo htmlspecialchars(substr($item['description'], 0, 60)); ?>...</td>
                            <td><span class="price-badge">$<?php echo number_format($item['price'], 2); ?></span></td>
                            <td><span class="category-badge"><?php echo htmlspecialchars($item['category']); ?></span></td>
                            <td>
                                <button class="btn btn-sm btn-edit" onclick="editItem(<?php echo $item['id']; ?>, '<?php echo addslashes(htmlspecialchars($item['name'])); ?>', '<?php echo addslashes(htmlspecialchars($item['description'])); ?>', '<?php echo number_format($item['price'],2); ?>', '<?php echo addslashes(htmlspecialchars($item['category'])); ?>')"><i class="fas fa-edit"></i></button>
                                <a href="manage_menu.php?delete=<?php echo $item['id']; ?>" class="btn btn-sm btn-delete" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="menuModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle"><i class="fas fa-plus me-2"></i>Add Menu Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="menuForm" method="POST">
                        <input type="hidden" name="id" id="itemId">
                        <div class="mb-3"><label for="name" class="form-label">Name</label><input type="text" class="form-control" id="name" name="name" required></div>
                        <div class="mb-3"><label for="description" class="form-label">Description</label><textarea class="form-control" id="description" name="description" rows="3"></textarea></div>
                        <div class="mb-3"><label for="price" class="form-label">Price</label><input type="number" step="0.01" class="form-control" id="price" name="price" required></div>
                        <div class="mb-3"><label for="category" class="form-label">Category</label><input type="text" class="form-control" id="category" name="category" required></div>
                        <button type="submit" class="btn btn-submit w-100"><i class="fas fa-save me-2"></i>Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function editItem(id, name, description, price, category) {
            document.getElementById('itemId').value = id;
            document.getElementById('name').value = name;
            document.getElementById('description').value = description;
            document.getElementById('price').value = price;
            document.getElementById('category').value = category;
            document.getElementById('modalTitle').textContent = 'Edit Menu Item';
            new bootstrap.Modal(document.getElementById('menuModal')).show();
        }

        document.getElementById('menuModal').addEventListener('show.bs.modal', function() {
            if (!document.getElementById('itemId').value) {
                document.getElementById('menuForm').reset();
                document.getElementById('modalTitle').textContent = 'Add Menu Item';
            }
        });
    </script>

<?php include 'footer.php'; ?>
