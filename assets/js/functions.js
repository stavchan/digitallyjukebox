function previewTracks(){
    $('.icon-refresh','#refresh-btn').addClass('fa-spin');
    $('#tracks-wrapper').fadeOut().empty();

    SC.get('/tracks',{
        original_format: 'mp3'
    }).then(function(tracks) {

        var html = '';
        $.each(tracks, function(index, track){
            html += previewTrack(track);
        });

        $('#tracks-wrapper').append(html).hide().fadeIn();
        $('.icon-refresh','#refresh-btn').removeClass('fa-spin');
    });
}

function previewTrack(track){
    html = '<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">';
    html +=   '<div class="item" data-track-id="'+ track['id'] +'">';
    html +=     '<div class="pos-rlt">';
    html +=       '<div class="item-overlay opacity r r-2x bg-black">';
    html +=         '<div class="center text-center m-t-n">';
    html +=           '<a href="#" class="play-track">';
    html +=             '<i class="icon-control-play i-2x"></i>';
    html +=             '<i class="icon-control-pause i-2x text-active"></i>';
    html +=           '</a>';
    html +=         '</div>';
    html +=         '<div class="bottom padder m-b-sm">';
    html +=           '<a href="#" class="pull-right add-favorite"><i class="fa fa-heart-o"></i></a>';
    html +=           '<a href="#"><i class="fa fa-plus-circle"></i></a>';
    html +=         '</div>';
    html +=       '</div>';

    if(track['artwork_url']){
        html +=       '<a href="#"><img src="'+ track['artwork_url'] +'" alt="" class="r r-2x img-full"></a>';
    }else{
        html +=       '<a href="#"><img src="assets/images/m0.jpg" alt="" class="r r-2x img-full"></a>';
    }

    html +=     '</div>';
    html +=     '<div class="padder-v">';
    html +=       '<a href="#" class="text-ellipsis">'+ track['title'] +'</a>';
    html +=       '<a href="#" class="text-ellipsis text-xs text-muted">'+ (track['genre'] ? track['genre'] : 'Unknown') +'</a>';
    html +=     '</div>';
    html +=   '</div>';
    html += '</div>';

    return html;
}

function playTrack(trackId){
    SC.get('/tracks/'+trackId).then(function(track){
        $('.jp-duration').text(timeFormat(track.duration));

        SC.stream('/tracks/'+trackId).then(function(player){
            player.play();

            // when audio controller changes state (e.g. from pause to play)
            player.on('state-change', function(){
                if(player.isPaused()){
                    $('.jp-play').show();
                    $('.jp-pause').hide();
                }else{
                    $('.jp-play').hide();
                    $('.jp-pause').show();
                }
            });

            setInterval(function(){
                var currentPercent = parseInt((parseInt(player.currentTime()) / track.duration) * 100);

                $('.jp-play-bar').css('width', currentPercent+'%');

                var currentTime = timeFormat(player.currentTime());
                $('.jp-current-time').text(currentTime);
            }, 500);


            $('.jp-play, .jp-pause').click(function(e){
                e.preventDefault();

                player.isPaused() ? player.play() : player.pause();
            });

            $('.jp-mute, .jp-unmute').click(function(e){
                e.preventDefault();

                if(player.getVolume()){
                    player.setVolume(0);
                    $('.jp-mute').hide();
                    $('.jp-unmute').show();
                }else{
                    player.setVolume(1);
                    $('.jp-unmute').hide();
                    $('.jp-mute').show();
                }
            });
        });
    });
}

function timeFormat(time){
	var totalSec = Math.round(parseInt(time)/1000);
	
	var minutes = parseInt( totalSec / 60 ) % 60;
	var seconds = totalSec % 60;
	var result = (minutes < 10 ? "0" + minutes : minutes) + ":" + (seconds  < 10 ? "0" + seconds : seconds);
	
	return result;
}
