$(function(){
	var time =1;
	$('html, body').animate({scrollTop:80}, 'slow');
	/**/
	var data = [[0,0,0]];
	var data_max = 10000; //Y轴最大刻度
	var line_title = ["第一月","第二月","第三月"]; //曲线名称
	var y_label = ""; //Y轴标题
	var x_label = ""; //X轴标题
	var x = ['第1月份（总额）','第2月份（总额）','第3月份（总额）']; //定义X轴刻度值
	var title = "某年某季度订单销售额度"; //统计图标标题
	j.jqplot.diagram.base("chart3", data, line_title, title, x, x_label, y_label, data_max, 1);
	j.jqplot.diagram.base("chart4", data, line_title, title, x, x_label, y_label, data_max, 2);
	/*三个小图标的样式*/
	$('#zhexian').click(function(){
		$('#zhexian').css('background','#ff8650');
		$('#zhuxing').css('background','#fabe00'); 
		$('#xiangxi').css('background','#fabe00'); 
		$('#chart1').css('visibility','visible');
		$('#chart2').css('visibility','hidden');
		$('.table-main').css('visibility','hidden');
	})
	$('#zhuxing').click(function(){
		$('#zhexian').css('background','#fabe00');
		$('#zhuxing').css('background','#ff8650'); 
		$('#xiangxi').css('background','#fabe00'); 
		$('#chart1').css('visibility','hidden');
		$('#chart2').css('visibility','visible');
		$('.table-main').css('visibility','hidden');
	})
	$('#xiangxi').click(function(){
		$('#zhexian').css('background','#fabe00');
		$('#zhuxing').css('background','#fabe00'); 
		$('#xiangxi').css('background','#ff8650'); 
		$('#chart2').css('visibility','hidden');
		$('#chart1').css('visibility','hidden');
		$('#chart3').css('visibility','hidden');
		$('#chart4').css('visibility','hidden');
		$('.table-main').css('visibility','visible');
	})
})

function searchBut() {
	time =2;
	var reg1 = $(".chooseSe1").val();
	var reg2 = $(".chooseSe2").val();
	if (reg1 == "请选择您要统计的年份") {
		alert('查询年份不能为空，请选择您的查询年份');
		return false;
	}
	if (reg2 == "请选择您要统计的季度") {
		alert('查询季度不能为空，请选择您的查询季度');
		return false;
	}

	$.ajax({
		type: "POST",
		url: "/Chart/ChartMoney_action",
		dataType: "json",
		data: {"chart_year":reg1,"chart_quarter":reg2},
		 success: function(json){
			 $('#chart3').css('visibility','hidden');
			 $('#chart4').css('visibility','hidden');
			 /*表里面需要传送的数值*/
		     var	data = [[json.one,json.two,json.three]];
			 var	data_max = 8000; //Y轴最大刻度
			 var 	line_title = ["第一月","第二月","第三月"]; //曲线名称
			 var 	y_label = ""; //Y轴标题
			 var    x_label = json.chart_year; //X轴标题
			 var    x = ['第1月份（总额）','第2月份（总额）','第3月份（总额）']; //定义X轴刻度值
			 var title = '2016-2017年'+json.chart_quarter+'订单销售情况'; //统计图标标题
			 j.jqplot.diagram.base("chart1", data, line_title, title, x, x_label, y_label, data_max, 1);
			 j.jqplot.diagram.base("chart2", data, line_title, title, x, x_label, y_label, data_max, 2);


		// 	if(json.success==1){
		// 		$('html, body').animate({scrollTop:0}, 'slow');
		// 		$('#UserName').val(json.username);
		// 		$('#PassWord').val(json.password);
		// 		$('#Mem_Name').val(json.mem_name);
		// 		$('#Mem_Card').val(json.mem_card);
		// 		$('#Mem_Email').val(json.mem_email);
		// 		$('#Mem_Tel').val(json.mem_telnum);
        //
		// 	}
		 }
	})
}
