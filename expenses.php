<?php
    include('classes/DB.php');
    include('classes/Login.php');

    $showTimeline = False;
    if (Login::isLoggedIn()) {

            $myusername = DB::query('SELECT username FROM users WHERE id=:userid', array(':userid'=>Login::isLoggedIn()))['0']['username'];
            
    }else{
        header('Location: ./login.php');

    }
?>

<html>
<head>
    <title>BotsBakers - Invoices</title>
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
    <link href="../dist/css/icons/fontawesome6/css/fontawesome.css" rel="stylesheet">
    <link href="../dist/css/icons/fontawesome6/css/brands.css" rel="stylesheet">
    <link href="../dist/css/icons/fontawesome6/css/solid.css" rel="stylesheet">
    <?php
    if(isset($_GET['mode'])){
        if($_GET['mode']== "dark"){
            echo'<link rel="stylesheet" type="text/css" href="./css/darkModeStyles.css">';
        }else{
            echo'<link rel="stylesheet" type="text/css" href="./css/styles.css">';
        }
    }else{
        echo'<link rel="stylesheet" type="text/css" href="./css/styles.css">';
    }
    ?>
    <link rel="stylesheet" type="text/css" href="./css/font-awesome.min.css">
</head>
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
    <div class="left-menu">
        <h2 class="p-4 pb-0 text-white">BotsBakers</h2>
        <p class="hanging-description px-4 pb-4 primary-grey">Admin & Management System</p>
        <ul class="left-menu-nav px-4">
            <li><a class="btn" href="./dashboard.php"><i class="mdi mdi-chart-line me-3"></i> Dashboard</a></li>
            <li><a class="btn" href="./orders.php"><i class="mdi me-3 mdi-cart"></i> Orders</a></li>
            <li><a class="btn" href="./invoicepage.php"><i class="mdi me-3 mdi-cash-multiple"></i> Invoices</a></li>
            <li><a class="btn" href="./debts.php"><i class="mdi me-3 mdi-receipt"></i> Debts</a></li>
            <li><a class="btn active"><i class="mdi me-3 mdi-receipt"></i> Expenses</a></li>
            <li class="bottom-divider"><a class="btn" href="#"><i class="mdi me-3 mdi-account-card-details"></i> Human Resourses</a></li>
            <li><a class="btn" href="#"><i class="fa me-3 fa-cog"></i> System Settings</a></li>
        </ul>
    </div>
    <div class="container main-body p-4">
        <div class="header-sec d-flex">
            <h1>Expenses</h1>
            <form class="search my-auto">
                <input type="text" name="Search" placeholder="Search">
            </form>
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
                            <h4 class="font-bold">R2,580</h4>
                            <span class="h4 greytext font-bold">.56</span>
                        </div>
                        
                    </div>
                </div>
                <div class="card me-3">
                    <div class="icon-area"><i class="mdi mdi-bell-outline"></i></div>
                    <div class="info-area">
                        <span class="card-name">Amount Due</span>
                        <p class="hanging-description">Total amount yet to be processed from clients</p>
                        <h4 class="font-bold">R<?php echo($duebalance); ?></h4>
                    </div>
                </div>
                <div class="card me-3">
                    <div class="icon-area"><i class="mdi mdi-coin"></i></div>
                    <div class="info-area">
                        <span class="card-name">Amount Paid</span>
                        <p class="hanging-description text-grey">Total amount processed from invoices</p>
                        <h4 class="font-bold">R14,300.00</h4>
                    </div>
                </div>
            </div>
        </div>

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
            <a class="btn-primary btn me-2" data-toggle="modal" data-target="#create-invoice" href="#"><i class="mdi mdi-plus me-1" ></i>New</a>
            <button class="btn greytext me-2"><i class="mdi mdi-magnify me-1"></i>Search</button>
            <button class="btn greytext me-2"><i class="mdi mdi-filter-outline me-1"></i>filter</button>
            <button class="btn greytext me-2"><i class="fa fa-sort me-1"></i>sort</button>
        </div>

        <div class="table-type2 container mb-4">
            <div class="table-head-row p-2 row">
                <div class="col-1">
                    <div class="form-check">
					    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            All
                        </label>
			  		</div>
                </div>
                <div class="col-2">Invoice</div>
                <div class="col-2">Date</div>
                <div class="col-3">Client</div>
                <div class="col-1">Amount</div>
                <div class="col-2">Status</div>
                <div class="col-1">Action</div>
            </div>
            <div id="invoice-list">

            </div>
            

        </div>
    </div>
    
    <div class="modal fade" tabindex="-1" id="create-invoice">
        <form action="#" method="POST" id="addinvoice" class="modal-dialog" role="document" style="max-width: 800px;">
            <div class="modal-content" style="border-radius: 1.5rem;">
                <div class="modal-header modal-header-dark p-2">
                    <div class="new-header text-center text-white w-100">
                        <h2 class="m-0">New Invoice</h2>
                    </div>
                </div>
                <div class="modal-body px-4">
                    
                    <div class="invoice-tab">

                        <div class="row pt-3">
                            <div class="col-8">
                                <div class="bill-header pb-2 row p-rel">
                                    <div class="col-5"><p class="font-bold">Description</p></div>
                                    <div class="col-3"><p class="font-bold">Unit Price</p></div>
                                    <div class="col-2"><p class="font-bold">Qty</p></div>
                                    <div class="col-2 text-right"><p class="font-bold">Amount</p></div>
                                </div>
                                <div class="items form-group py-2 p-rel" id="invoice-items">
                                    <div class="item p-rel py-1 row">
                                        <div class="col-5">
                                            <select class="form-control" onchange="unitPriceChange(this)" name="product[]">
                                                <option>Select Product</option>
                                                <option>BrownBread</option>
                                                <option>WhiteBread</option>
                                                <option>Rolls</option>
                                                <option>Softis</option>
                                                <option>BurgerBuns</option>
                                            </select>
                                        </div>
                                        <div class="col-3 d-flex-y-center">
                                            <p data-item="unitcost">0.00</p>
                                            <input type="number" name="unitcost[]" class="form-control d-none nobtns p-0 text-right" style="width:3rem;height:2rem;">
                                        </div>
                                        <div class="col-2">
                                            <input type="number" oninput="lineTotalValue(this)" placeholder="Qty" class="form-control w-5rem qty" name="qty[]" min="0">
                                        </div>
                                        <div class="col-2 justify-end d-flex-y-center">
                                            <p data-info="line-total" class="line-total">0.00</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="button-area d-flex">
                                    <a href="#" id="add-invoice-item" class="add-line text-center w-100 p-2 text-grey"><i class="fa fa-plus me-2"></i>Add a line</a>
                                </div>                                
                                <div class="totals pt-4">
                                    <div class="subtotal-area bottom-divider">
                                        <p class="font-medium py-2">Subtotal <span id="subtotal">0.00</span></p>
                                        <a href="">Add discount</a>
                                        <p class="font-medium py-2">Tax <span>0.00</span></p>
                                    </div>
                                    <div class="total-area bottom-divider">
                                        <p class="font-medium py-2">Total <input class="form-control nobtns p-0 text-right" name="invoice-total" type="number" id="invoice-total" value="0.00" step="0.01"></p>

                                        <p class="font-medium py-2">Amount Paid 
                                            <span><input type="number" oninput="lineTotalsSum()" id="paidOffAmount" name="paid" class="form-control nobtns p-0 text-right" value="0.00" step="0.01" style="width:3rem;height:2rem;"></span>
                                        </p>
                                    </div>
                                    <div class="total-area">
                                        <p class="font-bold py-2">Amount Due <span id="dueAmount">R0.00</span></p>
                                    </div>
                                </div>
                                <div class="extra-info mt-4">
                                    <p class="font-medium">Terms</p>
                                    <p class="greytext">[Enter terms and conditions. Lorem ipsum dolor]</p>
                                </div>
                            </div>
                            <div class="col-4 text-end p-rel right-side">
                                <div class="right-main">
                                    <p class="font-medium">Amount Due</p>
                                    <p class="font-bold fs-2">R<span id="dueAmountHeader">0.00</span></p>
                                </div>
                                <div class="bill-to mt-4">
                                    <p class="font-medium">Billed to:</p>
                                    <input type="text" style="height:2rem;" name="client" class="form-control" placeholder="[Client name]">
                                    <input type="text" style="height:2rem;" name="contact" class="form-control" placeholder="[Contact #]">
                                    <input type="text" style="height:2rem;" name="address1" class="form-control" placeholder="[address Line 1]">
                                    <input type="text" style="height:2rem;" name="address2" class="form-control" placeholder="[address Line 2]">
                                    <input type="text" style="height:2rem;" name="address3" class="form-control" placeholder="[Optional Line 3]">
                                    
                                </div>
                                <div class="more-info">
                                    <p class="font-bold mt-4">Invoice Number</p>
                                    <p><?php echo $newinvoicenumber; ?></p>
                                    <p class="font-bold mt-4">Date Of Issue</p>
                                    <p id="todayDate">[dd/mm/yyyy]</p>
                                    <p class="font-bold mt-4">Due Date</p>
                                    <input type="date" name="due">
                                </div>
                            </div>   
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" id="invoicebtn">New</button>
                </div>
            </div>
        </form>
    </div>

    <div id="success-modal" class="modal fade" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="border-radius:20px;width:450px;">
                <div class="modal-header">
                    <div class="icon-area"><i class="fa fa-check"></i></div>
                    <h2 class="mt-2">Success!</h2>
                </div>
                <div class="modal-body text-center">
                    <p>A new invoice has been successfully created.<br> Check the file directory for an excel file of this invoice.<br> The order has also been added in the database.</p>
                </div>
                <div class="modal-footer">
                    <button class="btn">Ok</button>
                </div>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript" src="./js/jquery-3.3.1.min.js"></script>
<script src="./js/bootstrap.min.js"></script>
<script type="text/javascript" src="./dist/html2pdf.bundle.min.js"></script>
<script type="text/javascript" src="./js/features.js"></script>
<script type="text/javascript" src="./js/push.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        getInvoices();
        //ajax ish
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
</script>
</html>