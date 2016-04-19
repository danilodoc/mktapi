$(document).ready(function(){ 

    $('#seoButton').click(function(){

        var urlField = $("#seoField").val();

        if(urlField == ""){
            alert("Digite a url corretamente!");
        }else{
            $('#seoButton').attr("disabled", true);
            $.getJSON( "seo.php", { url: urlField }, function( data ) {
                
                $('#seoButton').attr("disabled", false);
                
                $("#seoContainer").append("<div class=\"seo-card-square mdl-card mdl-shadow--2dp\"> <div class=\"mdl-card__title mdl-card--expand\"> <h2 class=\"mdl-card__title-text\">"+urlField+"</h2> </div> <div class=\"mdl-card__supporting-text\">  <p>Back Links: "+data.backLinks+"</p><p>Page Rank: "+data.pageRnak+"</p><p>Domain Authority: "+data.domainAuthority+"</p><p>Page Authority: "+data.pageAuthority+"</p><p>Key Words: "+data.keyWords+"</p><p>Page Title: "+data.pageTitle+"</p></div> <div class=\"mdl-card__actions mdl-card--border\"> <a class=\"mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect\"> Remove Card </a> </div> </div>");
                
                /*$.each( data, function( key, val ) {
                });*/

                /*$( "<ul/>", {
                    "class": "my-new-list",
                    html: items.join( "" )
                }).appendTo( "body" );*/
            });
        }

    });

});