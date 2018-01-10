<?php require "config.php"; function semester($smt){switch($smt){case '1':$s="I (Satu)";break;case '2':$s="II (Dua)"; break;case '3':$s="III (Tiga)";break;case '4':$s="IV (Empat)";break;case '5':$s="V (Lima)";break;case '6':$s="VI (Enam)";break;case '7':$s="VII (Tujuh)";break;case '8':$s="VIII (Delapan)";break;case '9':$s="IX (Sembilan)";break;case '10':$s="X (Sepuluh)";break;case '11':$s="XI (Sebelas)";break;case '12':$s="XII (Dua Belas)";break;case '13':$s="XIII (Tiga Belas)";break;case '14':$s="XIV (Empat Belas)";break;case '15':$s="XV (Lima Belas)";break;case '16':$s="XVI (Enam Belas)";break;case '17':$s="XVII (Tujuh Belas)";break;case '18':$s="XVIII (Delapan Belas)";break;case '19':$s="XIX (Sembilan Belas)";break;case '20':$s="XX (Dua Puluh)";break;case '21':$s="XXI (Dua Puluh Satu)";break;case '22':$s="XXII (Dua Puluh Dua)";break;}return $s;} function generate_password($digit){$val=rand(1,1000);$str=substr(md5($val),0,$digit);return $str;} function telepon($nomer){$cnomer=str_split(trim($nomer));switch($cnomer[0]){case '0':$resnomer="+62";for($i=1;$i<=count($cnomer);$i++)$resnomer.=$cnomer[$i];return $resnomer;break;case '+':return trim($nomer);break;case '6':return "+".trim($nomer);break;default :return "+62".trim($nomer);break;}} function terbilang($x){$abil=array("","satu","dua","tiga","empat","lima","enam","tujuh","delapan","sembilan","sepuluh","sebelas");if($x<12)return " ".$abil[$x];elseif($x<20)return terbilang($x-10)."belas";elseif($x<100)return terbilang($x/10)." puluh".terbilang($x%10);elseif($x<200)return " seratus".terbilang($x-100);elseif($x<1000)return terbilang($x/100)." ratus".terbilang($x%100);elseif($x<2000)return " seribu".terbilang($x-1000);elseif($x<1000000)return terbilang($x/1000)." ribu".terbilang($x%1000);elseif($x<1000000000)return terbilang($x/1000000)." juta".terbilang($x%1000000);elseif($x<1000000000000)return terbilang($x/1000000000)." milyar".terbilang($x%1000000000);} function nama_hari($hari){switch($hari){case '1':$day="Senin";break;case '2':$day="Selasa";break;case '3':$day="Rabu";break;case '4':$day="Kamis";break;case '5':$day="Jumat";break;case '6':$day="Sabtu";break;case '7':$day="Minggu";break;}return $day;} function send_mail($fromUser,$fromEmail,$toUser,$toEmail,$subject,$message){$headers='MIME-Version: 1.0' . "\r\n";$headers.='Content-type: text/html; charset=iso-8859-1' . "\r\n";$headers.='To: '.$toUser.' <'.$toEmail.'>' . "\r\n";$headers.='From: '.$fromUser.' <'.$fromEmail.'>' . "\r\n";mail($toEmail,$subject,$message,$headers);} function icon_mime($extension){switch(strtolower($extension)){case "doc":$icon="globals/icon/doc.gif";break;case "docx":$icon="globals/icon/doc.gif";break;case "pdf":$icon="globals/icon/pdf.gif";break;case "ppt":$icon="globals/icon/ppt.gif";break;case "pps":$icon="globals/icon/ppt.gif";break;case "xls":$icon="globals/icon/xls.gif";break;case "xlsx":$icon="globals/icon/xls.gif";break;case "zip":$icon="globals/icon/zip.gif";break;case "rar":$icon="globals/icon/rar.gif";break;case "swf":$icon="globals/icon/swf.gif";break;case "gif":$icon="globals/icon/pic.gif";break;case "jpg":$icon="globals/icon/pic.gif";break;case "jpeg":$icon="globals/icon/pic.gif";break;case "png":$icon="globals/icon/pic.gif";break;case "txt":$icon="globals/icon/txt.gif";break;case "sql":$icon="globals/icon/txt.gif";break;case "php":$icon="globals/icon/txt.gif";break;case "flv":$icon="globals/icon/vid.gif";break;case "mp4":$icon="globals/icon/vid.gif";break;default :$icon="globals/icon/unknown.gif";break;}return $icon;} function read_file($Dir){$files=null;if(file_exists($Dir)){if($handle=opendir($Dir)){$i=0;while(false!==($file=readdir($handle))){if($file!="."&&$file!=".."&&$file!=""){$files[$i]=$file;}$i++;}closedir($handle);}}else{echo "Folder atau File <b>$Dir</b> tidak ada.";}return $files;} function resize_image($srcImg,$ratio,$type){if(file_exists($srcImg)){list($w,$h)=getimagesize($srcImg);createImage($srcImg,"temp",$type,$w*$ratio,$h*$ratio);unlink($srcImg);createImage("temp",$srcImg,$type,$w*$ratio,$h*$ratio);unlink("temp");}else{echo "Gambar tidak ada";}} function merge_image($srcAwal,$srcInsert,$Result,$type,$wResult,$hResult){$awal=imagecreatefromstring(file_get_contents($srcAwal));$insert=imagecreatefromstring(file_get_contents($srcInsert));imagecopymerge($awal,$insert,0,0,0,0,$wResult,$hResult,100);switch($type){case "gif":imagegif($awal,$Result);break;case "jpg":imagejpeg($awal,$Result);break;case "png":imagepng($awal,$Result);break;default :imagegif($awal,$Result);break;}} function create_image($Source,$Result,$type,$wResult,$hResult){list($width,$height)=getimagesize($Source);$asli=imagecreatefromstring(file_get_contents($Source));$hasil=imagecreatetruecolor($wResult,$hResult);imagecopyresized($hasil,$asli,0,0,0,0,$wResult,$hResult,$width,$height);switch($type){case "gif":imagegif($hasil,$Result);break;case "jpg":imagejpeg($hasil,$Result);break;case "jpg":imagepng($hasil,$Result);break;default :imagegif($hasil,$Result);break;}} function is_mobile(){return preg_match("/(android|blackberry|bolt|boost|docomo|fone|mini|mobi|palm|phone|tablet|up\.browser|up\.link|webos|wos)/i",$_SERVER["HTTP_USER_AGENT"]);} function ticket($String){$tick=uniqid();$len=strlen($tick)/2;$words=str_split($tick);$res="";for($i=$len;$i<strlen($tick);$i++){$res.=$words[$i];}return $String.$res;} function encrypt_md5($Pass){$ssaP=strrev($Pass);return md5($ssaP);} function search_day($Date){$qDay="SELECT DAYNAME('$Date')";$hqDay=mysql_query($qDay);list($Day)=mysql_fetch_row($hqDay);switch($Day){case 'Sunday':$Hari="Minggu";break;case 'Monday':$Hari="Senin";	break;case 'Tuesday':$Hari="Selasa";break;case 'Wednesday':$Hari="Rabu";break;case 'Thursday':$Hari="Kamis";break;case 'Friday':$Hari="Jum'at";break;case 'Saturday':$Hari="Sabtu";break;default :$Hari=$Day;break;}return $Hari;} function greeting(){$Jam=date("H");switch($Jam){case "00":case "01":case "02":case "03":case "04":case "05":case "06":	case "07":case "08":case "09":case "10":case "11":case "12":$Salam	="Pagi";break;case "13":case "14":case "15":$Salam="Siang";	break;case "16":case "17":case "18":$Salam="Sore";break;case "19":case "20":case "21":case "22":case "23":$Salam="Malam";break;}return($Salam);} function explode_date_time($Tgl){$ArrayTanggal=explode("/",$Tgl);$Tanggal=$ArrayTanggal[2]."-".$ArrayTanggal[1]."-".$ArrayTanggal[0]." ".date("h:i:s");return($Tanggal);} function flip_date($Tgl){	$ArrayTanggal=explode("/",$Tgl);$Tanggal=$ArrayTanggal[2]."-".$ArrayTanggal[1]."-".$ArrayTanggal[0];return($Tanggal);} function implode_date_time($Tgl){$pos=strpos($Tgl,'/');if($pos===false){$Year=substr($Tgl,0,4);$Month=substr($Tgl,5,2);$Date=substr($Tgl,8,2);$Jam=substr($Tgl,11,8);$Tanggal=$Date."/".$Month."/".$Year." ".$Jam;}else{$Tanggal=$Tgl;}if($Tanggal=='//'){$Tanggal='';}return($Tanggal);} function is_leap_year($Thn){$LeapY=$Thn%4;if($LeapY==0){return(true);}else{return(false);}} function last_day($Bln,$Thn){switch($Bln){case "1":case "3":case "5":case "7":case "8":case "10":case "12":$Tanggal=31;break;case "2":if(IsLeapYear($Thn)){$Tanggal=29;}else{$Tanggal=28;}break;case "4":case "6":case "9":case "11":$Tanggal=30;break;}return($Tanggal);} function last_days($Month,$Year){static $lasts=array(false,31,28,31,30,31,30,31,31,30,31,30,31);if($Month<01||$Month>12){return (false);}if($Month==02){if(checkdate(2,29,$Year)){return (29);}return(28);}return($lasts[$Month]);} function report_date($Tgl){$Year=substr($Tgl,0,4);	$Month=substr($Tgl,5,2);$Date=substr($Tgl,8,2);switch($Month){case "01":$Month="Januari";		break;case "02":$Month="Februari";break;case "03":$Month="Maret";break;case "04":$Month="April";break;case "05":	$Month="Mei";break;case "06":$Month="Juni";break;case "07":$Month="Juli";break;case "08":$Month="Agustus";break;	case "09":$Month="September";break;case "10":$Month="Oktober";break;case "11":$Month="November";break;case "12":	$Month="Desember";break;}$Tanggal=$Date." ".$Month." ".$Year;return($Tanggal);} function report_date_time($Tgl){$Year=substr($Tgl,0,4);$Month=substr($Tgl,5,2);$Date=substr($Tgl,8,2);$Hour=substr($Tgl,11,2);$Minute=substr($Tgl,14,2);$Second=substr($Tgl,17,2);switch($Month){case "01":$Month="Januari";break;case "02":$Month="Febuari";break;case "03":$Month="Maret";break;case "04":$Month="April";break;case "05":$Month="Mei";break;case "06":$Month="Juni";break;case "07":$Month="Juli";break;case "08":$Month="Agustus";break;case "09":$Month="September";break;case "10":$Month="Oktober";break;case "11":$Month="November";break;case "12":$Month="Desember";break;}$Tanggal=$Date." ".$Month." ".$Year."  ".$Hour.":".$Minute.":".$Second;return($Tanggal);} function convert_date_time($Before){$datetime=explode(" ",$Before);$date_elements=explode("-",$datetime[0]);$time_elements=explode(":",$datetime[1]);$After=mktime($time_elements[0],$time_elements[1],$time_elements[2],$date_elements[1],$date_elements[2],$date_elements[0]);return($After);} function decode_date($Before){$datetime=explode(" ",$Before);$date_elements=explode("-",$datetime[0]);return($date_elements);} function date_diff2($interval,$datefrom,$dateto,$using_timestamps=false){if(!$using_timestamps){$datefrom=strtotime($datefrom,0);$dateto=strtotime($dateto,0);}$difference=$dateto-$datefrom;switch($interval){case 'yyyy':$years_difference=floor($difference /31536000);if(mktime(date("H",$datefrom),date("i",$datefrom),date("s",$datefrom),date("n",$datefrom),date("j",$datefrom),date("Y",$datefrom)+$years_difference)>$dateto){$years_difference--;}if(mktime(date("H",$dateto),date("i",$dateto),date("s",$dateto),date("n",$dateto),date("j",$dateto),date("Y",$dateto)-($years_difference+1))>$datefrom){$years_difference++;}$datediff=$years_difference;break;case "q":$quarters_difference=floor($difference/8035200);while(mktime(date("H",$datefrom),date("i",$datefrom),date("s",$datefrom),date("n",$datefrom)+($quarters_difference*3),date("j",$dateto),date("Y",$datefrom))<$dateto){	$months_difference++;}$quarters_difference--;$datediff=$quarters_difference;break;case "m":$months_difference=floor($difference/2678400);while(mktime(date("H",$datefrom),date("i",$datefrom),date("s",$datefrom),date("n",$datefrom)+($months_difference),date("j",$dateto),date("Y",$datefrom))<$dateto){$months_difference++;}$months_difference--;	$datediff=$months_difference;break;case 'y':$datediff=date("z",$dateto)-date("z",$datefrom);break;case "d":$datediff=floor($difference/86400);break;case "w":$days_difference=floor($difference/86400);$weeks_difference=floor($days_difference/7);$first_day=date("w",$datefrom);$days_remainder=floor($days_difference%7);$odd_days=$first_day+$days_remainder;if($odd_days>7){$days_remainder--;}if($odd_days>6){$days_remainder--;}$datediff=($weeks_difference*5)+$days_remainder;break;case "ww":$datediff=floor($difference/604800);break;case "h":$datediff=floor($difference/3600);break;case "n":$datediff=floor($difference/60);break;default:$datediff=$difference;break;}return $datediff;} function cek_null($DateValue){if(($DateValue<>'0000-00-00')and(isset($DateValue))){return true;}else{return false;}} function date_add2($v,$d=null,$f="d/m/Y"){$d=($d?$d:date("Y-m-d"));return date($f,strtotime($v." days",strtotime($d)));} function get_time($date){return substr($date,11);} function cut_time($Time,$Format="hm"){$Hour=substr($Time,0,2);$Minute	=substr($Time,3,2);$Second	=substr($Time,6,2);switch($Format){case 'h':$rTime=$Hour;break;case 'm':$rTime=$Minute;break;case 's':$rTime=$Second;break;case 'hm':$rTime=$Hour.":".$Minute;break;case 'ms':$rTime=$Minute.":".$Second;break;default :$rTime=$Time;break;}return $rTime;} function cut_string($Strings,$Length){$str=explode(" ",$Strings);$str_r	="";for($i=0;$i<$Length;$i++){$str_r.=$str[$i]." ";}return $str_r;} function explode_time($Strings){$str=explode(":",$Strings);$str_r="";for($i=0;$i<2;$i++){$str_r.=$str[$i];if($i<1)$str_r.=":";}return $str_r;} function key_seo($Keyword,$Len){$avoid=array(",",".","'","/","\\","\\\\","\"","-","=");$Key=str_replace($avoid,"",$Keyword);$raw=explode(" ",$Key);$rawKata="";for($i=0;$i<count($raw);$i++){if(trim($raw[$i])!=""){$rawKata.=$raw[$i]." ";}}	$Kata=str_replace(" ","-",trim($rawKata));$Words=explode("-",$Kata);$seo="";$Length=count($Words);if($Length>$Len){	for($i=0;$i<$Len;$i++){	if($i<($Len-1))$seo.=$Words[$i]."-";else $seo.=$Words[$i];}}else{for($i=0;$i<$Length;$i++){	if($i<($Length-1))$seo.=$Words[$i]."-";else $seo.=$Words[$i];}}return $seo;} function cek_file_exists($path, $base_url, $call_back){$path_info = parse_path();$component=$path_info['call_parts'][0];$action=$path_info['call_parts'][1];if(file_exists($path)){return include($path);}else{echo "<meta http-equiv='refresh' content='url=0; $base_url$call_back' />";}} function parse_path(){error_reporting(E_ALL^E_NOTICE);$path=array();if(isset($_SERVER['REQUEST_URI'])){$request_path=explode('?',$_SERVER['REQUEST_URI']);$path['base']=rtrim(dirname($_SERVER['SCRIPT_NAME']), '\/');$path['call_utf8']=substr(urldecode($request_path[0]),strlen($path['base'])+1);$path['call']=utf8_decode($path['call_utf8']);if($path['call']==basename($_SERVER['PHP_SELF'])){$path['call']='';}$path['call_parts']=explode('/', $path['call']);$path['query_utf8']=urldecode($request_path[1]);$path['query']=utf8_decode(urldecode($request_path[1]));$vars=explode('&',$path['query']);foreach($vars as $var){$t=explode('=',$var);$path['query_vars'][$t[0]] = $t[1];}}	return $path;} 
function throw_url($path, $base_url){
	$path_info = parse_path();

	$module		= "$path/";
	$action		= $path_info['call_parts'][1];
	
	if(empty($action) || $action == ''){
		$link = "modules/$module/components/default/main.php";
	}else{
		$link = "modules/$module/components/default/$action.php";
	}
	
	return cek_file_exists($link, $base_url, "error.php");
} 
function clear_url($url){$name=str_replace(' ','.',$url);	$name=str_replace(',','',$name);$name=str_replace('?','',$name);$name=str_replace('/','',$name);return $name;} function number_pad($number,$n){return str_pad((int) $number,$n,"0",STR_PAD_LEFT);}function search_multiple($field,$opf='|',$keys,$opk='&'){$fields=explode(' ',trim($field));$kata=explode(' ',trim($keys));$res='';$f=count($fields);$x=count($kata);$n=1;foreach($fields as $fie){if($fie!=''){$i=1;$res.=" ( ";foreach($kata as $a){if($a!=''){$res.=" $fie LIKE '%$a%' ";if($i<$x)$res.=($opk=='|')?" OR ":" AND ";}$i++;}$res.=" ) ";if($n<$f){$res.=($opf=='|')?" OR ":" AND ";}}$n++;}return $res;} function highlight_multiple($str,$keys){$kata=explode(' ',trim($keys));$resf=$str;foreach($kata as $k){$chString=str_split($resf);$lenKey=strlen($k);$res=$chString;for($i=0;$i<count($chString);$i++){$strKey='';for($a=$i;$a<($i+$lenKey);$a++){$strKey.=$chString[$a];}if(strtolower($strKey)==strtolower($k)){for($b=$i;$b<($i+$lenKey);$b++){$res[$b]="<b style='color:blue;'><i>".$chString[$b]."</i></b>";}}}$resf=implode("",$res);}return $resf;}

