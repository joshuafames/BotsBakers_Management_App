import { fixDate, convertNumToName } from "../js/fix-date.js";

export function getInvoices(client="") {
    fetch('./backend/get-invoices'+client)
    .then(response => response.json())
    .then(data => {
        let output = '';
        let inv_balance = 0;
        data.forEach(function(invoice){
            inv_balance += invoice.Amount;
			let inv_status = "";
			if(invoice.Amount - invoice.Amount_Paid == 0){
				inv_status = "paid";
			}else{
				inv_status = "pending";
			}
			let formatted_date = fixDate(invoice.Date_Issued);
            output += `
            <div class="single-table-row px-2 row">
                <div class="table-col col-2">INV${invoice.id}</div>
                <div class="table-col col-2">${formatted_date}</div>
                <div class="table-col col-3 greytext">${invoice.Client}</div>
                <div class="table-col col-2">R${invoice.Amount}</div>
                <div class="table-col col-3"><span class="status-${inv_status}">${inv_status}</span></div> 
            </div>
            `;
        });
        document.getElementById('invoice-list').innerHTML = output;
        // document.getElementById('inv_balance').innerText += inv_balance;
    })
    .catch(err => console.log(err))
}

window.getInvoices = getInvoices;

///REQUIRE : A Section with id=invoice-list
///REQUIRE : A p/h4    with id=inv_balance