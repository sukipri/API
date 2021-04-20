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
    $json_input = file_get_contents('php://input');
    $data_input = json_decode($json_input,true);
    /**/
    $tanggalperiksa = $data_input['tanggalperiksa'];
    $kodepoli = $data_input['kodepoli'];
    
    
    /*
    $tanggalperiksa = "2020-03-27";
    $kodepoli = "SAR";
    */
        //--DATA UNIT--//
        $cari_vunt01_sw = $ms_q("$sl UnitKode,UnitNama,PoliKodeBPJS FROM  TUnit WHERE PoliKodeBPJS='$kodepoli'"); 
            $cari_vunt01_sww = $ms_fas($cari_vunt01_sw);

        //-_DATA RAWAT JALAN--//
        $vrj01_sw = $ms_q("$sl JalanNoReg,PasienNomorRM,JalanRMTanggal,UnitKode,JalanNoUrut FROM TRawatJalan WHERE JalanRMTanggal BETWEEN '$tanggalperiksa' AND '$tanggalperiksa' AND NOT JalanStatus='9' AND UnitKode='$cari_vunt01_sww[UnitKode]'");
            //..CN//
                $cn_vrj01_sw = $ms_nr($vrj01_sw) ;
            //Fetch//
                 $vrj01_sww = $ms_fas($vrj01_sw);
            //..Unit../
            $vunt01_sw = $ms_q("$sl UnitKode,UnitNama,PoliKodeBPJS FROM  TUnit WHERE UnitKode='$vrj01_sww[UnitKode]'"); 
                $vunt01_sww = $ms_fas($vunt01_sw);

            if($cn_vrj01_sw < 1 ){
                $jadwal[] = array(
                   "Response_code"=>"Data Tidak Ditemukan"
                   ); 

                   $metadata[] = array(
                    "message"=>"Tidak ada pemeriksaan ditanggal ini",
                    "Code"=> "404"
                ); 
            }else{
                $jadwal[] = array(
                    "namapoli"=>$vunt01_sww['UnitNama'],
                    "totalatrian"=> $cn_vrj01_sw,
                    "jumlahterlayani"=>"0",
                    "lastupdate"=>strtotime("$date_html5")
                   ); 

                   $metadata[] = array(
                    "message"=>"Ok",
                    "Code"=> "200"
                ); 
            }
            

            $json = array(
                'response' => $jadwal,
                'metadata' => $metadata
            );
          

            $jadwaldata= json_encode($json);
          
            //echo "{\"bill\":" . $edata ."}";
            echo "$jadwaldata";
          

?>