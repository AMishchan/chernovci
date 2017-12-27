jQuery(document).ready(function(){
  jQuery(".quest").tablesorter( {sortList: [[0,"d"],[1,"a"]]});
});

function makeElementEditable(div){
  div.style.border = "1px solid lavender";
  div.style.padding = "5px";
  div.style.background = "white";
  div.contentEditable = true;
}

function updateTaskStatus(target, taskId){
  var data = target.textContent;
  target.style.border = "none";
  target.style.padding = "0px";
  target.contentEditable = false;

  jQuery.ajax({
      url: '../wp-content/plugins/wa-quest-order/ajax-admin.php',
      method: 'POST',
      data: {status: data, id: taskId},
      success: function (data){
        jQuery('#ajax_msg').css("display", "block").delay(5000).slideUp(2000).html(data);
      }
  });
}
function updateEventFIO(target, eventId) {
  var data = target.textContent;
  target.style.border = "none";
  target.style.padding = "0px";
  target.contentEditable = false;

  jQuery.ajax({
      url: '../wp-content/plugins/wa-quest-order/ajax-admin.php',
      method: 'POST',
      data: {fio: data, id: eventId},
      success: function (data){
        jQuery('#ajax_msg').css("display", "block").delay(5000).slideUp(2000).html(data);
      }
  });
}
function updateEventPhone(target, eventId) {
  var data = target.textContent;
  target.style.border = "none";
  target.style.padding = "0px";
  target.contentEditable = false;

  jQuery.ajax({
      url: '../wp-content/plugins/wa-quest-order/ajax-admin.php',
      method: 'POST',
      data: {phone: data, id: eventId},
      success: function (data){
        jQuery('#ajax_msg').css("display", "block").delay(5000).slideUp(2000).html(data);
      }
  });
}

function deleteEvent(target, taskId){
  if(confirm("Вы точно хотите удалить запись?")){
    jQuery.ajax({
        url: '../wp-content/plugins/wa-quest-order/ajax-delete.php',
        method: 'POST',
        data: {id: taskId},
        success: function (data){
          jQuery(target).parents('tr').slideUp(100);
          jQuery('#ajax_msg').css("display", "block").delay(3000).slideUp(300).html(data);
        }
    });
  }
}

function proveEvent(target, eventId) {
  var key = 'Подтвержден';
  jQuery.ajax({
      url: '../wp-content/plugins/wa-quest-order/ajax-admin.php',
      method: 'POST',
      data: {key: key, id: eventId},
      success: function (data){
        jQuery(target).parents('tr').find('.danger').attr('class', 'success').html(key);
        jQuery('#ajax_msg').css("display", "block").delay(5000).slideUp(2000).html(data);
      }
  });
}
