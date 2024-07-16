<?php
    include('classes/DB.php');
    include('classes/Login.php');

    $showTimeline = False;
    if (Login::isLoggedIn()) {
            $myusername = DB::query('SELECT username FROM users WHERE id=:userid', array(':userid'=>Login::isLoggedIn()))['0']['username'];

            $previnvnumber = DB::query('SELECT MAX(id) AS `col` FROM `invoices`')[0]['col'];
            $newinvoicenumber = "INV".$previnvnumber+1;

            $client_address = DB::query('SELECT `address` FROM clients WHERE name=:name', array(':name'=>$_GET['client']))['0']['address'];
            $client_contact = DB::query('SELECT `contact` FROM clients WHERE name=:name', array(':name'=>$_GET['client']))['0']['contact'];
            $client_rep = DB::query('SELECT `representative` FROM clients WHERE name=:name', array(':name'=>$_GET['client']))['0']['representative'];
            $client_credit = DB::query('SELECT `credit` FROM clients WHERE name=:name', array(':name'=>$_GET['client']))['0']['credit'];
            $client_inv_sum = DB::query('SELECT SUM(Amount) AS `sum` FROM `invoices` WHERE client = :client', array(':client'=>$_GET['client']))['0']['sum'];
            $client_balance = $client_credit - $client_inv_sum;
            if(!$client_rep) {
                $client_rep = "None";
            }
    }else{
        header('Location: ./login.php');
    }
?>

<html>
<?php
include('head.php');
?>
<body id="element-to-print">
    <?php include('./components/left-menu.php'); ?>
    <div class="container row main-body p-4">
        <section class="col-6">
            <section class="breadcrum d-flex align-items-center">
                <a class="back-button" href="./invoices.php"><i class="mdi mdi-arrow-left"></i></a>
                <p class="hanging-description">Invoices > Client</p>
            </section>
            
            <section class="header-sec mt-2">
                <h1><?php echo($_GET['client']); ?></h1>
                <article class="cards-row colored client-info d-flex">
                    <section class="card me-2">
                        <i class="mdi mdi-phone"></i>
                        <p><?php echo($client_contact); ?></p>
                    </section>
                    <section class="card me-2">
                        <i class="mdi mdi-map-marker"></i>
                        <p><?php echo($client_address); ?></p>
                    </section>
                    <section class="card">
                        <i class="mdi mdi-account-circle"></i>
                        <p><?php echo($client_rep); ?></p>
                    </section>
                </article> 
            </section>
            <div class="quickViewCards mt-2">
                <div class="card me-2">
                    
                    <div class="icon-area"><i class="mdi mdi-coin"></i></div>
                    <div class="info-area">
                        <span class="card-title">Balance</span>
                        <!-- <p class="hanging-description">Difference in the paid and due amounts</p> -->
                        <div class="price d-flex">
                            <h4 class="font-bold">R <?php echo($client_balance); ?></h4>
                            <span class="h4 greytext font-bold">.00</span>
                        </div>
                        
                    </div>
                </div>
                <div class="d-flex mt-2">
                    <div class="card height-10 card-btn me-2"  data-toggle="modal" data-target="#create-invoice">
                        <div class="icon-area"><i class="mdi mdi-plus"></i></div>
                        <div class="info-area">
                            <span class="card-name">New Invoice</span>
                            <p class="hanging-description">Generate New Invoice</p>
                        </div>
                    </div>
                    <div class="card height-10 card-btn text-white">
                        <div class="icon-area"><i class="mdi mdi-file"></i></div>
                        <div class="info-area">
                            <p class="card-name">Create Statement</p>
                            <p class="hanging-description text-grey">Generate a new statement</p>
                        </div>
                    </div>
                </div>
                <div class="card card-btn mt-2" >
                    <div class="icon-area"><i class="mdi mdi-coin"></i></div>
                    <div class="info-area">
                        <span class="card-title">Credit</span>
                        <p class="hanging-description">Record a payment made by <?php echo($_GET['client']); ?></p>
                        <div class="price d-flex">
                        </div>
                    </div>
                    <section class="form-area mt-2">
                        <form action="" method="post" class="d-flex" id="add-credit">
                            <input type="text" placeholder="R 0.00" class="form-control me-1">
                            <input type="button" value="Add" class="btn submit-btn">
                        </form>
                    </section>
                </div>
            </div>
        </section>

        <section class="col-6">
            <h2>Invoices</h2>
            <div class="nav-section table-nav pb-4">
                <nav class="nav-bar nav tabs">
                    <ul class="tab-links">
                        <li class="nav-item"><a class="nav-link active greytext" href="#tab1">Overdue</a></li>
                        <li class="nav-item"><a class="nav-link greytext" href="#tab2">All</a></li>
                    </ul>
                </nav>
            </div>
            <div class="action-bar nav mb-4">
                <a class="btn-primary btn me-2" data-toggle="modal" data-target="#create-invoice" href="#"><i class="mdi mdi-plus me-1" ></i>New</a>
                <button class="btn greytext me-2"><i class="mdi mdi-magnify me-1"></i>Search</button>
                <button class="btn greytext me-2"><i class="mdi mdi-filter-outline me-1"></i>filter</button>
                <button class="btn greytext me-2"><i class="fa fa-sort me-1"></i>sort</button>
            </div>

            <div class="table-type2 active container mb-4">
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
        </section>      
    </div>
    
    <?php include('./components/create-invoice-form.php'); ?>
    <?php include('./components/success-popup.php'); ?>
    <?php include('./components/loading-snackbar.php'); ?>
</body>
<script type="text/javascript" src="./js/jquery-3.3.1.min.js"></script>
<script src="./js/bootstrap.min.js"></script>
<script type="text/javascript" src="./js/features.js"></script>
<script type="module" src="./dataprovider/fetch-invoices.js"></script>
<script type="text/javascript" src="./features/create-invoice.js"></script>
<script type="module">
    $(document).ready( function() {

        //AUTO FILL CLIENT INFO ON INVOICE
        getInvoices(window.location.search);
        const clientDataForm = document.querySelectorAll('.bill-to input');
        clientDataForm[0].value = "<?php echo($_GET['client']); ?>" ;
        clientDataForm[1].value = "<?php echo($client_contact); ?>" ;
        clientDataForm[2].value = "<?php echo($client_address); ?>" ;

        $('#add-credit').submit(function(e){
            e.preventDefault();
            $.ajax({
                url: './backend/post-client-credit',
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
    
</script>
</html>