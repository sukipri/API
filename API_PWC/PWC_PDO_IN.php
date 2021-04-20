<?Php
/*VIEW DATA SET SIMRS */
    /*Algorithm
        0.0 Set token
        1.0 deteksi Nomor register
        2.0 entry Prosedur Register
            [
                2.1 Pilih tanggal
                2.2 Pilih poli 
                2.3 Cari dokter sesuai poli dengan dokter default dari sistem -searching algorithm-
                2.4 Simpan Prosedur register 
            ]
        3.0 
    ............................*/
	/*COINFIG */
			include_once"../config/connec_01_srv.php";
			include"../secure/GR_01.php"; //security enggine		
       		include"../sc/stack_Q.php"; //Query SQL
			include"../sc/code_rand.php"; 
	//.........//
	header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
                $json_input = file_get_contents('php://input');
                $data_input = json_decode($json_input,true);


    $char = "SI124CDY";
    $token = '';
    $token_sw = $_SESSION['token'] = $char;

    //echo"$token_sw";
    $REGRAND = rand('9999','8888');
    $TXT_REGRAND = "PL-WS$REGRAND";
    //$APIKEYGET = @$sql_slashes($_GET['APIKEYGET']);
        
        
    	/*  
        $KEYSET = $data_input['KEYSET']; 
        $nomorreg = $data_input['nomorreg'];  
        $nomorrm = $data_input['nomorrm'];
        $namapasien = $data_input['namapasien'];
        $tanggalperiksa = $data_input['tanggalperiksa'];
        $kodepoli = $data_input['kodepoli'];
        */
            $nomorkartu = $data_input['nomorkartu'];
            $nik = $data_input['nik'];
            $notelp = $data_input['notelp'];
            $tanggalperiksa = $data_input['tanggalperiksa'];
            $kodepoli = $data_input['kodepoli'];
            $nomorrefrensi = $data_input['nomorrefrensi'];
     
       /*
        $KEYSET = @$_POST['KEYSET']; 
        $nomorreg = ""; 
        $nomorrm = "544719";
        $namapasien = "Meika Kurniawan";
        $tanggalperiksa = "2020-12-31";
        $kodepoli = "06";
         */
                //--Data pasien--//
                $vpsn01_sw = $ms_q("$sl PasienNomorRM,PasienNama,PasienNoKartuJamin FROM TPasien WHERE PasienNoKartuJamin='$nomorkartu'");
                $vpsn01_sww = $ms_fas($vpsn01_sw);
    /*GET POLI */
    $vunit01_sw = $ms_q("$sl UnitKode,UnitNama,PoliKodeBPJS FROM TUnit WHERE PoliKodeBPJS='$kodepoli'");
    $vunit01_sww = $ms_fas($vunit01_sw);
    /* Get Rand Dokter */
    $vdkt01_sw = $ms_q("SELECT PelakuKode,PelakuNama,UnitKode FROM TPelaku WHERE UnitKode='$vunit01_sww[UnitKode]' AND PelakuStatus='A' AND NOT SpesKode='PAKET' order by NEWID()");
    $vdkt01_sww = $ms_fas($vdkt01_sw);
    /*......................*/

    /* Nomor register */
    $vdc_hit_01 = $ms_q("SELECT TOP 1  JalanNoUrut FROM TRawatJalan where DokterKode = '$vdkt01_sww[PelakuKode]' AND JalanRMTanggal between '$tanggalperiksa' AND '$tanggalperiksa 23:59' and not JalanStatus='9'  AND WaktuPesan ='P' AND JalanNoUrut > 0 order by Convert(Integer,JalanNoUrut) desc");
    $vdcc_hit_01 = $ms_fas($vdc_hit_01);
    $vdcc_jum_01 = $vdcc_hit_01['JalanNoUrut'] + 1 ;	
    $hit_zero_02 = sprintf("%02d", $vdcc_jum_01);
    $date_micro = strtotime($tanggalperiksa);
    /*................*/

        //...Proccess..//
            $save_rj = $ms_q("$in TRawatJalan(JalanNoReg,PasienNomorRM,PasienNama,JalanCaraDaftar,AppJenisDaftar,JalanTanggal,UnitKode,DokterKode,JalanNoUrut,WaktuPesan,JalanStatus,JalanRMTanggal,JalanJenisPeriksa)VALUES('$TXT_REGRAND','$vpsn01_sww[PasienNomorRM]','$vpsn01_sww[PasienNama]','4','1','$date_html5','$vunit01_sww[UnitKode]','$vdkt01_sww[PelakuKode]','$hit_zero_02','P','0','$tanggalperiksa','M')");
            
        if($save_rj){ 
            $json_fetch = array(
               'nomorantrean' => $hit_zero_02,
               'kodebooking' => $TXT_REGRAND,
               'jenisantrean' =>  $hit_zero_02,
               'estimasidilayani' =>  $date_micro,
               'namapoli' =>   $vunit01_sww['UnitNama'],
               'namadokter' => $vdkt01_sww['PelakuNama']
                

            );
            $metadata[] = array(
                "message"=>"Ok",
                "Code"=> "200"
            ); 
        
        
    }else{
        $json_fetch = array(
            'response_code' => '101',
            'response_code_desc' => 'Data Not Set'
         );

        }

        $json = array(
            'response' => $json_fetch,
            'metadata' => $metadata
        );
     
    

        $edata = json_encode($json);
        //echo "{\"bill\":" . $edata ."}";
         echo "$edata";
    /*
         "{
            ""response"": {
                ""nomorantrean"" : ""A10"",
                ""kodebooking"" : ""QWERTYUIO123"",
                ""jenisantrean"" : 2,
                ""estimasidilayani"" : 1576040301000,
                ""namapoli"" : ""Poli Jantung"",
                ""namadokter"" : """"
            },
            ""metadata"": {
                ""message"": ""Ok"",
                ""code"": 200
            }
        }"
        */
?>