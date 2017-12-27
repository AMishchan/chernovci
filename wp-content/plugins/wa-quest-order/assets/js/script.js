function getEventDay(year,month,day){

  jQuery.ajax({
      url: '../wp-content/plugins/wa-quest-order/ajax-quest.php',
      method: 'POST',
      data: {year: year, month: month, day: day },
      success: function (data){
        jQuery('.get-results').html(data);
        jQuery('ul.time-list li').click(function() {
          if (jQuery(this).hasClass('booked')){
            return false;
          }
        jQuery('input[name="ident"]').val(jQuery(this).attr('data-ident'));

        

        //jQuery('#hide-layout, #popup').fadeIn(300);  // плавно показываем окно/фон
        jQuery.magnificPopup.open({
          items: {
              src: '#booking-quest' 
          },
          type:'inline',
          closeBtnInside: true,
          closeOnBgClick: true
        });
      })
      }
  });
}



jQuery(document).ready(function(){

  var date = new Date();
  getEventDay(date.getFullYear(), date.getMonth()+1, date.getDate() )
  jQuery('.day-line li').click(function(){
  jQuery('.day-line').find('.block-day').removeClass('block-day');
  jQuery(this).addClass('block-day');
  });


  

/*  jQuery('#popup').hide();
  jQuery('#hide-layout').hide();
  jQuery('#hide-layout').css({opacity: .5});*/

/*
  jQuery('.btn-close, #hide-layout').click(function() {
  jQuery('#hide-layout, #popup').hide(); // плавно скрываем окно/фон
  })*/
  
  jQuery('form#booking').submit(function(e){
    e.preventDefault();

    var name = jQuery('#order-name').val();
    var phone = jQuery('#order-contact').val();
    var ident = jQuery('#order-ident').val();

    jQuery.ajax({
        url: '../wp-content/plugins/wa-quest-order/ajax-admin.php',
        method: 'POST',
        data: {phone: phone, name: name, ident: ident },
        success: function (data){
          
         jQuery('#console .content').html(data);

         jQuery.magnificPopup.open({
            items: {
                src: '#console' 
            },
            type:'inline',
            closeBtnInside: true,
            closeOnBgClick: true
         });

         /*function closeConsole() {
            jQuery.magnificPopup.close({
                  items: {
                      src: '#console' 
                  }
              });
          };*/

          //setTimeout(closeConsole ,2500);

          //addClass

          jQuery('[data-ident=' + ident + ']').addClass('booked');
        }
    });
  })
});


jQuery(document).ajaxStop(function(){

    foretime();

});

function foretime(){

  var globalTime = parseInt(jQuery('span[data-time]').attr('data-time').replace(/:/g,""));

  var globalDay = jQuery('span[data-time]').text().substring(0, 2);

  var item = jQuery('[data-ident]');

  item.each(function(){

    var ident = jQuery(this).attr('data-ident');

    var time = parseInt(ident.substring(ident.length - 4));
    var day = parseInt(ident.substring(ident.length - 6, ident.length - 4));

    if(time <= globalTime + 15 && globalDay == day) {
      
      jQuery(this).addClass('booked');

    }
    
  });
  
}