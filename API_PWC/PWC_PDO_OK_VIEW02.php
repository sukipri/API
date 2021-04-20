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
                $json_input = file_get_contents('php://input');
                $data_input = json_decode($json_input,true);
    $APIKEY = "PWC1001";
    $REGRAND = rand('99999','88888');
    $OrderNomor = "JB-$years$month$REGRAND";
    //$APIKEYGET = @$sql_slashes($_GET['APIKEYGET']);
    	

        $nopeserta = $data_input['nopeserta'];
            /*$nopeserta = "0000993133293";*/
    
        //...Proccess..//
            //--DATA PASIEN--/
            $vpsn01_sw = $ms_q("$sl PasienNomorRM,PasienNoKartuJamin FROM TPasien WHERE PasienNoKartuJamin='$nopeserta' ");
                $vpsn01_sww = $ms_fas($vpsn01_sw);
            //--DATA BEDAH--//
           $vbjdw01_sw = $ms_q("$call_sel TBedahJadwal WHERE PasienNomorRM='$vpsn01_sww[PasienNomorRM]' order by JadwalTglDaftar desc ");
             $vbjdw01_sww = $ms_fas($vbjdw01_sw);
            //--KONVERSI TANGGAL--//
            $date_vbjdw01_sw = $ms_q("$sl CONVERT(date,'$vbjdw01_sww[JadwalTanggal]',23) as tgl_bedah FROM TBedahJadwal WHERE JadwalNomor='$vbjdw01_sww[JadwalNomor]' ");
             $date_vbjdw01_sww = $ms_fas($date_vbjdw01_sw);
            $get_ok = $ms_nr($vbjdw01_sw);
            //--DATA PELAKU MEDIS--//
            $vplk01_sw = $ms_q("$sl PelakuKode,UnitKode,SpesKode FROM TPelaku WHERE PelakuKode='$vbjdw01_sww[OpDokOperator]' ");
                $vplk01_sww = $ms_fas($vplk01_sw);
            $vspes01_sw = $ms_q("$sl SpesKode,SpesNama FROM TSpesialis WHERE SpesKode='$vplk01_sww[SpesKode]' ");
                $vspes01_sww = $ms_fas($vspes01_sw);
             $vunit01_sw = $ms_q("$call_sel TUnit WHERE UnitKode='$vplk01_sww[UnitKode]'");
                $vunit01_sww = $ms_fas($vunit01_sw);
            

            //Konversi
            $tujuh_hari = mktime(0,0,0,date("n"),date("j")+7,date("Y"));
            $kembali = date("d-m-Y", $tujuh_hari); 
           

                $date_01 = "$date_html5 $time_html5";
                if($date_01 == $vbjdw01_sww['JadwalTanggal']){
                    $status_op = "0";
                }elseif($date_01 !== $vbjdw01_sww['JadwalTanggal'] ){
                    $status_op = "1";
                }

            //..Array data success
             $array_bjdw01_sw  = array(
             'kodebooking' => $vbjdw01_sww['JadwalNomor'],
             'tanggaloperasi' =>  $date_vbjdw01_sww['tgl_bedah'],
             'jenistindakan' => $vbjdw01_sww['OpNama'],
             'namapoli' =>   $vunit01_sww['UnitNama'],
             'terlaksana' => "$status_op",
             
             );

             
            if($get_ok){ 
                $json_view = array(
                'list' => $array_bjdw01_sw

           );
           $metadata = array(
            'message' => "OK",
            'code' => "200"

        );
        
        
    }else{
        $json_view = array(
            'response_code' => '101',
            'response_code_desc' => 'Data Not Set'
         );

        }
    
        $json = array(
            'response' => $json_view,
            'metadata' => $metadata
         );

        $edata = json_encode($json);
        //echo "{\"bill\":" . $edata ."}";
         echo "$edata";
    

?>