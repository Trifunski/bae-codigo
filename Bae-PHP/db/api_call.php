<?php

    function obtener_imagenes_aleatorias($api_key, $tag) {
        $url = "https://api.flickr.com/services/rest/?method=flickr.photos.search&api_key=".$api_key."&tags=".$tag."&format=json&nojsoncallback=1&per_page=50";
        $response = file_get_contents($url);
        $data = json_decode($response);
        $photos = $data->photos->photo;
        $image_indexes = array_rand($photos, 50);
        $img_urls = array();

        foreach ($image_indexes as $index) {
            $photo = $photos[$index];
            $farm_id = $photo->farm;
            $server_id = $photo->server;
            $photo_id = $photo->id;
            $secret = $photo->secret;
            $size = 'z';
            $img_url = "https://farm".$farm_id.".staticflickr.com/".$server_id."/".$photo_id."_".$secret."_".$size.".jpg";
            $img_urls[] = $img_url;
        }

        return $img_urls;
    }

?>