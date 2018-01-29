$(document).ready(function(){
	//show loading bar
	function showLoader(){
		$('.search-background').fadeIn(200);
	}
	//hide loading bar
	function hideLoader(){
		$('.search-background').fadeOut(200);
	};
	
	$("#paging_button li").click(function(){
		//show the loading bar
		showLoader();
		
		$("#paging_button li").css({'background-color' : ''});
		$(this).css({'background-color' : '#A5CDFA'});

		$("#content").load("commentData.php?page=" + this.id, hideLoader);
	});
	
	// by default first time this will execute
	$("#1").css({'background-color' : '#A5CDFA'});
	showLoader();
	$("#content").load("commentData.php?page=1", hideLoader);
});

$('a.delete').livequery("click", function(e){
 
	if(confirm('Are you sure you want to delete this comment?')==false)
	return false;
	e.preventDefault();
	var parent  = $(this).parent().parent().parent();
	var c_id =  $(this).attr('id');
	
	$.ajax({
		type: 'post',
		url: 'ajax.inc.php',
		data: 'cid='+ c_id+'&_task=deleteComment',
		beforeSend: function(){
		},
		success: function(){
			parent.fadeOut(400,function(){
				parent.remove();

			});
		}
	});
});