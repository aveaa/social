<?php

/**
* Заменяет английские временные единицы на русские
* @param {string} - строка с датой, полученной из date()
* @see date()
*/
function rusdate($datestring)
  {
    return preg_replace([
      "/January/",
      "/February/",
      "/March/",
      "/April/",
      "/May/",
      "/June/",
      "/July/",
      "/August/",
      "/September/",
      "/October/",
      "/November/",
      "/December/",
    ], [
      "января",
      "февраля",
      "марта",
      "апреля",
      "мая",
      "июня",
      "июля",
      "августа",
      "сентября",
      "октября",
      "ноября",
      "декабря"
    ], $datestring, 1);
  }

/**
* Возвращает относительное время на руссокм
* @param {int} date - дата в UNIX
*/
function zmdate($date)
  {
    $text ="";
    $diff = round(time() - $date);
    if($diff < 0) return null;
    
    $diff = $diff / 86400;
    if($diff > 2) return rusdate(implode(" в ", [date("d F Y ",$date), date(" H:i",$date)]));
    if($diff > 1) return rusdate("вчера в ".date("H:i",$date));
    
    $diff = round((time() - $date) / 60);
    if($diff > 60) return rusdate("сегодня в ".date("H:i",$date));
    
    return $diff === 5 ? "ровно 5 минут назад" : "$diff минут назад";
  }
  
function zmbd($date) { return zmdate($date); }

function zmdateapi($date) { return zmdate($date); }

function zmd($date) { return "Сервер времени недоступен: E22VR-SKA-I-OVKCI"; }
