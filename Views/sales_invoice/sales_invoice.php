<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<style>
    .sales_invoice_box {
        border: 1px solid #ccc;
        padding: 20px;
        border-radius: 15px; 
        background-color:#f0f0f0;
        border-top: 5px solid #80b380; 
    }

    .sales_invoice_title p{
        font-size: 1.3rem;
        font-weight: 600;
    }
    
    .sales_invoice_details_box {
        border: 1px solid #ccc;
        padding: 20px;
        border-radius: 15px; 
        background-color: #f9f9f9;
    }

    .sales_invoice_details_title p{
        font-size: 1rem;
        font-weight: 500;
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
            <div class="sales_invoice_box">
                <div class="sales_invoice_title">
                    <p>Sales Invoice</p>
                </div>
                <hr>
                <div class="">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-6 mb-4">
                                    <div class="sales_invoice_details_box">
                                        <div class="sales_invoice_details_title">
                                            <p>Customer Details</p>
                                        </div>
                                        <hr>
                                        <div class="d-flex align-items-center mb-2">
                                            <p>Name:&nbsp;</p>
                                            <select class="select2" id="clients_details" style="width: 100%;">
                                            </select>
                                        </div>
                                        <div class="d-flex align-items-center mb-2">
                                            <p>TIN:&nbsp;</p>
                                            <p class="fw-bold" id="client_tin_details">&nbsp;</p>
                                        </div>
                                        <div class="d-flex align-items-center mb-2">
                                            <p>Address:&nbsp;</p>
                                            <p class="fw-bold" id="client_address_details">&nbsp;</p>
                                        </div>
                                        <div class="d-flex align-items-center mb-2">
                                            <p>Company:&nbsp;</p>
                                            <p class="fw-bold" id="client_company_details">&nbsp;</p>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-6">
                                                <div class="d-flex align-items-center">
                                                    <p>Terms:&nbsp;</p>
                                                    <select class="select2" id="client_term_details" style="width: 100%;">
                                                        <option value="cod">COD</option>
                                                        <option value="7">7 Days</option>
                                                        <option value="15">15 Days</option>
                                                        <option value="21">21 Days</option>
                                                        <option value="30">30 Days</option>
                                                        <option value="45">45 Days</option>
                                                        <option value="60">60 Days</option>
                                                        <option value="flex">FLEX</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6 content_center">
                                                <div class="d-flex justify-content-end align-items-center">
                                                    <p>Date:&nbsp;</p>
                                                    <input type="date" class="form-control" id="client_date_details">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-6 mb-4">
                                    <div class="sales_invoice_details_box">
                                        <div class="sales_invoice_details_title">
                                            <p>Items</p>
                                        </div>
                                        <hr>
                                        <div class="d-flex align-items-center mb-2">
                                            <p>Product:&nbsp;</p>
                                            <select class="select2" id="products_details" style="width: 100%;">
                                            </select>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-6">
                                                <div class="d-flex align-items-center">
                                                    <p>Price:&nbsp;</p>
                                                    <input type="number" class="form-control" id="item_price_details">
                                                </div>
                                            </div>
                                            <div class="col-6 content_center">
                                                <div class="d-flex justify-content-end align-items-center">
                                                    <p>Qty:&nbsp;</p>
                                                    <input type="number" class="form-control" id="item_qty_details">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-6">
                                                <div class="d-flex align-items-center">
                                                    <p>Amount:&nbsp;</p>
                                                    <p class="fw-bold" id="item_amount_details">&nbsp;</p>
                                                </div>
                                            </div>
                                            <div class="col-6 content_center">
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" role="switch" id="item_switch_details">
                                                        <label class="form-check-label" id="item_switch_label_detail">No</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-7">
                                                <div class="d-flex align-items-center">
                                                    <p>Vatable&nbsp;Sales:&nbsp;</p>
                                                    <p class="fw-bold" id="item_vatsales_details">&nbsp;</p>
                                                </div>
                                            </div>
                                            <div class="col-5 content_center">
                                                <div class="d-flex align-items-center">
                                                    <p>Vat:&nbsp;</p>
                                                    <p class="fw-bold" id="item_vat_details">&nbsp;</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-6">
                                                <div class="d-flex align-items-center">
                                                    <p>Discount:&nbsp;</p>
                                                    <input type="number" class="form-control" id="item_discount_details">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mb-2">
                                            <p>Total Amount:&nbsp;</p>
                                            <p class="fw-bold" id="item_total_details">&nbsp;</p>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-end">
                                            <button class="btn btn-primary" onclick="add_item_details()">Add</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row">
                                <div class="col-8 mb-4">
                                    <div class="sales_invoice_details_box">
                                        <div class="sales_invoice_details_title">
                                            <p>Item Lists</p>
                                        </div>
                                        <hr>
                                        <div class="table-responsive">
                                            <table id="item_list_table" class="table" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th class="d-none">ID</th>
                                                        <th>Item&nbsp;Code</th>
                                                        <th>Qty</th>
                                                        <th>Amount</th>
                                                        <th>Discount</th>
                                                        <th>Total&nbsp;Amount</th>
                                                        <th>Vatable&nbsp;Sales</th>
                                                        <th>Vat</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-4 mb-4">
                                    <div class="sales_invoice_details_box">
                                        <div class="sales_invoice_details_title">
                                            <p>Summary</p>
                                        </div>
                                        <hr>
                                        <div class="">
                                            
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-end">
                                            <button class="btn btn-secondary me-2" onclick="">Draft</button>
                                            <button class="btn btn-success" onclick="">Print</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var clients = [];
    var products = [];
    var vat_switch = false;
    var selected_item_id = "";
    var selected_item_code = "";
    var item_table_data = [];
    var item_table_list;

    $(document).ready(function() {
        get_products_clients();
    });

    $('#clients_details').change(function() {
        clientShowDetails($(this).val());
    });

    $('#products_details').change(function() {
        productShowDetails($(this).val());
    });
    
    $('#item_switch_details').change(function() {
        if ($(this).is(':checked')) {
            $('#item_switch_label_detail').text('Yes');
            vat_switch = true;
            calculateVatableSales();
            calculateVat();
        } else {
            $('#item_switch_label_detail').text('No');
            vat_switch = false;
            $('#item_vatsales_details').text('').attr('data-vatsales', '');
            $('#item_vat_details').text('').attr('data-vat', '');
        }
    });
    
    $('#item_qty_details').on('input', function() {
        calculateAmount();
        calculateVatableSales();
        calculateVat();
    });
    
    $('#item_price_details').on('input', function() {
        calculateAmount();
        calculateVatableSales();
        calculateVat();
    });

    $('#item_discount_details').on('input', function() {
        calculateTotalAmount();
        calculateVatableSales();
        calculateVat();
    });

    function showLoader() {
        $('#loader').show();
    }

    function hideLoader() {
        $('#loader').hide();
    }

    function formatPrice(price) {
        return new Intl.NumberFormat('en-US', { style: 'currency', currency: 'PHP' }).format(price);
    }

    function get_products_clients() {
        showLoader();
        $.ajax({
            url: '<?= base_url('sales_invoice/get_products_clients') ?>',
            type: 'POST',
            success: function(response) {
                $('#loader').hide();
                var unsanitizedData = JSON.parse(response); 
                products = unsanitizedData.products.map(function(product) {
                    return {
                        id: product.id,
                        product_name: sanitizeOutput(product.product_name),
                        product_item: sanitizeOutput(product.product_item),
                        product_weight: sanitizeOutput(product.product_weight),
                        product_price: sanitizeOutput(product.product_price),
                        product_name_item: sanitizeOutput(product.product_name + ' ( ' + product.product_item + ' )')
                    };
                });
                clients = unsanitizedData.clients.map(function(client) {
                    return {
                        id: client.id,
                        client_name: sanitizeOutput(client.client_name),
                        client_tin: sanitizeOutput(client.client_tin),
                        client_business_name: sanitizeOutput(client.client_business_name),
                        client_term: sanitizeOutput(client.client_term),
                        client_address: sanitizeOutput(client.client_address)
                    };
                });

                populateSelect('#clients_details', clients, 'client_name');
                populateSelect('#products_details', products, 'product_name_item');
                
                hideLoader();
            },
            error: function() {
                hideLoader();
            }
        });
    }

    function sanitizeOutput(input) {
        return input.replace(/\(alt39\)/g, "'");
    }

    function populateSelect(selector, items, textProperty) {
        var select = $(selector);
        select.empty();
        select.append($('<option></option>').attr('value', '').text('')); // Add blank option
        items.forEach(function(item) {
            var option = $('<option></option>').attr('value', item.id).text(item[textProperty]);
            select.append(option);
        });
    }

    function clientShowDetails(id) {
        var selectedItem = clients.find(client => client.id == id);
        if (selectedItem) {
            $('#client_tin_details').text(selectedItem.client_tin);
            $('#client_address_details').text(selectedItem.client_address);
            $('#client_company_details').text(selectedItem.client_business_name);
            $('#client_term_details').val(selectedItem.client_term).change();
            $('#client_date_details').val(new Date().toISOString().split('T')[0]);
        }
    }

    function productShowDetails(id) {
        var selectedItem = products.find(product => product.id == id);
        console.log(selectedItem);
        selected_item_id = selectedItem.id;
        selected_item_code = selectedItem.product_item;
        if (selectedItem) {
            $('#item_price_details').val(selectedItem.product_price);
            calculateAmount();
        }
    }

    function vatableSalesToCalculate(total_amount) {
        return total_amount / 1.12;
    }
    
    function calculateVatableSales() {
        if(vat_switch) {
            var total_amount = $('#item_total_details').attr('data-total');
            $('#item_vatsales_details').text(formatMoney(vatableSalesToCalculate(total_amount))).attr('data-vatsales', vatableSalesToCalculate(total_amount));
        }
    }

    function vatToCalculate(total_amount) {
        return total_amount - ( total_amount / 1.12 );
    }

    function calculateVat() {
        if(vat_switch) {
            var total_amount = $('#item_total_details').attr('data-total');
            $('#item_vat_details').text(formatMoney(vatToCalculate(total_amount))).attr('data-vat', vatToCalculate(total_amount));
        }
    }

    function totalAmountToCalculate(amount, discount, qty) {
        return amount - (discount * qty);
    }

    function calculateTotalAmount() {
        var amount = $('#item_amount_details').attr('data-amount');
        var discount = $('#item_discount_details').val();
        var qty = $('#item_qty_details').val();
        $('#item_total_details').text(formatMoney(totalAmountToCalculate(amount, discount, qty))).attr('data-total', totalAmountToCalculate(amount, discount, qty));
    }

    function amountToCalculate(price, qty) {
        return price * qty;
    }
    
    function calculateAmount() {
        var price = $('#item_price_details').val();
        var qty = $('#item_qty_details').val();
        $('#item_amount_details').text(formatMoney(amountToCalculate(price,qty))).attr('data-amount', amountToCalculate(price,qty));
        calculateTotalAmount();
    }

    function formatMoney(amount) {
        return amount.toLocaleString('en-US', { style: 'currency', currency: 'PHP' });
    }

    function add_item_details() {
        var add_item_price = $('#item_price_details').val();
        var add_item_qty = $('#item_qty_details').val();
        var add_item_discount = $('#item_discount_details').val();

        if(selected_item_id === "" || selected_item_code === "") {
            alert("Product is empty.");
            return;
        }

        if(add_item_price === "") {
            alert("Item price is empty.");
            return;
        }

        if(add_item_qty === "") {
            alert("Quantity is empty.");
            return;
        }

        add_item_discount = add_item_discount === "" ? 0 : add_item_discount;

        console.log(selected_item_id);
        console.log(selected_item_code);
        console.log(add_item_price);
        console.log(add_item_qty);
        console.log(add_item_discount);
        item_table_data.push(
            {
                id: selected_item_id,
                item_code: selected_item_code,
                item_price: add_item_price,
                item_qty: add_item_qty,
                item_discount: add_item_discount,
                item_vatable_sales: vatableSalesToCalculate(totalAmountToCalculate(amountToCalculate(add_item_price, add_item_qty))),
                item_vat: vatableSalesToCalculate(totalAmountToCalculate(amountToCalculate(add_item_price, add_item_qty)))
            }
        );
        console.log(item_table_data);
        item_list_table();
    }

    function clear_item_fields() {

    }

    function item_list_table() {
        console.log('item_table_data');
        console.log(item_table_data);
        item_table_list = $('#item_list_table').DataTable({
            destroy: true,
            data: item_table_data,
            columns: [
                { data: 'id', visible: false },
                { data: 'item_code'},
                { data: 'item_qty'},
                { 
                    data: function(data) {
                        return formatPrice(amountToCalculate(data.item_price, data.item_qty));
                    }
                },
                { data: 'item_discount'},
                { 
                    data: function(data) {
                        return formatPrice(totalAmountToCalculate(amountToCalculate(data.item_price, data.item_qty), data.item_discount, data.item_qty));
                    }
                },
                { 
                    data: function(data) {
                        return formatPrice(data.item_vatable_sales);
                    }
                },
                { 
                    data: function(data) {
                        return formatPrice(data.item_vat);
                    }
                }
            ],
            columnDefs: [
                { targets: '_all', className: 'content_center' },
            ],
            drawCallback: function() {

            }
        });
    }

</script>

<?= $this->endSection() ?>