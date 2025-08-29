<div class="productsList">
    <div class="productsList__sort mb-4">
        <div class="productsListSortLine">
            <select class="form-select productsListSortSelect">
                <?php foreach ($this->productSortHelpers as $sort) : ?>
                    <option value="<?php echo $sort['id']; ?>">
                        <?php echo $sort['description']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div id="productsListRow" class="row"></div>

    <div class="productsListModal" id="productsListModal">
        <?php include_once __DIR__ . '/modal_dialog.php'; ?>
    </div>
</div>
