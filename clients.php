<?php
    include('classes/DB.php');
    include('classes/Login.php');

    $showTimeline = False;
    if (Login::isLoggedIn()) {

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
    <?php include('./components/left-menu.php'); ?>
    <div class="container main-body p-4">
        <div class="header-sec d-flex">
            <h1>Clients</h1>
        </div>
        <p class="hanging-description mb-4">Find and manage all your clients</p>

        <div class="action-bar nav mb-4">
            <a class="btn-primary btn me-2" data-toggle="modal" data-target="#create-invoice" href="#"><i class="mdi mdi-plus me-1" ></i>New</a>
            <button class="btn greytext me-2"><i class="mdi mdi-magnify me-1"></i>Search</button>
            <button class="btn greytext me-2"><i class="mdi mdi-filter-outline me-1"></i>filter</button>
            <button class="btn greytext me-2"><i class="fa fa-sort me-1"></i>sort</button>
        </div>

        <div class="clients table-type2">
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
        const asideNavActiveBtn = document.querySelector("#link-to-clients");
        asideNavActiveBtn.classList.add("active"); 

        // Load clients and then run the manipulation function
        getClients("", () => {
            const linksToSingleClient = document.querySelectorAll(".single-client-table-row");
        
            linksToSingleClient.forEach(element => {
                element.attributes['href'].nodeValue += "&&prev=clients";
            });
            console.log(linksToSingleClient);
        });
    });
</script>
</html>