var temp = [];
$(function()
{
	//文字標簽的點擊事件
	$(".changeType").bind("click", inputEventClick);
	//儲存的點擊事件
	$(".save").bind("click", saveEventAjax);
	//刪除的點擊事件
	$(".delete").bind("click", deleteEventClick);
	//新增的點擊事件
	$("#addButton").bind("click", addEventClick);
	//分頁
	page();
	//表單的處理
	formProcess();
	
	projectTableList();
	
	preLoader();
});

/**
* 先找出首頁所有的圖片
**/
function preLoader()
{
	$("ul img").each(function(){
		temp.push(this.src);
	});
};

/**
* lightbox
**/
function lightBox(inIndex)
{
	Lightview.show(temp, { controls: 'thumbnails', skin: 'mac' }, inIndex);
}

/**
* 個案列表操作處理
**/
function projectTableList()
{
	var dom = 
		'<tr>' +
			'<td><input type="text" name="annual[]" value="" class="form-control" placeholder="輸入年度" style=""></td>' +
			'<td><input type="text" name="department[]" value="" class="form-control" placeholder="輸入部門" style=""></td>' +
			'<td><input type="text" name="designer[]" value="" class="form-control" placeholder="輸入設計師" style=""></td>' +
			'<td><input type="text" name="company[]" value="" class="form-control" placeholder="輸入公司" style=""></td>' +
			'<td><span class="glyphicon glyphicon-remove-sign cursor remove_dom"></span></td>' +
		'</tr>';
	//新增dom
	$(".insert_dom").click(function(){
		$("table > tbody").append($(dom));
		//移除dom
		$(".remove_dom").click(function(){
			$(this).parent().parent().remove();
		});
	});
	//移除dom
	$(".remove_dom").click(function(){
		$(this).parent().parent().remove();
	});
	
}

/**
* 表單的按鈕處理
**/
function formProcess()
{
	$("#save").click(function(){
		ajaxFormOpreation(1);
	});
	$("#insert").click(function(){
		ajaxFormOpreation(3);
	});
	$("#delete").click(function(){
		bootbox.confirm("Are you sure?", function(result)
		{
			if(result)ajaxFormOpreation(2);
		});
	});
	$("#form-insert-button").click(function(){
		window.location.href = "customer_detail";
	});
	$("#searchButton").click(function(){
		var currentPage = (getUrlParameter("currentPage") == undefined)?1:getUrlParameter("currentPage");
		window.location.href = "customer?currentPage=" + currentPage + "&search=" + $("#search_kwd").val();
	});
	$("#selectButton").click(function(){
		window.location.href = "customer?search=" + $("#category_search_select").val();
	});
	$("#resetButton").click(function(){
		window.location.href = "customer";
	});
	
}

/**
* 表單的資料處理
**/
function ajaxFormOpreation(inType)
{
	$.ajax({
		type: "POST",
		url: "",
		data: $("form").serialize() + "&type=" +inType,
		dataType: "json"
	}).done(function( msg ){
		if(msg == 'SUCCESS')
		{
			$(".alert").removeClass('alert-danger').addClass('alert-success').html('<strong>Done !</strong>Operation ' + msg);
			
		}else{
			$(".alert").removeClass('alert-success').addClass('alert-danger').html('<strong>Error !</strong>Operation ' + msg);
		}
		displayAlert();
	}).fail(function(jqXHR, textStatus) {
		$(".alert").removeClass('alert-success').addClass('alert-danger').html('<strong>Error !</strong>Request failed: ' + textStatus);
		displayAlert();
	});
}

/**
* 分頁處理
**/
function page()
{
	$.ajax({
		type: "POST",
		url: "",
		data: {type:4},
		dataType: "json"
	}).done(function( msg ){
		var current = (msg.currentPage)?msg.currentPage:1;
		var options = {
			totalPages: msg.totalPage,
			currentPage: msg.currentPage,
			alignment:'center',
			onPageClicked: function(e, originalEvent, type, page){
				window.location.href = "?currentPage=" + page;
			}
		}
		//超過一頁的才顯示分頁
		if(msg.totalPage > 1)$('#page_bar').bootstrapPaginator(options);
	}).fail(function(jqXHR, textStatus) {
		// $(".alert").removeClass('alert-success').addClass('alert-danger').html('<strong>Error !</strong>Request failed: ' + textStatus);
		// displayAlert();
	});
	
}

