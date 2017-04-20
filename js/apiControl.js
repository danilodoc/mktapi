$(document).ready(function(){ 
    
    initChart('#seoChart', '#seoContainer', '#pageScore');
    initChart('#facebookChart', '#facebookContainer', '#pageScore');
    initChart('#instagramChart', '#instagramContainer', '#pageScore');
    initChart('#twitterChart', '#twitterContainer', '#pageScore');
    initChart('#youtubeChart', '#youtubeContainer', '#pageScore');
    
});

$(document).on('click', '#seoButton', function() {
    var urlField = $("#seoField").val();

    if(urlField == ""){
        alert("Digite a url corretamente!");
    }else{
        $('#seoButton').attr("disabled", true);
        $.getJSON( "seo.php", { url: urlField }, function( data ) {

            $('#seoButton').attr("disabled", false);

            $("#seoContainer").append("<div class=\"api-card-event mdl-card mdl-shadow--2dp\"><div class=\"mdl-card__title mdl-card--expand\"><p><span id='pageName'>"+urlField+"</span><br><b>Back Links:</b><span id='pageBackLinks'>"+accounting.formatNumber(data.backLinks,0,'.')+"</span><br><b>Domain Authority:</b> <span id='pageDomainAuthority'>"+accounting.formatNumber(data.domainAuthority,0,'.')+"</span><br><b>Page Authority:</b> <span id='pageAuthority'>"+accounting.formatNumber(data.pageAuthority,0,'.')+"</span><br><b>Key Words:</b> "+data.keyWords+"<br><b>Page Title:</b> "+data.pageTitle+"</p></div><div class=\"mdl-card__actions mdl-card--border\"><a id=\"remove_btn\" class=\"mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect\">Delete</a><div class=\"mdl-layout-spacer\"><i class=\"material-icons\">swap_vert</i><i class=\"score\">Score: <span id='pageScore'>"+data.pageScore+"</span></i></div></div></div>");
            
            initChart('#seoChart', '#seoContainer', '#pageScore');

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

            $("#facebookContainer").append("<div class=\"api-card-event mdl-card mdl-shadow--2dp\"><div class=\"mdl-card__title mdl-card--expand\"><p><img src=\""+data.pageAvatar+"\" /><br><b>Page Name:</b> <span id='pageName'>"+data.pageName+"</span><br><b>Page Fans:</b> <span id='pageFans'>"+accounting.formatNumber(data.pageFans,0,'.')+"</span><br><b>Post Frequency:</b> <span id='pagePostFrequency'>"+data.pagePostFrequency+"</span><br><b>Post Engagement:</b> <span id='pagePostEngagement'>"+accounting.formatNumber(data.pagePostEngagement,0,'.')+"</span><br></p></div><div class=\"mdl-card__actions mdl-card--border\"><a id=\"remove_btn\" class=\"mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect\">Delete</a><div class=\"mdl-layout-spacer\"><i class=\"material-icons\">swap_vert</i><i class=\"score\">Score: <span id='pageScore'>"+data.pageScore+"</span></i></div></div></div>");
            
            initChart('#facebookChart', '#facebookContainer', '#pageScore');
            
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

            $("#instagramContainer").append("<div class=\"api-card-event mdl-card mdl-shadow--2dp\"><div class=\"mdl-card__title mdl-card--expand\"><p><img src=\""+data.profilePicture+"\" width=\"50px\" height=\"50px\" /><br><b>Page Name:</b> <span id='pageName'>"+data.fullName+"</span><br><b>Followers:</b> <span id='pageFollowers'>"+accounting.formatNumber(data.followedBy,0,'.')+"</span><br><b>Post Frequency:</b> <span id='pagePostFrequency'>"+data.postFrequency+"</span><br><b>Post Engagement:</b> <span id='pagePostEngagement'>"+accounting.formatNumber(data.postEngagement,0,'.')+"</span><br></p></div><div class=\"mdl-card__actions mdl-card--border\"><a id=\"remove_btn\" class=\"mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect\">Delete</a><div class=\"mdl-layout-spacer\"><i class=\"material-icons\">swap_vert</i><i class=\"score\">Score: <span id='pageScore'>"+data.pageScore+"</span></i></div></div></div>");
            
            initChart('#instagramChart', '#instagramContainer', '#pageScore');
            
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

            $("#twitterContainer").append("<div class=\"api-card-event mdl-card mdl-shadow--2dp\"><div class=\"mdl-card__title mdl-card--expand\"><p><img src=\""+data.pageAvatar+"\" width=\"50px\" height=\"50px\" /><br><b>Page Name:</b> <span id='pageName'>"+data.pageName+"</span><br><b>Followers:</b> <span id='pageFollowers'>"+accounting.formatNumber(data.followers,0,'.')+"</span><br><b>Post Frequency:</b> <span id='pagePostFrequency'>"+data.pagePostFrequency+"</span><br><b>Post Engagement:</b> <span id='pagePostEngagement'>"+accounting.formatNumber(data.pagePostEngagement,0,'.')+"</span><br></p></div><div class=\"mdl-card__actions mdl-card--border\"><a id=\"remove_btn\" class=\"mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect\">Delete</a><div class=\"mdl-layout-spacer\"><i class=\"material-icons\">swap_vert</i><i class=\"score\">Score: <span id='pageScore'>"+data.pageScore+"</span></i></div></div></div>");
            
            initChart('#twitterChart', '#twitterContainer', '#pageScore');
            
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

            $("#youtubeContainer").append("<div class=\"api-card-event mdl-card mdl-shadow--2dp\"><div class=\"mdl-card__title mdl-card--expand\"><p><img src=\""+data.profilePicture+"\" width=\"50px\" height=\"50px\" /><br><b>Channel:</b> <span id='pageName'>"+data.fullName+"</span><br><b>Subscribers:</b> <span id='pageSubscribers'>"+accounting.formatNumber(data.subscribers,0,'.')+"</span><br><b>Videos:</b> <span id='pageTotalVideos'>"+accounting.formatNumber(data.videos,0,'.')+"</span><br><b>Total Views:</b> <span id='pageTotalViews'>"+accounting.formatNumber(data.views,0,'.')+"</span><br><b>Total Comments:</b> <span id='pageTotalComments'>"+accounting.formatNumber(data.comments,0,'.')+"</span><br></p></div><div class=\"mdl-card__actions mdl-card--border\"><a id=\"remove_btn\" class=\"mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect\">Delete</a><div class=\"mdl-layout-spacer\"><i class=\"material-icons\">swap_vert</i><i class=\"score\">Score: <span id='pageScore'>"+data.pageScore+"</span></i></div></div></div>");

            initChart('#youtubeChart', '#youtubeContainer', '#pageScore');
            
        }).fail(function() {
            alert("Ocorreu um erro na api, verifique os dados e tente novamente.");
            $('#youtubeButton').attr("disabled", false);
        });
    }
});

