	<?php 
	$user = $this->ion_auth->user()->row();
	$userid = $user->id;
	$phone_prefs = $this->nu_schools->get_phone_prefs($userid); 
	?>
	<script src="https://dl.dropboxusercontent.com/s/6tls9z1rsoh4yc2/jquery.min.js"></script>
	<script type="text/javascript">
	$( document ).ready(function() {
    	console.log( "ready!" );
    		$(window).on("ready scroll resize", function () {
				handleScroll()
			});
		$(".app-page").click(function(){
			var showID = $(this).attr("href");
			$("#welcome").hide();
			$(".hidden-welcome:visible").hide();
			$(showID + ":hidden").fadeIn("fast");
			if ($(".dropdown-menu:visible").index > -1)
			{
				$(".dropdown-menu:visible").hide();	
			}
			$(window).scrollTop(0);
			return false;
		});
		$(".welcome-page").click(function(){
			$(".hidden-welcome:visible").hide();
			$("#welcome").fadeIn("fast");
			if ($(".dropdown-menu:visible").index > -1)
			{
				$(".dropdown-menu:visible").hide();	
			}
			$(window).scrollTop(0);
			return false;
		});
		$('.pop').popover({placement: 'right', trigger: 'hover'});
		$('.pop').click(function(e){
		e.preventDefault();
		});
		$("#del-assignments-submit").click(function(event){
			event.preventDefault();
			$("#editing-close").children().removeClass("fa-times").addClass("fa-refresh fa-spin");
			var del_formdata = $(".delegate-assign:input").serialize();
			console.log(del_formdata);
			$.post( "/assign_delegates/submit", del_formdata, function(data) {
			var updates = jQuery.parseJSON(data);
			for ( var i in updates) {
	        var id = updates[i].id;
	        var name = updates[i].name;
	        console.log(id);
	        console.log(name);
			$('#slot_' + id + '_exists').parent().html('<span class="del-name-exists">' + name + '</span>&nbsp;&nbsp;<a href="#" class="btn btn-xs btn-warning pull-right edit-slot new" id="slot_' + id + '_exists">Edit</a>');
			}
			}, "text");
			$('.currently:visible').detach();
			});
		$(".double-del").tooltip();
		$(".edit-slot").on("click", function(e){
			e.preventDefault();
			$(this).after('<a href="#" class="btn btn-danger btn-sm pull-right undo-edit" id="editing-close"><i class="fa fa-times fa-inverse"></i></a>');
			$(this).hide();
			$(this).parent().prepend('<span class="currently" style="font-weight: bold;">Currently:&nbsp;</span>');
			$(this).find(".del-name-exists").wrapInner('<p class="editing_slot"></p>');
			var slot_exists = $(this).attr('id');
			var slot = slot_exists.substring(0, slot_exists.length - 7);
			console.log(slot);
			$(this).after('<br /><div class="form-group col-sm-8"><input type="text" class="form-control delegate-assign" name="' + slot + '" id="' + slot + '" placeholder="New Delegate"></div>');
		});
		$(document).on("click", ".undo-edit", function(e){
			console.log('fired');
			e.preventDefault();
			console.log('fired');
			$(this).parent().find(".currently").detach();
			$(this).parent().find(".form-group").detach();
			$(this).parent().find(".edit-slot:hidden").show();
			$(this).detach();
		});
		$("#edit-delegate-numbers").click(function(e){
			e.preventDefault();
			$(this).after('<a href="#" class="btn btn-danger btn-sm pull-right undo-edit"><i class="fa fa-times fa-inverse"></i></a>');
			$(this).hide();
			
			
		});
		
		var phone_prefs_json = '<?php echo $phone_prefs; ?>';
		if(phone_prefs_json != "No phone number found."){
		var phone_prefs = jQuery.parseJSON(phone_prefs_json);
		if(phone_prefs.prefs == 'none'){
			$("#checkboxes-2").prop('checked', true);
		}
		if(phone_prefs.prefs == 'text'){
			$("#checkboxes-0").prop('checked', true);
		}
		if(phone_prefs.prefs == 'text-other'){
			$("#checkboxes-1").prop('checked', true);
			if(phone_prefs.phone_2 != "none"){
				$("#phone-2").val(phone_prefs.phone);
			}
		}
		}

	});
	function handleScroll(){
                if($(window).scrollTop()<=100)
                {
                    $(".navbar-brand").hide();
                    $('#main-nav-content').removeClass('compact');
                    $("#navbar-quick-login").show();
                    $(".navbar-header").show();
                }
                else
                {
                    $('#main-nav-content').addClass('compact');
                    $("#navbar-quick-login").hide();
                    $(".navbar-header").hide();
                    $(".navbar-brand").hide();
                }
            }        
   

	</script>