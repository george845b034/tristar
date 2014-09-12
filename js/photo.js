$(function()
{
	$("select[name='category']").change(function(){
		window.location.href = '?mp_type=' + this.value;
	});
});