function akses($crud){
	$stats = false;
	switch(strtoupper($crud)){
		case 'C' : $stats = (substr($_SESSION['s_accessMenu'],0,1)=='1') ? true : false; break;
		case 'R' : $stats = (substr($_SESSION['s_accessMenu'],1,1)=='1') ? true : false; break;
		case 'U' : $stats = (substr($_SESSION['s_accessMenu'],2,1)=='1') ? true : false; break;
		case 'D' : $stats = (substr($_SESSION['s_accessMenu'],3,1)=='1') ? true : false; break;
		case 'CR':
		case 'RC': $stats = (substr($_SESSION['s_accessMenu'],0,1)=='1' && substr($_SESSION['s_accessMenu'],1,1)=='1') ? true : false; break;
		case 'CRU' :
		case 'RUC' :
		case 'UCR' : $stats = (substr($_SESSION['s_accessMenu'],0,1)=='1' && substr($_SESSION['s_accessMenu'],1,1)=='1' && substr($_SESSION['s_accessMenu'],2,1)=='1') ? true : false; break;
		case 'CRUD' :
		case 'DCRU' :
		case 'UDCR' :
		case 'RUDC' : $stats = (substr($_SESSION['s_accessMenu'],0,1)=='1' && substr($_SESSION['s_accessMenu'],1,1)=='1' && substr($_SESSION['s_accessMenu'],2,1)=='1' && substr($_SESSION['s_accessMenu'],3,1)=='1') ? true : false; break;
	}
	return $stats;
}

