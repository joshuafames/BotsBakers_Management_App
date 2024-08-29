<?php
    include('classes/DB.php');
    include('classes/Login.php');

    $showTimeline = False;
    if (Login::isLoggedIn()) {
            $userid = Login::isLoggedIn();
            $showTimeline = True;

            $myusername = DB::query('SELECT username FROM users WHERE id=:userid', array(':userid'=>Login::isLoggedIn()))['0']['username'];
            
            $previnvnumber = DB::query('SELECT MAX(id) AS `col` FROM `invoices`')[0]['col'];
            $newinvoicenumber = "INV".$previnvnumber+1;

            /// GET DUE INVOICES SUM
            $dueArray = DB::query('SELECT Amount FROM invoices');
            $dueInvSum = 0;
            foreach($dueArray as $bal){
                $dueInvSum = $dueInvSum + $bal['Amount'];
            }
            $dueInvSum = number_format($dueInvSum, 2, '.', '');

            /// GET PENDING INVOICES SUM
            $pendingInvArray = DB::query('SELECT * FROM `invoices` WHERE Due_Date > CURRENT_DATE()');
            $pendingInvSum = 0;
            foreach($pendingInvArray as $bal){
                $pendingInvSum = $pendingInvSum + $bal['Amount'];
            }
            $pendingInvSum = number_format($pendingInvSum, 2, '.', '');
    }else{
        header('Location: ./login.php');

    }
?>

<html>
<?php
include('head.php');
?>
<body id="element-to-print">
    <form method="post" action="./home.php" name="order" class="hide">
        <input type="text" name="clientname" placeholder="Client Name">
        <p>Items:</p>
            <input type="radio" name="item" value="Brown Bread" id="brownbread">
            <label for="brownbread">Brown Bread</label>
            <input type="radio" name="item" value="White Bread" id="whitebread">
            <label for="whitebread">White Bread</label>
            <input type="radio" name="item" value="Long Rolls" id="longrolls">
            <label for="longrolls">Long Rolls</label>
            <input type="radio" name="item" value="Burger Buns" id="burgerbuns">
            <label for="burgerbuns">Burger Buns</label><br>
        <input type="checkbox" name="Sliced">Sliced <br>
        <input type="text" name="quantity" placeholder="how many">
        <input type="submit" name="order" class="btn-primary">

    </form>
    <?php include('./components/left-menu.php'); ?>
    <div class="container main-body p-4">
        <div class="header-sec d-flex">
            <h1>Invoices</h1>
        </div>
        <p class="hanging-description">Add description</p>

        <div class="row">
            <div class="quickViewCards d-flex my-4">
                <div class="card me-3">
                    
                    <div class="icon-area"><i class="mdi mdi-clock"></i></div>
                    <div class="info-area">
                        <span class="card-title">Balance</span>
                        <p class="hanging-description">Difference in the paid and due amounts</p>
                        <div class="price d-flex">
                            <h4 class="font-bold" id="inv_balance">R</h4>
                            <span class="h4 greytext font-bold">.99</span>
                        </div>
                        
                    </div>
                </div>
                <div class="card me-3">
                    <div class="icon-area"><i class="mdi mdi-bell-outline"></i></div>
                    <div class="info-area">
                        <span class="card-name">Amount Due</span>
                        <p class="hanging-description">Total amount yet to be processed from clients</p>
                        <h4 class="font-bold">R<?php echo($dueInvSum); ?></h4>
                    </div>
                </div>
                <div class="card me-3">
                    <div class="icon-area"><i class="mdi mdi-coin"></i></div>
                    <div class="info-area">
                        <span class="card-name">Amount Pending</span>
                        <p class="hanging-description text-grey">Total amount for invoices not yet due</p>
                        <h4 class="font-bold">R<?php echo($pendingInvSum); ?></h4>
                    </div>
                </div>
            </div>
            <!---<div class="form new-invoice">
                <h2>New Invoice</h2>
                <form class="">
                    <input type="text" name="clientname" placeholder="Client Name">
                    <div class="form-group">
                        <div class="row">
                            <div class="col"><input type="text" name="item1" placeholder="White Bread"></div>
                            <div class="col"><input type="text" name="item2" placeholder="Brown Bread"></div>
                            <div class="col"><input type="text" name="item3" placeholder="Rolls"></div>
                            <div class="col"><input type="text" name="item4" placeholder="Burger Buns"></div>
                            <div class="col"><input type="text" name="item5" placeholder="Softis"></div>
                        </div>
                        <div class="row">
                            <div class="col summary">
                                <p>Total</p>
                                <p>Balance</p>
                            </div>
                            <div class="col summary-span">
                                <p>R300</p>
                                <p>R300</p>
                            </div>

                        </div>
                    </div>
                </form>
            </div>--->
        </div>

        <div class="nav-section table-nav pb-4">
            <nav class="nav-bar nav tabs">
                <ul class="tab-links">
                    <li class="nav-item"><a class="nav-link active greytext" href="#tab1">All</a></li>
                    <li class="nav-item"><a class="nav-link greytext" href="#tab2">Clients</a></li>
                    <li class="nav-item"><a class="nav-link greytext" href="#tab3">Completed</a></li>
                </ul>
            </nav>
        </div>
        <div class="action-bar nav mb-4">
            <a class="btn-primary btn me-2" data-toggle="modal" data-target="#create-invoice" href="#"><i class="mdi mdi-plus me-1" ></i>New</a>
            <button class="btn greytext me-2"><i class="mdi mdi-magnify me-1"></i>Search</button>
            <button class="btn greytext me-2"><i class="mdi mdi-filter-outline me-1"></i>filter</button>
            <button class="btn greytext me-2"><i class="fa fa-sort me-1"></i>sort</button>
        </div>

        <div class="tab-content">
            <div id="tab1" class="table-type2 tab active container mb-4">
                <div class="table-head-row p-2 row">
                    <div class="table-col col-2">Invoice</div>
                    <div class="table-col col-2">Date</div>
                    <div class="table-col col-3">Client</div>
                    <div class="table-col col-2">Amount</div>
                    <div class="table-col col-3">Status</div>
                </div>
                <div id="invoice-list">
                </div>
            </div>

            <div id="tab2" class="tab clients table-type2">
                <div class="table-head-row p-2 row">
                    <div class="table-col col-3">Client ID</div>
                    <div class="table-col col-3">Name</div>
                    <div class="table-col col-3">Number of Orders</div>
                    <div class="table-col col-3">Contact</div>
                </div>
                <ul id="client-list">
                </ul>
            </div>
        </div>
        
    </div>
    
    <?php include('./components/create-invoice-form.php');?>
    <?php include('./components/success-popup.php'); ?>
