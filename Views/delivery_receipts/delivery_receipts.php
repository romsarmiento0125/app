<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<style>
    .delivery_receipt_box {
        border: 1px solid #ccc;
        padding: 20px;
        border-radius: 15px; 
        background-color:#f0f0f0;
        border-top: 5px solid #80b380; 
    }

    .delivery_receipt_title p{
        font-size: 1.3rem;
        font-weight: 600;
    }
    
    .delivery_receipt_details_box {
        border: 1px solid #ccc;
        padding: 20px;
        border-radius: 15px; 
        background-color: #f9f9f9;
    }

    .delivery_receipt_details_title p{
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
            <div class="delivery_receipt_box">
                <div class="delivery_receipt_title">
                    <p id="si_id">Delivery Receipt</p>
                </div>
                <hr>
                <div class="">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-6 mb-4">
                                    <div class="delivery_receipt_details_box">
                                        <div class="delivery_receipt_details_title">
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
                                                    <!-- Remove the date field -->
                                                    <p>Date:&nbsp;</p>
                                                    <input type="date" class="form-control" id="client_date_details" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-6 mb-4">
                                    <div class="delivery_receipt_details_box">
                                        <div class="delivery_receipt_details_title">
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
                                               
                                            </div>
                                        </div>
                                       
                                        <div class="row mb-2">
                                            <div class="col-10">
                                                <div class="row"  id="add_input_discount">
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <button type="button" class="btn btn-danger" id="item_remove_discount" ><i class="fa fa-trash"></i></button>
                                                <button type="button" class="btn btn-success" id="item_add_discount" ><i class="fa fa-plus"></i></button>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mb-2">
                                            <p>Total Amount:&nbsp;</p>
                                            <p class="fw-bold" id="item_total_details">&nbsp;</p>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-end">
                                            <button class="btn btn-primary" id="add_product_item" >Add</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mb-4">
                            <div class="delivery_receipt_details_box">
                                <div class="delivery_receipt_details_title">
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
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="offset-2 col-4">
                                         <div class="d-flex">
                                            <div class="">
                                                <div class="d-flex align-items-center mb-2">
                                                    <p>Freight:&nbsp;</p>
                                                    <input type="number" class="form-control" id="item_freight_details" value='0'>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                         <div class="d-flex">
                                            <div class="">
                                                <div class="d-flex align-items-center mb-2">
                                                    <p>Total&nbsp;amount:&nbsp;</p>
                                                    <p class="fw-bold" id="summary_total_amount"></p>
                                                </div>
                                                <p>Discount:</p>
                                                <div class="" id="discount_summary">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="offset-1 col-5">
                                        <div class="d-flex">
                                            <div class="">
                                             
                                                <div class="d-flex align-items-center mb-2">
                                                    <p>TOTAL&nbsp;AMOUNT&nbsp;DUE:&nbsp;</p>
                                                    <p class="fw-bold" id="summary_total_amount_due"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-secondary me-2" id="update_draft_btn" style="display: none;" onclick="update_delivery_receipt('draft')">Update Draft</button>
                                    <button class="btn btn-danger me-2" id="cancel_update_draft_btn" style="display: none;" onclick="cancel_update_delivery_receipt()">Cancel</button>
                                    <button class="btn btn-secondary me-2" id="draft_btn" onclick="save_delivery_receipt('draft')">Draft</button>
                                    <button class="btn btn-success" id="print_btn" onclick="save_delivery_receipt('printed')">Print</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mb-4">
                            <div class="delivery_receipt_details_box">
                                <div class="delivery_receipt_details_title">
                                    <p>Invoices</p>
                                </div>
                                <hr>
                                <div class="table-responsive">
                                    <table id="invoice_list_table" class="table" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>SI_ID</th>
                                                <th>Name</th>
                                                <th>Terms</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="<?= base_url('assets/delivery_receipts/script.js') ?>"></script>

<?= $this->endSection() ?>