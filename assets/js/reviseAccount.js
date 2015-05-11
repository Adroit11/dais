$( document ).ready(function() {
$(".revise-delegates").click(function(e){
	e.preventDefault();
	var schoolid = $(this).data("school-id");
	var delegateQuantity = $(this).data("delegate-quantity");
	var schoolName = $(this).data("school-name");
	
	$("#revise-school").text(schoolName);
	$("#revise-delegate-quantity").attr("placeholder", delegateQuantity);
	$("#revise-schoolid").val(schoolid);
	
	//clear messages
	$("#response-revise-delegate").html('');
	$(".invoice-message").html('').removeClass('text-success').removeClass('text-danger').addClass('hidden');
	
	$("#reviseSchoolModal").modal('show');
	
});

$("body").on("click", "#save-revise-delegates", function(e){
	var button = $(this);
	e.preventDefault();
	console.log("clicked");
	button.html('<i class="fa fa-refresh fa-spin"></i>').removeClass('btn-primary').addClass('btn-warning');
	
	$.post( "/sec_ajax/edit_delegate_count", $( "#revise-delegate-form" ).serialize(), function(response){
			
			var response = $.parseJSON(response);
			if (response.status == 'ok'){
				
				button.html('Update').removeClass('btn-warning').addClass('btn-primary');
				$("#response-revise-delegate").html('<p class="lead">OK&nbsp;<i class="fa fa-check text-success"></i></p>');
				$(".invoice-message").html('A new invoice has been created to reflect these changes. <br /><strong>Note:</strong> An email was not sent to the adviser.').addClass('text-success').removeClass('hidden');
				$("#school-"+response.id+"-req-slots span.req-slots-number").html("<em>"+response.slots+"</em>");
				
				//clear input
				$("#revise-delegate-quantity").val("");
				
				
			}else{
				button.html('<i class="fa fa-times"></i>').removeClass('btn-warning').addClass('btn-danger');
				$(".invoice-message").html('An error occured.').addClass('text-danger').show();
			}
		} );

});
});