/**
* 修改的點擊事件
**/
function saveEventAjax()
{
	var serialId = $(this).attr("id").split("_")[1];
	operationAjax({ id: serialId, value: $("#valueNumber_" + serialId + " > input").val(), type: 1});
	
	return false;
}

/**
* 新增點擊事件
**/
function addEventClick()
{
	//顯示輸入區
	$(".addRow").show("slow", function(){
		//啟用點擊事件
		$(".add").bind("click", function(){
			operationAjax({ type: 3, value: $("#addInput").val()});
			//綁定輸入點擊事件
			$(".changeType").bind("click", inputEventClick);
		});
		
		//加入拒絕事件
		$("#addInput").bind("click", denyEvent);
		//增加擊點任何區域的事件
		$(document).bind("click", "*", function(){
			addEventReset();
			return false;
		});
		//解除輸入點擊事件
		$(".changeType").unbind("click");
	});
	return false;
}

/**
* 輸入元件重置
**/
function addEventReset()
{
	$(".addRow").hide("slow");
	//解除區域事件
	$(document).unbind("click");
	//綁定輸入點擊事件
	$(".changeType").bind("click", inputEventClick);
}

/**
* 刪除點擊事件
**/
function deleteEventClick()
{
	var delId = $(this).attr("id").split("_")[1];
	bootbox.confirm("Are you sure?", function(result)
	{
		if(result)
		{
			operationAjax({ id: delId, type: 2});
		}
	});
	return false;
}

/**
* Ajax處理
**/
function operationAjax(inData)
{
	$.ajax({
		type: "POST",
		url: "",
		dataType: "json",
		data: inData
	}).done(function( msg ){
		if(msg == 'SUCCESS')
		{
			$(".alert").removeClass('alert-danger').addClass('alert-success').html('<strong>Done !</strong>Operation ' + msg);
			
		}else{
			$(".alert").removeClass('alert-success').addClass('alert-danger').html('<strong>Error !</strong>Operation ' + msg);
		}
		displayAlert();
	}).fail(function(jqXHR, textStatus) {
		$(".alert").removeClass('alert-success').addClass('alert-danger').html('<strong>Error !</strong>Request failed: ' + textStatus);
		displayAlert();
	});
}

/**
* 顯示效果
**/
function displayAlert()
{
	$.blockUI({ 
		message: $(".alert"),
		css: {border: '0px', cursor: 'default'},
		overlayCSS: {cursor: 'pointer'}
	});
	
	$(".alert").fadeIn(1500, function(){
		$('.blockOverlay').attr('title','Click to unblock').click($.unblockUI, function(){
			window.location.reload();
		});
	});
}

/**
* 輸入元件點擊事件
**/
function inputEventClick()
{
	//判斷當前是否已經有input
	if($(this).find("input").val() != undefined)return false;
	var emptyInput = $("<input type='text' value='' />");
	var tempId = emptyInput.attr("id");
	var serialId = $(this).attr("id").split("_")[1];
	
	//重置元件
	inputEventReset();
	//輸入原本的值
	emptyInput.attr("id", $(this).attr("id"));
	emptyInput.val($(this).text());
	$(this).html(emptyInput);
	//取消當前的dom事件
	// $(this).unbind("click");
	//顯示按鈕
	$("#saveIcon_" + serialId).show();
	
	//增加擊點任何區域的事件
	$(document).bind("click", "*", function(){
		inputEventReset();
		return false;
	});
	return false;
}

/**
* 輸入元件重置
**/
function inputEventReset()
{
	//綁定點擊事件
	$(".changeType").bind("click", inputEventClick);
	$(".changeType").each(function()
	{
		//關閉按鈕
		$("#saveIcon_" + $(this).attr("id").split("_")[1]).hide();
		if($(this).find('input').val() != undefined)
		{
			$(this).html($(this).find('input').val());
		}
	});
	//解除區域事件
	$(document).unbind("click");
}

/**
* 拒絕事件
**/
function denyEvent()
{
	return false;
}

/**
* 取的網址參數
**/
function getUrlParameter(inParam)
{
	var sPageURL = window.location.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    for (var i = 0; i < sURLVariables.length; i++) 
    {
        var sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] == inParam) 
        {
            return sParameterName[1];
        }
    }
}