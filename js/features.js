function amountDue(total){
	due = total - parseFloat(document.querySelector("#paidOffAmount").value);
	document.querySelector("#dueAmount").innerText = due.toFixed(2);
	document.querySelector("#dueAmountHeader").innerText = due.toFixed(2);
}

function lineTotalsSum(){
	var targets = document.querySelectorAll('.line-total');
	let sum = 0;
	for (var i = targets.length - 1; i >= 0; i--) {
		sum += parseFloat(targets[i].innerText);
	}
	document.querySelector('#subtotal').innerText = sum.toFixed(2);
	document.querySelector('#invoice-total').value = sum.toFixed(2);
	amountDue(sum.toFixed(2));
}


function lineTotalValue(q){
	var unitprice = q.parentElement.parentElement.children[1].children[0].innerText;
	var lt = unitprice * q.value
	q.parentElement.parentElement.children[3].children[0].innerText = lt.toFixed(2);
	lineTotalsSum();
};

/////DYNAMIC FORM

const addButton = document.querySelector('#add-invoice-item');
const itemParent = document.querySelector('#invoice-items');

addButton.addEventListener('click',() => {
	const cover = document.createElement("div");
	cover.className = "item row p-rel py-1 mt-1";

	const cover2 = document.createElement("div");
	cover2.className = "col-5";

	const selectbody = document.createElement("select");
	selectbody.setAttribute("onchange",  'unitPriceChange(this)');
	selectbody.className = "form-control";
	selectbody.setAttribute("name", 'product[]')

	const option1 = document.createElement("option");
	option1.innerText = "Select Product";
	const option2 = document.createElement("option");
	option2.innerText = "BrownBread";
	const option3 = document.createElement("option");
	option3.innerText = "WhiteBread";
	const option4 = document.createElement("option");
	option4.innerText = "Rolls";
	const option5 = document.createElement("option");
	option5.innerText = "Softis";
	const option6 = document.createElement("option");
	option6.innerText = "BurgerBuns";
	selectbody.appendChild(option1);
	selectbody.appendChild(option2);
	selectbody.appendChild(option3);
	selectbody.appendChild(option4);
	selectbody.appendChild(option5);
	selectbody.appendChild(option6);

	const lmnt2 = document.createElement("p");
	lmnt2.innerText= "0";
	
	const extralmnt = document.createElement('input');
	extralmnt.type = "number";
	extralmnt.className = "form-control d-none nobtns p-0 text-right";
	extralmnt.style = "width:3rem;height:2rem;";
	extralmnt.setAttribute("name", "unitcost[]");

	const lmnt3 = document.createElement('input');
	lmnt3.type = "number";
	lmnt3.placeholder = "Qty";
	lmnt3.className = "form-control w-5rem qty";
	lmnt3.setAttribute("oninput", 'lineTotalValue(this)');
	lmnt3.setAttribute("name", 'qty[]');
	lmnt3.setAttribute("min", '0');

	const lmnt4 = document.createElement("p");
	lmnt4.className ="line-total";
	lmnt4.innerText = "fourth";

	const cover3 = document.createElement("div");
	cover3.className = "col-3 d-flex-y-center";

	const cover4 = document.createElement("div");
	cover4.className = "col-2";

	const cover5 = document.createElement("div");
	cover5.className = "col-2 justify-end d-flex-y-center";

	itemParent.appendChild(cover);
	cover.appendChild(cover2);
	cover2.appendChild(selectbody);
	cover.appendChild(cover3);
	cover3.appendChild(lmnt2);
	cover3.appendChild(extralmnt);
	cover.appendChild(cover4);
	cover4.appendChild(lmnt3)
	cover.appendChild(cover5);
	cover5.appendChild(lmnt4);
}); 

///UNIT COSTS

function unitPriceChange(choice){
	let unitvalue;
	
	if(choice.value == "BrownBread"){
		choice.parentElement.parentElement.children[1].children[0].innerText = "9.00";
		unitvalue = 9;
	}else if(choice.value == "WhiteBread"){
		choice.parentElement.parentElement.children[1].children[0].innerText = "10.00";
		unitvalue = 10;
	}else if(choice.value == "Rolls"){
		choice.parentElement.parentElement.children[1].children[0].innerText = "13.00";
		unitvalue = 13;
	}else if(choice.value == "Softis"){
		choice.parentElement.parentElement.children[1].children[0].innerText = "17.00";
		unitvalue = 17;
	}else if(choice.value == "BurgerBuns"){
		choice.parentElement.parentElement.children[1].children[0].innerText = "13.00";
		unitvalue = 13;
	}else {
		choice.parentElement.parentElement.children[1].children[0].innerText = "1.00";
		unitvalue = 1;
	};

	choice.parentElement.parentElement.children[1].children[1].value = unitvalue.toFixed(2);
	choice.parentElement.parentElement.children[3].children[0].innerText = unitvalue * choice.parentElement.parentElement.children[2].children[0].value + ".00";
	
	lineTotalsSum();
};

const today = new Date();
const month = today.getMonth() + 1;
document.querySelector('#todayDate').innerText = today.getDate() + '/' + month + '/' + today.getFullYear();


function metricGet() {
    fetch('./api/metric')
    .then(response => response.json())
    .then(data => {
        let output = [];
		let myitems = [];
        data.forEach(function(pitem){
            output.push(parseFloat(pitem.unitsSold));
			myitems.push(pitem.item);
        });
			/*console.log(output, myitems); */
		var opo = document.getElementById('rev-graph-3').getContext('2d');
		var someOtherOGraph = new Chart(opo, {
			type: 'doughnut',
			options: {
				responsive: true,
				maintainAspectRatio: false,
				scales: {
					y:{
						display: false
					},
					x:{
						display: false
					}
				},
				plugins: {
					legend: {
						display : false
					}
				}
			},
			
			data: {
				labels: myitems,
				datasets: [{
					data: output,
					backgroundColor: ['#f6d047', '#005361', '#6b84ff','#008194', '#c66bff'],
					borderColor: '#fff',
					tension: 0.4,
					pointRadius: 0,
				}],
			}
		});
    })
    .catch(err => console.log(err))
	
}