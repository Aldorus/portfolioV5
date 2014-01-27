var allCategorieSelected = true;

//color : 630561,  5A007A, 5A007A, 310563, 1C067A

function isEmpty(StringToCheck)
{
	//first remove all spaces using the following regex
	StringToCheck= StringToCheck.replace(/^\s+|\s+$/, '');

	//then we check for the length of the string if its 0 or not
	if( StringToCheck.length==0){
		return true;
	}
	return false;
}

$(function() {
	moovableHeader();
	dynamicBox();
	charts();
});

function moovableHeader(){
	$('#headerBar').mouseover(function(){
		$(this).stop().animate({
			top : 0
		},400);
	}).mouseout(function(){
		$(this).stop().animate({
			top : -100
		},400);
	});
}

function dynamicBox(){
	$('.box').mouseover(function(){
		$(this).children("p").children("strong").stop().animate({
			color:'#5A007A'
		},650);	


	}).mouseout(function(){
		$(this).children("p").children("strong").stop().animate({
			color:'#565656'
		},650);

	});
	
	$("#clickContactTable").mouseover(function(){
		$(this).stop().animate({
			backgroundColor:'#AD9C11',
			color:'white'
		},400);
		
	}).mouseout(function(){
		$(this).stop().animate({
			backgroundColor:'#CABF6C',
			color:'#5f5f5f'
		},400);
		
	});
}

function charts(){
	$.ajax({
		url : "/listAllSkills",
		dataType: "json",
		type: "GET"
		
	}).done(function(datas) {
		displaySkill(datas);
	});
}

function displaySkill(datas){
	
	var dataSource = [];
	for ( var data in datas) {
		dataSource.push({
				breed : datas[data].label,
				count : datas[data].coef,
		});
	}
	
	var chart = $("#chartContainer").dxChart({
		dataSource: dataSource,
		palette: ['#310563'],
		rotated: true,
		commonSeriesSettings: {
			argumentField: "breed",
			type: "bar"
		},
		valueAxis: {
			min: 0,
			max: 9,
			maxValueMargin:0.15
		},
		series: {
			valueField: "count",	argumentField:"breed"		
		},
		size:{
			height:600
		},
		legend: {
			visible: false,     
		},
	}).dxChart("instance");
}

function checkCategorie(input, check){
	if(check){
		if(allCategorieSelected){
			$(":input[type='checkbox']").attr('checked',false);
			allCategorieSelected = false;
			$(".littreProjet").hide();
			
		}
		
		if($(input).parent().children("input").attr('checked')){
			$(input).parent().children("input").attr('checked',false);
			//récuperation du type
			var type= $(input).parent().children("input").attr('value');
			$(".categorie"+type).hide();
			
		}else{
			$(input).parent().children("input").attr('checked',true);
			//récuperation du type
			var type= $(input).parent().children("input").attr('value');
			$(".categorie"+type).show();
			
		}	
	}else{
		if(allCategorieSelected){
			
			$(":input[type='checkbox']").attr('checked',false);
			allCategorieSelected = false;
			$(".littreProjet").hide();
			$(input).parent().children("input").attr('checked',true);
		}
		
		if(!$(input).parent().children("input").attr('checked')){
			//récuperation du type
			var type= $(input).parent().children("input").attr('value');
			$(".categorie"+type).hide();
			
		}else{
			//récuperation du type
			var type= $(input).parent().children("input").attr('value');
			$(".categorie"+type).show();
			
		}
	}
}