<?php
/**
 *
 */
class Klikasi_Controller_Action_Helper_EmbedExternal extends Zend_Controller_Action_Helper_Abstract
{
    public function youtubeUrlMatch($url)
    {
        preg_match('/.*<iframe.*src=\"(.*)\".*>.*<\/iframe>.*/isU', $url, $matches);
        if (!empty($matches) && isset($matches[1])) {
            $url = $matches[1];
        }

        $pattern  = '#^(?:https?://|//)?';    # Optional URL scheme. Either http or https.
        $pattern .= '(?:www\.)?';         #  Optional www subdomain.
        $pattern .= '(?:';                #  Group host alternatives:
        $pattern .=   'youtu\.be/';       #    Either youtu.be,
        $pattern .=   '|youtube\.com';    #    or youtube.com
        $pattern .=   '(?:';              #    Group path alternatives:
        $pattern .=     '/embed/';        #      Either /embed/,
        $pattern .=     '|/v/';           #      or /v/,
        $pattern .=     '|/watch\?v=';    #      or /watch?v=,
        $pattern .=     '|/watch\?.+&v='; #      or /watch?other_param&v=
        $pattern .=   ')';                #    End path alternatives.
        $pattern .= ')';                  #  End host alternatives.
        $pattern .= '([\w-]{11})';        # 11 characters (Length of Youtube video ids).
        $pattern .= '(?:.+)?$#x';         # Optional other ending URL parameters.

        preg_match($pattern, $url, $matches);

        if (isset($matches[1])) {
            return $matches[1];
        }

        return null;
    }

    /**
     * crea un iframe de youtube con el hash del video
     * @param string $code
     */
    public function youtubeRender($code)
    {
        $src = 'src="https://www.youtube.com/embed/' . $code . '/?feature=oembed"';
        return '<iframe ' . $src . ' allowfullscreen="true"></iframe>';
    }

    public function vimeoUrlMatch($url)
    {
        preg_match('/.*<iframe.*src=\"(.*)\".*>.*<\/iframe>.*/isU', $url, $matches);
        if (!empty($matches) && isset($matches[1])) {
            $url = $matches[1];
        }

        $url2 = str_replace('#038;', '', str_replace('amp;', '', str_replace('&', '', $url)));

        $patternVimeo  = '#^(?:https?://|//)?';
        $patternVimeo .= '(?:www\.)?';
        $patternVimeo .= '(?:';
        $patternVimeo .=   'player\.vimeo\.com/';
        $patternVimeo .=   '|vimeo\.com/)';
        $patternVimeo .=     '(?:';
        $patternVimeo .=       'video/';
        $patternVimeo .=       '|m/';
        $patternVimeo .=       '|';
        $patternVimeo .=       '|(?:album)/(?:[0-9]+)/video/';
        $patternVimeo .=       '|(?:channels)/(?:[^\/]*/)?';
        $patternVimeo .=       '|(?:groups/(?:[^\/]*)/videos)/';
        $patternVimeo .=     ')';
        $patternVimeo .= '([0-9]+)#i';

        preg_match_all($patternVimeo, $url2, $vimeo);
        if (sizeof($vimeo) > 1) {

            if (isset($vimeo[1][0])) {
                return $vimeo[1][0];
            }
        }

        return null;
    }

    /**
     * Devuelve un objeto json con la información del video
     * @param String $url
     * @return application/json $data
     */
    public function getVimeoData($url)
    {
    	$videoId = $this->vimeoUrlMatch($url);

    	$vimeoRequest = 'http://vimeo.com/api/v2/video/' .
    			$videoId .
    			'.json';

    	$vimeoResponse = file_get_contents($vimeoRequest);

    	if (!$vimeoResponse) {
    		return null;
    	}

    	$vimeoResponse = json_decode($vimeoResponse);

    	return $vimeoResponse;
    }

    /**
     * Crea un iframe de Vimeo
     * @param String $code
     * @return String $iframe
     */
    public function vimeoRender($code)
    {
        $src = ' src="https://player.vimeo.com/video/' . $code . '/?portrait=0&amp;color=def1fa" ';
        //$sizeIframe = ' width="' . $size["width"] . '" height="' . $size["height"] . '" ';
        $attrs = ' webkitAllowFullScreen mozallowfullscreen allowFullScreen ';

        return '<iframe ' . $src . ' frameborder="0" ' . $attrs . ' ></iframe>';
    }

