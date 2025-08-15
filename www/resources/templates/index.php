<!DOCTYPE html>
<html lang="en">
<head>
    <?php require __DIR__ . '/blocks/header.php'; ?>
</head>
<body class="body">

    <main class="container">
        <div class="row">
            <div class="col-md-4">
                <?php require_once __DIR__ . '/blocks/menu.php'; ?>
            </div>

            <div class="col-md-8">
                <?php require_once __DIR__ . '/blocks/products_list.php'; ?>
            </div>
        </div>
    </main>

</body>
</html>