function keygen($length=10){
	$key = ''; 
	list($usec, $sec) = explode(' ', microtime()); 
	mt_srand((float) $sec + ((float) $usec * 100000)); 
	$inputs = array_merge(range('z','a'), range(0,9), range('A','Z')); 
	for($i=0; $i<$length; $i++){
		$key .= $inputs{ mt_rand(0,61) }; 
	} 
	return $key;
}

function highlight($String,$Keyword){
	error_reporting(E_ALL^E_NOTICE);
	if($Keyword==null){
		return $String;
	}else{
		$chString=str_split($String);
		$lenKey=strlen($Keyword);
		$strResult=$chString;
		for($i=0;$i<count($chString);$i++){
			$strKey="";
			for($a=$i;$a<($i+$lenKey);$a++){
				$strKey.=$chString[$a];
			}
			if(strtolower($strKey)==strtolower($Keyword)){
				for($b=$i;$b<($i+$lenKey);$b++){		
					$strResult[$b]="<b style='color:blue;'><i>".$chString[$b]."</i></b>";
				}
			}
		}
		return implode("",$strResult);
	}
}

function replace_coma_of_number($number){
	$number = str_replace(',', '', $number);
	// $number = str_replace(',', '.', $number);
	return $number;
}

function replace_dot_of_number($number){
	$number = str_replace('.', '', $number);
	$number = str_replace(',', '.', $number);
	return $number;
}

