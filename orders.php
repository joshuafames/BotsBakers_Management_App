<?php
    include('classes/DB.php');
    include('classes/Login.php');

    $showTimeline = False;
    if (Login::isLoggedIn()) {
            $userid = Login::isLoggedIn();
            $showTimeline = True;

            $myusername = DB::query('SELECT username FROM users WHERE id=:userid', array(':userid'=>Login::isLoggedIn()))['0']['username'];
            
            $previnvnumber = DB::query('SELECT MAX(id) AS `col` FROM `invoices`')[0]['col']+1;
            $newinvoicenumber = "INV".$previnvnumber;

            $dueArray = DB::query('SELECT Amount FROM invoices');
            $duebalance = 0;
            foreach($dueArray as $bal){
                $duebalance = $duebalance + $bal['Amount'];
            }
            $duebalance = number_format($duebalance, 2, '.', '');
    }else{
        header('Location: ./login.php');

    }
?>

<html>
<?php include('head.php');?>
<body id="element-to-print">

    <?php include('./components/left-menu.php');?>
    <div class="container main-body p-4">
        <div class="header-sec d-flex">
            <h1 class="mb-0">Orders</h1>
        </div>
        <p class="hanging-description">Add description</p>

        <form class="row" method="POST" id="quickOrder" action="#">
            <input type="text" name="useless" hidden value="usels">
            <div class="quickOrderCards col-8 my-3">
                <div class="d-flex">
                    <div class="card d-flex-space-between tab-selector m-2">
                        <div class="description-header">
                            <i class="fa-regular fa-bread-slice fs-4"></i>
                        </div>
                        <div class="item-name">
                            <h4 class="mb-0 mt-2">Breads</h4>
                            <p class="hanging-description mb-3"><span>6</span> items</p>
                        </div>
                    </div>
                    <div class="card d-flex-space-between tab-selector m-2">
                        <div class="description-header">
                            <i class="fa-regular fa-puzzle-piece fs-4"></i>
                        </div>
                        <div class="item-name">
                            <h4 class="mb-0 mt-2">Other</h4>
                            <p class="hanging-description mb-3"><span>1</span> item</p>
                        </div>
                    </div>
                    <div class="card d-flex-space-between tab-selector m-2">
                        <div class="description-header">
                            <i class="fa-regular fa-pen fs-4"></i>
                        </div>
                        <div class="item-name">
                            <h4 class="mb-0 mt-2">Custom</h4>
                            <p class="hanging-description mb-3">No items</p>
                        </div>
                    </div>
                </div>                
                <div class="d-flex">
                    <div class="card m-2">
                        <div class="description-header">
                            <p class="hanging-description">Quick Action  <span><i class="fa fa-arrow-right"></i>   Order</span></p>
                        </div>
                        <div class="item-name">
                            <h4 class="mb-0 mt-2">Brown Buns</h4>
                            <p class="hanging-description mb-3" data-product="BurgerBuns">R10.00</p>
                        </div>
                        <div class="action-button-area d-flex">
                            <button class="icon btn simple-border" id="card-order-qty-less" onclick="decrementValue(this)"><i class="fa-regular fa-minus"></i></button>
                            <input class="form-control nobtns" type="number" name="BrownBuns" id="card-order-qty" min="0" value="0">
                            <button class="icon btn simple-border" id="card-order-qty-more" onclick="incrementValue(this)"><i class="fa-regular fa-add"></i></button>
                        </div>
                    </div>
                    <div class="card m-2">
                        <div class="description-header">
                            <p class="hanging-description">Quick Action  <span><i class="fa fa-arrow-right"></i>   Order</span></p>
                        </div>
                        <div class="item-name">
                            <h4 class="mb-0 mt-2">Buns</h4>
                            <p class="hanging-description mb-3" data-product="BurgerBuns">R<span>10.00</span></p>
                        </div>
                        <div class="action-button-area d-flex">
                            <button class="icon btn simple-border" id="card-order-qty-less" onclick="decrementValue(this)" onclick="decrementValue(this)"><i class="fa-regular fa-minus"></i></button>
                            <input class="form-control nobtns" type="number" name="Buns" id="card-order-qty" min="0" value="0">
                            <button class="icon btn simple-border" id="card-order-qty-more" onclick="incrementValue(this)"><i class="fa-regular fa-add"></i></button>
                        </div>
                    </div>
                    <div class="card m-2">
                        <div class="description-header">
                            <p class="hanging-description">Quick Action  <span><i class="fa fa-arrow-right"></i>   Order</span></p>
                        </div>
                        <div class="item-name">
                            <h4 class="mb-0 mt-2">Softis</h4>
                            <p class="hanging-description mb-3" data-product="Softis">R10.00</p>
                        </div>
                        <div class="action-button-area d-flex">
                            <button class="icon btn simple-border" id="card-order-qty-less" onclick="decrementValue(this)"><i class="fa-regular fa-minus"></i></button>
                            <input class="form-control nobtns" type="number" name="Softis" id="card-order-qty" min="0" value=0>
                            <button class="icon btn simple-border" id="card-order-qty-more" onclick="incrementValue(this)"><i class="fa-regular fa-add"></i></button>
                        </div>
                    </div>
                </div>  
                <div class="d-flex">
                    <div class="card m-2">
                        <div class="description-header">
                            <p class="hanging-description">Quick Action  <span><i class="fa fa-arrow-right"></i>   Order</span></p>
                        </div>
                        <div class="item-name">
                            <h4 class="mb-0 mt-2">Brown Bread</h4>
                            <p class="hanging-description mb-3" data-product="BrownBread">R10.00</p>
                        </div>
                        <div class="action-button-area d-flex">
                            <button class="icon btn simple-border" id="card-order-qty-less" onclick="decrementValue(this)"><i class="fa-regular fa-minus"></i></button>
                            <input class="form-control nobtns" type="number" name="BrownBread" id="card-order-qty" min="0" value="0">
                            <button class="icon btn simple-border" id="card-order-qty-more" onclick="incrementValue(this)"><i class="fa-regular fa-add"></i></button>
                        </div>
                    </div>
                    <div class="card m-2">
                        <div class="description-header">
                            <p class="hanging-description">Quick Action  <span><i class="fa fa-arrow-right"></i>   Order</span></p>
                        </div>
                        <div class="item-name">
                            <h4 class="mb-0 mt-2">White Bread</h4>
                            <p class="hanging-description mb-3" data-product="WhiteBread">R10.00</p>
                        </div>
                        <div class="action-button-area d-flex">
                            <button class="icon btn simple-border" id="card-order-qty-less" onclick="decrementValue(this)"><i class="fa-regular fa-minus"></i></button>
                            <input class="form-control nobtns" type="number" name="WhiteBread" id="card-order-qty" min="0" value="0">
                            <button class="icon btn simple-border" id="card-order-qty-more" onclick="incrementValue(this)"><i class="fa-regular fa-add"></i></button>
                        </div>
                    </div>
                    <div class="card m-2">
                        <div class="description-header">
                            <p class="hanging-description">Quick Action  <span><i class="fa fa-arrow-right"></i>   Order</span></p>
                        </div>
                        <div class="item-name">
                            <h4 class="mb-0 mt-2">Rolls</h4>
                            <p class="hanging-description mb-3" data-product="Rolls">R10.00</p>
                        </div>
                        <div class="action-button-area d-flex">
                            <button class="icon btn simple-border" id="card-order-qty-less" onclick="decrementValue(this)"><i class="fa-regular fa-minus"></i></button>
                            <input class="form-control nobtns" type="number" name="Rolls" id="card-order-qty" min="0" value="0">
                            <button class="icon btn simple-border" id="card-order-qty-more" onclick="incrementValue(this)"><i class="fa-regular fa-add"></i></button>
                        </div>
                    </div>
                </div> 
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
                        <p class="font-medium">No items added</p>
                    </div>
                    
                </div>

                <div class="reciept-footer-bottom">
                    <p class="hanging-description mb-2" id="qop-title">Payment Option <span id="error-icon" class="hide"><i class="fa-regular fa-warning"></i></span></p>
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
                    <li class="nav-item"><a class="nav-link active greytext" href="">All</a></li>
                    <li class="nav-item"><a class="nav-link greytext" href="">Pending</a></li>
                    <li class="nav-item"><a class="nav-link greytext" href="">Completed</a></li>
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

                <div class="col-2">Date</div>
                <div class="col-2">Sales</div>
                <div class="col-2">Cash Payments</div>
                <div class="col-3">Debit Card Payments</div>
                <div class="col-2">Invoice Payments</div>
                <div class="col-1">Total</div>
            </div>
            <div id="table-list">
            </div>
        </div>
    </div>

    <div id="success-modal" class="modal fade" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="border-radius:20px;width:450px;">
                <div class="modal-header">
                    <div class="icon-area"><i class="fa fa-check"></i></div>
                    <h2 class="mt-2">Success!</h2>
                </div>
                <div class="modal-body text-center">
                    <p>A new order recorded successfully</p>
                </div>
                <div class="modal-footer">
                    <button class="btn" id="after-submission" data-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>
    <div id="record-daily-sales" class="modal fade" tabindex="-1">
        <div class="modal-dialog" role="document" style="max-width:900px;">
            <form class="modal-content" style="border-radius:20px;width:900px;">
                <div class="modal-header" style="flex-direction: column;">
                    <small>Daily Sales</small>
                    <h2 class="mt-2">End Of Day Count</h2>
                </div>
                <div class="modal-body p-0 row text-center" style="--bs-gutter-x: 0;">
                    <section class="col text-center" id="daily-card-sales">
                        <i class="mdi mdi-credit-card"></i>
                        <h3>Card Payment</h3>
                        <input type="text" placeholder="R 00,00" name="card-sales">

                    </section>
                    <section class="col text-center" style="border-left: 1px solid #cdcdcd; border-right: 1px solid #cdcdcd;" id="daily-cash-sales">
                        <i class="mdi mdi-coin"></i>
                        <h3>Cash</h3>
                        <input type="text" placeholder="R 00,00" name="cash-sales">

                    </section>
                    <section class="col text-center" id="daily-vendor-sales">
                        <i class="mdi mdi-bike"></i>
                        <h3>Bicycles</h3>
                        <input type="text" placeholder="R 00,00"  name="vendor-sales">
                    </section>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="submit-btn btn">Submit</button>
                    <button class="btn cancel-btn" id="after-submission" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</body>
