
<?php
//include("checklogin.php");
require_once("Connections/dms.php");

//$id = $_GET['id'];
//$mercatid = $id;
$var1 = 1;
$var = 0;
$result = "";
if (isset($_GET['id'])) {
	$mercatid = $_GET['id'];
//$mercatid = $_GET['mercatid'];
}
if (isset($_GET['hmercatid'])) {
	$mercatid = $_GET['hmercatid'];
//$mercatid = $_GET['mercatid'];
}
if (isset($_GET['stateid'])) {
	$stateid = $_GET['stateid'];
//$mercatid = $_GET['mercatid'];
}

$sql = "SELECT storeid, store_name, ims_store.state, states.state AS mstate, current_address, mercatname, store_story, imgname FROM ims_store";
$sql .= " LEFT JOIN ims_mer_cat ON ims_store.mercatid = ims_mer_cat.mercatid";
$sql .= " JOIN states ON ims_store.state = states.stateid";
$sql.= " WHERE ims_store.status = '$var1'";
if (isset($mercatid)) {
	if ($mercatid != "") {
		if ( $mercatid != $var){
	$sql.=" AND ims_store.mercatid = $mercatid";
		}
	}
	}
if (isset($stateid)) {
	if ($stateid != "") {
		if ( $stateid != $var){
	$sql.=" AND ims_store.state = $stateid";
		}
	}
	}

	$query = mysqli_query($dms,$sql);
	$count = mysqli_num_rows($query);



if ($count > 0){
	while($row = mysqli_fetch_assoc($query)){
		$merid = $row['storeid'];
		$mercatname = $row['mercatname'];
		$img = $row['imgname'];
		$state = $row['mstate'];
		$desc = $row['store_story'];
		//$mercatid = $row['mercatid'];
		//session_start($merid);
	
		
	
	
	$result .="<div class=\"news-mask\"></div>";

	//$result .="<br/>";
    $result .="<div class=\"news-container\">";	

  
  if (!isset($_GET['noform'])) {
	$result .="<input name=\"mercartid\" type=\"hidden\" value=\"$mercatid\" id=\"hmercatid\" />";
	$result .="<div class=\"dropdown\" id=\"dropdown\">";
    $result .="<select class=\"dropbtn\" id=\"stateid\">";
    $result .="<option value=\"\">Select City</option>";
    $result .="<option value=\"25\">Lagos</option>";
    $result .="<option value=\"2\">Abuja</option>";
    $result .="<option value=\"3\">Portharcourt</option>";
    $result .="</select>";
	
 //   $result .="<label>Materialize Select</label>";
  	$result .="</div>";


	$result .="</div>";
  }
	$result .="<div class=\"showinfo\">";
    $result .="<ul class=\"w-clearfix list-news\">";
    $result .="<li class=\"list-item-new\">";
	
	$result.="<div class=\"image-new\"><img src=\"http://premiumincentives.biz/visang/images/photo/".$row['imgname']."\" class=\"image-new\"/></div>";
    //$result .="<div class=\"text-new\">";

	$result .="<ul>";
    $result .="<li>";
    $result .="<input type=\"checkbox\" checked>";
    $result .="<i></i>";
    $result .="<h3 class=\"storename icon ion-home\">      {$row['store_name']}</h3><span class=\"cat ion-ios-briefcase\">      $mercatname</span><br/>";
	$result .="<h6 class=\"story\">  {$row['store_story']} </h6>";
	$result .="<h4 class=\"xpad icon ion-location iconcolor\"><b class=\"add-color\">{$row['current_address']} $state</b></h4>";
//	$result .="<i class=\"cat\"> $state</i><br/>";
    $result .="<span class=\"read\">See Offering</span><br/>";

  //$result .="<h2 class=\"title-new\">{$row['store_name']}</h2>";
 // $result .="<h2 class=\"title-new\">{$row['current_address']}</h2>";
    $result .="<p class=\"story\">";
	$result .="OFFERING:<br/><br/>";

		$sql2= "SELECT merid, offering, offering_type FROM ims_offering_cat";
		$sql2.=" WHERE merid = $merid AND status = '$var1'";
		$query2 = mysqli_query($dms,$sql2);
		$count2 = mysqli_num_rows($query2);
		if ($count2 >0){
			while ($row2 = mysqli_fetch_assoc($query2)){
				$offtype = $row2['offering_type'];
				//$edito = $row['merid'];
				//$result .="<br/>";
				//$result .="<ul>";
				if ($offtype == 1) {
					//$result .="<ul>";
					$result .="<span> - </span>{$row2['offering']}<br/><br/>";
					//$result .="<h2>{$row2['offering']}</h2>";
				}else {
					//$result .="<h2>{$row2['offering']}</h2>";
					$result .="<span> - </span>{$row2['offering']}<br/><br/>";

				}

			} $result .="</p></li><br/>";
		}
		

//	$result .=" <div class=\"loginform\">";
//	$result .="<input type=\"submit\" name=\"submit\" class=\"w-button action-button loginform\" id='$merid' value=\"Generate Voucher\" />";
 // $result .="</ul>";

//  $result .="</li>";
   // $result .="</div>";
   // $result .="</a>";
    $result .="</li>";
	$result .="</ul>";
	$result .="</div>";
	$result .="</div>";

	}


}
else {
	$result .="<div class=\"body\">";
	$result .="<ul class=\"list list-messages\">";
	$result .="<li class=\"list-message\" >";

	                        //$result.="<div class=\"w-clearfix column-left\">";
							//$result.="<div class=\"image-message\"><img src=\"images/128.jpg\">";

							 $result.="<div class=\"message-text\" align=\"center\">No Registered Merchant</div>";
							// $result .="<p class=\"right merch navbar-button\">Back</p> <div class=\"icon ion-ios-undo-outline icon-list-menu navbar-button right merch\"></div>";
							 $result.="</div></div>";
							$result.="<div class=\"column-right\">";

							 $result.="</div></li></ul></div>";
}
echo $result;
//echo $sql;
?>
