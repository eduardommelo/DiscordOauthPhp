<?php
    class Api{
        function requestGET($get, $fields = false, $headers = false){
            $sh = curl_init($get);
            if($headers !== false) curl_setopt($sh, CURLOPT_HTTPHEADER, $headers);
            if($fields !== false)  curl_setopt($sh, CURLOPT_POSTFIELDS, http_build_query($fields));
            curl_setopt($sh, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($sh, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($sh,CURLOPT_SSL_VERIFYHOST , 0);
            $result = curl_exec($sh);
            curl_close($sh);
            return json_decode($result);
        }
        function requestPOST($post, $fields = false, $headers = false){
            $sh = curl_init($post);
            if(isset($fields)) curl_setopt($sh, CURLOPT_POSTFIELDS, http_build_query($fields));
            if(isset($headers)) curl_setopt($sh, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($sh, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($sh, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($sh,CURLOPT_SSL_VERIFYHOST , 0);
            curl_setopt($sh, CURLOPT_POST, 1);
            $result = curl_exec($sh);
            curl_close($sh);
            return json_decode($result);
        }
        function btoa($encode){
            return base64_encode($encode);
        }
    }

?>