<script type="text/javascript" src="./js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="./js/bootstrap.min.js"></script>
<script type="module" src="./js/ordering-features.js"></script>
<script type="text/javascript" src="./js/getProds.js"></script>
<script type="text/javascript" src="./dataprovider/post-daily-sales.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
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


        /// POS SECTION FUNCTIONALITY
        var selectedOption;

        function qopSelect(lmnt){
            if(selectedOption != undefined){
                $("#"+selectedOption).removeClass("selected");
                document.querySelector('[data-qopm='+selectedOption.slice(4)+']').checked = false;
            }
            document.querySelector('[data-qopm='+lmnt.dataset.qop+']').checked = true;
            $("#"+lmnt.id).addClass("selected");
            selectedOption = lmnt.id;
        };
        window.qopSelect = qopSelect;

        $("#quickOrder").submit(function(e){
            e.preventDefault();
            if(selectedOption == undefined){
                $('#qop-title').addClass('error-message');
                $('#error-icon').removeClass('hide');
            }else{
                $.ajax({
                    url: './orderAPI.php',
                    method: 'post',
                    data: $(this).serialize(),
                    success:function(response){
                        console.log(response);
                        $('#create-invoice').modal('hide');
                        $('#success-modal').modal('show');
                        setTimeout(() => {
                            //location.reload();
                        }, 1800);
                    }
                });
            }
        });
        
    });
</script>
</html>