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

            $tanggalawal = @$_POST['tanggalawal'];
            $tanggalahir = @$_POST['tanggalahir'];
            $vbjadwal01_sw = $ms_q("$call_sel TBedahJadwal WHERE JadwalTanggal BETWEEN '$tanggalawal' AND '$tanggalahir'");
                $cp_vbjadwal01_sw = $ms_nr($vbjadwal01_sw);
                while($vbjadwal01_sww = $ms_fas($vbjadwal01_sw)){
                    //..Ruang..//
                    $vrbedah01_sw = $ms_q("$call_sel TBedahRuang WHERE RuangKode='$vbjadwal01_sww[RuangKode]' ");
                        $vrbedah01_sww = $ms_fas($vrbedah01_sw);
                    $jadwal[] = array(
                        "kodebooking"=>$vbjadwal01_sww["JadwalNomor"],
                        "tanggaloperasi"=>$vbjadwal01_sww["JadwalTanggal"],
                        "jenistindakan"=>$vbjadwal01_sww["OpNama"],
                        "kodepoli"=>$vbjadwal01_sww["RuangKode"],
                        "namapoli"=>$vrbedah01_sww["RuangNama"],
                        "terlaksana"=>$vbjadwal01_sww["JadwalStatus"],
                        "nopeserta"=>$vbjadwal01_sww["PasienNomorRM"],
                        "lastupdate"=>$vbjadwal01_sww["UserDate"]
                        
                       ); 

                }

                        if($cp_vbjadwal01_sw > 0){ 
                            $daftar = array(
                            'list' => $jadwal
                            );

                            $metadata[] = array(
                                "message"=>"Ok",
                                "Code"=> "200"
                            ); 
                            
                        }elseif($cp_vbjadwal01_sw  < 1){
                            $daftar = array(
                                'response_code' => '101',
                                'response_code_desc' => 'Data Gagal Ditampilkan'
                            );

                            $metadata[] = array(
                                "message"=>"Ok",
                                "Code"=> "200"
                            ); 
                        }
                        $json = array(
                            'jadwal' => $daftar,
                            'metadata' => $metadata
                        );
                            $jadwaldata= json_encode($json);
                            //echo "{\"bill\":" . $edata ."}";
                            echo "$jadwaldata";

?>