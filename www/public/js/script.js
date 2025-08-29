document.addEventListener('DOMContentLoaded', function () {
    const productsListModalEl = document.querySelector('#productsListModal .modal');
    const productsContainerEl = document.getElementById('productsListRow');
    const urlParams = new URLSearchParams(window.location.search);
    const categoriesFilterListEls = document.querySelectorAll('.categoriesFilterList__link');

    const filters = {
        filters: {
            category_id: urlParams.get('filters[category_id]') || null,
        },
        sort: urlParams.get('sort') || 'newest',
    };

    if (filters.sort) {
        document.querySelector('.productsListSortSelect').value = filters.sort;
    }

    document.querySelector('.productsListSortSelect').addEventListener('change', function () {
        filters.sort = this.value;

        updateURL();
        loadProducts();
    });

    if (filters.filters.category_id) {
        categoriesFilterListEls.forEach(link => {
            if (link.dataset.categoryId === filters.filters.category_id) {
                link.classList.add('active');
            }
        });
    }

    categoriesFilterListEls.forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();

            if (link.dataset.categoryId !== filters.filters.category_id) {
                removeActiveMenuLinks();
                link.classList.add('active');
                filters.filters.category_id = this.dataset.categoryId;

                updateURL();
                loadProducts();
            }
        });
    });

    function updateURL() {
        const params = new URLSearchParams();

        if (filters.filters.category_id) {
            params.set('filters[category_id]', filters.filters.category_id);
        }

        if (filters.sort) {
            params.set('sort', filters.sort);
        }

        history.pushState(filters, '', `?${params.toString()}`);
    }

    function loadProducts() {
        const params = new URLSearchParams();
        if (filters.filters.category_id) {
            params.set('filters[category_id]', filters.filters.category_id);
        }

        if (filters.sort) {
            params.set('sort', filters.sort);
        }

        fetch(`/api/products?${params.toString()}`)
            .then(res => res.json())
            .then(data => renderProducts(data))
            .catch(err => console.error(err));
    }

    function removeActiveMenuLinks() {
        categoriesFilterListEls.forEach(link => {
            link.classList.remove('active');
        });
    }

    productsContainerEl.addEventListener('click', function (e) {
        e.preventDefault();

        if (e.target.classList.contains('productsListItem__buy')) {
            let modal = new bootstrap.Modal(productsListModalEl);
            let productId = e.target.getAttribute('data-product-id');

            if (!productId) {
                console.log('Product id not provided');
                return;
            }

            fetch('/api/products/show?id=' + productId)
                .then(res => res.json())
                .then(function (data) {

                    if (!data.success) {
                        console.log(data.message);
                        return;
                    }

                    let product = data.productData;
                    productsListModalEl.querySelector('.modal-body').innerHTML = `
                        <div class="card-body">
                            <h5 class="card-title">${product.title}</h5>
                            <p class="card-text">${product.short_description}</p>
    
                            <p class="productsListItem__price">
                                Price: ${product.price}
                            </p>
    
                            <p class="productsListItem__created">
                                Created: ${product.created_at}
                            </p>
                        </div>
                    `
                })
                .catch(err => console.error(err));

            modal.show();
        }
    });

    function renderProducts(products) {
        productsContainerEl.innerHTML = products.products.map(product => `
            <div class="col-md-4">
                <div class="card mb-3 productsList__item productsListItem" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">${product.title}</h5>
                        <p class="card-text">${product.short_description}</p>

                        <p class="productsListItem__price">
                            Price: ${product.price}
                        </p>

                        <p class="productsListItem__created">
                            Created: ${product.created_at}
                        </p>
                        
                        ${product.category_id && product.category
                            ? `<p class="productsListItem__category">Category: ${product.category.title}</p>`
                            : ''}
                        
                        <a class="btn btn-primary productsListItem__buy" data-product-id="${product.id}">Buy</a>
                    </div>
                </div>
            </div>
        `).join('');
    }

    loadProducts();
});