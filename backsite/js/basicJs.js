var formType;
$(document).ready(function(){
	//檢查表單
	projectDetailFormValidate();
	//隱藏popup
	$(".panel").hide();
	//處理列表上的按鈕事件
	tableListButtonProcess();
	//分頁
	page();
	//登入處理
	loginAjax();
	//登入按鍵處理
	loginEnter();
});

/**
* 登入處理
**/
function loginAjax()
{
	$("#login").click(function(){
		$.ajax({
			type: "POST",
			url: "",
			dataType: "json",
			data: {type: 1, id: $("#account").val(), password: $("#password").val()}
		}).done(function( msg ){
			if(msg)
			{
				window.location.href = "plants_list";
			}else{
				$(".form-signin .label").removeClass("hide").fadeIn("slow", function(){
					setTimeout(function(){
						$(".form-signin .label").fadeOut('slow');
						loginReset();
					},2000);
				});
			}
		}).fail(function(jqXHR, textStatus) {
			$(".alert").removeClass('alert-success').addClass('alert-danger').html('<strong>Error !</strong>Request failed: ' + textStatus);
			displayAlert();
		});
	});
}

/**
* Login Reset
**/
function loginReset()
{
	$("#account").val('');
	$("#password").val('');
}

/**
* 登入 Enter keyup
**/
function loginEnter()
{
	$("#password").keyup(function(event){
		if(event.keyCode == 13){
			$("#login").click();
		}
	});
}

/**
* 檢查表單
**/
function projectDetailFormValidate()
{
	$(".dom_form").each(function(){
		$(this).validate({
			submitHandler: function(form){
				var options = { 
				    data: { type: formType },
				    dataType: 'json',
				    url: '', 
				    success:function(result){ 
				        if(result.status == 'SUCCESS')
				        {
				        	$.unblockUI();
				        	alertCustome('SUCCESS', 'Add Complete!', 'success');
				        }else{
				        	$.unblockUI();
				        	alertCustome('FAIL', result.message, 'error');
				        }
				    } 
				};
				$(form).ajaxSubmit(options);
			}
		});
	});
}
/**
 * 客製警示框
 * @param  string inTitle     標題
 * @param  string inContent   內容
 * @param  string} inColorType bootstrap color
 * @return void
 */
function alertCustome(inTitle, inContent, inColorType)
{
	$.pnotify({
	    title: inTitle,
	    text: inContent,
	    type: inColorType,
	    delay: 2000,
	    animation: {
	        effect_in: 'show',
	        effect_out: 'slide'
	    },
	    after_close: function(pnotify) {
	        window.location.reload();
	    }
	});
}

/**
* lightbox
**/
function popupLightBox(inClassName)
{
	var temp = [];
	$("." + inClassName).each(function(){
		if($(this).prop("href") != '')
		{
			temp.push($(this).prop("href"));
		}else{
			temp.push($(this).val());
		}
	});
	Lightview.show(temp, { controls: 'thumbnails', skin: 'mac' }, 1);
}


/**
 * 處理列表上的按鈕事件
 * @return void
 */
function tableListButtonProcess()
{
	//新增
	$(".insert_dom").click(function(){
		insertDomPopup($(this).attr("name"));
	});
	
	//修改
	$(".edit_dom").click(function(){
		editDomPopup($(this).parent().parent(), $(this).attr("name"));
	});
	
	//刪除事件
	$(".remove_dom").click(function(){
		removeDomPopup($(this).attr("name"), $(this).attr("data-delete"));
	});
}

/**
* 顯示popup windows insert
**/
function insertDomPopup(inId)
{
	$.blockUI({ 
		message: $("#" + inId),
		css: {
				border: '0px', 
				width: '50%',
				top: '15%', 
				left: '25%', 
				textAlign: 'left',
				backgroundColor: '',   
				cursor: 'default'
		},
		overlayCSS: {cursor: 'pointer'},
		onBlock: function(){
			
			$(".dom_submit").unbind("click");
			$(".dom_submit").bind("click", function(){
				formType = $(this).attr("data-insert");
				$(this).closest(".dom_form").submit();
			});
			$('.blockOverlay').attr('title','Click to unblock').click(function(){
				$.unblockUI();
			});
		}
	});
}


