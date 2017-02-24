<?php
    class Stylist
    {
      private $name;
      private $id;

      function __construct($name, $id=null)
      {
        $this->name = $name;
        $this->id = $id;
      }
      function getName()
      {
        return $this->name;
      }
      function getId()
      {
        return $this->id;
      }
      function setName($new_name)
      {
        $this->name = (string)$new_name;
      }
      function save()
      {
        $GLOBALS['DB']->exec("INSERT INTO stylists (name) VALUES('{$this->getName()}')");
        $this->id = $GLOBALS['DB']->lastInsertID();
      }

      static function getAll()
      {
        $returned_stylists = $GLOBALS['DB']->query("SELECT * FROM stylists;");
        $stylists= array();
        foreach ($returned_stylists as $stylist) {
          $name = $stylist['name'];
          $id = $stylist['id'];
          $new_stylist = new Stylist($name, $id);
          array_push($stylists, $new_stylist);
        }
        return $stylists;
      }
      static function deleteAll()
      {
          $GLOBALS['DB']->exec("DELETE FROM stylists;");
      }
      static function find($search_id)
      {
        $found_stylist = null;
        $stylists = Stylist::getAll();
        foreach ($stylists as $stylist) {
          $stylist_id =$stylist->getId();
          if ($stylist_id ==$search_id) {
            $found_stylist= $stylist;
          }
        }
        return $found_stylist;
      }
      function edit($new_name)
      {
        $GLOBALS['DB']->exec("UPDATE stylists SET name = '{$new_name}' WHERE id = {$this->getId()};");
        $this->setName($new_name);
      }
      function delete()
      {
          $GLOBALS['DB']->exec("DELETE FROM stylists WHERE id = {$this->getId()};");
          // $GLOBALS['DB']->exec("DELETE FROM clients WHERE cuisine_id={$this->getid()};");
      }


    }
 ?>