function replace_dot_to_coma($number){
	$number = str_replace('.', ',', $number);
	return $number;
}

function replace_coma_to_dot($number){
	$number = str_replace(',', '.', $number);

	$cek = explode('.', $number);
	if($cek[0] == '') $number = '0.00';
	elseif($cek[0] != '' && $cek[1] == '') $number .= '00';

	return $number;
}

function implode_date($Tgl){
	$pos=strpos($Tgl,'/');
	if($pos===false){
		$Year=substr($Tgl,0,4);
		$Month=substr($Tgl,5,2);
		$Date=substr($Tgl,8,2);
		$Tanggal=$Date."/".$Month."/".$Year;
	}else{
		$Tanggal=$Tgl;
	}
	if($Tanggal=='//'){
		$Tanggal='';
	}
	return($Tanggal);
}

function explode_date($Tgl){
	$ArrayTanggal=explode("/",$Tgl);
	$Tanggal=$ArrayTanggal[2]."-".$ArrayTanggal[1]."-".$ArrayTanggal[0]." 00:00:00";return($Tanggal);
}

function registrasi_acc($idTransaksi, $id_acc_Param){
	include "globals/config.php";
			
	$query_acc_transaksi = $db->prepare("SELECT id_acc, debit, kredit FROM _acc_transaksi WHERE id_jurnal = '$idTransaksi'");
	$query_acc_transaksi->execute();
	while($result_acc_transaksi = $query_acc_transaksi->fetch(PDO::FETCH_ASSOC)){
		$queryInduk = $db->prepare("SELECT A1.id_acc AS ACC1, A1.level AS ACCL1, A2.id_acc AS ACC2, A2.level AS ACCL2, A3.id_acc AS ACC3, A3.level AS ACCL3, A4.id_acc AS ACC4, A4.level AS ACCL4, A5.id_acc AS ACC5, A5.level AS ACCL5, A6.id_acc AS ACC6, A6.level AS ACCL6 FROM _acc AS A1 LEFT JOIN _acc AS A2 ON(A1.id_acc_parent = A2.id_acc) LEFT JOIN _acc AS A3 ON(A2.id_acc_parent = A3.id_acc) LEFT JOIN _acc AS A4 ON(A3.id_acc_parent = A4.id_acc) LEFT JOIN _acc AS A5 ON(A4.id_acc_parent = A5.id_acc) LEFT JOIN _acc AS A6 ON(A5.id_acc_parent = A6.id_acc) WHERE A1.id_acc = '$id_acc_Param'");
		$queryInduk->execute();
		list($ACC1, $ACCL1, $ACC2, $ACCL2, $ACC3, $ACCL3, $ACC4, $ACCL4, $ACC5, $ACCL5, $ACC6, $ACCL6) = $queryInduk->fetch(PDO::FETCH_NUM);
		
		# 1.
		$queryACC1 = $db->prepare("SELECT id_acc FROM _acc_registrasi WHERE id_acc = '$ACC1'"); 
		$queryACC1->execute(); 
		$jumACC1 = $queryACC1->rowCount();
		
		$fieldACC1 = "kredit";
		$valueFieldACC1 = $result_acc_transaksi['kredit'];
		if($result_acc_transaksi['debit'] > 0){
			$fieldACC1 = "debit";
			$valueFieldACC1 = $result_acc_transaksi['debit'];
		}
		
		if($jumACC1 == 0){
			$db->prepare("INSERT INTO _acc_registrasi(periode, id_acc, level, $fieldACC1) VALUES('".date("ym")."', '$ACC1', '$ACCL1', '$valueFieldACC1')")->execute();
		}else{
			$db->prepare("UPDATE _acc_registrasi SET $fieldACC1 = $fieldACC1 + '$valueFieldACC1' WHERE id_acc = '$ACC1' AND periode = '".date("ym")."'")->execute();
		}
		# 1.
	}
	
	// return $x;
		
	# 2.
	$qGetJumAcc2 = $db->prepare("SELECT SUM(debit), SUM(kredit) FROM _acc_registrasi WHERE id_acc = '$ACC1'");
	$qGetJumAcc2->execute();
	list($SumDebit2, $SumKredit2) = $qGetJumAcc2->fetch(PDO::FETCH_NUM);
	
	$queryACC2 = $db->prepare("SELECT id_acc FROM _acc_registrasi WHERE id_acc = '$ACC2'"); 
	$queryACC2->execute(); 
	$jumACC2 = $queryACC2->rowCount();
	
	if($ACC2 != ''){
		if($jumACC2 == 0){
			$db->prepare("INSERT INTO _acc_registrasi(periode, id_acc, level, $fieldACC1) VALUES('".date("ym")."', '$ACC2', '$ACCL2', '$valueFieldACC1')")->execute();
		}else{
			$db->prepare("UPDATE _acc_registrasi SET $fieldACC1 = $fieldACC1 + '$valueFieldACC1' WHERE id_acc = '$ACC2' AND periode = '".date("ym")."'")->execute();
		}
	}
	# 2.
	
	# 3.
	$qGetJumAcc3 = $db->prepare("SELECT SUM(debit), SUM(kredit) FROM _acc_registrasi WHERE id_acc = '$ACC2'");
	$qGetJumAcc3->execute();
	list($SumDebit3, $SumKredit3) = $qGetJumAcc3->fetch(PDO::FETCH_NUM);
	
	$queryACC3 = $db->prepare("SELECT id_acc FROM _acc_registrasi WHERE id_acc = '$ACC3'"); 
	$queryACC3->execute(); 
	$jumACC3 = $queryACC3->rowCount();
	
	if($ACC3 != ''){
		if($jumACC3 == 0){
			$db->prepare("INSERT INTO _acc_registrasi(periode, id_acc, level, $fieldACC1) VALUES('".date("ym")."', '$ACC3', '$ACCL3', '$valueFieldACC1')")->execute();
		}else{
			$db->prepare("UPDATE _acc_registrasi SET $fieldACC1 = $fieldACC1 + '$valueFieldACC1' WHERE id_acc = '$ACC3' AND periode = '".date("ym")."'")->execute();
		}
	}
	# 3.
	
	# 4.
	$qGetJumAcc4 = $db->prepare("SELECT SUM(debit), SUM(kredit) FROM _acc_registrasi WHERE id_acc = '$ACC3'");
	$qGetJumAcc4->execute();
	list($SumDebit4, $SumKredit4) = $qGetJumAcc4->fetch(PDO::FETCH_NUM);
	
	$queryACC4 = $db->prepare("SELECT id_acc FROM _acc_registrasi WHERE id_acc = '$ACC4'"); 
	$queryACC4->execute(); 
	$jumACC4 = $queryACC4->rowCount();
	
	if($ACC4 != ''){
		if($jumACC4 == 0){
			$db->prepare("INSERT INTO _acc_registrasi(periode, id_acc, level, $fieldACC1) VALUES('".date("ym")."', '$ACC4', '$ACCL4', '$valueFieldACC1')")->execute();
		}else{
			$db->prepare("UPDATE _acc_registrasi SET $fieldACC1 = $fieldACC1 + '$valueFieldACC1' WHERE id_acc = '$ACC4' AND periode = '".date("ym")."'")->execute();
		}
	}
	# 4.
	
	# 5.
	$qGetJumAcc5 = $db->prepare("SELECT SUM(debit), SUM(kredit) FROM _acc_registrasi WHERE id_acc = '$ACC4'");
	$qGetJumAcc5->execute();
	list($SumDebit5, $SumKredit5) = $qGetJumAcc5->fetch(PDO::FETCH_NUM);
	
	$queryACC5 = $db->prepare("SELECT id_acc FROM _acc_registrasi WHERE id_acc = '$ACC5'"); 
	$queryACC5->execute(); 
	$jumACC5 = $queryACC5->rowCount();
	
	if($ACC5 != ''){
		if($jumACC5 == 0){
			$db->prepare("INSERT INTO _acc_registrasi(periode, id_acc, level, $fieldACC1) VALUES('".date("ym")."', '$ACC5', '$ACCL5', '$valueFieldACC1')")->execute();
		}else{
			$db->prepare("UPDATE _acc_registrasi SET $fieldACC1 = $fieldACC1 + '$valueFieldACC1' WHERE id_acc = '$ACC5' AND periode = '".date("ym")."'")->execute();
		}
	}
	# 5.
	
	# 6
	$qGetJumAcc6 = $db->prepare("SELECT SUM(debit), SUM(kredit) FROM _acc_registrasi WHERE id_acc = '$ACC5'");
	$qGetJumAcc6->execute();
	list($SumDebit6, $SumKredit6) = $qGetJumAcc6->fetch(PDO::FETCH_NUM);
	
	$queryACC6 = $db->prepare("SELECT id_acc FROM _acc_registrasi WHERE id_acc = '$ACC6'"); 
	$queryACC6->execute(); 
	$jumACC6 = $queryACC6->rowCount();
	
	if($SumDebit6 > 0 || $SumKredit6 > 0){
		if($jumACC6 == 0){
			$db->prepare("INSERT INTO _acc_registrasi(periode, id_acc, level, $fieldACC1) VALUES('".date("ym")."', '$ACC6', '$ACCL6', '$valueFieldACC1')")->execute();
		}else{
			$db->prepare("UPDATE _acc_registrasi SET $fieldACC1 = $fieldACC1 + '$valueFieldACC1' WHERE id_acc = '$ACC6' AND periode = '".date("ym")."'")->execute();
		}
	}
	# 6
}

