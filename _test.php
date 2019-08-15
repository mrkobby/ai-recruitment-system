<?php
include_once("_sys/db_connection.php");
$array1 = array('item1','item2','item3','item4','item5');
$array2 = array('item1','item4','item6','item7','item8','item9','item10');
$matches = array_intersect($array1,$array2);
$a = round(count($matches));
$b = count($array1);
$similarity = $a/$b*100;
echo $a;echo "<br />";
echo $b;echo "<br />";
echo 'SIMILARITY: ' . $similarity . '%';

echo "<br /><br /><br />";
echo "================= SKILL SIMILARITY  =====================";
echo "<br /><br /><br />";

$array_1 = array();
$array_2 = array();
$sql = "SELECT skill_set_name FROM job_post_skill_set";
$query = mysqli_query($db_connection, $sql);
while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
	array_push($array_1, $row["skill_set_name"]);
}
$sql2 = "SELECT skill_set_name FROM seeker_skill_set";
$query2 = mysqli_query($db_connection, $sql2);
while ($row = mysqli_fetch_array($query2, MYSQLI_ASSOC)) {
	array_push($array_2, $row["skill_set_name"]);
}

$matches_2 = array_intersect($array_1,$array_2);
$a2 = round(count($matches_2));
$b2 = count($array_1);
$c2 = count($array_2);
$similarity2 = $a2/$b2*60;
echo 'matches: ' . $a2 . '';
echo "<br />";
echo 'job_post_skill_set: ' . $b2 . '';
echo "<br />";
echo 'seeker_skill_set: ' . $c2 . '';
echo "<br />";
echo 'SIMILARITY: ' . $similarity2 . '%';
echo "<br />";
echo "=================   =====================";
$a1=array("red","orange","blue","yellow");
$a2=array("pink","green","blue");
$result=array_intersect($a1,$a2);
foreach($result as $row){
      echo $row."<br>";
}
print_r($result);
echo "<br />";
echo "=================   =====================";
echo "<br />";
$a=array(5,5,25,);
$rr = array_sum($a);
echo $rr;
echo "<br /><br /><br />";
echo "================= DEGREE SIMILARITY  =====================";
echo "<br /><br /><br />";

$array_3 = array();$array_4 = array();
$sql3 = "SELECT certificate_degree_name FROM education_detail";
$query3 = mysqli_query($db_connection, $sql3);
while ($row = mysqli_fetch_array($query3, MYSQLI_ASSOC)) {
	array_push($array_3, $row["certificate_degree_name"]);
}
$sql4 = "SELECT qualification FROM job_post";
$query4 = mysqli_query($db_connection, $sql4);
while ($row = mysqli_fetch_array($query4, MYSQLI_ASSOC)) {
	array_push($array_4, $row["qualification"]);
}
$matches_3 = array_intersect($array_3,$array_4);
$a3= round(count($matches_3));
echo 'SIMILARITY: ' . $a3 .'';

echo "<br /><br /><br />";
echo "================= DATE DIFFERENCE  =====================";
echo "<br /><br /><br />";

$date1 = "2007-03-24";
$date2 = "2009-06-26";

$diff = abs(strtotime($date2) - strtotime($date1));

$years = floor($diff / (365*60*60*24));
$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

printf("%d years, %d months, %d days\n", $years, $months, $days);
?>