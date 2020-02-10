<?php
  class linkedList {
      private $data;
      private $head;
      private $next;
      private $last;

      function __construct ($data, $obj = NULL) {
        $this -> addData($data);
        if ($obj === NULL) {
          $this -> head = $this;
        } else {
          $this -> head = $obj ->getHead();
          $obj -> setNext($this);
          $this -> setLastForAll();
        }
      }

      public function setNext ($nextNode) {
        return $this -> next = $nextNode;
      }

      private function addData ($value) {
        return $this -> data = $value;
      }

      public function getData () {
        return $this -> data;
      }

      public function getNext() {
        return $this -> next;
      }

      public function getHead() {
        return $this -> head;
      }

      private function setLastForAll() {
        $obj = $this -> head;
        while ($obj -> getNext() != NULL) {
          $obj -> setLast($this);
          $obj = $obj -> getNext();
        }
      }

      private function setLast($obj) {
        return $this -> last = $obj;
      }
}

//вспомогательная функция для создания связанных списков
function createLinkedList ($num) {
  $linkedList = NULL;
  $digit = $num;
  for ($i = 0; $i < strlen($num); $i++) {

    if ($linkedList === NULL) {
      $linkedList = new linkedList($digit % 10);
    } else {
      $linkedList = new linkedList($digit % 10, $linkedList);
    }

    $digit /= 10;
  }

  return $linkedList;
}


$num1 = 342;
$num2 = 465;

$firstLL = createLinkedList($num1);
$secondLL = createLinkedList($num2);


?>
