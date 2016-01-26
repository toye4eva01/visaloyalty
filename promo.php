<?php
//include("checklogin.php");
require_once("Connections/dms.php");

$sql = "SELECT promo_head, image_name_page, end_date, description, store_id FROM ims_promo WHERE status = 1 AND end_date >=  CURRENT_DATE()";

$query = mysqli_query($dms,$sql);
$count = mysqli_num_rows($query);


if ($count <1) {
	
	
$result = "";	

$result .="<div class=\"body backgroundpg1\">";	
$result .="<ul class=\"list list-messages\">";	
$result .="<li class=\"list-message\" >";
                
                        //$result.="<div class=\"w-clearfix column-left\">";
						//$result.="<div class=\"image-message\"><img src=\"images/128.jpg\">";
						 $result.="<div class=\"message-text\" align=\"center\">No Promo Available</div>";
						// $result.="</div></div>";
						$result.="<div class=\"column-right\">";
						
						 $result.="</div></li></ul></div>";	


} else {
$result=""; 
$result.="<div class=\"news-mask backgroundpg1 \"></div>";
$result.="<div class=\"news-container \">";
	
$result.="<ul class=\"w-clearfix list-news\">";
//$result .="<div class=\"swiper-container swiper-init\" data-effect=\"slide\" data-direction=\"vertical\" data-pagination=\".swiper-pagination\">";
//$result .= "<div class=\"swiper-wrapper\">";
while ($row = mysqli_fetch_assoc($query)) {
	$merid = $row['store_id'];
	$title = $row["promo_head"];
	$desc = $row["description"];
	$end = $row["end_date"];
	

$result.="<li class=\"list-item-new\">";
$result.="<a class=\"w-inline-block\"  data-load=\"1\">";
$result.="<div><img src=\"http://premiumincentives.biz/visang/images/photo/".$row['image_name_page']."\" class=\"image-new\"/></div>";
$result.="<div class=\"text-new\">";
$result.="<h2 class=\"storename\">$title</h2>";
$result.="<p class=\"description-new\">$desc</p>";
$result.="<p class=\"description-new2\">Expiry Date: $end</p>";
//$result .=" <div class=\"w-button action-button\">";
//$result .=" <div class=\"loginform\">";
//$result .="<input type=\"submit\" name=\"submit\" class=\"w-button action-button loginform\" id='$merid' value=\"Generate Voucher\" />";
//$result.="</div>";
$result.="</div>";

$result.="</a>";
$result.="</li>";
//$result.="</div>";
//$result.="<li>";
//$result.="<div class=\"feat_small_icon\"><br/></div>";
//$result .= "<div class=\"feat_small_details\">";
//$result.= "<div>""</div>";

//$result.="<a href=\"merchant.html\" class=\"swiper_read_more\">slide down to see more</a>";

//$result.="</li>";
					  
}
$result.="</ul>";
//$result.="</div>";
$result.="</div>";
//$result.="</div>";
//$result.="<div class=\"swiper-pagination\"></div>";	   
//$result.="</div>";                   
                      
                    
}

echo $result;



?>

<script>
$(document).ready(function(){
	$('.backgroundpg1').css('position:"relative", margin-top:"50px"');
	
});
</script>