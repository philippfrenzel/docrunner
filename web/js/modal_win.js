function myModalWindow(){
  var th=$(this),
    id=th.attr('id').slice(0);  
  $('#applicationModal').modal('show');
  $('#applicationModal div.modal-header h4').html('Action: '+id);
  $('#applicationModal div.modal-body').load(th.attr('href'));
  return false;
};

function dhtmlxContactModal(url){
  $('#applicationModal').modal('show');
  $('#applicationModal div.modal-header h4').html('Window');
  $('#applicationModal div.modal-body').load(url);
  return false;
}

dhtmlxButtonClick = function(myurl){
  $.ajax({
    url: myurl
  }).done(function() {
    $(this).addClass( "done" );
    refreshAllGrids();
  });
  return false;
}

addCommas = function (nStr)
{
  nStr += '';
  x = nStr.split('.');
  x1 = x[0];
  x2 = x.length > 1 ? '.' + x[1] : '';
  var rgx = /(\d+)(\d{3})/;
  while (rgx.test(x1)) {
    x1 = x1.replace(rgx, '$1' + ',' + '$2');
  }
  return x1 + x2;
}