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

            $("#seoContainer").append("<div class=\"api-card-event mdl-card mdl-shadow--2dp\"><div class=\"mdl-card__title mdl-card--expand\"><p><span id='pageName'>"+urlField+"</span><br><b>Back Links:</b> "+data.backLinks+"<br><b>Page Rank:</b> "+data.pageRnak+"<br><b>Domain Authority:</b> "+data.domainAuthority+"<br><b>Page Authority:</b> "+data.pageAuthority+"<br><b>Key Words:</b> "+data.keyWords+"<br><b>Page Title:</b> "+data.pageTitle+"</p></div><div class=\"mdl-card__actions mdl-card--border\"><a id=\"remove_btn\" class=\"mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect\">Delete</a><div class=\"mdl-layout-spacer\"><i class=\"material-icons\">swap_vert</i><i class=\"score\">Score: <span id='pageScore'>"+data.pageScore+"</span></i></div></div></div>");
            
            initChart('#seoChart', '#seoContainer');

        }).fail(function() {
            alert("Ocorreu um erro na api, verifique os dados e tente novamente.");
            $('#seoButton').attr("disabled", false);
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

            $("#facebookContainer").append("<div class=\"api-card-event mdl-card mdl-shadow--2dp\"><div class=\"mdl-card__title mdl-card--expand\"><p><img src=\""+data.pageAvatar+"\" /><br><b>Page Name:</b> <span id='pageName'>"+data.pageName+"</span><br><b>Page Fans:</b> "+data.pageFans+"<br><b>Post Frequency:</b> "+data.pagePostFrequency+"<br><b>Post Engagement:</b> "+data.pagePostEngagement+"<br></p></div><div class=\"mdl-card__actions mdl-card--border\"><a id=\"remove_btn\" class=\"mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect\">Delete</a><div class=\"mdl-layout-spacer\"><i class=\"material-icons\">swap_vert</i><i class=\"score\">Score: <span id='pageScore'>"+data.pageScore+"</span></i></div></div></div>");
            
            initChart('#facebookChart', '#facebookContainer');
            
        }).fail(function() {
            alert("Ocorreu um erro na api, verifique os dados e tente novamente.");
            $('#facebookButton').attr("disabled", false);
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

            $("#instagramContainer").append("<div class=\"api-card-event mdl-card mdl-shadow--2dp\"><div class=\"mdl-card__title mdl-card--expand\"><p><img src=\""+data.profilePicture+"\" width=\"50px\" height=\"50px\" /><br><b>Page Name:</b> <span id='pageName'>"+data.fullName+"</span><br><b>Followers:</b> "+data.followedBy+"<br><b>Post Frequency:</b> "+data.postFrequency+"<br><b>Post Engagement:</b> "+data.postEngagement+"<br></p></div><div class=\"mdl-card__actions mdl-card--border\"><a id=\"remove_btn\" class=\"mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect\">Delete</a><div class=\"mdl-layout-spacer\"><i class=\"material-icons\">swap_vert</i><i class=\"score\">Score: <span id='pageScore'>"+data.pageScore+"</span></i></div></div></div>");
            
            initChart('#instagramChart', '#instagramContainer');
            
        }).fail(function() {
            alert("Ocorreu um erro na api, verifique os dados e tente novamente.");
            $('#instagramButton').attr("disabled", false);
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

            $("#twitterContainer").append("<div class=\"api-card-event mdl-card mdl-shadow--2dp\"><div class=\"mdl-card__title mdl-card--expand\"><p><img src=\""+data.pageAvatar+"\" width=\"50px\" height=\"50px\" /><br><b>Page Name:</b> <span id='pageName'>"+data.pageName+"</span><br><b>Followers:</b> "+data.followers+"<br><b>Post Frequency:</b> "+data.pagePostFrequency+"<br><b>Post Engagement:</b> "+data.pagePostEngagement+"<br></p></div><div class=\"mdl-card__actions mdl-card--border\"><a id=\"remove_btn\" class=\"mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect\">Delete</a><div class=\"mdl-layout-spacer\"><i class=\"material-icons\">swap_vert</i><i class=\"score\">Score: <span id='pageScore'>"+data.pageScore+"</span></i></div></div></div>");
            
            initChart('#twitterChart', '#twitterContainer');
            
        }).fail(function() {
            alert("Ocorreu um erro na api, verifique os dados e tente novamente.");
            $('#twitterButton').attr("disabled", false);
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

            $("#youtubeContainer").append("<div class=\"api-card-event mdl-card mdl-shadow--2dp\"><div class=\"mdl-card__title mdl-card--expand\"><p><img src=\""+data.profilePicture+"\" width=\"50px\" height=\"50px\" /><br><b>Channel:</b> <span id='pageName'>"+data.fullName+"</span><br><b>Subscribers:</b> "+data.subscribers+"<br><b>Videos:</b> "+data.videos+"<br><b>Views:</b> "+data.views+"<br><b>Comments:</b> "+data.comments+"<br></p></div><div class=\"mdl-card__actions mdl-card--border\"><a id=\"remove_btn\" class=\"mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect\">Delete</a><div class=\"mdl-layout-spacer\"><i class=\"material-icons\">swap_vert</i><i class=\"score\">Score: <span id='pageScore'>"+data.pageScore+"</span></i></div></div></div>");

            initChart('#youtubeChart', '#youtubeContainer');
            
        }).fail(function() {
            alert("Ocorreu um erro na api, verifique os dados e tente novamente.");
            $('#youtubeButton').attr("disabled", false);
        });
    }
});

$(document).on('click', '#remove_btn', function() {
    
    var type = $(this).parent().parent().parent().attr('id');
    type = '#'+type.slice(0,-9);
    
    $(this).parent().parent().remove();
    
    initChart(type+'Chart', type+'Container');
});

function initChart(chartId, cardId){
    
    $(chartId+"Parent").empty();
    $(chartId+"Parent").append('<canvas id="'+chartId.slice(1)+'" width="400" height="100"><canvas>');
    
    var names = getCardsName(cardId);
    
    var scores = getCardsScore(cardId);
    
    var barChartData = {
        labels: names,
        datasets: [{
            label: 'Score',
            backgroundColor: "rgba(220,220,220,0.5)",
            data: scores
        }]
    };
    
    showChart(chartId, barChartData);
}

function getCardsName(id){
    
    var names = new Array();
    
    $(id+" .api-card-event").each(function( index ) {
        names.push($(this).find('#pageName').text());
    });
    
    return names;
    
}

function getCardsScore(id){
    
    var scores = new Array();
    
    $(id+" .api-card-event").each(function( index ) {
        scores.push($(this).find('#pageScore').text());
    });
    
    return scores;
    
}

function showChart(id, barChartData){

    var ctx = $(id).get(0).getContext("2d");
    
    window.myBar = new Chart(ctx, {
        type: 'bar',
        data: barChartData,
        options: {
            // Elements options apply to all of the options unless overridden in a dataset
            // In this case, we are setting the border of each bar to be 2px wide and green
            elements: {
                rectangle: {
                    borderWidth: 2,
                    borderColor: 'rgb(190, 190, 190)',
                    borderSkipped: 'bottom'
                }
            },
            responsive: true,
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: ''
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });
    
}