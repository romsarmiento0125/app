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
                                                        <label class="form-check-label" id="item_switch_label_detail">Not Vatable</label>
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
                                            <div class="col-10">
                                                <div class="row"  id="add_input_discount">

                                                </div>
                                            </div>
                                            <!-- <div class="col-4">
                                                <div class="d-flex align-items-center">
                                                    <p>Discount:&nbsp;</p>
                                                    <input type="number" class="form-control" id="item_discount_details">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="d-flex align-items-center">
                                                    <p>Discount&nbsp;Label:&nbsp;</p>
                                                    <input type="number" class="form-control" id="item_discount_details">
                                                </div>
                                            </div> -->
                                            <div class="col-2">
                                                <button type="button" class="btn btn-danger" id="item_remove_discount" onclick="remove_discount_input()"><i class="fa fa-trash"></i></button>
                                                <button type="button" class="btn btn-success" id="item_add_discount" onclick="add_discount_input()"><i class="fa fa-plus"></i></button>
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

                        <div class="col-12 mb-4">
                            <div class="sales_invoice_details_box">
                                <div class="sales_invoice_details_title">
                                    <p>Summary</p>
                                </div>
                                <hr>
                                <div class="table-responsive">
                                    <table id="item_list_table" class="table" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th class="d-none">ID</th>
                                                <th>Item&nbsp;Code</th>
                                                <th>Price</th>
                                                <th>Qty</th>
                                                <th>Amount</th>
                                                <th>Discount</th>
                                                <th>Total&nbsp;Amount</th>
                                                <th>Action</th>
                                                <th class="d-none">Vatable&nbsp;Sales</th>
                                                <th class="d-none">Vat</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="offset-2 col-4">
                                         <div class="d-flex">
                                            <div class="">
                                                <h4>Discount</h4>
                                                <div class="d-flex align-items-center mb-2">
                                                    <p class="fw-bold" id="">50</p>
                                                    <p class="mx-2">x</p>
                                                    <p class="fw-bold" id="">40</p>
                                                    <p class="fw-bold ms-2" id="">Label</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="offset-1 col-5">
                                        <div class="d-flex">
                                            <div class="">
                                                <div class="d-flex align-items-center mb-2">
                                                    <p>VATable&nbsp;Sales:&nbsp;</p>
                                                    <p class="fw-bold" id="summary_vatable_sales">&nbsp;</p>
                                                </div>
                                                <div class="d-flex align-items-center mb-2">
                                                    <p>VAT-Exempt&nbsp;Sales:&nbsp;</p>
                                                    <p class="fw-bold" id="">&nbsp;</p>
                                                </div>
                                                <div class="d-flex align-items-center mb-2">
                                                    <p>VAT-Zero&nbsp;Rated&nbsp;Sales:&nbsp;</p>
                                                    <p class="fw-bold" id="">&nbsp;</p>
                                                </div>
                                                <div class="d-flex align-items-center mb-2">
                                                    <p>VAT&nbsp;Amount:&nbsp;</p>
                                                    <p class="fw-bold" id="">&nbsp;</p>
                                                </div>
                                                <div class="d-flex align-items-center mb-2">
                                                    <p>TOTAL&nbsp;AMOUNT&nbsp;DUE:&nbsp;</p>
                                                    <p class="fw-bold" id="">&nbsp;</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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

