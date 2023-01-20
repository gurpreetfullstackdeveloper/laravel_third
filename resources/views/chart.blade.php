<html>  
<head>  
<title>Bootstrap date and time</title>  
<script src ="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>  
<script src ="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>  
<script src ="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>  
<script src ="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>  
<script> 
 
$(function() {  
  $('#datetimepicker1').datetimepicker({
                 format: 'YYYY-MM-DD'
           });  
		   
  $('#datetimepicker2').datetimepicker({
			 format: 'YYYY-MM-DD'
	   }); 



	$('#btnSubmit').click(function(event){
	   var startDtVal=$('#start_date').val();
	   var endDtVal=$('#end_date').val();
	   
	   //alert(startDtVal);
	   
	   if(!$.trim(startDtVal) || !$.trim(endDtVal) ) {
		   $('.error_empty').show();
		   event.preventDefault();
		   return false;
		}
		else{
			//alert("kkkk");
				$('.error_empty').hide();
				
				
				var dt1 = new Date(startDtVal);
				var dt2 = new Date(endDtVal);
				
				var milli_secs = dt2.getTime() - dt1.getTime();
				 //alert(milli_secs);
				// Convert the milli seconds to Days 
				var days = milli_secs / (1000 * 3600 * 24);
			
				
				 //alert(days);
				 
			   if(days < 7)
			   {
				  $('.error').hide();
				  return true;
			   }
			   else
			   {
				 $('.error').show();
				 event.preventDefault();
			   }
		}
	   
	   
	   
   });


	   
});  
</script>  
<link rel ="stylesheet" href ="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
<link rel ="stylesheet" href ="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">  
<style>  
    .container {          
        width: 100%;  
		margin:0 auto;
    }  
</style>  
</head>  
<body>  
</br>  
<div class ="container">  
	<div class="row">
		<div class="col-md-12">&nbsp;</div>
	</div>
	<div class="row">
		<div class="col-md-12 text-center"><h2>chart.js feature here</h2></div>
	</div>
	<div class="row">
		<div class="col-md-12 text-center"><h2>Please fill the Form</h2></div>
	</div>
	<div class="row">
		<div class="col-md-12">&nbsp;</div>
	</div>
	<div class="row">
		<div class="col-md-12">&nbsp;</div>
	</div>
	<form method="POST" name="form-one"  action="chartsubmit">
		{{ csrf_field() }}
	  <div class ="row">  
		<div class="col-md-3">&nbsp;</div>
		<div class="col-md-2 text-right"><label for="start_date">Start Date:</label></div>
		<div class="col-md-3">
		
		  <div class ="form-group"> 		  
			<div class ='input-group date' id='datetimepicker1'>  
			  <input type ='text' id='start_date' name='start_date' required class="form-control" />  
			  <span class ="input-group-addon">  
				<span class ="glyphicon glyphicon-calendar"></span>  
			  </span>  
			</div>  
		  </div> 
		   
		</div> 
		<div class="col-md-3">&nbsp;</div>	
	  </div> 
	  
	  <div class ="row">  
		<div class="col-md-3">&nbsp;</div>
		<div class="col-md-2 text-right"><label for="start_date">End Date:</label></div>
		<div class="col-md-3">
		
		  <div class ="form-group"> 		  
			<div class ='input-group date' id='datetimepicker2'>  
			  <input type ='text' id='end_date' name='end_date' required class="form-control" />  
			  <span class ="input-group-addon">  
				<span class ="glyphicon glyphicon-calendar"></span>  
			  </span>  
			</div>  
		  </div> 
		   
		</div> 
		<div class="col-md-3">&nbsp;</div>	
	  </div> 
	 

<div class ="row">  
		<div class="col-md-3">&nbsp;</div>
		<div class="col-md-2 text-right">&nbsp;</div>
		<div class="col-md-3">
		
		  <div class ="form-group"> 		  
			<span style='display:none; color:red; text-decoration:bold' class="error"> 
				Invalid Start Date or End Date or Date Difference more than 7 days
			</span>	
			<span style='display:none; color:red; text-decoration:bold' class="error_empty"> 
				Start Date or End Date is empty
			</span>	
		  </div> 
		
	  </div> 
	  </div>





	  <div class ="row">  
		<div class="col-md-3">&nbsp;</div>
		<div class="col-md-2 text-right">&nbsp;</div>
		<div class="col-md-3">
		
		  <div class ="form-group"> 		  
			<input class="btn btn-primary" id='btnSubmit' type ='submit' name='form_submit' value='Submit'>  			
		  </div> 
		<div class="col-md-3">&nbsp;</div>	
	  </div> 
	  </div>
  </form>	
	<div class="row">
		<div class="col-md-12">&nbsp;</div>
	</div>
	<div class="row">
		<div class="col-md-12">&nbsp;</div>
	</div>
	<div class="row">
		<div class="col-md-12">&nbsp;</div>
	</div>
	<div class="row">
		<div class="col-md-12">&nbsp;</div>
	</div>  
</div>  
</body>  
</html>  