function getOrderSummary() {
    fetch('./api/orders')
    .then(response => response.json())
    .then(data => {
        let output = '';
        var before = ["DATE", 99];
        var dayOrders = [];
        data.forEach(function(order){
            ///DATA PROCESSING
            ///ROLLS -------> NUMBER OF SALES
            ///BrownBread --> INVOICE INCOME
            ///WhiteBread --> CASH    INCOME
            ///Softis ------> CARD    INCOME

            if(before[0] == order.Date){
                var newAmount = parseInt(order.Amount) + before[1];
                dayOrders[dayOrders.length - 1].Amount = newAmount;

                dayOrders[dayOrders.length - 1].Rolls =dayOrders[dayOrders.length -1].Rolls + parseInt(order.BrownBread)+parseInt(order.WhiteBread)+parseInt(order.Rolls)+parseInt(order.Softis)+parseInt(order.BurgerBuns);

                if(order.Payment == "Invoice"){
                    dayOrders[dayOrders.length - 1].BrownBread = dayOrders[dayOrders.length - 1].BrownBread  + parseInt(order.Amount);
                }else{
                    if(order.Payment == "Cash"){
                        dayOrders[dayOrders.length - 1].WhiteBread += parseInt(order.Amount);
                    }else {
                        if(order.Payment == "Card"){
                            dayOrders[dayOrders.length - 1].Softis += parseInt(order.Amount);
                        }
                    }
                }
            }else{
                before[0] = order.Date;
                before[1]= parseInt(order.Amount);

                order.Rolls = parseInt(order.BrownBread)+parseInt(order.WhiteBread)+parseInt(order.Rolls)+parseInt(order.Softis)+parseInt(order.BurgerBuns);
                order.Date = fixDate(order.Date);

                if(order.Payment == "Invoice"){
                    order.BrownBread = parseInt(order.Amount);
                    order.WhiteBread = 0;
                    order.Softis = 0;
                }else{
                    if(order.Payment == "Cash"){
                        order.BrownBread = 0;
                        order.WhiteBread = parseInt(order.Amount);
                        order.Softis = 0;
                    }else {
                        if(order.Payment == "Card"){
                            order.BrownBread = 0;
                            order.WhiteBread = 0;
                            order.Softis = parseInt(order.Amount);
                        }
                    }
                }
                dayOrders.push(order);
            }
        });
        dayOrders.forEach(function(order){
            ////DISPLAYING DATA
            output += `
                <div class="single-table-row px-2 row" id="${order.id}">
                    <div class="col-2">${order.Date}</div>
                    <div class="col-2">${order.Rolls}</div>
                    <div class="col-2">${order.WhiteBread}</div>
                    <div class="col-3">${order.Softis}</div>
                    <div class="col-2">${order.BrownBread}</div>
                    <div class="col-1 font-medium primary-grey">R${order.Amount}</div>
                </div>
            `;
        });

        document.getElementById('table-list').innerHTML = output;
    })
    .catch(err => console.log(err))
}

getOrderSummary();