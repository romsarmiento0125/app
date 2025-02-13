<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="">
    <div class="row">
        <div class="col-8">
            <p>Rom Paulo Sarmiento</p>
        </div>
        <div class="col-4">
            <p>2025-01-16</p>
        </div>
        <div class="col-12">
            <p>KM 37 PULONG BUHANGIN, STA. MARIA BULACAN</p>
        </div>
        <div class="col-8">
            <p>MGDR POULTRY</p>
        </div>
        <div class="col-4">

        </div>
    </div>
    <div class="">
        <div class="row">
            <div class="col-1">
                <p>30</p>
            </div>
            <div class="col-2">
                <p>BAGS</p>
            </div>
            <div class="col-5">
                <p>1 BLEND HOG BREEDER MASH</p>
            </div>
            <div class="col-2">
                <p>1,180.00</p>
            </div>
            <div class="col-2">
                <p>35,400.00</p>
            </div>
        </div>
        <div class="">
            <div class="row">
                <div class="col-1">
                    <p>30</p>
                </div>
                <div class="col-2">
                    <p>BAGS</p>
                </div>
                <div class="col-5">
                    <p>1 BLEND HOG BREEDER MASH</p>
                </div>
                <div class="col-2">
                    <p>1,180.00</p>
                </div>
                <div class="col-2">
                    <p>35,400.00</p>
                </div>
            </div>
        </div>
        <div class="">
            <div class="row">
                <div class="col-1">
                    <p>30</p>
                </div>
                <div class="col-2">
                    <p>BAGS</p>
                </div>
                <div class="col-5">
                    <p>1 BLEND HOG BREEDER MASH</p>
                </div>
                <div class="col-2">
                    <p>1,180.00</p>
                </div>
                <div class="col-2">
                    <p>35,400.00</p>
                </div>
            </div>
        </div>
        <div class="">
            <div class="row">
                <div class="col-1">
                </div>
                <div class="col-2">
                </div>
                <div class="col-5">
                    DISCOUNT
                </div>
                <div class="col-2">
                </div>
                <div class="col-2">
                    <p>80,610.00</p>
                </div>
            </div>
        </div>
        <div class="">
            <div class="row">
                <div class="col-1">
                </div>
                <div class="col-2">
                </div>
                <div class="col-5">
                    <p>40 x 150</p>
                </div>
                <div class="col-2">
                </div>
                <div class="col-2">
                    <p>6,000.00 hbm</p>
                </div>
            </div>
        </div>
        <div class="">
            <div class="row">
                <div class="col-3">
                </div>
                <div class="col-5">
                    <p>40 x 150</p>
                </div>
                <div class="col-2">
                </div>
                <div class="col-2">
                    <p>6,000.00 tac</p>
                </div>
            </div>
        </div>
        <div class="">
            <div class="row">
                <div class="col-1">

                </div>
                <div class="col-2">

                </div>
                <div class="col-5">

                </div>
                <div class="col-2">

                </div>
                <div class="col-2">
                    <p>336,696.43</p>
                </div>
            </div>
        </div>
        <div class="">
            <div class="row">
                <div class="col-1">

                </div>
                <div class="col-2">

                </div>
                <div class="col-5">

                </div>
                <div class="col-2">

                </div>
                <div class="col-2">
                    <p>228,750.00</p>
                </div>
            </div>
        </div>
        <div class="">
            <div class="row">
                <div class="col-1">

                </div>
                <div class="col-2">

                </div>
                <div class="col-5">

                </div>
                <div class="col-2">

                </div>
                <div class="col-2">
                    <p>0</p>
                </div>
            </div>
        </div>
        <div class="">
            <div class="row">
                <div class="col-1">

                </div>
                <div class="col-2">

                </div>
                <div class="col-5">

                </div>
                <div class="col-2">

                </div>
                <div class="col-2">
                    <p>40,403.57</p>
                </div>
            </div>
        </div>
        <div class="">
            <div class="row">
                <div class="col-1">

                </div>
                <div class="col-2">

                </div>
                <div class="col-5">

                </div>
                <div class="col-2">

                </div>
                <div class="col-2">
                    <p>605,850.00</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Get the JSON data from the hidden input field
    var dataFromCodeIgniter = <?= $result ?>;

    // Using jQuery:
    $(document).ready(function() {
        console.log(dataFromCodeIgniter); // Output: 123 (jQuery example)
    });
</script>
<?= $this->endSection() ?>
