<?php


     /**
           * Description of ClipCanvas
      *
      * @author sajidhussain
      */
      
      
class FF_Api_ClipCanvas {

    //put your code here

    /**
    *
    * @return FF_Api_ClipCanvas
    */
    public static function instance()
    {
         $classname = __CLASS__;
         return new $classname();

    }

    //put your code here

    public function getSearchResults( FF_DTO_ParametersDTO $search )
    {

         $client = new Zend_Rest_Client( 'http://api.clipcanvas.com' );

         $search_params = array ( 'q' => $search->searchText );
         $result = $client->restGet( '/search/1e5f6d7ccb72f6fd388d5cfb26e6158a' , $search_params );

         var_dump( $result );
         $restResultAsObject = Zend_Json::decode( $result->getBody() , Zend_Json::TYPE_OBJECT );
    //$client->q('vision');
    // var_dump($client);
    //$result = $client->get();
    //                foreach ($restResultAsObject as $obj) {
    //                       print_r($obj);
    //                }
         var_dump( $restResultAsObject ); // "Hello Davey, Good Day"
         exit;
         // new HTTP request to some HTTP address
         //
    // $offset=($display*$page)-$display;
    //$curl_postfields=array('type_id' => 1, 'q'=>$search->searchText, 'number'=>$search->num_display_entries, 'page'=>$search->current_page);
    //$pid = '9254';
    //$pwd = 'foovIdQuav';
    //$url = "https://en.clipdealer.com/api/query";
    //$ch_clipdealer=curl_init();
    //curl_setopt($ch_clipdealer, CURLOPT_URL, $url);
    //curl_setopt($ch_clipdealer, CURLOPT_HTTPHEADER, array('Accept: text/json'));
    //curl_setopt($ch_clipdealer, CURLOPT_USERPWD, $pid . ':' . $pwd);
    //curl_setopt($ch_clipdealer, CURLOPT_HEADER, 0);
    //curl_setopt($ch_clipdealer, CURLOPT_RETURNTRANSFER, 1);
    //curl_setopt($ch_clipdealer, CURLOPT_POST, 1);
    //curl_setopt($ch_clipdealer, CURLOPT_POSTFIELDS,$curl_postfields);
    //curl_setopt($ch_clipdealer, CURLOPT_SSL_VERIFYHOST, 1);
    //curl_setopt($ch_clipdealer, CURLOPT_SSL_VERIFYPEER, FALSE);
    //curl_setopt($ch_clipdealer, CURLOPT_SSLVERSION, 3);
    //curl_setopt($ch_clipdealer, CURLOPT_FOLLOWLOCATION, true);
    //curl_setopt($ch_clipdealer, CURLOPT_ENCODING , "gzip");
    //
    // $result = curl_exec($ch_clipdealer);
    // var_dump($result);
    //
    //$error2=curl_getinfo( $ch_clipdealer, CURLINFO_HTTP_CODE );
    //curl_close($ch_clipdealer);
    //                     $client = new Zend_Http_Client( 'https://en.clipdealer.com/api/query' );
    //                     $client->setAuth( '9254' , 'foovIdQuav' );
    //
    //// set some parameters
    //                     $client->setParameterPost( 'q' , $search->searchText );
    //
    //// POST request
    //                     $response = $client->request( Zend_Http_Client::POST );
    //                     echo $response;
    //
    //
    //        $client = new Zend_Rest_Client();
    //        $args = array("type_id" => 1, "q" => "water");
    //        $client->setUri('https://9254:foovIdQuav@clipdealer.com/api');
    //        $result = $client->restPost('/query', $args);
    //        //$restResultAsObject = Zend_Json::decode($result->getBody(), Zend_Json::TYPE_OBJECT);
    //        // print_r($restResultAsObject);
    //        echo $result;

         exit;

    }


}


?>
