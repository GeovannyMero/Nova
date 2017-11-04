@if(Session::has('message'))
	<div id="messageSucces" class="alert alert-success" role="alert">
		<button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>
		<strong><i class="ace-icon fa fa-check"></i></strong>
		{{Session::get('message')}}
	</div>
@endif
@if(Session::has('warning'))
	<div id="messageWarning" class="alert alert-danger" role="alert">
		<button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>
		<i class="ace-icon fa fa-exclamation-triangle bigger-120"></i>
		{{Session::get('warning')}}
		<br />
	</div>
@endif

@if(Session::has('info'))
	<div class="alert alert-info" role="alert">
		<button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>
		<i class="fa-info-circle "></i>
		{{Session::get('info')}}
		<br />
	</div>
@endif


<script type="text/javascript">
window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 4000);
</script>