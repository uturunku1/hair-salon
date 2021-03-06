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
            Client::deleteAll();
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
        function test_find()
        {
          $name= "Jason";
          $id = 1;
          $stylist = new Stylist($name,$id);
          $stylist->save();

          $name2= "Mike";
          $id2= 2;
          $stylist2 = new Stylist($name2, $id2);
          $stylist2->save();

          $result= Stylist::find($stylist->getId());
          $this->assertEquals($stylist, $result);
        }
        function test_edit()
        {
          $name= "Jason";
          $id = 1;
          $stylist = new Stylist($name, $id);
          $stylist->save();
          $new_name= "Taylor";
          $stylist->edit($new_name);

          $result= $stylist->getName();
          $this->assertEquals($new_name, $result);
        }
        function test_delete()
        {
          $name= "Jason";
          $id = 1;
          $stylist = new Stylist($name, $id);
          $stylist->save();

          $stylist->delete();

          $result= Stylist::getAll();
          $this->assertEquals([], $result);
        }
        function test_deleteClientsToo()
        {
            $name= "Jason";
            $id = 1;
            $stylist = new Stylist($name, $id);
            $stylist->save();

            $name="Julie";
            $id=null;
            $stylist_id= $stylist->getId();
            $client=new Client($name, $id, $stylist_id);
            $client->save();

            $stylist->delete();

            $result= Client::getAll();
            $this->assertEquals([], $result);
        }
        function test_getClients()
        {
            $name= "Jason";
            $id = null;
            $stylist = new Stylist($name, $id);
            $stylist->save();

            $name="Julie";
            $stylist_id= $stylist->getId();
            $client=new Client($name, $id, $stylist_id);
            $client->save();
            $name2="Mary";
            $client2=new Client($name, $id, $stylist_id);
            $client2->save();

            $result= $stylist->getClients();
            $this->assertEquals([$client, $client2], $result);

        }


    }
?>
