<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<style>
.product_box {
    border: 1px solid #ccc;
    padding: 20px;
    border-radius: 15px; 
    background-color: #f9f9f9;
    border-top: 5px solid #80b380; 
}

.product_title {
    font-size: 1.3rem;
    font-weight: 600;
}

.modal_box {
    border: 1px solid #ccc;
    padding: 20px;
    border-radius: 10px;
    /* box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.3); */
}

.content_center {
    align-content: center;
}

.loader {
    border: 16px solid #f3f3f3;
    border-radius: 50%;
    border-top: 16px solid #3498db;
    width: 120px;
    height: 120px;
    animation: spin 2s linear infinite;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    display: none;
    z-index: 999;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

</style>

<div class="loader" id="loader"></div>

<div class="mx-5">
    <div class="row">
        <div class="col-12">
            <div class="product_box">
                <div class="product_title">
                    <p>Products</p>
                </div>
                <hr>
                <div class="">
                    <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#addProductModal">Add Product</button>
                    <div class="">
                        <table id="product_table" class="table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Item&nbsp;Code</th>
                                    <th>Weight&nbsp;(kg)</th>
                                    <th>Price</th>
                                    <th class='text-center'>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Add Products</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="modal_box">
            <div class="row mb-3">
                <div class="col-6 px-3">
                    <div class="d-flex align-items-center">
                        <p>Name:&nbsp;</p>
                        <input type="text" class="form-control" id="product_name">
                    </div>
                </div>
                <div class="col-6 px-3">
                    <div class="d-flex align-items-center">
                        <p>Item&nbsp;code:&nbsp;</p>
                        <input type="text" class="form-control" id="product_item">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6 px-3">
                    <div class="d-flex align-items-center">
                        <p>Weight&nbsp;(kg):&nbsp;</p>
                        <input type="text" class="form-control" id="product_weight">
                    </div>
                </div>
                <div class="col-6 px-3">
                    <div class="d-flex align-items-center">
                        <p>Price:&nbsp;</p>
                        <input type="text" class="form-control" id="product_price">
                    </div>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='save_product'>Save changes</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Edit Products</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="modal_box">
            <div class="row mb-3">
                <div class="col-6 px-3">
                    <div class="d-flex align-items-center">
                        <p>Name:&nbsp;</p>
                        <p class="fw-bold" id="edit_product_name"></p>
                        <!-- <input type="text" class="form-control" id="edit_product_name"> -->
                    </div>
                </div>
                <div class="col-6 px-3">
                    <div class="d-flex align-items-center">
                        <p>Item&nbsp;code:&nbsp;</p>
                        <p class="fw-bold" id="edit_product_item"></p>
                        <!-- <input type="text" class="form-control" id="edit_product_item"> -->
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6 px-3">
                    <div class="d-flex align-items-center">
                        <p>Weight&nbsp;(kg):&nbsp;</p>
                        <input type="text" class="form-control" id="edit_product_weight">
                    </div>
                </div>
                <div class="col-6 px-3">
                    <div class="d-flex align-items-center">
                        <p>Price:&nbsp;</p>
                        <input type="text" class="form-control" id="edit_product_price">
                    </div>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='edit_products'>Save changes</button>
      </div>
    </div>
  </div>
</div>

<script>
    var product_table_data;

    function showLoader() {
        $('#loader').show();
    }

    function hideLoader() {
        $('#loader').hide();
    }

    $(document).ready(function() {
        get_table_products();
    });

    function get_table_products () {
        showLoader();
        $.ajax({
            url: '<?= base_url('products/get_table_products') ?>',
            type: 'POST',
            success: function(response) {
                var data = JSON.parse(response);
                product_table(data);
                hideLoader();
            },
            error: function() {
                hideLoader();
            }
        });
    }

    function product_table (data) {
        product_table_data = $('#product_table').DataTable({
            destroy: true,
            data: data,
            columns: [
                { data: 'id' },
                { data: 'product_name' },
                { data: 'product_item' },
                { data: 'product_weight' },
                { data: 'product_price' },
                { 
                    data: function(data) {
                        return '<button type="button" class="btn btn-warning edit_product"><i class="fa fa-pencil"></i></button>'; 
                    }
                }
            ],
            columnDefs: [
                { targets: '_all', className: 'content_center' },
                { targets: [5], className: 'text-center' }
            ],
            drawCallback: function() {
                initButton();
            }
        });
    }

    function initButton() {
        $('.edit_product').off('click');
        $('.edit_product').on('click', function() {
            var data = product_table_data.row($(this).parents('tr')).data();
            $('#edit_product_name').text(data.product_name);
            $('#edit_product_name').attr('data-id', data.id);
            $('#edit_product_item').text(data.product_item);
            $('#edit_product_weight').val(data.product_weight);
            $('#edit_product_price').val(data.product_price);
            $('#editProductModal').modal('show');
        });
    }

    $('#save_product').click(function() {
        var product_name = $('#product_name').val();
        var product_item = $('#product_item').val();
        var product_weight = $('#product_weight').val();
        var product_price = $('#product_price').val();

        if (product_name === '' || product_item === '' || product_weight === '' || product_price === '') {
            alert('All fields are required');
            return;
        }

        if (isProductNameExists(product_name)) {
            alert('Product name already exists');
            return;
        }

        if (isProductItemExists(product_item)) {
            alert('Product item code already exists');
            return;
        }

        showLoader();
        $.ajax({
            url: '<?= base_url('products/save_product') ?>',
            type: 'POST',
            data: {
                product_name: product_name,
                product_item: product_item,
                product_weight: product_weight,
                product_price: product_price
            },
            success: function(response) {
                var data = JSON.parse(response);
                if (data == 'success') {
                    get_table_products();
                    clear_modal_fields();
                    $('#addProductModal').modal('hide');
                }
                else if (data == 'failed') {
                    alert('Error saving product');
                }
                else if (data == 'exists') {
                    alert('Product name or item code is already exists');
                }
                else {
                    alert('Contact system administrator');
                }
                hideLoader();
            },
            error: function() {
                hideLoader();
            }
        });
    });

    $('#edit_products').click(function() {
        var product_name = $('#edit_product_name').text();
        var product_name_attr = $('#edit_product_name').attr('data-id');
        var product_item = $('#edit_product_item').text();
        var product_weight = $('#edit_product_weight').val();
        var product_price = $('#edit_product_price').val();

        if (product_weight === '' || product_price === '') {
            alert('All fields are required');
            return;
        }

        showLoader();
        $.ajax({
            url: '<?= base_url('products/edit_product') ?>',
            type: 'POST',
            data: {
                product_name: product_name,
                product_name_attr: product_name_attr,
                product_item: product_item,
                product_weight: product_weight,
                product_price: product_price
            },
            success: function(response) {
                var data = JSON.parse(response);
                if (data == 'success') {
                    get_table_products();
                    $('#editProductModal').modal('hide');
                }
                else if (data == 'failed') {
                    alert('Error editing product');
                }
                else {
                    alert('Contact system administrator');
                }
                hideLoader();
            },
            error: function() {
                hideLoader();
            }
        });
    });

    function isProductNameExists(product_name) {
        var exists = false;
        product_table_data.rows().every(function() {
            var data = this.data();
            if (data.product_name === product_name) {
                exists = true;
                return false;
            }
        });
        return exists;
    }

    function isProductItemExists(product_item) {
        var exists = false;
        product_table_data.rows().every(function() {
            var data = this.data();
            if (data.product_item === product_item) {
                exists = true;
                return false;
            }
        });
        return exists;
    }

    function clear_modal_fields () {
        $('#product_name').val('');
        $('#product_item').val('');
        $('#product_weight').val('');
        $('#product_price').val('');
    }
</script>

<?= $this->endSection() ?>