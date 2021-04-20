<?Php
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

         
            $vbjadwal01_sw = $ms_q("$call_sel vcovidtt ");
                $cp_vbjadwal01_sw = $ms_nr($vbjadwal01_sw);
                while($vbjadwal01_sww = $ms_fas($vbjadwal01_sw)){
                    
                    $jadwal[] = array(
                        "Keterangan"=>$vbjadwal01_sww["Keterangan"],
                        "Isolasi"=>$vbjadwal01_sww["JmlIsolasi"],
                        "JmlICU"=>$vbjadwal01_sww["JmlICU"],
                        
                       ); 

                }

                        if($cp_vbjadwal01_sw > 0){ 
                            $json = array(
                            'list' => $jadwal
                            );
                        }elseif($cp_vbjadwal01_sw  < 1){
                            $json = array(
                                'response_code' => '101',
                                'response_code_desc' => 'Data Gagal Ditampilkan'
                            );
                        }
                            $jadwaldata= json_encode($json);
                            //echo "{\"bill\":" . $edata ."}";
                            echo "$jadwaldata";

?>