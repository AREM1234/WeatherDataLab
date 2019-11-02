
var sortParams = [];
var sortOrders = [];
var filterParams = [];
window.onload = initAll();



	function initAll(){

		var searchButton = document.getElementById("search");
		var dateBtn = document.getElementById("dateBtn");
		var maxTempBtn = document.getElementById("maxTempBtn");
		var minTempBtn = document.getElementById("minTempBtn");
		var averageTempBtn = document.getElementById("averageTempBtn");
		var avWindSpeedBtn = document.getElementById("avWindSpeedBtn");
		var precipitationBtn = document.getElementById("precipitationBtn");
		var clearBtn = document.getElementById("clear");

		searchButton.onclick = function(){
			SearchData();
		} 

		dateBtn.onclick = function(){
			AddSortFilter('Date');
			SearchData();
		}

		maxTempBtn.onclick = function(){
			AddSortFilter('MaxTemp');
			SearchData();
		}

		minTempBtn.onclick = function(){
			AddSortFilter('MinTemp');
			SearchData();
		}

		averageTempBtn.onclick = function(){
			AddSortFilter('AverageTemp');
			SearchData();
		}

		avWindSpeedBtn.onclick = function(){
			AddSortFilter('AverageWindSpeed');
			SearchData();
		}

		precipitationBtn.onclick = function(){
			AddSortFilter('Precipitation');
			SearchData();
		}


		clearBtn.onclick = function(){
			sortParams = [];
			sortOrders = [];
			var icons = document.getElementsByClassName('material-icons');
			for(var j = 0; j < icons.length; j++){
				icons[j].innerHTML = "";
			}
			SearchData();
		}

		getData();

	}

	function AddSortFilter(Type){

		var icon = document.getElementById(Type + "Icon");
		if(checkArray(sortParams, Type)){
			var index = sortParams.indexOf('"'+Type+'"');
			if(sortOrders[index] == '"ASC"'){
				icon.innerHTML = "arrow_drop_down";
				sortOrders[index]='"DESC"';
			}
			else if(sortOrders[index] == '"DESC"'){
				icon.innerHTML = "arrow_drop_up";
				sortOrders[index]='"ASC"';
			}
		}
		else{
			sortParams.push('"' + Type + '"');
			icon.innerHTML = "arrow_drop_up";
			sortOrders.push('"ASC"');
		}	

	}

	function checkArray(array, value){
		for(var i = 0; i < array.length; i++){
			if(array[i] == '"' + value + '"'){
				return true;
			}
		}
		return false;
	}

	function SearchData(){

		var City = document.getElementById("CitySearch").value;
		var State = document.getElementById("StateSearch").value;
		var aDate = document.getElementById("DateSearch").value;		

		if(filterParams.length > 0){
			filterParams[1] = '"'+City+'"';
			filterParams[3] = '"'+State+'"';
			filterParams[5] = '"'+aDate+'"';
		}
		else{
			filterParams.push('"CityName"', '"'+City+'"');
			filterParams.push('"StateName"', '"'+State+'"');
			filterParams.push('"Date"', '"'+aDate+'"');
		}


		getData();

	}

	function getData(){

		var aCondition = document.getElementById("ConditionSearch").value;
		JSON.stringify(sortParams);
		JSON.stringify(sortOrders);
		JSON.stringify(filterParams);

		if(window.XMLHttpRequest){
			var xmlhttp = new XMLHttpRequest();
		}
		else{
			var xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
    	
    	xmlhttp.onreadystatechange = function() {
    				
    		if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
    			
    			//window.alert(xmlhttp.responseText);
    			document.getElementById("tableBody").innerHTML = xmlhttp.responseText;
    					
    		}

    	}

    	xmlhttp.open("GET", "Models/getWeather.php?filterParams=[" + filterParams + "]&sortParams=[" +  sortParams + "]&sortOrders=[" 
    					+  sortOrders + "]&conditionFilters=" + aCondition, true);

    	xmlhttp.send();

	}


