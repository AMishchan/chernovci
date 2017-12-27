<?php
date_default_timezone_set("Europe/Moscow");
$locale_time = setlocale (LC_TIME, 'ru_RU.UTF-8', 'Rus');

function strf_time($format, $timestamp, $locale)
{
    $date_str = strftime($format, $timestamp);
    if (strpos($locale, '1251') !== false)
    {
        return iconv('cp1251', 'utf-8', $date_str);
    }
    else
    {
        return $date_str;
    }
}
?>
<div class="wrapper">
<div class="content">

  <div class="row date-string">
    <div class="columns large-2">
      <?php $day = 0; ?>
      <?php $curtime = date('H:i'); ?>
      <span data-time="<?php echo $curtime; ?>"><?php echo strf_time("%d %B" , time(), $locale_time); ?></span>
    </div>
    <div class="columns large-10">
      <ul class="day-line">
        <?php for( $i = 14; $i > 0; --$i ){ ?>
        <?php $today = strf_time("%d", strtotime("+$day day"), $locale_time); ?>
        <?php $week = str_replace('.', '', strf_time("%a", strtotime("+$day day"), $locale_time)); ?>

          <li onclick='getEventDay(<?php echo date('Y,m,d', strtotime("+$day day"));?>)'<?php if ($i == 14) echo "class='block-day'"; ?>>
            <?php echo $today ?><br><span <?php if('Сб' == $week || 'Вс' == $week){ echo "style='color:red;'";};?>><?php echo $week;?></span></li>
          <?php $day++ ?>
        <?php } ?>
      </ul>
    </div>
  </div>

  <div class="get-results">

  </div>
</div>


<div id="booking-quest" class="white-popup mfp-hide mfp-popup">

  <h2 class="popup-title"> Бронирование квеста </h2>

  <p>Введит Фио и телефон!</p>

  <form  action="" method="post" id="booking">

    <input id="order-name" type="text" name="name" value="" placeholder="Ваше Имя">
    <input id="order-contact" type="text" name="phone" value="" placeholder="Ваш номер телефона">
    <input id="order-ident" type="hidden" name="ident" value="">

    <button id="btn-yes" class="book-kvest-but">Забронировать</button>

  </form>

</div>
<!-- mfp console popup-->

<div id="console" class="white-popup mfp-hide mfp-popup">

  <h2 class="popup-title"> Бронирование квеста </h2>

  <div class="content"></div>

</div>
