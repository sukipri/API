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
    
        $vunt01_sw = $ms_q("$call_sel TUnit WHERE UnitGrup='KSP'"); 
            $cp_vunt01_sw = $ms_nr($vunt01_sw);
            while($vunt01_sww = $ms_fas($vunt01_sw)){
                $unit[] = array(
                    "Unit_Kode"=>$vunt01_sww["UnitKode"],
                    "Unit_Nama"=>$vunt01_sww["UnitNama"],
                    "Unit_Alias"=>$vunt01_sww["UnitAlias"]
                    
                   );

            }
            if($cp_vunt01_sw > 0){ 
                $json = array(
                   'KodePoli' => $unit
                );
            }elseif($cp_vunt01_sw < 1){
                $json = array(
                    'response_code' => '101',
                    'response_code_desc' => 'Data Gagal Ditampilkan'
                 );
            }
                $unitdata = json_encode($json);
                //echo "{\"bill\":" . $edata ."}";
                 echo "$unitdata";


?>