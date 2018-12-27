<?php

class Pawn extends Figure {
     private $CountStep = 0;      // Счетчик ходов
     
     /* Проверяем ходы пешки */
     public function validation($xFrom, $yFrom, $xTo, $yTo, $DistCell, $figures)  {
        
        $this->CountStep++; // увеличиваем счетчик ходов

        /* Пешка просто ходит */
        if ($DistCell == 0 AND $xFrom == $xTo) {
             if ((max($yFrom, $yTo) - min($yFrom, $yTo)) ==  1) {  // Пешка ходит на одну клетку
                 return true;
             }
             elseif ((max($yFrom, $yTo) - min($yFrom, $yTo)) ==  2 AND  $this->CountStep == 1) {  // Пешка ходит первый раз на 2 клетки
                 if(!isset($figures[$xFrom][(($yFrom + $yTo)/2)])) // если на пути нет фигур                 
                      return true;
                 else
                       throw new \Exception("Obstacle on the way");

             } else { throw new \Exception("Pawn doesn't go like that"); }
        }
        /* Пешка нападает на противника */
        elseif ($DistCell == 2 AND $xFrom !== $xTo) {

             $xPlus = $xFrom;   // для смещения буквы вверх
             $xMinus = $xFrom;  // для смещения буквы вниз

             if ((++$xPlus == $xTo OR --$xPlus == $xTo) AND (max($yFrom, $yTo) - min($yFrom, $yTo)) ==  1)  // Пешка ест на одну клетку по диагонали
                  return true;
      
        }  else {
            throw new \Exception("Wrong move");
        }

    }

    public function __toString() {
        return $this->isBlack ? '♟' : '♙';
    }

 	
}
