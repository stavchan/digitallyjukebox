<?php
//arxikopoihsh statheras to opoio exoume paralavei apo thn selida soundcloud 
define('SOUDNCLOUD_API','aa5da74ab07b51ce2c025fefa20ab19e');

//dexetai 2 parametrous to kommati kai ean prepeu na xrhsimopoihthei rest arxitektonikh thn opoia exoume paralaveiapo to soundcloud
function preview_track($track, $rest=false){
    if($rest){
    	$data = rest_request('/tracks/'.$track);
    }else{
    	$data = $track;
    }

    if($data->streamable && $data->downloadable){
        $html = "<div class='col-xs-6 col-sm-4 col-md-3 col-lg-2'>";
        $html .=   "<div class='item' data-track-id='{$data->id}'>";
        $html .=     "<div class='pos-rlt'>";
        $html .=       "<div class='item-overlay opacity r r-2x bg-black'>";
        $html .=         "<div class='center text-center m-t-n'>";
        $html .=           "<a href='#' class='play-track'>";
        $html .=             "<i class='icon-control-play i-2x'></i>";
        $html .=             "<i class='icon-control-pause i-2x text-active'></i>";
        $html .=           "</a>";
        $html .=         "</div>";
        $html .=         "<div class='bottom padder m-b-sm'>";
        $html .=           "<a href='#' class='pull-right download-track'><i class='fa fa-download'></i></a>";
        $html .=           "<a href='#' class='playlist-add'><i class='fa fa-plus-circle'></i></a>";
        $html .=         "</div>";
        $html .=       "</div>";

        if($data->artwork_url){
            $html .=       "<a href='#'><img src='{$data->artwork_url}' class='r r-2x img-full'></a>";
        }else{
            $html .=       "<a href='#'><img src='assets/images/logo.jpg' class='r r-2x img-full'></a>";
        }

        $html .=     "</div>";
        $html .=     "<div class='padder-v'>";
        $html .=       "<a href='#' class='text-ellipsis'>{$data->title}</a>";
        $html .=       "<a href='#' class='text-ellipsis text-xs text-muted'>" . ($data->genre ? $data->genre : 'Unknown') . "</a>";
        $html .=     "</div>";
        $html .=   "</div>";
        $html .= "</div>";
        return $html;
    }else{
        return '';// epistrefei kenh symvoloseira ean to kommati den plhrh thn domh elegxou 
    }
}
//
function rest_request($url, $options=false){
	$url = 'https://api.soundcloud.com' . $url;
	$clientid = SOUDNCLOUD_API; // Your API Client ID
	
	$url_options = '';
	//gia kathe timh pou yparxei sto options thn prosarmozoume analoga gia to aithma http pou tha ginei sto soundcloud
	if($options){
		foreach ($options as $key => $value) {
			$url_options .= "{$key}={$value}&";
		}
	}
	
	$url_options .= "format=json&client_id={$clientid}";
	 //enwnoume tis 2 symvoloseires gia thn dhmiourgia katallhlou url
	$soundcloud_url = "{$url}?{$url_options}";
	//kanoume aithma sto url parapanw kai to apotelesma to epistrefoume sthn metavlhth data
	$data = file_get_contents($soundcloud_url);
	return json_decode($data);
}

function time_format($time){
    $totalSec = round((int)($time)/1000);
    $minutes = (int)( $totalSec / 60 ) % 60;
    $seconds = $totalSec % 60;
    $result = ($minutes < 10 ? "0" . $minutes : $minutes) . ":" . ($seconds  < 10 ? "0" . $seconds : $seconds);
    return $result;
}
