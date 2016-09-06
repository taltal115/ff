<?php


/*
* To change this template, choose Tools | Templates
* and open the template in the editor.
*/

/**
 * Description of PondEngine
 *
 * @author sajidhussain
 */
require_once "p5ap/p5api_client_v1.php";

class FF_Api_PondEngine
{
    //put your code here
    /**
     *
     * @return FF_Api_PondEngine
     */
     
    public $searchType = "Pond5";
    public $totalPages;
    
    public static function instance()
    {
        $classname = __CLASS__;
        return new $classname(); 
    }

    public function getTotalPages() {
        return $this->totalPages;
    }

    private function generateTotalPages($totalRecords, FF_DTO_ParametersDTO $search) {

        $this->totalPages = ceil($totalRecords / $search->items_per_page);
        return $this->totalPages;
    }
    
    public function getSearchEmpty(FF_DTO_ParametersDTO $searchObj) {
        $dateSortOrder = "relevance";
        $resultSet = new FF_DTO_ResultSetDTO($searchObj,$this->searchType);
        
        if ($searchObj->searchType != 'All') {
            $jsonObjects = Zend_Json_Encoder::encode($resultSet);
            return $jsonObjects;
        }
        return $resultSet;
    }
    
    public function getSearchResults(FF_DTO_ParametersDTO $search)
    {
        $pond5Client = new p5api_client();
        $pond5Client->api_key = "8015_810895849"; // prod
        $pond5Client->my_secret = "fsdjkfskljflj34mj"; // prod
        $pondCmd = $pond5Client->get_search_command();
        $pondCmd->query = $search->searchText;
        $pondCmd->at_page = ($search->current_page - 1);
        $pondCmd->no = $search->items_per_page;
        $pondCmd->bm = p5api_client_command_search::$BM_ANY_VIDEO;
        $pondCmd->col_mask = p5api_client_command_search::$COL_NAME +
            p5api_client_command_search::$COL_DURATION +
            p5api_client_command_search::$COL_KEYWORDS;
        
        if($search->hdSearch==1)
            $pondCmd->col_mask =p5api_client_command_search::$BM_HD;
         if($search->dateSortOrder==1)
            $pondCmd->col_mask =p5api_client_command_search::$SB_DATE_UPLOADED;
        
        $pond5Client->add_command($pondCmd);
        //http://www.pond5.com/document/api.html
        //http://www.pond5.com/files/search_api.txt
        
        $jsonObjects = $pond5Client->query_pond5();
        //echo '<pre>';
        //print_r($jsonObjects);
        //exit;
        if (false === $jsonObjects) {
            LOGI($pond5Client->get_error());
        }
        // We know we only have one command_response
        //die($jsonObjects["commands"][0][ 'tot_nbr_rows' ] . " :: ");
        $command = $jsonObjects["commands"][0];
        
        $resultSet = new FF_DTO_ResultSetDTO($search,$this->searchType);
        $resultSet->totalResults = $command['tot_nbr_rows'];
        
        $resultSet->totalPages=$this->generateTotalPages($command['tot_nbr_rows'], $search);

        $items = $command["items"];
        $videoId = 1;
        //put condition if it dont have records like I did another api /ok    
        if($resultSet->totalResults > 0)
        {
            foreach ($items AS $item)
            {
	            if($videoId > $search->items_per_page)
                    break;
                
                $videoObject = new FF_DTO_VideoObjectDTO();
                $videoObject->videoId = $videoId++;
                $videoObject->videoServiceId = $item["id"];
                $videoObject->videoName = $item["n"];
                $videoObject->creator_name = "pond5_noname";
                  //echo $item["n"];
                //    echo   $videoObject->videoName;

                  ///exit;

                //if agent is non flash then we would call get_mov method but leave this for now
                $videoFlvURLObject = $pond5Client->get_flv($command, $item, 480, 270);
               // var_dump($videoFlvURLObject);
                //$videoObject->videoFlvURL = $videoObject->videoFlvURL[0];
                $flvUrl = $videoFlvURLObject[1];
                $mp4Url = str_replace("_prev_l.flv","_main_xxl.mp4",$flvUrl);
                $videoObject->videoFlvURL = $mp4Url;

                list($thumbURL, $width, $height) = $pond5Client->get_icon($command, $item, 120, 90);
                //'<img class="srimg" alt="item ' . $v["id"] . '" style="width:' . $xsize . 'px;height:' . $ysize . 'px;" src="' . $icon_url . '" />' .
                $item_url = $pond5Client->get_canonical_url($command, $item);
                $videoObject->thumbURL = $thumbURL;
                $videoObject->videoHeight = $height;
                $videoObject->videoWidth = $width;
                $videoObject->videoDollor = $item_url."?ref=VjPurpleEye";

                //Setting Objects in Array
                $resultSet->videoObjects[] = $videoObject;
                //tot_nbr_rows
            }
        }

          //  var_dump($resultSet);
        if ($search->searchType != 'All') {
            $jsonObjects = Zend_Json_Encoder::encode($resultSet);

            return $jsonObjects;
        }
        return $resultSet;

    }

}


?>
