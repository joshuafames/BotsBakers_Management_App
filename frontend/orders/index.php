<html>
<?php include('../head.php');?>
<body id="element-to-print">

    <?php include('../components/left-menu.php');?>
    <div class="container main-body p-4">
        <section class="header-sec d-flex justify-space-between">
            <div>
                <h1 class="mb-0">Sales</h1>
                <p class="hanging-description">Record New Sales And Keep Track Of Previous Ones</p>
            </div>
            <button class="btn-outlined rounded-lg p-3">Edit Products +</button>
        </section>

        <form class="row" method="POST" id="quickOrder">
            <!-- <input type="text" name="useless" hidden value="usels"> -->
            <div class="quickOrderCards col-8 my-3">

                <section id="Products">
                </section>

            </div>
            <div class="reciept-design d-flex-space-between col-4">
                <div id="bill-items" class="reciept-footer-upper hide fade">
                    
                    <div id="orderbill" class="pb-3 dashed-bottom-divider">
                    </div>
                    <div class="reciept-footer-line d-flex-space-between mb-1 mt-3">
                        <p class="font-norm">Subtotal</p>
                        <p class="font-medium">R<span id="bill-sub-total">0.00</span></p>
                    </div>
                    <div class="reciept-footer-line d-flex-space-between dashed-bottom-divider pb-3">
                        <p class="font-norm">Tax 0%</p>
                        <p class="font-medium">R<span>0.00</span></p>
                    </div>
                    <div class="receipt-footer-line d-flex-space-between total-line py-3">
                        <h5 class="font-medium">Total</h5>
                        <h5 class="font-medium">R<span id="bill-total">1400.00</span><input type="number" name="bill-total" id="bill-total-h" hidden></h5>
                    </div>
                </div>
                <div id="no-items-yet" class="fade show">
                    <div class="icon-area text-center">
                        <div class="icon-section fs-1 mb-3"><i class="fa-regular fa-hourglass"></i></div>
                        <p id="bill-message" class="font-medium">No items added</p>
                    </div>
                    
                </div>

                <div class="reciept-footer-bottom">
                    <p class="hanging-description mb-2" id="qop-title">
                        Payment Option 
                        <span id="error-icon" class="hide">
                            <i class="fa-regular fa-warning"></i>
                        </span>    
                    </p>
                    <div class="d-flex justify-space-between options">
                        <input type="checkbox" name="paidby" value="Card" id="qopm-card" data-qopm="card" hidden>
                        <input type="checkbox" name="paidby" value="Cash" id="qopm-cash" data-qopm="cash" hidden>
                        <input type="checkbox" name="paidby" value="Invoice" id="qopm-invoice" data-qopm="invoice" hidden>
                        <button id="QOP-card" data-qop="card" onclick="qopSelect(this)" class="btn disabled easein simple-border"><i class="fa-regular fa-credit-card"></i></button>
                        <button id="QOP-cash" data-qop="cash" onclick="qopSelect(this)" class="btn disabled easein simple-border ml-2" ><i class="fa-regular fa-coins"></i></button>
                        <button id="QOP-invoice" data-qop="invoice" onclick="qopSelect(this)" class="btn disabled easein simple-border ml-2"><i class="fa-regular fa-qrcode"></i></button>
                    </div>
                    
                    <input type="submit" value="Place Order" class="w-100 mx0 disabled easein mt-4 btn btn-primary" id="place-bill">
                </div>

            </div>
        </form>

        <div class="nav-section table-nav pb-4">
            <nav class="nav-bar nav">
                <ul>
                    <li class="nav-item"><a class="nav-link active greytext" href="">Sales</a></li>
                    <li class="nav-item"><a class="nav-link greytext" href="">Product Sales Summary</a></li>
                    <li class="nav-item"><a class="nav-link greytext" href="">Daily Sales</a></li>
                </ul>
            </nav>
        </div>
        <div class="action-bar nav mb-4">
            <a class="btn-primary btn me-2" data-toggle="modal" data-target="#record-daily-sales" href="#"><i class="mdi mdi-plus me-1" ></i>Record End of Day Sales</a>
            <button class="btn greytext me-2"><i class="mdi mdi-magnify me-1"></i>Search</button>
            <button class="btn greytext me-2"><i class="mdi mdi-filter-outline me-1"></i>filter</button>
            <button class="btn greytext me-2"><i class="fa fa-sort me-1"></i>sort</button>
        </div>

        <div class="table-type2 container mb-4">
            <div class="table-head-row p-2 row">

                <div class="col-3">Date</div>
                <div class="col-3">Product</div>
                <div class="col-3">Unit Price</div>
                <div class="col-3">Total</div>
            </div>
            <div id="table-list">
            </div>
        </div>
    </div>

</body>

<script defer type="text/javascript" src="../utilities/js/getProds.js"></script>
<!-- <script defer type="text/javascript" src="../utilities/dataprovider/post-daily-sales.js"></script> -->

<script defer type="module">

    import { getProducts } from "./get-and-parse-products.js";
    import { incrementValue, decrementValue, clearBill } from "./dynamic-bill.js";
    import { getSalesSummary } from "./get-and-parse-sales.js";

    $(document).ready(function(){
        getProducts();
        getSalesSummary();

        //Set Aside Nav Menu Active Button
        const asideNavActiveBtn = document.querySelector("#link-to-orders");
        asideNavActiveBtn.classList.add("active"); 
    
        $(".btn.simple-border").click(function(e){
            e.preventDefault();
        });
        $('#after-submission').click(function() {
            setTimeout(() => {
                location.reload();
            }, 800);
        });


        /// POINT OF SALE SECTION -- SELECT PAYMENT OPTION
        var selectedPaymentOption;

        function qopSelect(lmnt){
            if(selectedPaymentOption != undefined){
                $("#"+selectedPaymentOption).removeClass("selected");
                document.querySelector('[data-qopm='+selectedPaymentOption.slice(4)+']').checked = false;
            }
            document.querySelector('[data-qopm='+lmnt.dataset.qop+']').checked = true;
            $("#"+lmnt.id).addClass("selected");
            selectedPaymentOption = lmnt.id;
        };
        window.qopSelect = qopSelect;

        // POINT OF SALE SECTION -- SUBMIT FORM
        const pointOfSaleSubmit = document.getElementById('place-bill');
        pointOfSaleSubmit.addEventListener('click', () => {
            if(selectedPaymentOption == undefined){
                $('#qop-title').addClass('error-message');
                $('#error-icon').removeClass('hide');
            }else{
                $.ajax({
                    url: '/Business_Manager_App/backend/sales',
                    method: 'post',
                    data: $('#quickOrder').serialize(),
                    success:function(response){
                        console.log(response);
                        $('#create-invoice').modal('hide');
                        $('#success-modal').modal('show');
                        setTimeout(() => {
                            //location.reload();
                        }, 1800);
                    }
                });
                const billItems = document.querySelectorAll('.bill-item-qty');
                billItems.forEach(item => {
                    item.value = 0
                });
                clearBill();
            }
        });
        $("#quickOrder").submit(function(e){
            e.preventDefault();
        });
        
    });
</script>
</html>