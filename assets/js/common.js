$(function() {
	$('.addTooltip').tooltip();
	$('.addTooltip').tooltip('disable');
	
	$('.tooltipEnabledSwitch').bind('click', function() {
		
		if($(this).html() === "OFF")
		{
			$('.addTooltip').tooltip('enable');
			$(this).removeClass("label-default").addClass("label-success").html("ON");
		}
		else
		{
			$('.addTooltip').tooltip('disable');
			$(this).removeClass("label-success").addClass("label-default").html("OFF");
		}
		
	});
});