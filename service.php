<?php 
	/* 
		Author -> Mehmet Kılıç | mail@mehmetkilic.com.tr
		Create -> 18.11.2014   | 10:39
		Web    -> www.mehmetkilic.com.tr   
		@todo  -> Sizin belirteceğiniz 3 parametre (yazı adedi,başlangıç tarihi, bitiş tarihi) üzerine görevleri zamanlar ve istenilen görevleri veritabanına işlemek için kullanılabilir.
		@note  -> Günlük olarak yayınlanacak yazı adedi belirtilirken tek sayı kullanmayınız. Kulladığınız takdirde matematiksel işlemler yapacağından cronjob çalışmayacaktır.
	*/

	class PublishContent 
	{
		function CronContent($start_date,$end_date) 
		{ 
			$publish_count	= 4;
			$daily			= 24/$publish_count;
			$kes1=explode('-',$start_date); 
			$kes2=explode('-',$end_date); 
			$time1=mktime(0,0,0,$kes1[1],$kes1[0],$kes1[2]); 
			$time2=mktime(0,0,0,$kes2[1],$kes2[0],$kes2[2]); 

			while($time1<=$time2) 
			{ 
				$x=date('d.m.Y', ($time1)); 
				for ($f=0; $f < $publish_count; $f++) 
				{ 
					$time +=  $daily;

					// Eğer gelen değer 05 değilde 5 ise başına 0 ekliyoruz ki saat formatımızda herhangi bir problem olmasın.
					if(strlen($time)==1)
					{
						$time =  ' '.'0'.$time.':00:00';
					}

					// Gelen değer 24 ise 00 olarak sisteme yansıtılacak ve 24 den büyük ise ertesi güne yansıtıyoruz
					else if($time==24)
					{	
						$time = ' '.'00:00:00'.'<br>';	
					}

					// Eğer gelen saat değeri 24'den büyük ise ertesi gün olduğunu varsayıyor ve günü tekrar 00:00:00'dan başlatıyoruz
					else if($time>=24)
					{
						// Gelen saat değerini boşaltıyoruz ve tekrardan değer veriyoruz
						unset($time);
						$time = $daily;

						if(strlen($time==1))
						{
							$time =  ' '.'0'.$time.':00:00'.'<br>';
						}
						else
						{
							$time =  ' 0'.$time.':00:00'.'<br>';
						}			
					}

					else if(strlen($time)==2)
					{
						$time = $time.':00:00';
					}

					echo $x.' '.$time.'<br>';
				}
				
				$time1=$time1+86400; 
			} 
		} 
	}
	
	$data = new PublishContent;
	$return = $data->CronContent('18-11-2014', '03-12-2014');
?>
