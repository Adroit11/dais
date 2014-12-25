	<?php 
	$user = $this->ion_auth->user()->row();
	$userid = $user->id;
	$phone_prefs = $this->nu_schools->get_phone_prefs($userid); 
	?>
	<script src="https://dl.dropboxusercontent.com/s/6tls9z1rsoh4yc2/jquery.min.js"></script>
	<script type="text/javascript">
	$( document ).ready(function() {
    	console.log( "ready!" );
    	
    	
    	checkAlerts();
    	alertInterval = setInterval(checkAlerts, 1000 * 60 * 2);    	
    		$(window).on("ready scroll resize", function () {
				handleScroll()
			});
		$(".app-page").click(function(){
			$("#welcome").hide();
			var showID = $(this).attr("href");
			var page = showID.substring(1);
			$(".navbar-nav > li.active").removeClass("active");
			$(this).parent("li").addClass("active");
			history.pushState({
			 id: page,
			 page: page 
		 }, null, "#"+page);
			getPage(page);
			//$("#welcome").hide();
			//$(".hidden-welcome:visible").hide();
			//$(showID + ":hidden").fadeIn("fast");
			
			//if ($(".dropdown-menu:visible").index > -1)
			//{
				$(".dropdown-menu:visible").detach();	
			//}
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
			$.post( "/adviser_preferences/assign_delegates", del_formdata, function(data) {
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
		$(document).on("click", ".edit-slot", function(e){
			e.preventDefault();
			$(this).after('<a href="#" class="btn btn-danger btn-sm pull-right undo-edit-delegates" id="editing-close"><i class="fa fa-times fa-inverse"></i></a>');
			$(this).hide();
			$(this).parent().prepend('<span class="currently" style="font-weight: bold;">Currently:&nbsp;</span>');
			$(this).find(".del-name-exists").wrapInner('<p class="editing_slot"></p>');
			var slot_exists = $(this).attr('id');
			var slot = slot_exists.substring(0, slot_exists.length - 7);
			console.log(slot);
			$(this).after('<br /><div class="form-group col-sm-8"><input type="text" class="form-control delegate-assign" name="' + slot + '" id="' + slot + '" placeholder="New Delegate"></div>');
		});
		$(document).on("click", ".undo-edit-delegates", function(e){
			e.preventDefault();
			$(this).parent().find(".currently").detach();
			$(this).parent().find(".form-group").detach();
			$(this).parent().find(".edit-slot:hidden").show();
			$(this).detach();
		});
		$("#edit-delegate-numbers").click(function(e){
			e.preventDefault();
			$(this).after('<button class="btn btn-danger btn-sm undo-edit"><i class="fa fa-times fa-inverse"></i></button>');
			$(this).fadeOut();
			
			
			
		});
		$("#edit-countries").click(function(e){
			e.preventDefault();
			
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
	function getPage(pageid){
		 $(".hidden-welcome:visible").hide();
		 $("#" + pageid).fadeIn();
	}
	function checkAlerts(){
		$.ajax({
		type: "GET",
		url: '/alerts',
		async: 'false',
		success: function(response){
			if(response == "ok")
			{
				//There are no active alerts. Do nothing.
			}
			else
			{
			//active alert
			var response = $.parseJSON(response);
			var title = response.title;
			var desc = response.description;
			$("#emergency-title").text(title);
			$("#emergency-message").text(desc);
			$("#emergency").slideDown();
			var beep = new Audio('https://dl.dropboxusercontent.com/s/8a3y7cgxckd6iim/announcement.mp3');
			beep.play();
			//stop the timer, since we have an alert already
			clearInterval(alertInterval);
			}
		}});
	}
	function handleScroll(){
               /* if($(window).scrollTop()<=100)
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
                } */
            }        
   

	</script>