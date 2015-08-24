<?php

/**
 * 封装的CUrl工具类
 */
class UrlUtil{
    /*
     * 功能:
     *      向服务器发送POST请求
     * 参数:
     *      $url    请求地址
     *      $postData   要发送的数据
     *      $dataType   1:urlencoded 2:multipart/form-data
     *      $protocolType   1:http 2:https
     * 返回值:
     *      返回服务器的返回信息
     */

    public static function SendPostRequest($url, $postData, $dataType = 1, $protocolType = 1) {
        ini_set('user_agent', 'Mozilla/5.0 (Linux; Android 4.2.1; en-us; Nexus 4 Build/JOP40D) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166 Mobile Safari/535.19');
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POST, 1);

        if ($protocolType == 2) {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        }

        if ($dataType == 1) {
            $urlencodedString = '';
            foreach ($postData as $key => $value) {
                $urlencodedString .= $key . '=' . $value . '&';
            }
            $urlencodedString = rtrim($urlencodedString, '&');
            curl_setopt($curl, CURLOPT_POSTFIELDS, $urlencodedString);
        } else {
            curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
        }

        $data = curl_exec($curl);
        curl_close($curl);

        return $data;
    }

    /*
     * 功能:
     *      向服务器发送Get请求
     * 参数:
     *      $url    请求地址
     *      $protocolType   1:http 2:https
     * 返回值:
     *      返回服务器的返回信息
     */

    public static function SendGetRequest($url, $protocolType = 1, $jumpRedirect = TRUE) {
        ini_set('user_agent', 'Mozilla/5.0 (Linux; Android 4.2.1; en-us; Nexus 4 Build/JOP40D) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166 Mobile Safari/535.19');
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        if ($protocolType == 2) {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        }

        $data = curl_exec($curl);
        $responseInfo = curl_getinfo($curl);

        if ($responseInfo['redirect_url'] && $jumpRedirect) {
            return self::SendGetRequest($responseInfo['redirect_url']);
        }

        curl_close($curl);


        return $data;
    }

}
