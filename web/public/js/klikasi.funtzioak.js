jQuery().ready(function(){
    
    $('#ikastegiKatSelect').on('change', function(e){
        window.location.href = $(this).find(':selected').val();
    });
    
    if ($('div#infoBox').length > 0) {
        
        $("div#infoBox").dialog({
            title: "Informazioa",
            modal: true,
            buttons: {
                'Ok': function() {
                    $( this ).dialog( "close" );
                }
            }
        });
        
    }
    
});