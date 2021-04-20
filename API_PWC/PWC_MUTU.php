<h4>#GET ARRAY</h4>
<hr>
<?php
	
			$ch = curl_init(); 
			curl_setopt($ch,CURLOPT_HTTPHEADER,array(
			"Content-Type: Application/JSON",          
			"Accept: Application/JSON"
			));
			$url = "http://182.253.60.178:7880/mutu/api/";
			curl_setopt($ch, CURLOPT_URL, $url); 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
			curl_setopt($ch, CURLOPT_TIMEOUT, 60);  
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLPROTO_HTTPS , true);
			curl_setopt($ch, CURLINFO_HEADER_OUT, true);
			$output = curl_exec($ch); 
			curl_close($ch);  
			 
			//..Get Content..//
			$data02 = json_decode($output, TRUE);
			//echo"<textarea cols=80 rows=10>";
			//print_r($data02);   
			//echo"</texarea>";
			
			
?>
			<table style="max-width:30rem;" width="100%" border="0" class="table table-bordered table-striped table-sm">
                     
					<tr class="table-info">
                        <td width="11%">Record</td>
                        <td width="52%">-</td>
                        <td width="37%">-</td>
                      </tr>
		<?php
				foreach($data02['data'] as $baris01){
			?>
					 <tr>
                        <td><?php echo $baris01['chapter_id'] ; ?></td>
                        <td><?php echo $baris01['chapter_code'] ; ?></td>
                        <td><?php echo $baris01['chapter_name'] ; ?></td>
                      </tr>
       <?php } ?>
	    	
				</table>