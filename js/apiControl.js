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

            $("#seoContainer").append("<div class=\"api-card-event mdl-card mdl-shadow--2dp\"><div class=\"mdl-card__title mdl-card--expand\"><p>"+urlField+"<br><b>Back Links:</b> "+data.backLinks+"<br><b>Page Rank:</b> "+data.pageRnak+"<br><b>Domain Authority:</b> "+data.domainAuthority+"<br><b>Page Authority:</b> "+data.pageAuthority+"<br><b>Key Words:</b> "+data.keyWords+"<br><b>Page Title:</b> "+data.pageTitle+"</p></div><div class=\"mdl-card__actions mdl-card--border\"><a id=\"remove_btn\" class=\"mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect\">Delete</a><div class=\"mdl-layout-spacer\"><i class=\"material-icons\">swap_vert</i></div></div></div>");

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

            $("#facebookContainer").append("<div class=\"api-card-event mdl-card mdl-shadow--2dp\"><div class=\"mdl-card__title mdl-card--expand\"><p><img src=\""+data.pageAvatar+"\" /><br><b>Page Name:</b> "+data.pageName+"<br><b>Page Fans:</b> "+data.pageFans+"<br><b>Post Frequency:</b> "+data.pagePostFrequency+"<br><b>Post Engagement:</b> "+data.pagePostEngagement+"<br></p></div><div class=\"mdl-card__actions mdl-card--border\"><a id=\"remove_btn\" class=\"mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect\">Delete</a><div class=\"mdl-layout-spacer\"><i class=\"material-icons\">swap_vert</i><i class=\"score\">Score: "+data.pageScore+"</i></div></div></div>");

        });
    }
});

$(document).on('click', '#instagramButton', function() {
    var instagramField = $("#instagramField").val();

    if(instagramField == ""){
        alert("Digite o ID do perfil!");
    }else{
        $('#instagramButton').attr("disabled", true);
        $.getJSON( "instagram.php", { id: instagramField }, function( data ) {

            $('#instagramButton').attr("disabled", false);

            $("#instagramContainer").append("<div class=\"api-card-event mdl-card mdl-shadow--2dp\"><div class=\"mdl-card__title mdl-card--expand\"><p><img src=\""+data.profilePicture+"\" width=\"50px\" height=\"50px\" /><br><b>Page Name:</b> "+data.fullName+"<br><b>Followers:</b> "+data.followedBy+"<br><b>Post Frequency:</b> "+data.postFrequency+"<br><b>Post Engagement:</b> "+data.postEngagement+"<br></p></div><div class=\"mdl-card__actions mdl-card--border\"><a id=\"remove_btn\" class=\"mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect\">Delete</a><div class=\"mdl-layout-spacer\"><i class=\"material-icons\">swap_vert</i></div></div></div>");

        });
    }
});

$(document).on('click', '#twitterButton', function() {
    var twitterField = $("#twitterField").val();

    if(twitterField == ""){
        alert("Digite o ID da página!");
    }else{
        $('#twitterButton').attr("disabled", true);
        $.getJSON( "twitter.php", { id: twitterField }, function( data ) {

            $('#twitterButton').attr("disabled", false);

            $("#twitterContainer").append("<div class=\"api-card-event mdl-card mdl-shadow--2dp\"><div class=\"mdl-card__title mdl-card--expand\"><p><img src=\""+data.pageAvatar+"\" width=\"50px\" height=\"50px\" /><br><b>Page Name:</b> "+data.pageName+"<br><b>Followers:</b> "+data.followers+"<br><b>Post Frequency:</b> "+data.pagePostFrequency+"<br><b>Post Engagement:</b> "+data.pagePostEngagement+"<br></p></div><div class=\"mdl-card__actions mdl-card--border\"><a id=\"remove_btn\" class=\"mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect\">Delete</a><div class=\"mdl-layout-spacer\"><i class=\"material-icons\">swap_vert</i></div></div></div>");

        });
    }
});

$(document).on('click', '#youtubeButton', function() {
    var youtubeField = $("#youtubeField").val();

    if(instagramField == ""){
        alert("Digite o ID do canal!");
    }else{
        $('#youtubeButton').attr("disabled", true);
        $.getJSON( "youtube.php", { id: youtubeField }, function( data ) {

            $('#youtubeButton').attr("disabled", false);

            $("#youtubeContainer").append("<div class=\"api-card-event mdl-card mdl-shadow--2dp\"><div class=\"mdl-card__title mdl-card--expand\"><p><img src=\""+data.profilePicture+"\" width=\"50px\" height=\"50px\" /><br><b>Channel:</b> "+data.fullName+"<br><b>Subscribers:</b> "+data.subscribers+"<br><b>Videos:</b> "+data.videos+"<br><b>Views:</b> "+data.views+"<br><b>Comments:</b> "+data.comments+"<br></p></div><div class=\"mdl-card__actions mdl-card--border\"><a id=\"remove_btn\" class=\"mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect\">Delete</a><div class=\"mdl-layout-spacer\"><i class=\"material-icons\">swap_vert</i></div></div></div>");

        });
    }
});

$(document).on('click', '#remove_btn', function() {
    $(this).parent().parent().remove();
});