<script>
    var clients = [];
    var products = [];
    var vat_switch = false;
    var selected_item_id = "";
    var selected_item_code = "";
    var item_table_data = [];
    var item_table_list;
    var input_counter = 0;
    var discount_list = [];

    $(document).ready(function() {
        get_products_clients();
        add_discount_input();
        initialize_inputs();
        $('#item_remove_discount').hide();
    });

    $('#clients_details').change(function() {
        clientShowDetails($(this).val());
    });

    $('#products_details').change(function() {
        productShowDetails($(this).val());
    });
    
    $('#item_switch_details').change(function() {
        if ($(this).is(':checked')) {
            $('#item_switch_label_detail').text('Vatable');
            vat_switch = true;
            calculateVatableSales();
            calculateVat();
        } else {
            $('#item_switch_label_detail').text('Not Vatable');
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

    // $('#item_discount_details').on('input', function() {
    function initialize_inputs() {
        $('.item_discounts_details').on('input', function() {
            get_all_discount_value();
            calculateTotalAmount();
            calculateVatableSales();
            calculateVat();
        });
    }

    function showLoader() {
        $('#loader').show();
    }

    function hideLoader() {
        $('#loader').hide();
    }

    function formatPrice(price) {
        return new Intl.NumberFormat('en-US', { style: 'currency', currency: 'PHP' }).format(price);
    }

    // function formatMoney(amount) {
    //     return amount.toLocaleString('en-US', { style: 'currency', currency: 'PHP' });
    // }

    function roundToTwoDecimals(number) {
        return parseFloat(number.toFixed(2));
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
            $('#item_vatsales_details').text(formatPrice(vatableSalesToCalculate(total_amount))).attr('data-vatsales', vatableSalesToCalculate(total_amount));
        }
    }

    function vatToCalculate(total_amount) {
        return total_amount - ( total_amount / 1.12 );
    }

    function calculateVat() {
        if(vat_switch) {
            var total_amount = $('#item_total_details').attr('data-total');
            $('#item_vat_details').text(formatPrice(vatToCalculate(total_amount))).attr('data-vat', vatToCalculate(total_amount));
        }
    }

    function totalAmountToCalculate(amount, discount, qty) {
        return amount - (discount * qty);
    }

    function calculateTotalAmount() {
        var amount = $('#item_amount_details').attr('data-amount');
        var discount = 0;
        get_all_discount_value();
        discount = get_total_discount();
        var qty = $('#item_qty_details').val();
        $('#item_total_details').text(formatPrice(totalAmountToCalculate(amount, discount, qty))).attr('data-total', totalAmountToCalculate(amount, discount, qty));
    }

    function amountToCalculate(price, qty) {
        return price * qty;
    }
    
    function calculateAmount() {
        var price = $('#item_price_details').val();
        var qty = $('#item_qty_details').val();
        $('#item_amount_details').text(formatPrice(amountToCalculate(price,qty))).attr('data-amount', amountToCalculate(price,qty));
        calculateTotalAmount();
    }

    function add_item_details() {
        var add_item_price = $('#item_price_details').val();
        var add_item_qty = $('#item_qty_details').val();
        var add_item_discount = 0;
        var add_item_vatable_sales = $('#item_vatsales_details').attr('data-vatsales');
        var add_item_vat = $('#item_vat_details').attr('data-vat');

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

        // add_item_discount = (add_item_discount === "" || add_item_discount === undefined) ? 0 : add_item_discount;
        add_item_vatable_sales = (add_item_vatable_sales === "" || add_item_vatable_sales === undefined) ? 0 : add_item_vatable_sales;
        add_item_vat = (add_item_vat === "" || add_item_vat === undefined) ? 0 : add_item_vat;

        console.log(selected_item_id);
        console.log(selected_item_code);
        console.log(add_item_price);
        console.log(add_item_qty);
        console.log(add_item_discount);
        console.log(add_item_vatable_sales);
        console.log(add_item_vat);
        item_table_data.push(
            {
                id: selected_item_id,
                item_code: selected_item_code,
                item_price: add_item_price,
                item_qty: add_item_qty,
                item_discount: discount_list,
                item_vatable_sales: add_item_vatable_sales,
                item_vat: add_item_vat
            }
        );
        console.log(item_table_data);
        item_list_table();
        // compute_vatables();
    }

    function clear_item_fields() {

    }

    function item_list_table() {
        item_table_list = $('#item_list_table').DataTable({
            destroy: true,
            data: item_table_data,
            columns: [
                { data: 'id', visible: false },
                { data: 'item_code'},
                { data: 'item_price'},
                { data: 'item_qty'},
                { 
                    data: function(data) {
                        return formatPrice(amountToCalculate(data.item_price, data.item_qty));
                    }
                },
                { 
                    data: function(data) {
                        console.log(data.item_discount);
                        var discount = 0;
                        data.item_discount.forEach(function(dis) {
                            console.log(dis.discount);
                            discount = discount + dis.discount;
                        });
                        console.log("table discount: " + discount);
                        return "discount";
                    }
                },
                { 
                    data: function(data) {
                        return formatPrice(totalAmountToCalculate(amountToCalculate(data.item_price, data.item_qty), data.item_discount, data.item_qty));
                    }
                },
                { 
                    data: function(data) {
                        var edit_button = '<button type="button" class="btn btn-warning mx-1"><i class="fa fa-pencil"></i></button>';
                        var remove_button = '<button type="button" class="btn btn-danger mx-1"><i class="fa fa-trash"></i></button>';
                        return edit_button + remove_button;
                    }
                },
                { 
                    data: function(data) {
                        return data.item_vatable_sales;
                    },
                    visible: false
                },
                { 
                    data: function(data) {
                        return data.item_vat;
                    },
                    visible: false
                }
            ],
            columnDefs: [
                { targets: '_all', className: 'content_center' },
            ],
            drawCallback: function() {

            }
        });
    }

    function compute_vatables() {
        var sum_vat_sale;
        item_table_data.forEach(function(item) {
            sum_vat_sale += item.item_vatable_sales;
        });
    }

    function add_discount_input() {
        input_counter++;
        if(input_counter > 1) {
            $('#item_remove_discount').show();
        }
        else {  
            $('#item_remove_discount').hide();
        }
        var dicount_input = '<div class="col-5 mb-2">'+
            '<div class="d-flex align-items-center">'+
            '<p>Discount:&nbsp;</p>'+
            '<input type="number" class="form-control item_discounts_details" id="item_discount_value_' + input_counter + '">'+
            '</div>'+
            '</div>';
        var discount_label = '<div class="col-7 mb-2">'+
            '<div class="d-flex align-items-center">'+
            '<p>Discount&nbsp;Label:&nbsp;</p>'+
            '<input type="text" class="form-control item_discounts_details" id="item_discount_label_' + input_counter + '">'+
            '</div>'+
            '</div>';
        $('#add_input_discount').append(dicount_input);
        $('#add_input_discount').append(discount_label);
        initialize_inputs();
    }

    function remove_discount_input() {
        const container = $("#add_input_discount");
        input_counter--;
        if(input_counter > 1) {
            $('#item_remove_discount').show();
        }
        else {
            $('#item_remove_discount').hide();
        }
        container.children().last().remove();
        container.children().last().remove();
        initialize_inputs();
    }

    function get_all_discount_value() {
        discount_list = [];
        for(var i = 1; i <= input_counter; i++){
            var dis_val = $('#item_discount_value_'+i).val();
            var dis_label = $('#item_discount_label_'+i).val();
            discount_list.push(
                {
                    label: dis_label,
                    discount: dis_val
                }
            );
        }
    }

    function get_total_discount() {
        var dis = 0;
        discount_list.forEach(function(discounts){
            dis += parseFloat(discounts.discount) || 0;
        });
        return dis;
    }

</script>

<?= $this->endSection() ?>