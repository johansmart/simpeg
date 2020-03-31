var t, day, minute, second;
window.onload =function() {

	var sec =document.getElementById('the-time2');
	sec.timer =setInterval(function(){jam_in()},1000);
	
	var sec =document.getElementById('the-time3');
	sec.timer =setInterval(function(){jamout()},1000);
}


function jam_in(){
	if(t != null) t=null;
	t = new Date();
	hour = t.getHours(); // Jumlah jam (0-23)
	minute = t.getMinutes(); // Jumlah menit (0-59)
	second = t.getSeconds(); // Jumlah detik (0-59)
	daynumber = t.getDay();
	monthnumber = t.getMonth(); // Jumlah bulan (0-11)
	monthday = t.getDate(); // Hari dari bulan (0-31)
	year = t.getFullYear();
	//jam
	if(hour < 10) hour ='0'+hour;
	if(minute < 10) minute ='0'+minute;
	if(second < 10) second ='0'+second;
	//hari
	hari = getTheDay(daynumber);
	//bulan
	bulan = getTheMonth(monthnumber);
	
	document.getElementById('the-time2').innerHTML=hour+':'+minute+':'+second;


}

function jamout(){
	if(t != null) t=null;
	t = new Date();
	hour = t.getHours(); // Jumlah jam (0-23)
	minute = t.getMinutes(); // Jumlah menit (0-59)
	second = t.getSeconds(); // Jumlah detik (0-59)
	daynumber = t.getDay();
	monthnumber = t.getMonth(); // Jumlah bulan (0-11)
	monthday = t.getDate(); // Hari dari bulan (0-31)
	year = t.getFullYear();
	//jam
	if(hour < 10) hour ='0'+hour;
	if(minute < 10) minute ='0'+minute;
	if(second < 10) second ='0'+second;
	//hari
	hari = getTheDay(daynumber);
	//bulan
	bulan = getTheMonth(monthnumber);
	
	document.getElementById('the-time3').innerHTML=hour+':'+minute+':'+second;

}