function registrasi_acc_edit($idTransaksi, $id_acc_Param){
	include "globals/config.php";
			
	$query_acc_transaksi = $db->prepare("SELECT id_acc, debit, kredit FROM _acc_transaksi WHERE id_jurnal = '$idTransaksi'");
	$query_acc_transaksi->execute();
	while($result_acc_transaksi = $query_acc_transaksi->fetch(PDO::FETCH_ASSOC)){
		$queryInduk = $db->prepare("SELECT A1.id_acc AS ACC1, A1.level AS ACCL1, A2.id_acc AS ACC2, A2.level AS ACCL2, A3.id_acc AS ACC3, A3.level AS ACCL3, A4.id_acc AS ACC4, A4.level AS ACCL4, A5.id_acc AS ACC5, A5.level AS ACCL5, A6.id_acc AS ACC6, A6.level AS ACCL6 FROM _acc AS A1 LEFT JOIN _acc AS A2 ON(A1.id_acc_parent = A2.id_acc) LEFT JOIN _acc AS A3 ON(A2.id_acc_parent = A3.id_acc) LEFT JOIN _acc AS A4 ON(A3.id_acc_parent = A4.id_acc) LEFT JOIN _acc AS A5 ON(A4.id_acc_parent = A5.id_acc) LEFT JOIN _acc AS A6 ON(A5.id_acc_parent = A6.id_acc) WHERE A1.id_acc = '$id_acc_Param'");
		$queryInduk->execute();
		list($ACC1, $ACCL1, $ACC2, $ACCL2, $ACC3, $ACCL3, $ACC4, $ACCL4, $ACC5, $ACCL5, $ACC6, $ACCL6) = $queryInduk->fetch(PDO::FETCH_NUM);
		
		$fieldACC1 = "kredit";
		$valueFieldACC1 = $result_acc_transaksi['kredit'];
		if($result_acc_transaksi['debit'] > 0){
			$fieldACC1 = "debit";
			$valueFieldACC1 = $result_acc_transaksi['debit'];
		}
		
		$db->prepare("UPDATE _acc_registrasi SET $fieldACC1 = $fieldACC1 - '$valueFieldACC1' WHERE id_acc = '$ACC1' AND periode = '".date("ym")."'")->execute();
	}
	
	if($ACC2 != ''){
		$db->prepare("UPDATE _acc_registrasi SET $fieldACC1 = $fieldACC1 - '$valueFieldACC1' WHERE id_acc = '$ACC2' AND periode = '".date("ym")."'")->execute();
	}
	
	if($ACC3 != ''){
		$db->prepare("UPDATE _acc_registrasi SET $fieldACC1 = $fieldACC1 - '$valueFieldACC1' WHERE id_acc = '$ACC3' AND periode = '".date("ym")."'")->execute();
	}
	
	if($ACC4 != ''){
		$db->prepare("UPDATE _acc_registrasi SET $fieldACC1 = $fieldACC1 - '$valueFieldACC1' WHERE id_acc = '$ACC4' AND periode = '".date("ym")."'")->execute();
	}
	
	if($ACC5 != ''){
		$db->prepare("UPDATE _acc_registrasi SET $fieldACC1 = $fieldACC1 - '$valueFieldACC1' WHERE id_acc = '$ACC5' AND periode = '".date("ym")."'")->execute();
	}
	
	if($ACC6 != ''){
		$db->prepare("UPDATE _acc_registrasi SET $fieldACC1 = $fieldACC1 - '$valueFieldACC1' WHERE id_acc = '$ACC6' AND periode = '".date("ym")."'")->execute();
	}
}

