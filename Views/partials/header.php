<?php
    $current_page = basename($_SERVER['REQUEST_URI']);
?>
<nav class="navbar navbar-expand-lg navbar-light bg-transparent p-3">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link <?= $current_page == '' ? 'active' : '' ?>" href="<?= base_url('/') ?>" style="font-size: 1.25rem; padding: 0 2rem;">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $current_page == 'dahsboard' ? 'active' : '' ?>" href="<?= base_url('/dahsboard') ?>" style="font-size: 1.25rem; padding: 0 2rem;">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $current_page == 'sales_invoice' ? 'active' : '' ?>" href="<?= base_url('/sales_invoice') ?>" style="font-size: 1.25rem; padding: 0 2rem;">Sales Invoice</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $current_page == 'delivery_receipt' ? 'active' : '' ?>" href="<?= base_url('/delivery_receipt') ?>" style="font-size: 1.25rem; padding: 0 2rem;">Delivery Receipt</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $current_page == 'add_clients' ? 'active' : '' ?>" href="<?= base_url('/add_clients') ?>" style="font-size: 1.25rem; padding: 0 2rem;">Add Clients</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $current_page == 'add_products' ? 'active' : '' ?>" href="<?= base_url('/add_products') ?>" style="font-size: 1.25rem; padding: 0 2rem;">Add Products</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
