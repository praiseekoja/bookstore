<?php

function abbreviateBalance($count){
    $abbreviations = array(12 => 'T', 9 => 'B', 6 => 'M', 3 => 'K', 0 => '');

    foreach ($abbreviations as $key => $value) {
        if ($count >= pow(10, $key)) {
            return $value;
        }
    }
}

function abbreviateNumber($num) {
    if ($num >= 0 && $num < 1000) {
      $format = floor($num);
      $suffix = '';
    }
    else if ($num >= 1000 && $num < 1000000) {
      $format = floor($num / 1000);
      $suffix = 'K';
    }
    else if ($num >= 1000000 && $num < 1000000000) {
      $format = floor($num / 1000000);
      $suffix = 'M';
    }
    else if ($num >= 1000000000 && $num < 1000000000000) {
      $format = floor($num / 1000000000);
      $suffix = 'B';
    }
    else if ($num >= 1000000000000) {
      $format = floor($num / 1000000000000);
      $suffix = 'T';
    }

    return !empty($format . $suffix) ? $format . $suffix : 0;
  }

function timeElapsed($date){
    date_default_timezone_set("Africa/Lagos");
    $months=array();
    for ($i=1; $i < 13; $i++) {
        $month = date('F',mktime(0,0,0,$i));
        $months += [$month => $i];
    }
    $date_year = date('Y', strtotime($date));//year of the date
    $date_month = date('m', strtotime($date));//month of the date
    $date_day = date('j', strtotime($date));//day of the date
    $date_hour = date('H', strtotime($date));//hour of the date
    $date_minute = date('i', strtotime($date));//minute of the date
    $current_year = date('Y');//current year

    //seconds passed between the given and current date
    $seconds_passed = round((time()-strtotime($date)),0);

    //minutes  passed between the given and current date
    $minutes_passed = round((time()-strtotime($date))/ 60,0);

    //hours passed between the given and current date
    $hours_passed = round((time()-strtotime($date))/ 3600,0);

    //days passed between the given and current date
    $days_passed = round((time()-strtotime($date))/ 86400,0);

    if($seconds_passed<60 && $current_year==$date_year) return $seconds_passed." second".($seconds_passed == (1) ? " " : "s")." ago";
    //outputs 1 second / 2-59 seconds ago

    else if($seconds_passed>=60 && $minutes_passed<60 && $current_year==$date_year) return $minutes_passed." minute".($minutes_passed == (1) ? " " : "s")." ago";
    //outputs 1 minute/ 2-59 minutes ago

    else if($minutes_passed>=60 && $hours_passed<24 && $current_year==$date_year) return $hours_passed." hour".($hours_passed == (1) ? " " : "s")." ago";
    //outputs 1 hour / 2-23 hours ago

    else if($hours_passed>=24 && $days_passed<2 && $current_year==$date_year) return "Yesterday at ".$date_hour.":".$date_minute." ".($date_hour < (12) ? "AM" : "PM");
    //outputs [Yesterday at 11:30] for example

    else{
        if ($date_year > $current_year) {
            return '';
        }

            foreach($months as $month_name => $month_number){
                if($month_number==$date_month){
                    return $month_name." ".$date_day.", ".$date_year;
                    //echo $date_hour < (12) ? "AM" : "PM " ;
                    //outputs [Dec 11, 11:32] for example
                }
            }
    }
}

?>