    /**
     * Devuelve la URL del thumbnail de un video de Vimeo
     * @param String $url
     * @return String $thumbnailUrl
     */
    public function getVimeoThumbnail($url)
    {
        $vimeoResponse = $this->getVimeoData($url);

        if (!isset($vimeoResponse[0]->thumbnail_large)) {
        	return null;
        }

        return $vimeoResponse[0]->thumbnail_large;
    }

    public function slideshareUrlMatch($url)
    {
        preg_match('/.*(<iframe.*src=\"(.*)\".*>.*<\/iframe>)+.*/isU', $url, $matches);
        if (!empty($matches) && isset($matches[1])) {
            return $matches[1];
        }

        //http://www.slideshare.net/Mandalah_Global/from-social-media-to-social-impact-33417090

        $pattern  = '#^(?:https?://|//)?';
        $pattern .= '(?:www\.)?';
        $pattern .= '(slideshare\.net/)';
        $pattern .= '(.*)/(.*)#i';

        preg_match_all($pattern, $url, $match);

        if (!isset($match[0]) || !is_array($match[0])) {
            return null;
        }

        return $url;
    }

    public function slideshareRender($url)
    {
        preg_match('/.*<iframe.*src=\"(.*)\".*>.*<\/iframe>.*/isU', $url, $matches);
        if (!empty($matches)) {
            return $url;
        }

        $slideshareRequest = 'http://www.slideshare.net/api/oembed/2?url=' .
                             $url .
                             '&format=json';

        $slideshareResponse = file_get_contents($slideshareRequest);

        if (!$slideshareResponse) {
            return null;
        }

        $slideshareResponse = json_decode($slideshareResponse);
        if (!isset($slideshareResponse->html)) {
            return null;
        }

        return $slideshareResponse->html;
    }

    public function issuuUrlMatch($url)
    {
    	//http://issuu.com/txlopez/docs/anornogabeak

    	$pattern  = '#^(?:https?://|//)?';
    	$pattern .= '(?:www\.)?';
    	$pattern .= '(issuu\.com/)';
    	$pattern .= '(.*)/docs/(.*)#i';

    	preg_match_all($pattern, $url, $match);

    	if (!isset($match[0]) || !is_array($match[0])) {
    		return null;
    	}

    	return $url;
    }

    /**
     * Devuelve un objeto json con la información de la presentación
     * @param String $url
     * @return application/json $data
     */
    public function getIssuuData($url)
    {
    	$issuuRequest = 'http://issuu.com/oembed?url=' .
    					$url .
    					'&format=json';

    	$issuuResponse = file_get_contents($issuuRequest);

    	if (!$issuuResponse) {
    		return null;
    	}

    	$issuuResponse = json_decode($issuuResponse);

    	return $issuuResponse;
    }

    /**
     * Crea un div para el render de la presentación
     * @param String $code
     * @return String $div
     */
    public function issuuRender($url)
    {
        $issuuResponse = $this->getIssuuData($url);

        if (!isset($issuuResponse->html)) {
            return null;
        }

        return $issuuResponse->html;
    }

    /**
     * Devuelve la URL del thumbnail de una presentación de ISSUU
     * @param String $url
     * @return String $thumbnailUrl
     */
    public function getIssuuThumbnail($url)
    {

       $issuuResponse = $this->getIssuuData($url);
        if (!isset($issuuResponse->thumbnail_url)) {
        	return null;
        }

        $thumbnailUrl = substr ($issuuResponse->thumbnail_url , 0, strlen($issuuResponse->thumbnail_url) - 10) . "large.jpg";

        return $thumbnailUrl;
    }

    public function flickrUrlMatch($url)
    {
        preg_match_all(
            '#^(?:https?://)?(?:www\.)?(flickr\.com\/)(.)*\/([0-9]+)\/#i',
            $url,
            $match
        );

        if (!empty($match)) {
            $id = end($match);
            return current($id);
        }

        return null;
    }

