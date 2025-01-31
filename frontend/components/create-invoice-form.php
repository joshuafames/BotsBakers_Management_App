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