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
    
        $vuser01_sw = $ms_q("$call_sel TBuser WHERE idmain='PWCssdfjorge34t30' ");
            $vuser01_sww = $ms_fas($vuser01_sw);
            $cp_vuser01_sw  = $ms_nr($vuser01_sw);
            $User[] = array(
                "username"=> $vuser01_sww["namauser"],
                "password"=>$vuser01_sww["passuser"],
                "password_text"=>$vuser01_sww["password_text"]
               );

               if(  $cp_vuser01_sw > 0){ 
                $json = array(
                'User' => $User
                );
            }elseif(  $cp_vuser01_sw  < 1){
                $json = array(
                    'response_code' => '101',
                    'response_code_desc' => 'Data Gagal Ditampilkan'
                );
            }
                $userdata= json_encode($json);
                //echo "{\"bill\":" . $edata ."}";
                echo "$userdata";


?>