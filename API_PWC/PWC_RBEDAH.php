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

        $vrbedah01_sw = $ms_q("$call_sel TBedahRuang WHERE RuangKode >= '011' UNION Select '000' as RuangKode , 'Ruang Operasi' as RuangNama , '1' as RuangStatus");
        $cp_rbedah01_sw = $ms_nr($vrbedah01_sw);    
         while($vrbedah01_sww = $ms_fas($vrbedah01_sw)){
                $rbedah[] = array(
                    "Ruang_Kode"=>$vrbedah01_sww["RuangKode"],
                    "Ruang_Nama"=>$vrbedah01_sww["RuangNama"],
                    "Ruang_Status"=>$vrbedah01_sww["RuangStatus"]
                    
                   );
            }
                if($cp_rbedah01_sw > 0){ 
                    $json = array(
                    'Ruang' => $rbedah
                    );
                }elseif($cp_rbedah01_sw  < 1){
                    $json = array(
                        'response_code' => '101',
                        'response_code_desc' => 'Data Gagal Ditampilkan'
                    );
                }
                    $ruangdata= json_encode($json);
                    //echo "{\"bill\":" . $edata ."}";
                    echo "$ruangdata";
    ?>