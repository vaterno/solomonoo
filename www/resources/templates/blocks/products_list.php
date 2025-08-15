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

    <div class="productsListModal modal fade" id="productsListModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Loading...
                </div>
            </div>
        </div>
    </div>
</div>
