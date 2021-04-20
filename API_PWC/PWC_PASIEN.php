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
        $NoRM = @$_GET['NoRM'];
        $vpsn01_sw = $ms_q("$sl PasienNomorRM,PasienNama,PasienGender,PasienTglLahir FROM TPasien WHERE PasienNomorRM='$NoRM' "); 
            $cp_vpsn01_sw = $ms_nr($vpsn01_sw);
            while($vpsn01_sww = $ms_fas($vpsn01_sw)){
                $Pasien[] = array(
                    "NoRM"=>$vpsn01_sww["PasienNomorRM"],
                    "PasienNama"=>$vpsn01_sww["PasienNama"],
                    "JenisKelamin"=>$vpsn01_sww["PasienGender"],
                    "TglLahir"=>$vpsn01_sww["PasienTglLahir"]
                    
                   );

            }
            if($cp_vpsn01_sw > 0){ 
                $json = array(
                   'Pasien' => $Pasien
                );
            }elseif($cp_vpsn01_sw < 1){
                $json = array(
                    'response_code' => '101',
                    'response_code_desc' => 'Data Gagal Ditampilkan'
                 );
            }
                $pasiendata = json_encode($json);
                //echo "{\"bill\":" . $edata ."}";
                 echo "$pasiendata";


?>