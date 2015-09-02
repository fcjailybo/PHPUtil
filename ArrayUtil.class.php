<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/9/2
 * Time: 15:41
 */


/**
 * Class ArrayUtil
 * 方便操作数组的类
 * @package Common\Library\PHPUtil
 */
class ArrayUtil{

    /**
     * 截取数组的指定key的部分
     * 例如 :
     *      $a = array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4);
     *      ArrayUtil::GetPartArray($a, array('a', 'c'))
     *      返回值为  array('a' => 1, 'c' => 3);
     * @param array $arr 要截取的数组
     * @param array $keys 要截取的key
     * @return array    截取到的数组
     */
    static public function GetPartArray($arr, $keys) {
        $ret = array();
        foreach ($keys as $key) {
            $ret[] = $arr[$key];
        }

        return $ret;
    }
}