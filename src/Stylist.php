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
        $this->Name = (string)$new_name;
      }


    }
 ?>
