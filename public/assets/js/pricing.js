/**
 * Created by NotPrometey on 20.09.2015.
 */
$(function(){
   $('.pricing-footer').find('a').click(function(e){
       e.preventDefault();

       var bye = $.ajax({
           url: $(this).attr('href'),
           headers: {
               'X-CSRF-Token' : $('meta[name=_token]').attr('content')
           },
           method: "POST",
           dataType: "json"
       });

       bye.done(function( response ) {
           console.log(response);
           $.each(response, function(index, res){
               toastr[res.type](res.message, res.name);
           });
       });

       bye.fail(function( jqXHR, textStatus ) {
           toastr['error']("Request failed: " + textStatus, 'Error!');
       });
   });
});