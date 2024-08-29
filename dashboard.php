<?php
    include('classes/DB.php');
    include('classes/Login.php');
    if (Login::isLoggedIn()) {
            $userid = Login::isLoggedIn();

            $myusername = DB::query('SELECT username FROM users WHERE id=:userid', array(':userid'=>Login::isLoggedIn()))['0']['username'];
            
            $previnvnumber = DB::query('SELECT MAX(id) AS `col` FROM `invoices`')[0]['col']+1;
            $newinvoicenumber = "INV".$previnvnumber;

            $dueArray = DB::query('SELECT Amount FROM invoices');
            $duebalance = 0;
            foreach($dueArray as $bal){
                $duebalance = $duebalance + $bal['Amount'];
            }
            $duebalance = number_format($duebalance, 2, '.', '');
            
            if(isset($_GET['mode'])){
                $main_bg = "linear-gradient(45deg, #10142e, #465581)";
                $left_menu_bg = "#26254e"; 
            }
    }else{
        header('Location: ./login.php');
    }
?>

<html>
    <?php 
        include('head.php');
    ?>
<body id="element-to-print" class="dashboard">
    <?php include('./components/left-menu.php'); ?>
    <div class="container main-body p-4" style="padding-left:2rem !important;">
        <div class="header-sec d-flex">
            <h1 class="mb-0">Welcome Back, <?php echo($myusername); ?></h1>
        </div>
        <p class="hanging-description mb-4">Manage Your Business & Your Employees At One Place</p>

        <div class="row">
            <div class="col-6">
                <div class="dashboard-item">
                    <div class="dash-header d-flex-space-between">
                        <h4>Sales Report</h4>
                        <select name="timeInterval" id="timeInterval" class="form-select" aria-label="Default select example" style="width:6rem;">
                            <option>Weekly</option>
                            <option>Monthly</option>
                            <option>Yearly</option>
                        </select>
                    </div>
                    <div class="key-section"></div>
                    <div class="graph-area w-100 my-2" style="height:230px;">
                        <canvas class="graph-section" id="pie-chart"></canvas>
                    </div>
                        
                </div>
            </div>
            <div class="col-3">
                <div class="dashboard-item">
                    <span class="fs-4 icon"><i class="fa-solid fa-bell"></i></span>
                    <p class="grey-text mt-2">Overdue Invoices</p>
                    <h4 class="mt-1">R<?php echo($duebalance);?></h4>
                    
                </div>
                <div class="dashboard-item">
                    <span class="fs-4 icon"><i class="fa-solid fa-circle-dollar-to-slot"></i></span>
                    <p class="grey-text mt-2">Today's Expenses</p>
                    <h4 class="mt-1">R<?php echo($duebalance);?></h4>
                </div>
            </div>
            <div class="col-3">
                <div class="dashboard-item">
                    <span class="fs-4 icon"><i class="fa-solid fa-bell"></i></span>
                    <p class="grey-text mt-2">Today's Income</p>
                    <h4 class="mt-1">R<?php echo($duebalance);?></h4>
                    
                </div>
                <div class="dashboard-item">
                    <span class="fs-4 icon"><i class="fa-solid fa-bell"></i></span>
                    <p class="grey-text mt-2">Debts to date</p>
                    <h4 class="mt-1">R<?php echo($duebalance);?></h4>
                </div>
                
            </div>
        </div>

        <div class="row pt-1">
            <div class="col">
                <div class="dashboard-item p-rel">
                    <div class="top-lmnt d-flex">
                        <div class="title-space">
                            <p class="hanging-description">Revenue</p>
                            <h4>R12,910</h4>
                        </div>
                        <div class="button-space">

                        </div>
                    </div>
                    <div class="graph-section" style="height:100px;width:210px;">
                        <canvas class="graph-history" id="rev-graph"></canvas>
                        <div class="graph-info">
                            <p><span><i class="fa-solid fa-arrow-up"></i></span>45%</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="dashboard-item p-rel">
                    <div class="top-lmnt d-flex">
                        <div class="title-space">
                            <p class="hanging-description">Revenue</p>
                            <h4>R12,910</h4>
                        </div>
                        <div class="button-space">

                        </div>
                    </div>
                    <div class="graph-section" style="height:100px;width:210px;">
                        <canvas class="graph-history" id="rev-graph-2"></canvas>
                        <div class="graph-info">
                            <p><span><i class="fa-solid fa-arrow-up"></i></span>45%</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="dashboard-item p-rel">
                    <div class="top-lmnt d-flex">
                        <div class="title-space">
                            <p class="hanging-description">Sales</p>
                            <h4>R12,910</h4>
                        </div>
                        <div class="button-space">

                        </div>
                    </div>
                    <div class="graph-section" style="height:100px;width:210px;">
                        <canvas class="graph-history" id="rev-graph-3"></canvas>
                        <div class="graph-info">
                            <p><span><i class="fa-solid fa-arrow-up"></i></span>45%</p>
                        </div>
                    </div>
                </div>
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
<script type="text/javascript" src="./js/features.js"></script>
<script src="./js/chart.js"></script>
<script>

    
    metricGet();

    //Set Aside Nav Menu Active Button
    const asideNavActiveBtn = document.querySelector("#link-to-dashboard");
        asideNavActiveBtn.classList.add("active");

    var ctx = document.getElementById('pie-chart').getContext('2d');
    var gfb = document.getElementById('rev-graph').getContext('2d');
    var histo = new Chart(gfb, {
        type: 'bar',
        data: {
            labels: ['mon', 'tue', 'wed', 'thu', 'fri'],
            datasets: [{
                data: [10, 20, 30, 54, 16, 20],
                backgroundColor: '#f6d047',
                borderColor: '#f6d047',
                borderRadius: 5,
                tension: 0.4,
                pointRadius: 0,
            },{
                data: [40, 3, 15, 23, 43, 18],
                backgroundColor: '#005361',
                borderRadius: 5,
                borderColor: '#005361',
                tension: 0.4,
                pointRadius: 0,
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y:{
                    display: false
                },
                x:{
                    grid:{
                        display:false
                    }
                }
            },
            plugins: {
                legend: {
                    display : false
                }
            }
        }
    });

    var jjk = document.getElementById('rev-graph-2').getContext('2d');
    var someOtherGraph = new Chart(jjk, {
        type: 'bar',
        data: {
            labels: ['mon', 'tue', 'wed', 'thu', 'fri'],
            datasets: [{
                data: [10, 20, 30, 54, 16, 20],
                backgroundColor: '#f6d047',
                borderColor: '#f6d047',
                borderRadius: 5,
                tension: 0.4,
                pointRadius: 0,
            },{
                data: [40, 3, 15, 23, 43, 18],
                backgroundColor: '#005361',
                borderRadius: 5,
                borderColor: '#005361',
                tension: 0.4,
                pointRadius: 0,
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y:{
                    display: false
                },
                x:{
                    grid:{
                        display:false
                    }
                }
            },
            plugins: {
                legend: {
                    display : false
                }
            }
        }
    });

    var myPieChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['mon', 'tue', 'wed', 'thu', 'fri', 'sat'],
            datasets: [{
                label: 'Daily Sales',
                data: [10, 20, 30, 54, 16, 20, 5],
                backgroundColor: '#f6d047',
                borderColor: '#f6d047',
                tension: 0.4,
                pointRadius: 0,
            },{
                label: 'Daily Expenses',
                data: [40, 3, 15, 23, 43, 18, 35],
                backgroundColor: '#005361',
                borderColor: '#005361',
                tension: 0.4,
                pointRadius: 0,
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y:{
                    grid:{
                        display: false
                    }
                }
            },
            plugins: {
                legend: {
                    labels: {
                        usePointStyle: true
                    }
                }
            }
        }
    });
</script>
</html>