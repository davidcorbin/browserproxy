<?php

class DailyMotion_com extends ParserTemplate {

	function parse($output, $url, $type){
	
		// stream_h264_hd_url
		// stream_h264_hq_url
		// stream_h264_ld_url
		// stream_h264_url
		
		if(preg_match('/video\/([^_]+)/', $url, $matches)){
		
			$id = $matches[1];
			
			$html = file_get_contents("http://www.dailymotion.com/embed/video/{$id}");
			
			if(preg_match('/stream_h264_ld_url":"([^"]+)"/is', $html, $matches)){

				$url = $matches[1];
				$url = stripslashes($url);

				$output = preg_replace('#\<div\sclass\=\"dmpi_video_playerv4(.*?)>.*?\<\/div\>#s', 
			'<div class="dmpi_video_playerv4${1}>'.vid_player($url, 620, 348).'</div>', $output, 1);
			}
			
		}
		
		return $output;
	}
}

?>