$(document).on('click', '#remove_btn', function() {
    
    var cardType = $(this).parent().parent().parent().attr('id');
    cardType = '#'+cardType.slice(0,-9);
    
    $(this).parent().parent().remove();
    
    initChart(cardType+'Chart', cardType+'Container', '#pageScore');
});

$(document).on('click', '#chartBtns button', function(){
    
    var cardType = $(this).parent().parent().attr('id').slice(0, -9);
    var valueId = $(this).attr('id').slice(3);
    
    initChart('#'+cardType+'Chart', '#'+cardType+'Container', '#page'+valueId);
});

function initChart(chartId, cardId, valuesId){
    
    var names = getCardsValue(cardId, '#pageName');
    var values = getCardsValue(cardId, valuesId);
    
    $(chartId+"Parent").empty();
    $(chartId+"Parent").append('<canvas id="'+chartId.slice(1)+'" width="400" height="100"><canvas>');
    
    var barChartData = {
        labels: names,
        datasets: [{
            label: valuesId,
            backgroundColor: "rgba(220,220,220,0.5)",
            data: values
        }]
    };
    
    showChart(chartId, barChartData);
}

function getCardsValue(id, field){
    
    var values = new Array();
    
    $(id+" .api-card-event").each(function( index ) {
        values.push($(this).find(field).text());
    });

    return values;
    
}

function showChart(id, barChartData){

    var ctx = $(id).get(0).getContext("2d");
    
    window.myBar = new Chart(ctx, {
        type: 'bar',
        data: barChartData,
        options: {
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