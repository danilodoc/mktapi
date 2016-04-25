$(document).ready(function(){ 
        
});

$(document).on('click', '#seoButton', function() {
    var urlField = $("#seoField").val();

    if(urlField == ""){
        alert("Digite a url corretamente!");
    }else{
        $('#seoButton').attr("disabled", true);
        $.getJSON( "seo.php", { url: urlField }, function( data ) {

            $('#seoButton').attr("disabled", false);

            $("#seoContainer").append("<div class=\"seo-card-event mdl-card mdl-shadow--2dp\"><div class=\"mdl-card__title mdl-card--expand\"><p>"+urlField+"<br><b>Back Links:</b> "+data.backLinks+"<br><b>Page Rank:</b> "+data.pageRnak+"<br><b>Domain Authority:</b> "+data.domainAuthority+"<br><b>Page Authority:</b> "+data.pageAuthority+"<br><b>Key Words:</b> "+data.keyWords+"<br><b>Page Title:</b> "+data.pageTitle+"</p></div><div class=\"mdl-card__actions mdl-card--border\"><a id=\"remove_btn\" class=\"mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect\">Delete</a><div class=\"mdl-layout-spacer\"><i class=\"material-icons\">swap_vert</i></div></div></div>");

        });
    }
});

$(document).on('click', '#facebookButton', function() {
    var facebookField = $("#facebookField").val();

    if(facebookField == ""){
        alert("Digite o ID da página!");
    }else{
        $('#facebookButton').attr("disabled", true);
        $.getJSON( "facebook.php", { id: facebookField }, function( data ) {

            $('#facebookButton').attr("disabled", false);

            $("#facebookContainer").append("<div class=\"seo-card-event mdl-card mdl-shadow--2dp\"><div class=\"mdl-card__title mdl-card--expand\"><p><img src=\""+data.pageAvatar+"\" /><br><b>Page Name:</b> "+data.pageName+"<br><b>Page Fans:</b> "+data.pageFans+"<br><b>Post Frequency:</b> "+data.pagePostFrequency+"<br><b>Post Engagement:</b> "+data.pagePostEngagement+"<br></p></div><div class=\"mdl-card__actions mdl-card--border\"><a id=\"remove_btn\" class=\"mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect\">Delete</a><div class=\"mdl-layout-spacer\"><i class=\"material-icons\">swap_vert</i></div></div></div>");

        });
    }
});

$(document).on('click', '#remove_btn', function() {
    $(this).parent().parent().remove();
});