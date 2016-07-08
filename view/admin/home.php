<div id="indicator"></div>
<div id="tab"></div>




<script type="text/javascript" src="/src/jquery.js"></script>

<script type="text/javascript">
	


 function get(i,a)
{
  $.ajax({
url:i+".php",
success:function(msg)
{
  $(a).html(msg);
}


});
}
$(document).ready(function(){


get("indicator","#indicator");
get("tab","#tab");







});





</script>