function namaAcc($id_acc){
	include "globals/config.php";
	
	$queryNama = $db->prepare("SELECT nama FROM _acc WHERE id_acc = '$id_acc'");
	$queryNama->execute();
	list($namaAcc) = $queryNama->fetch(PDO::FETCH_NUM);
	
	return $namaAcc;
}

function created_by($table, $id){
	include "globals/config.php";
	
	if($id != ''){
		$queryLogs = $db->prepare("SELECT action_by, action_date FROM _activity_logs WHERE `table` = '$table' AND id_trans = '$id' ORDER BY id DESC");
		$queryLogs->execute();
		list($action_by, $action_date) = $queryLogs->fetch(PDO::FETCH_NUM);
	}else{
		$action_by = $_SESSION['s_userAdmin'];
		$action_date = date("Y-m-d H:i");
	}

	$queryUser = $db->prepare("SELECT nama FROM _user WHERE id_user = '$action_by'");
	$queryUser->execute();
	list($namaUser) = $queryUser->fetch(PDO::FETCH_NUM);

	if($namaUser == '') $namaUser = '-';
	$action_date_view = implode_date($action_date).' '.substr($action_date,-8);
	if($action_date == '') $action_date_view = '-';
	
	$html = '';
	$html .= '<div class="row">';
	$html .= '	<div class="col-xs-9 col-sm-9">';
	$html .= '		<table width="50%" style="text-transform:capitalize;">';
	$html .= '			<tr>';
	$html .= '				<td>Dibuat oleh : <b>'.$namaUser.'</b></td>';
	$html .= '				<td>Tanggal : <b>'.$action_date_view.'</b></td>';
	$html .= '			</tr>';
	$html .= '		</div>';
	$html .= '	</div>';
	$html .= '</div>';

	return $html;
}

