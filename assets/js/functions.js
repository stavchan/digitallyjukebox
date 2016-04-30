function previewTracks(){
    $('.icon-refresh','#refresh-btn').addClass('fa-spin');
    $('#tracks-wrapper').fadeOut().empty();

    SC.get('/tracks',{
        original_format: 'mp3',
        sharing: 'public',
        streamable: true,
        downloadable: true,
        state: 'finished',
        track_type: 'original'
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
    if(track['streamable'] && track['downloadable']){
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
        html +=           '<a href="#" class="pull-right download-track"><i class="fa fa-download"></i></a>';
        html +=           '<a href="#" class="playlist-add"><i class="fa fa-plus-circle"></i></a>';
        html +=         '</div>';
        html +=       '</div>';

        if(track['artwork_url']){
            html +=       '<a href="#"><img src="'+ track['artwork_url'] +'" alt="" class="r r-2x img-full"></a>';
        }else{
            html +=       '<a href="#"><img src="assets/images/logo.jpg" alt="" class="r r-2x img-full"></a>';
        }

        html +=     '</div>';
        html +=     '<div class="padder-v">';
        html +=       '<a href="#" class="text-ellipsis">'+ track['title'] +'</a>';
        html +=       '<a href="#" class="text-ellipsis text-xs text-muted">'+ (track['genre'] ? track['genre'] : 'Unknown') +'</a>';
        html +=     '</div>';
        html +=   '</div>';
        html += '</div>';

        return html;
    }else{
        return '';
    }
}

function playTrack(trackId){
    SC.get('/tracks/'+trackId).then(function(track){
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

            // set player timer
            playerInterval(player, track.duration);
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

var $playerInterval;
function playerInterval(player, duration){
    clearInterval($playerInterval);
    $playerInterval = setInterval(function(){
        if(player.isPaused()){
            $('.jp-pause').hide();
            $('.jp-play').show();
        }else{
            $('.jp-play').hide();
            $('.jp-pause').show();
        }

        if(player.getVolume()){
            $('.jp-mute').show();
            $('.jp-unmute').hide();
        }else{
            $('.jp-unmute').show();
            $('.jp-mute').hide();
        }

        bindPlayBtns(player);
        bindVolumeBtns(player);

        var currentPercent = parseInt((parseInt(player.currentTime()) / duration) * 100);

        $('.jp-play-bar').css('width', currentPercent+'%');
        $('.jp-current-time').empty().text(timeFormat(player.currentTime()));
        $('.jp-duration').text(timeFormat(duration));
    }, 500);
}

function showAlert(type, message, target){
    if(typeof target == 'undefined'){
        var target = '#content .wrapper';
    }

    var alertContent = '<div class="alert alert-'+type+'">';
    alertContent +=         message;
    alertContent +=     '<div>';

    $(target).find('.alert').remove();
    $(target).prepend(alertContent);
}

function showModal(content, options){
	if(typeof options != 'undefined'){
		var modalId = options['id'] ? options['id'] : 'showModal';
		var modalBackdrop = options['backdrop'] ? options['backdrop'] : 'true';
		var modalTitle = options['title'] ? options['title'] : '';
	}else{
		var modalId = 'showModal';
		var modalBackdrop = 'true';
		var modalTitle = '';
	}
	
	var modal = '<div id="'+modalId+'" class="modal fade" tabindex="-1" data-backdrop="'+modalBackdrop+'" role="dialog">';
		modal += '<div class="modal-dialog">';
		modal +=	'<div class="modal-content">';
		modal +=		'<div class="modal-header">';
		modal +=			'<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
		modal +=			'<h4 class="modal-title">'+modalTitle+'</h4>';
		modal +=		'</div>';
		modal +=		'<div class="modal-body">';
		modal +=			content;
		modal +=		'</div>';
		modal +=		'<div class="modal-footer">';
		modal +=			'<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
		modal +=		'</div>';
		modal +=	'</div><!-- /.modal-content -->';
		modal += '</div><!-- /.modal-dialog -->';
		modal += '</div><!-- /.modal -->';
		
	$('.modal').modal('hide');
	$('.modal').remove();	
	$('body').append(modal);
	$('#'+modalId).modal();
}

function showFormErrors(form, errors){
    $.each(errors,function(index,value){
        if(index == 'base'){
            var base = '<div class="alert alert-danger">';
            base += '<h4>You have current errors:</h4>';
            base += '<ul>';

            $.each(value, function(key, val){
                base += '<li>'+val+'</li>';
            });

            base += '</ul>';

            base += '</div';

            $(form).prepend(base);
        }else{
            var input = $(".form-control[name='" + index + "']", form).parent();
            input.addClass('has-error');
            input.append("<span class='help-block'>"+ value +"</span>");
        }
    });
}

function bindVolumeBtns(player){
    $(document).on('click','.jp-mute, .jp-unmute', function(e){
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
}

function bindPlayBtns(player){
    $(document).on('click','.jp-play, .jp-pause', function(e){
        e.preventDefault();
        player.isPaused() ? player.play() : player.pause();
    });
}