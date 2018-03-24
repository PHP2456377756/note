<?php
/**
 * Created by PhpStorm.
 * User: administrator
 * Date: 2017/11/2
 * Time: 下午7:38
 */
namespace Foo;
class Bar {
    public function Bar() {
        print 'bar object';
        // treated as constructor in PHP 5.3.0-5.3.2
        // treated as regular method as of PHP 5.3.3
    }
}
$bar = new Bar();



