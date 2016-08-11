<?php
	require ('phpQuery/phpQuery.php');
	
	set_time_limit (999); // Время выполнения
	
	$link = mysql_connect('localhost', 'root', '32167ADmin911') or die('Не удалось соединиться: ' . mysql_error());
	
	mysql_select_db('mailbase') or die('Не удалось выбрать базу данных');
	
	$exclude = array("support@deal.by", "21@21vek.by"); // Исключения
	
	//error_reporting( E_ERROR );  // Выпиливает варнинги и ноутисы
	
	if (get_headers($_POST['url'], 1)){
		$content = file_get_contents($_POST['url']);
  
		$document = phpQuery::newDocument($content);
		  
		$hentry = $document->find('.ShopList__ShopName');
	  
		$i=1;
		$count = 0;
		$data = "";
		foreach ($hentry as $el) {
			$pq = pq($el);
			
			$site_url = "http://".$pq->text();
			
			
			$data .= "<p>".$i.". ".$site_url;
			
			//$site = strip_tags(file_get_contents("http://".$pq->text()."/info.xhtml")); если ошибка 404, то нет результат
			
			$c = curl_init($site_url."/info.xhtml");
			curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
			$site = strip_tags(curl_exec($c));
			
			preg_match('/([a-z0-9_\.\-])+\@(([a-z0-9\-])+\.)+([a-z0-9]{2,4})+/i', $site, $mails); 
			if($mails){
				if(!in_array(strtolower($mails[0]), $exclude)){
					$data .= " ".strtolower($mails[0]);
					$site_mail = strtolower($mails[0]);
					
					$query = 'SELECT * FROM mail WHERE mail ="'.$site_mail.'"';
					$result = mysql_query($query) or die('Запрос не удался: ' . mysql_error());
					
					$query_info = mysql_fetch_array($result);
					
					if(!$query_info){
						$add_query = 'INSERT INTO mail (url, mail, platform) values("'.$site_url.'","'.$site_mail.'", "shop.by")';
						mysql_query($add_query,$link);
						$data .= " <img src='ok.png' /> СОХРАНЕНО!";
						$count++;
					}else{
						$data .= " <img src='cancel.png' /> ДУБЛИРОВАНИЕ!";
					}
					
					mysql_free_result($result);
				}else{
					$data .= " <img src='cancel.png' /> ИСКЛЮЧЕНИЕ!";
				}
			}else{
				$data .= " <img src='cancel.png' /> ОТСУТСТВУЕТ ПОЧТА!";
			}
			$data .= "</p>";
			$i++;
		}
		
		$data .= "<h1>Сохранено: ".$count." строк</h1>";
		
		if(!$data){
			echo "Не нашел такой категории на shop.by";
		}else{
			echo $data;	
		}
	}else{
		echo "Введена не верная ссылка либо такого сайта не существует, рабочий пример: http://shop.by/avto/";
	}
   
	mysql_close($link);

?>