    public function flickrRender($id)
    {
        $restClient = new Zend_Rest_Client('https://www.flickr.com');

        $response = $restClient->restGet('/services/rest/', array(
            'api_key' => 'USER_CONFIGURABLE:YOUR_FLICKR_API_KEY',
            'secret'  => 'USER_CONFIGURABLE:YOUR_FLICKR_SECRET_KEY',
            'method' => 'flickr.photos.getInfo',
            'photo_id' => $id
        ));

        $dom = new DOMDocument();
        $dom->loadXML($response->getBody());

        if ($dom->documentElement->getAttribute('stat') === 'fail') {
            return null;
        }

        $photos = $dom->getElementsByTagName("photo");
        $photo = $photos->item(0);

        $id = $photo->getAttribute("id");
        $server = $photo->getAttribute("server");
        $farm = $photo->getAttribute("farm");
        $secret = $photo->getAttribute("secret");

        $title = "";
        if ($photo->hasChildNodes()) {

            foreach ($photo->childNodes as $childNode) {
                if (! $childNode instanceof DOMElement) {
                    continue;
                }

                if($childNode->nodeName == 'title') {
                    $title = htmlspecialchars($childNode->nodeValue);
                    break;
                }
            }
        }

        $response = $restClient->restGet('/services/rest/', array(
            'api_key' => 'USER_CONFIGURABLE:YOUR_FLICKR_API_KEY',
            'method' => 'flickr.photos.getSizes',
            'photo_id' => $id
        ));

        $pattern = "#<size.*label=\"([^\"]*)\" .*/>.*#i";
        preg_match_all($pattern, $response->getBody(), $availableSizes);

        $size = "_c";
        if (!in_array("Medium 800", $availableSizes)) {
            $size = "";
        }

        $imgScr = "https://farm{$farm}.staticflickr.com/{$server}/{$id}_{$secret}{$size}.jpg";

        return array(
            'url' => $imgScr,
            'embed' => "<img src='$imgScr' alt='$title'  title ='$title' />"
        );
    }

    public function pinterestUrlMatch($url)
    {
        preg_match_all(
            '#^(?:https?://)?(?:(www|[a-z]{2})\.)?pinterest\.com\/([^\/]+)\/([^\/]*)?#i',
            $url,
            $match
        );

        if (!empty($match)) {

            $match = array_slice($match, -2);
            $response = array(
                $match[0][0]
            );

            if (isset($match[1][0]) && $match[1][0] != "") {
                $response[] = $match[1][0];
            }

            return $response;
        }

        return null;
    }

    public function pinterestRender(array $ids)
    {
        if (count($ids) > 1) {

            if (is_numeric($ids[1])) {
                //pin
                return '<a style="display:none;" data-ref="'. $ids[1] .'" data-pin-do="embedPin" href="http://es.pinterest.com/' .
                       $ids[0] . '/' .  $ids[1] .'/' .
                       '">Pinterest pin</a>';
            } else {
                //Tablero
                return '<a style="display:none;" data-ref="'. $ids[0] . '/' . $ids[1] .'" data-pin-do="embedBoard" href="http://es.pinterest.com/' .
                       $ids[0] . '/' . $ids[1] . '/' .
                       '" data-pin-scale-width="115" data-pin-scale-height="120" data-pin-board-width="850">Pinterest Board</a>';
            }

        } else {
            //perfil
            return '<a style="display:none;" data-ref="'. $ids[0] .'" data-pin-do="embedUser" href="http://es.pinterest.com/' .
                   $ids[0] .
                   '/" data-pin-scale-width="115" data-pin-scale-height="120" data-pin-board-width="850">Pinterest profile</a>';
        }
    }

