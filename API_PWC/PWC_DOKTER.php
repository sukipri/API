<?php
/*VIEW DATA SET SIMRS */
	/*COINFIG */
			include_once"../config/connec_01_srv.php";
				include"../secure/GR_01.php"; //security enggine
				 //include"sc/ID_IDF.php";  //Identifer ID PAGE
				//include"css.php";   //style and control title meta
       			 include"../sc/stack_Q.php"; //Query SQL
				  include"../sc/code_rand.php"; 
	//.........//
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
		
			$vpl01_sw = $ms_q("$call_sel TPelaku WHERE PelakuJenis2='2' order by RAND() ");
				$rows = $ms_nr($vpl01_sw);
				while($vpl01_sww = $ms_fas($vpl01_sw)){
					//echo"$vpl01_sww[PelakuNama]";
			
 	 	//..Listing content..//
		  $item[] = array(
		   "Kode_Dokter"=>$vpl01_sww["PelakuKode"],
		   "Nama_Dokter"=>$vpl01_sww["PelakuNama"],
		   "Spes_Kode"=>$vpl01_sww["SpesKode"]
		   
		  );
		}
			//..JSON..//
			 if($rows < 1){ 
		  $json = array(
  			 'result' => '404',
			 'response_code' => '14',
			'response_code_desc' => 'Tidak Ada Dokter '
			 ); 
			}elseif($rows  > 0){
			 $json = array(
			 'Kode_Dokter' => $item
			 ); 
			 
   						}else{
 			 $json = array(
  			 'result' => '404',
			 'response_code' => '96',
			'response_code_desc' => 'Error'
			 ); 
 					  }
			 $edata = json_encode($json);
			echo "$edata";
?>
