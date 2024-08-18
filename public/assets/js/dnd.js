$(function () {
     systems = {
          _ajax: function (options) {
               $.ajax({
                    url: options.url + ((options.url.indexOf("?") == -1) ? "?" : "&") + 'SID=' + Math.random(),
                    type: "POST",
                    data: options.data,
                    dataType: options.dataType,
                    processData: false,
                    contentType: options.contentType,
                    complete: function (data) {
                         options.oncomplete(data);
                    }
               });
          }
     }


     loadingStatus = {
          show: function(options)
          {
               $('#status').show();
               $('#preloader').show();
          }
          ,hide: function(options)
          {
               $('#status').hide();
               $('#preloader').hide();
          }
     }


});