/**
* 顯示popup windows edit
**/
function editDomPopup(inParentDom, inId)
{	
	$.blockUI({ 
		message: $("#" + inId),
		css: {
				border: '0px', 
				width: '50%',
				top: '15%', 
				left: '25%', 
				textAlign: 'left',
				backgroundColor: '',   
				cursor: 'default'
		},
		overlayCSS: {cursor: 'pointer'},
		onBlock: function(){
			
			//處理塞值
			//判斷塞值到那一個popup
			switch(inId)
			{
				case 'image_popup':imageAssign(inParentDom);break;
				case 'plants_popup':plantsAssign(inParentDom);break;
			}
			//更新按鈕事件
			$(".dom_submit").unbind("click");
			$(".dom_submit").bind("click", function(){
				formType = $(this).attr("data-edit");
				$(this).closest(".dom_form").submit();
			});
			$('.blockOverlay').attr('title','Click to unblock').click(function(){
				$.unblockUI();
			});
		}
	});
}
/**
* 移除dom
**/
function removeDomPopup(inId, inType)
{
	bootbox.confirm("確定刪除?", function(result)
	{
		if(result)
		{
			$.ajax({
				type: "POST",
				url: "",
				data: "type=" + inType + "&id=" + inId,
				dataType: "json"
			}).done(function( msg ){
				if(msg == 'SUCCESS')
				{
		        	$.unblockUI();
		        	alertCustome('SUCCESS', 'Add Complete!', 'success');
		        }else{
		        	$.unblockUI();
		        	alertCustome('FAIL', result.message, 'error');
		        }
			}).fail(function(jqXHR, textStatus) {
			});
		}
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
 * 修改圖片的修改
 * @param  Object inDom 預存的資料物件
 * @return void
 */
function imageAssign(inDom)
{
	var pathDom = "#image_popup ";
	
	var resultPiid = $(inDom.find("input[name='mp_id']")[0]).val();
	$($(pathDom + " input[name='id']")[0]).val(resultPiid);
	
	var resultRecipt = $(inDom.find("input[name='mp_name']")[0]).val();
	$($(pathDom + " input[name='mp_name']")[0]).val(resultRecipt);
	
	var resultInvoiceType = $(inDom.find("input[name='mp_type']")[0]).val();
	$($(pathDom + " select[name='mp_type']")[0]).val(resultInvoiceType);

	$($(pathDom + " input[type='file']")[0]).parent().append('<a href="javascript:popupLightBox(\'lightbox_'+ resultPiid +'\')">[Current Images]</a>');
}

/**
 * 修改列表的修改
 * @param  Object inDom 預存的資料物件
 * @return void
 */
function plantsAssign(inDom)
{
	var pathDom = "#plants_popup ";
	
	var resultPiid = $(inDom.find("input[name='pl_id']")[0]).val();
	$($(pathDom + " input[name='id']")[0]).val(resultPiid);
	
	var resultRecipt = $(inDom.find("input[name='pl_type']")[0]).val();
	$($(pathDom + " input[name='pl_type']")[0]).val(resultRecipt);
	
	var resultInvoiceType = $(inDom.find("input[name='pl_name1']")[0]).val();
	$($(pathDom + " input[name='pl_name1']")[0]).val(resultInvoiceType);

	var resultInvoiceType = $(inDom.find("input[name='pl_name2']")[0]).val();
	$($(pathDom + " input[name='pl_name2']")[0]).val(resultInvoiceType);

	var resultInvoiceType = $(inDom.find("input[name='pl_size']")[0]).val();
	$($(pathDom + " input[name='pl_size']")[0]).val(resultInvoiceType);

	var resultInvoiceType = $(inDom.find("input[name='pl_price']")[0]).val();
	$($(pathDom + " input[name='pl_price']")[0]).val(resultInvoiceType);

	var resultInvoiceType = $(inDom.find("input[name='pl_comment']")[0]).val();
	$($(pathDom + " textarea[name='pl_comment']")[0]).val(resultInvoiceType);

	//file attac
	var resultInvoiceType = $(inDom.find("input[name='pl_image']")[0]).val();
	if(resultInvoiceType != '')
		$($(pathDom + " input[name='pl_image[]']")[0]).parent().find("span").html('<a href="javascript:popupLightBox(\'imgBox_'+ resultPiid +'\')">[Current Images]</a>');

	var resultInvoiceType = $(inDom.find("input[name='pl_name1_img']")[0]).val();
	if(resultInvoiceType != '')
		$($(pathDom + " input[name='pl_name1_img[]']")[0]).parent().find("span").html('<a href="javascript:popupLightBox(\'imgBox1_'+ resultPiid +'\')">[Current Images]</a>');

	var resultInvoiceType = $(inDom.find("input[name='pl_name2_img']")[0]).val();
	if(resultInvoiceType != '')
		$($(pathDom + " input[name='pl_name2_img[]']")[0]).parent().find("span").html('<a href="javascript:popupLightBox(\'imgBox2_'+ resultPiid +'\')">[Current Images]</a>');

	// var resultInvoiceType = $(inDom.find("input[name='pl_name2_img']")[0]).val();
	// $($(pathDom + " input[name='pl_name2_img']")[0]).val(resultInvoiceType);

	//$($(pathDom + " input[type='file']")[0]).parent().append('<a href="javascript:popupLightBox(\'lightbox_'+ resultPiid +'\')">[Current Images]</a>');
}