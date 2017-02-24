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
      class ClientTest extends PHPUnit_Framework_TestCase
      {
          protected function tearDown()
          {
              Stylist::deleteAll();
              // Client::deleteAll();
          }
          function test_getName()
          {
              $name="Mike";
              $id= null;
              $stylist= new Stylist($name, $id);
              $stylist->save();

              $name="Chris";
              $id=1;
              $stylist_id= $stylist->getId();
              $client = new Client($name,$id, $stylist_id);

              $result= $client->getName();
              $this->assertEquals($name, $result);
          }
          function test_getId()
          {
            $name="Mike";
            $id= null;
            $stylist= new Stylist($name, $id);
            $stylist->save();

            $name="Chris";
            $id=1;
            $stylist_id= $stylist->getId();
            $client = new Client($name,$id, $stylist_id);

            $result= $client->getId();
            $this->assertEquals(true, is_numeric($result));
          }
          function test_getStylistId()
          {
              $id=null;
              $name="Mike";
              $stylist= new Stylist($name, $id);
              $stylist->save();

              $id=1;
              $name="Chris";
              $stylist_id= $stylist->getId();
              $client = new client($name,$id, $stylist_id);

              $result= $client->getStylistId();
              $this->assertEquals($stylist_id, $result);
          }
      }
 ?>
