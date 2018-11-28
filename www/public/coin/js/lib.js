function number_format(number, decimals, decPoint, thousandsSep){
	decimals = decimals || 0;
	number = parseFloat(number);

	if(!decPoint || !thousandsSep){
		decPoint = '.';
		thousandsSep = ',';
	}

	var roundedNumber = Math.round( Math.abs( number ) * ('1e' + decimals) ) + '';
	var numbersString = decimals ? roundedNumber.slice(0, decimals * -1) : roundedNumber;
	var decimalsString = decimals ? roundedNumber.slice(decimals * -1) : '';
	var formattedNumber = "";

	while(numbersString.length > 3){
		formattedNumber += thousandsSep + numbersString.slice(-3)
		numbersString = numbersString.slice(0,-3);
	}

	return (number < 0 ? '-' : '') + numbersString + formattedNumber + (decimalsString ? (decPoint + decimalsString) : '');
}
// //english format
// number_format( 1234.50, 2, '.', ',' ); // ~> "1,234.50"

// //german format
// number_format( 1234.50, 2, ',', '.' ); // ~> "1.234,50"

// //french format
// number_format( 1234.50, 2, '.', ' ' ); // ~> "1 234.50"

// unix timestamp to date
function con_date(str){
    var ret=new Date(str*1000).format("yyyy-MM-dd hh:mm:ss");
    // var str=new Date(str*1000);
    return ret;
}

// get unix timestamp
function get_current_ts(){
    var ret= Math.floor(new Date().getTime()/1000);
    return ret;
}
// get unix timestamp
function get_current_ts_msec(){
    var ret= Math.floor(new Date().getTime());
    return ret;
}

Date.prototype.format = function(f) {
    if (!this.valueOf()) return " ";

    var weekName = ["일요일", "월요일", "화요일", "수요일", "목요일", "금요일", "토요일"];
    var d = this;

    return f.replace(/(yyyy|yy|MM|dd|E|hh|mm|ss|a\/p)/gi, function($1) {
        switch ($1) {
            case "yyyy": return d.getFullYear();
            case "yy": return (d.getFullYear() % 1000).zf(2);
            case "MM": return (d.getMonth() + 1).zf(2);
            case "dd": return d.getDate().zf(2);
            case "E": return weekName[d.getDay()];
            case "HH": return d.getHours().zf(2);
            case "hh": return ((h = d.getHours() % 12) ? h : 12).zf(2);
            case "mm": return d.getMinutes().zf(2);
            case "ss": return d.getSeconds().zf(2);
            case "a/p": return d.getHours() < 12 ? "오전" : "오후";
            default: return $1;
        }
    });
};

String.prototype.string = function(len){var s = '', i = 0; while (i++ < len) { s += this; } return s;};
String.prototype.zf = function(len){return "0".string(len - this.length) + this;};
Number.prototype.zf = function(len){return this.toString().zf(len);};



function numberWithCommas(x) {
	var num=x.toString();
	if(num.indexOf(".") != -1) {
		var numString = num.split('.');

		var dollars = numString[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
		var cents = numString[1];

		var str = [dollars, cents].join('.');

		return str;
	}
	else {
		return num.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	}

	///\B(?=(\d{3})+(?!\d))/g, ","
}


function leadingZeros(n, digits) {
	var zero = '';
	n = n.toString();

	if (n.length < digits) {
		for (i = 0; i < digits - n.length; i++)
			zero += '0';
	}
	return zero + n;
}