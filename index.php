<?php
  class linkedList {
      private $data;
      private $head;
      private $next;
      private $last;
	  private $digit; // здесь храниться разряд числа

      function __construct ($data, $obj = NULL) {
        $this -> addData($data, $obj);

        if ($obj === NULL) {
          $this -> head = $this;
        } else {
		//В момент создания последующих узлов, записываем в них информацию о первом и последнем узле
          $this -> head = $obj -> getHead();
          $obj -> setNext($this);
          $this -> setLastForAll();
        }
      }

      public function setNext ($nextNode) {
        return $this -> next = $nextNode;
      }

      private function addData ($value, $obj = NULL) {
		if ($obj -> digit) {
			$value ++;
		}
		if ($value > 9) {
			$this -> digit = 1;
		}
        return $this -> data = $value % 10;
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
	//создание либо первого узла списка, либо записываем в существующий узел ссылку и данные нового узла
    if ($linkedList === NULL) {
      $linkedList = new linkedList($digit % 10);
    } else {
      $linkedList = new linkedList($digit % 10, $linkedList);
    }

    $digit /= 10;
  }

  return $linkedList -> getHead();
}

//возвращает проссумированный связанный список
function sumNodes ($firstLL, $secondLL) {

	$resultLL;

	$flag = false;
	while ($firstLL !== NULL || $secondLL !== NULl) {
		$sum = $firstLL -> getData() + $secondLL -> getData();

		if ($flag) {
			$resultLL =  new linkedList($sum);
			$flag = true;
		} else {
			$resultLL =  new linkedList($sum, $resultLL);
		}

		$firstLL = $firstLL -> getNext();
		$secondLL = $secondLL -> getNext();
	}

	return $resultLL -> getHead();
}

//прошу прощения за хардкод
//по сути можно было бы реализовать более элегатно, к примеру получать числа из формы
$num1 = 342;
$num2 = 465;

$firstLL = createLinkedList($num1);
$secondLL = createLinkedList($num2);

$summedLL = sumNodes($firstLL, $secondLL);

while($summedLL !== NULL) {
	echo $summedLL -> getData();
	$summedLL = $summedLL -> getNext();
}
