<?php

/**
 * 正则表达式工具类
 *
 * @author Knight
 */
class PregUtil {
    /*
     * 	功能:
     *      构造函数
     *  参数:
     *      source: 匹配的源文本(string)
     */

    public function __construct($source) {
        $this->source = $source;
    }

    /*
     * 功能:
     *      根据匹配模式,返回一条匹配的内容,对应preg_match
     * 参数:
     * 		pattern 正则表达式的匹配模式(string)
     * 		data 保存匹配内容的数组(array)
     * 		indexs 匹配对象在匹配模式中的索引,从1开始(array)
     * 		keys 保存内容在$data数组中的key(array)
     * 返回值:
     * 		匹配成功,返回true,否则返回false
     */

    public function GetMatch($pattern, &$data, $indexs, $keys) {
        $arr = array();
        if (preg_match($pattern, $this->source, $arr)) {
            for ($i = 0; $i < count($indexs); $i++) {
                $data[$keys[$i]] = $arr[$indexs[$i]];
            }
            return true;
        } else {
            for ($i = 0; $i < count($keys); $i++) {
                $data[$keys[$i]] = '';
                $message = $keys[$i] . "未匹配\r\n";
                echo $message;
            }
            return false;
        }
    }

    /*
     * 功能:
     *      根据匹配模式,返回所有匹配的内容,对应preg_match_all
     * 参数:
     *      pattern 正则表达式的匹配模式
     *      data 保存匹配内容的数组
     *      indexs 匹配对象在匹配模式中的索引,从1开始
     *      keys 保存内容在$data数组中的key
     * 返回值:
     * 		匹配成功,返回true,否则返回false
     */

    public function GetAllMatch($pattern, &$data, $indexs, $keys) {
        $arr = array();
        if (preg_match_all($pattern, $this->source, $arr)) {
            for ($i = 0; $i < count($indexs); $i++) {
                $data[$keys[$i]] = $arr[$indexs[$i]];
            }
            return true;
        } else {
            return false;
        }
    }

    /*
     * 功能：
     *      根据匹配模式，替换找到的字符串，对应原生的preg_replace
     * 参数：
     *      $pattern    匹配模式
     *      $replacement    替换的字符串
     * 返回值：
     *      替换完后的字符串
     */

    public function Replace($pattern, $replacement) {
        return $this->source = preg_replace($pattern, $replacement, $this->source);
    }

    /*
     * 功能:
     *      设置匹配的源文本
     * 参数:
     *      source:源文本
     * 返回值:
     *      无
     */

    public function SetSource($source) {
        $this->source = $source;
    }

    private $source; //匹配的源

}
