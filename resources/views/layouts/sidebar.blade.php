<div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
    <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
        <a href="/home" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <span class="fs-5 d-none d-sm-inline">Menu</span>
        </a>
        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
            <li class="nav-item">
                <a href="/home" class="nav-link align-middle px-0">
                    <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">{{ __('admin.home_page_link') }}</span>
                </a>
            </li>
            <li>
                <a href="/recipes" class="nav-link px-0 align-middle">
                    <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">{{ __('admin.recipes_link') }}</span>
                </a>
            </li>
            @auth
                <li>
                    <a href="/festive" class="nav-link px-0 align-middle">
                        <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">{{ __('admin.festives_link') }}</span>
                    </a>
                </li>

                <li>
                    <a href="/productcart" class="nav-link px-0 align-middle">
                        <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">{{ __('admin.product_cart_link') }}</span>
                    </a>
                </li>
            @endauth
                <li>
                    <a href="/contact" class="nav-link px-0 align-middle">
                        <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">{{ __('admin.contact_link') }}</span>
                    </a>
                </li>
            </ul>
        <hr>
    </div>
</div>
