export function convertNumToName(mon){
	if(mon == 1){mon = "Jan";}else{
		if(mon == 2){mon = "Feb";}else{
			if(mon == 3){mon = "Mar";}else{
				if(mon == 4){mon = "Apr";}else{
					if(mon == 5){mon = "May";}else{
						if(mon == 6){mon = "Jun";}else{
							if(mon == 7){mon = "Jul";}else{
								if(mon == 8){mon = "Aug";}else{
									if(mon == 9){mon = "Sep";}else{
										if(mon == 10){mon = "Oct";}else{
											if(mon == 11){mon = "Nov";}else{
												if(mon == 12){mon = "Dec";}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}
	return mon;
}

export function fixDate(e) {
	var yr = "";
	var mon = "";
	var dae = "";
	
	for (let i = 0; i < 10; i++) {
		if(i!=4){
			if(i!=7){
				if (i<4) {
					yr = yr + e[i];
				}else{
					if(i<7){
						mon = mon + e[i];
					}else{
						dae = dae + e[i];
					}
				}
			}
		}	
	}
	mon = convertNumToName(mon);
	var therightdate = dae + " " + mon + " " + yr;
	return therightdate;
};