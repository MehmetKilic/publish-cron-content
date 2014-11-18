<?php 
	/* 
		Author -> Mehmet Kılıç | mail@mehmetkilic.com.tr
		Create -> 18.11.2014   | 10:39
		Web    -> www.mehmetkilic.com.tr   
		@todo  -> Sizin belirteceğiniz 3 parametre (yazı adedi,başlangıç tarihi, bitiş tarihi) üzerine görevleri zamanlar ve istenilen görevleri veritabanına işlemek için kullanılabilir.
	*/

	class PublishContent 
	{
		function CronContent()
		{
			$publish_count	= 3;
			$start_date		= '17-11-2014';
			$end_date		= '24-11-2014';
			$date 			= $end_date-$start_date;

			$daily = 24/$publish_count;
			$start = '00:00:00';
			$baslaGun = substr($start_date, 0,2);
			$bitirGun = substr($end_date, 0,2);

			for ($a=$baslaGun; $a < $bitirGun; $a++) 
			{ 
				for ($i=0; $i < $publish_count; $i++) 
				{ 
					$time +=  $daily;

					// Eğer gelen değer 05 değilde 5 ise başına 0 ekliyoruz ki saat formatımızda herhangi bir problem olmasın.
					if(strlen($time)==1)
					{
						$data =  $a.' '.'0'.$time.':00:00'.'<br>';
					}

					// Gelen değer 24 ise 00 olarak sisteme yansıtılacak ve 24 den büyük ise ertesi güne yansıtıyoruz
					else if($time==24)
					{
						$data = $a.' '.'00:00:00'.'<br>';
					}

					// Eğer gelen saat değeri 24'den büyük ise ertesi gün olduğunu varsayıyor ve günü tekrar 00:00:00'dan başlatıyoruz
					else if($time>24)
					{
						// Gelen saat değerini boşaltıyoruz ve tekrardan değer veriyoruz
						unset($time);
						$time = $daily;

						if(strlen($time==1))
						{
							$data =  $a.' '.'0'.$time.':00:00'.'<br>';
						}
						else
						{
							$data =  $a.' 0'.$time.':00:00'.'<br>';
						}			
					}

					else
					{
						$data =  $a.' '.$time.':00:00'.'<br>';
					}
					echo $data;
				}
			}
		} 
	}
	
	$data = new PublishContent;
	$return = $data->CronContent();
?>