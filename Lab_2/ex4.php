<?php  class A {
    public static function test()
    {
        echo 1;
    }

    public static function get()
    {
        self::test();
    }
}
class B extends A
{
    public static function test()
    {
        echo 2;
    }
    public static function get()
    {
        self::test();
    }
}
B::get();

?>