</body>
<script type="text/javascript" src="./js/jquery-3.3.1.min.js"></script>
<script src="./js/bootstrap.min.js"></script>
<script type="text/javascript" src="./js/features.js"></script>
<script type="module" src="./dataprovider/fetch-invoices.js"></script>
<script type="module" src="./dataprovider/fetch-clients.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        //Set Aside Nav Menu Active Button
        const asideNavActiveBtn = document.querySelector("#link-to-invoices");
        asideNavActiveBtn.classList.add("active"); 

        //load invoices
        getInvoices();
        //load clients
        getClients("", () => {
            const linksToSingleClient = document.querySelectorAll(".single-client-table-row");
            linksToSingleClient.forEach(element => {
                element.attributes['href'].nodeValue += "&&prev=invoices";
            });
            console.log(linksToSingleClient);
        });
        //Create New Invoice
        $('#addinvoice').submit(function(e){
            e.preventDefault();
            $.ajax({
                url: './documents/invoices/invoiceAction.php',
                method: 'post',
                data: $(this).serialize(),
                success:function(response){
                    console.log(response);
                    $('#create-invoice').modal('hide');
                    $('#success-modal').modal('show');
                }
            });
            
        });

    });
    document.addEventListener("DOMContentLoaded", function() {
            var tabLinks = document.querySelectorAll('.tab-links a');
            var tabs = document.querySelectorAll(".tab");

            tabLinks.forEach(function(link) {
                link.addEventListener("click", function(e) {
                    e.preventDefault();
                    var currentAttrValue = this.getAttribute("href");
                    tabLinks.forEach(function(tab) {
                        tab.classList.remove("active");

                    });
                    tabs.forEach(function(tab) {
                        tab.classList.remove("active");
                    });

                    this.classList.add("active");
                    document.querySelector(currentAttrValue).classList.add("active");
                });
            });
        });
</script>
</html>