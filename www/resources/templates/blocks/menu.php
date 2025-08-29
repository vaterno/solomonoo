<div class="list-group list-group-flush border-bottom scrollarea categoriesFilterList">

    <?php if (!empty($this->categories)) : ?>
        <?php foreach ($this->categories as $category) : ?>
            <a class="list-group-item list-group-item-action py-3 lh-tight categoriesFilterList__link" data-category-id="<?php echo $category['id']; ?>">
                <div class="d-flex w-100 align-items-center justify-content-between">
                    <strong class="mb-1"><?php echo $category['title']; ?> <span>(<?php echo $category['product_count']; ?>)</span></strong>
                </div>

                <div class="col-10 mb-1 small"><?php echo $category['short_description']; ?></div>
            </a>
        <?php endforeach; ?>
    <?php endif; ?>

</div>