<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    require_once "src/Stylist.php";
    require_once "src/Client.php";
    $server = 'mysql:host=localhost:8889;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);
    class StylistTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Stylist::deleteAll();
            // Client::deleteAll();
        }
        function test_getName()
        {
            $name= "Jason";
            $id = 1;
            $stylist = new Stylist($name, $id);

            $result = $stylist->getName();
            $this->assertEquals($name, $result);
        }
        function test_getId()
        {
            $name= "Jason";
            $id = 1;
            $stylist = new Stylist($name, $id);

            $result = $stylist->getId();
            $this->assertEquals(true, is_numeric($result));
        }
        function test_save()
        {
          $name= "Jason";
          $id = 1;
          $stylist = new Stylist($name, $id);
          $stylist->save();

          $result = Stylist::getAll();
          $this->assertEquals($stylist, $result[0]);
        }
        function test_getAll()
        {
          $name= "Jason";
          $id = 1;
          $stylist = new Stylist($name,$id);
          $stylist->save();

          $name2= "Mike";
          $id2= 2;
          $stylist2 = new Stylist($name2, $id2);
          $stylist2->save();

          $result= Stylist::getAll();
          $this->assertEquals([$stylist,$stylist2], $result);
        }


    }
?>
