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
    $APIKEY = "PWC1001";
    $REGRAND = rand('99999','88888');
    $OrderNomor = "OO-$years$month$REGRAND";
    //$APIKEYGET = @$sql_slashes($_GET['APIKEYGET']);
    	
        /*
        $OrderTanggal = @$_POST['OrderTanggal']; 
        $PasienNoJKN = @$_POST['PasienNoJKN'];
        $RuangKode = @$_POST['RuangKode'];
        $PasienNoKTP = @$_POST['PasienNoKTP']; 
        $PasienNomorRM = @$_POST['PasienNomorRM'];
        $PasienNama = @$_POST['PasienNama']; 
        $PasienAlamat = @$_POST['PasienAlamat']; 
        $PasienKota = @$_POST['PasienKota']; 
        $OpNama = @$_POST['OpNama']; 
    */
    $OrderTanggal = "2021-03-30"; 
    $PasienNoJKN = "38432842394238";
    $RuangKode = "06";
    $PasienNoKTP = "9348593459034"; 
    $PasienNomorRM = "345691";
    $PasienNama = "YERIMIA NGAHU,TN"; 
    $PasienAlamat = ""; 
    $PasienKota = ""; 
    $OpNama = "SCTP"; 
        //-GET DATA--//
        
        
        //...Proccess..//
            $save_ok= $ms_q("$in TBedahJadwalOrder(OrderNomor,OrderTanggal,PasienNoJKN,PasienNoKTP,PasienNomorRM,PasienNama,PasienAlamat,PasienKota,OpNama,RuangKode,OrderStatus,UserID1,UserDate1)VALUES('$OrderNomor','$OrderTanggal','$PasienNoJKN','$PasienNoKTP','$PasienNomorRM','$PasienNama','$PasienAlamat','$PasienKota','$OpNama','$RuangKode','0','JKN','$date_html5')");

        if($save_ok){ 

            $json_fetch = array(
               'kodebooking' => $OrderNomor,
               'response_code_desc' => $OrderTanggal,
               'jenistindakan' =>  $OpNama,
               'kodepoli' => $RuangKode,
               'namapoli' => ''


            );

            $json_meta = array(
                
               'response_code' => '00',
               'response_code_desc' => 'Pendaftaran Berhasil'
           );
        
        
    }else{
        $json_meta = array(
        'response_code' => '404',
        'response_code_desc' => 'Pendaftaran Gagal'
        );
        }
    
        $json = array(
            'Response' => $json_fetch,
            'metadata' => $json_meta
         );

        $edata = json_encode($json);
        //echo "{\"bill\":" . $edata ."}";
         echo "$edata";
    

?>