    /**
     * comprueba si el link que se le pasa es de youtube o de vimeo
     * @param string $url
     */
    public function parse_url($url)
    {
        $pattern  = '#^(?:https?://)?';    # Optional URL scheme. Either http or https.
        $pattern .= '(?:www\.)?';         #  Optional www subdomain.
        $pattern .= '(?:';                #  Group host alternatives:
        $pattern .=   'youtu\.be/';       #    Either youtu.be,
        $pattern .=   '|youtube\.com';    #    or youtube.com
        $pattern .=   '(?:';              #    Group path alternatives:
        $pattern .=     '/embed/';        #      Either /embed/,
        $pattern .=     '|/v/';           #      or /v/,
        $pattern .=     '|/watch\?v=';    #      or /watch?v=,
        $pattern .=     '|/watch\?.+&v='; #      or /watch?other_param&v=
        $pattern .=   ')';                #    End path alternatives.
        $pattern .= ')';                  #  End host alternatives.
        $pattern .= '([\w-]{11})';        # 11 characters (Length of Youtube video ids).
        $pattern .= '(?:.+)?$#x';         # Optional other ending URL parameters.

        preg_match($pattern, $url, $matches);

        if (isset($matches[1])) {

            return $matches[1];
        } else {
            $url2 = str_replace('#038;', '', str_replace('amp;', '', str_replace('&', '', $url)));
            preg_match($pattern, $url2, $matches2);

            if (isset($matches2[1])) {
                return $matches2[1];
            } else {

                $patternVimeo  = '#^(?:https?://)?';
                $patternVimeo .= '(?:www\.)?';
                $patternVimeo .= '(';
                $patternVimeo .=   'player\.vimeo\.com/';
                $patternVimeo .=   '|vimeo\.com/)';
                $patternVimeo .=     '(';
                $patternVimeo .=       'video/';
                $patternVimeo .=       '|m/';
                $patternVimeo .=       '|';
                $patternVimeo .=       '|(album)/([0-9]+)/video/';
                $patternVimeo .=     ')';
                $patternVimeo .= '([0-9]+)#i';

                preg_match_all($patternVimeo, $url2, $vimeo);

                if (sizeof($vimeo) == 6) {
                    $album = $vimeo[3][0] == 'album';

                    if ($album) {
                        $albumNumber = $vimeo[4][0];
                    } else {
                        $albumNumber = false;
                    }

                    $video = $vimeo[5][0];

                }

                $match = array($video, $album, $albumNumber);

                if ( $vimeo[0] != NULL ) {
                    return $match;
                } else {
                    return false;
                }
            }
        }
    }

    /**
     * crea un iframe de youtube con el hash del video
     * @param string $code
     */
    public function direcYoutube($code, $size)
    {

        $src = 'src="https://www.youtube.com/embed/' . $code . '/?feature=oembed"';
        $sizeIframe = 'width="' . $size["width"] . '" height="' . $size["height"] . '"';

        return '<iframe ' . $src . ' allowfullscreen="true" ' . $sizeIframe . '></iframe>';
    }

    /**
     * crea un iframe de Vimeo
     * @param String $url
     */
    public function direcVimeo($code, $size)
    {

        $src = ' src="https://player.vimeo.com/video/' . $code[0] . '/?badge=0" ';
        $sizeIframe = ' width="' . $size["width"] . '" height="' . $size["height"] . '" ';
        $attrs = ' webkitAllowFullScreen mozallowfullscreen allowFullScreen ';

        return '<iframe ' . $src . $sizeIframe . ' frameborder="0" ' . $attrs . ' ></iframe>';

    }

    /**
     * comprueba que es un videos de vimeo
     * @param string $url
     */
    public function is_vimeo($url)
    {
        if ( is_array($url) and sizeof($url) == 3 ) {
            return $url;
        } else {
            return false;
        }

    }

    /**
     * comprueba que es una presentacion de SlideShare y hace return del Iframe
     * @param string $url
     */
    public function slideShare($url)
    {
        $oembedUrl = 'http://www.slideshare.net/api/oembed/2?url=';
        $slideshareJson = $oembedUrl . $url . '&format=json';

        $jsondata = file_get_contents($slideshareJson);
        $obj = json_decode($jsondata);

        $slideshowId = $obj->slideshow_id;

        $src =  ' src="http://www.slideshare.net/slideshow/embed_code/' . $slideshowId . '" ';
        $sizeIframe = ' width="' . $obj->width . '" height="' . $obj->height . '" ';

        $params = 'frameborder="0" marginwidth="0" allowfullscreen';
        $params .= 'marginheight="0" scrolling="no" ';
        $params .= 'style="border:1px solid #CCC; border-width:1px 1px 0; margin-bottom:5px; max-width: 100%;"';

        $iframe = '<iframe ' . $src . $sizeIframe . $params . ' ></iframe>';

        $divFinal = '<div style="margin-bottom:5px">';
            $divFinal .= '<strong>';
            $divFinal .= '<a href="' . $url . '" title="' . $obj->title .'" target="_blank">';
                $divFinal .= $obj->title;
            $divFinal .= '</a>';
            $divFinal .= '</strong>';
        $divFinal .= '</div>';

        return $iframe . $divFinal;

    }

}