function SecretToken($user){
	$token = base64_encode(md5($user).encrypt_md5($user)).".".base64_encode(base64_encode($user));
	return $token;
}

function CekIdTransaction($table, $user, $dataID = null, $dataWhere = null, $sts = false){
	include "globals/config.php";

	/*
	if($dataID != null){
		return "ada";
	}
	*/

	$id1 = $dataID['id'][0];
	$id2 = $dataID['id'][1];
	$id3 = $dataID['id'][2];
	$id4 = $dataID['id'][3];

	if($sts == true){
		$id4 = number_pad($id4,4);
		$IdFormTransactionId = $id1."-".$id2."-".$id3."-".$id4;

		return $IdFormTransactionId;
	}

	// return $id1;

	# mengambil token
	$token = SecretToken($_SESSION['s_userAdmin']);

	# cek ketersediaan data di table _transaksi_id
	# dengan parameter $table dan $user

	$queryCekIdTransaction = $db->prepare("SELECT COUNT(*) FROM _transaksi_id WHERE table_transaksi = '$table' AND token = '$token'");
	$queryCekIdTransaction->execute();
	list($jumDataCekIdTransaction) = $queryCekIdTransaction->fetch(PDO::FETCH_NUM);

	# get Default parameter of ID

	if($jumDataCekIdTransaction == 0){
		
		# jika tidak ditemukan table dan token yang sama maka dihapus semua ID transaksi yang berhubungan dengan user tersebut.

		$db->prepare("DELETE FROM _transaksi_id WHERE token = '$token'")->execute();

		$queryGetIdFormRealTable = $db->prepare("SELECT SUBSTRING_INDEX(id_$table, '-', -1) AS id_$table FROM _$table WHERE SUBSTRING_INDEX(id_$table, '-', 3) = '$id1-$id2-$id3' $dataWhere ORDER BY SUBSTRING_INDEX(id_$table, '-', -1) DESC");
		$queryGetIdFormRealTable->execute();
		$jumGetIdFormRealTable = $queryGetIdFormRealTable->rowCount();
		list($LastIdTableTransaction) = $queryGetIdFormRealTable->fetch(PDO::FETCH_NUM);

		$queryCekIdTransaction = $db->prepare("SELECT SUBSTRING_INDEX(id_transaksi, '-', -1) FROM _transaksi_id WHERE SUBSTRING_INDEX(id_transaksi, '-', 3) = '$id1-$id2-$id3' AND table_transaksi = '$table' ORDER BY SUBSTRING_INDEX(id_transaksi, '-', -1) DESC");
		$queryCekIdTransaction->execute();
		$jumCekIdTransaction = $queryCekIdTransaction->rowCount();
		list($LastIdRealTable) = $queryCekIdTransaction->fetch(PDO::FETCH_NUM);

		$LastID = $LastIdTableTransaction;
		if($LastIdRealTable >= $LastID && $jumCekIdTransaction > 0) $LastID = $LastIdRealTable;

		$LastID++;

		$id4 = number_pad($LastID,4);
		$db->prepare("INSERT INTO _transaksi_id(id_transaksi, table_transaksi, tanggal, token) VALUES('$id1-$id2-$id3-$id4', '$table', NOW(), '$token')")->execute();
		
		$dataID['status'] = true;
		$dataID['id'][0] = $id1;
		$dataID['id'][1] = $id2;
		$dataID['id'][2] = $id3;
		$dataID['id'][3] = $id4;
		
		return CekIdTransaction($table, $user, $dataID, false, true);
	}else{

		$queryCekIdTransactionIsset = $db->prepare("SELECT COUNT(*) FROM _transaksi_id WHERE table_transaksi = '$table' AND token = '$token' AND SUBSTRING_INDEX(id_transaksi, '-', 3) = '$id1-$id2-$id3-$id4'");
		$queryCekIdTransactionIsset->execute();
		list($jumDataCekIdTransactionIsset) = $queryCekIdTransactionIsset->fetch(PDO::FETCH_NUM);

		if($jumDataCekIdTransactionIsset == 0){

			if(count($dataID['id'][3]) > 0){
				$id4 = $dataID['id'][3];

				$QcekTrasactExsist = $db->prepare("SELECT COUNT(*) FROM _transaksi_id WHERE id_transaksi = '$id1-$id2-$id3-$id4'");
				$QcekTrasactExsist->execute();
				list($cekTrasactExsist) = $QcekTrasactExsist->fetch(PDO::FETCH_NUM);

				$QcekTrasactExsistSelft = $db->prepare("SELECT COUNT(*) FROM _transaksi_id WHERE id_transaksi = '$id1-$id2-$id3-$id4' AND token = '$token'");
				$QcekTrasactExsistSelft->execute();
				list($cekTrasactExsistSelft) = $QcekTrasactExsistSelft->fetch(PDO::FETCH_NUM);

				$QcekTrasactExsistReal = $db->prepare("SELECT COUNT(*) FROM _$table WHERE id_$table = '$id1-$id2-$id3-$id4' $dataWhere");
				$QcekTrasactExsistReal->execute();
				list($cekTrasactExsistReal) = $QcekTrasactExsistReal->fetch(PDO::FETCH_NUM);

				if($cekTrasactExsistReal > 0) return false;

				if($cekTrasactExsist > 0 && $cekTrasactExsistSelft == 0){
					return false;
				}else{
					$db->prepare("UPDATE _transaksi_id SET id_transaksi = '$id1-$id2-$id3-$id4' WHERE table_transaksi = '$table' AND token = '$token'")->execute();
				}
			}else{
				$queryGetIdFormRealTable = $db->prepare("SELECT SUBSTRING_INDEX(id_$table, '-', -1) AS id_$table FROM _$table WHERE SUBSTRING_INDEX(id_$table, '-', 3) = '$id1-$id2-$id3' $dataWhere ORDER BY SUBSTRING_INDEX(id_$table, '-', -1) DESC");
				$queryGetIdFormRealTable->execute();
				$jumGetIdFormRealTable = $queryGetIdFormRealTable->rowCount();
				list($LastIdTableTransaction) = $queryGetIdFormRealTable->fetch(PDO::FETCH_NUM);

				$queryCekIdTransaction = $db->prepare("SELECT SUBSTRING_INDEX(id_transaksi, '-', -1) FROM _transaksi_id WHERE SUBSTRING_INDEX(id_transaksi, '-', 3) = '$id1-$id2-$id3' AND table_transaksi = '$table' ORDER BY SUBSTRING_INDEX(id_transaksi, '-', -1) DESC");
				$queryCekIdTransaction->execute();
				$jumCekIdTransaction = $queryCekIdTransaction->rowCount();
				list($LastIdRealTable) = $queryCekIdTransaction->fetch(PDO::FETCH_NUM);

				$LastID = $LastIdTableTransaction;
				if($LastIdRealTable >= $LastID && $jumCekIdTransaction > 0) $LastID = $LastIdRealTable;
				$LastID++;
				$id4 = number_pad($LastID,4);

				$QcekUserExsist = $db->prepare("SELECT COUNT(*) FROM _transaksi_id WHERE table_transaksi = '$table' AND token = '$token' AND SUBSTRING_INDEX(id_transaksi, '-', 3) = '$id1-$id2-$id3'");
				$QcekUserExsist->execute();
				list($cekUserExsist) = $QcekUserExsist->fetch(PDO::FETCH_NUM);
				
				if($cekUserExsist == 0){
					$db->prepare("UPDATE _transaksi_id SET id_transaksi = '$id1-$id2-$id3-$id4' WHERE table_transaksi = '$table' AND token = '$token'")->execute();
				}
			}
		}

		$queryCekIdTransactionSelf = $db->prepare("SELECT SUBSTRING_INDEX(id_transaksi, '-', -1) FROM _transaksi_id WHERE SUBSTRING_INDEX(id_transaksi, '-', 3) = '$id1-$id2-$id3' AND table_transaksi = '$table' AND token = '$token' ORDER BY SUBSTRING_INDEX(id_transaksi, '-', -1) DESC");
		$queryCekIdTransactionSelf->execute();
		list($LastIdRealTable) = $queryCekIdTransactionSelf->fetch(PDO::FETCH_NUM);

		if($LastIdRealTable == ''){
			$queryCekIdTransaction = $db->prepare("SELECT SUBSTRING_INDEX(id_transaksi, '-', -1) FROM _transaksi_id WHERE SUBSTRING_INDEX(id_transaksi, '-', 3) = '$id1-$id2-$id3' AND table_transaksi = '$table' ORDER BY SUBSTRING_INDEX(id_transaksi, '-', -1) DESC");
			$queryCekIdTransaction->execute();
			list($LastIdRealTable) = $queryCekIdTransaction->fetch(PDO::FETCH_NUM);
		}

		$LastID = $LastIdRealTable;
		$id4 = number_pad($LastID,4);
		$IdFormTransactionId = $id1."-".$id2."-".$id3."-".$id4;

		return $IdFormTransactionId;

	}
}

function checkFunctionalyTable(array $table = null, $id_transaksi){
	include "globals/config.php";

	$jumData = '';
	foreach($table as $namaTable => $idTableTransaksi){
		$queryTable = $db->prepare("SELECT COUNT(*) FROM $namaTable WHERE $idTableTransaksi = '$id_transaksi'");
		$queryTable->execute();
		list($jumTable) = $queryTable->fetch(PDO::FETCH_NUM);

		$jumData += $jumTable;
	}

	return $jumData;
}

function goFirstPositionButton($position, $data_count){
	if($position == 0){
		echo "<script>window.top.document.getElementById('btnPrevOnAdd').disabled=true;</script>";
	}else{
		echo "<script>window.top.document.getElementById('btnPrevOnAdd').disabled=false;</script>";
	}

	if($position == $data_count-1 || $data_count == 1 || $data_count == 0){
		echo "<script>window.top.document.getElementById('btnNextOnAdd').disabled=true;</script>";
	}else{
		echo "<script>window.top.document.getElementById('btnNextOnAdd').disabled=false;</script>";
	}
}

?>