$(document).ready(function() {
	// Tooltips
	$('.tooltipLink').tooltip();

	// Loading
	$(".loading").click(function() {
	    var $btn = $(this);
	    $btn.button('loading');
	    // simulating a timeout
	    setTimeout(function () {
	        $btn.button('reset');
	    }, 1000);
	});

	// document.getElementById("uploadBtn").onchange = function () {
	//       document.getElementById("uploadFile").value = this.value;
	//       document.getElementById("uploadFile").value = this.value.replace("C:\\fakepath\\", "");
	//   };


	$('.editable').editable({
	            inlineMode: false, 
	            width: 800,  
	            language: 'en_gb',
	             buttons: ['undo', 'redo' , 'sep', 'bold', 'italic', 'underline']
	        });
	$('.editable-fulltext').editable({
	    inlineMode: false, 
	    width: 800,  
	    language: 'en_gb'
	});
});

/**
 * Determine if the video url is youtube or Vimeo and return the video id
 * - Supported YouTube URL formats:
 *    - http://www.youtube.com/watch?v=My2FRPA3Gf8
 *    - http://youtu.be/My2FRPA3Gf8
 *    - https://youtube.googleapis.com/v/My2FRPA3Gf8
 *  - Supported Vimeo URL formats:
 *    - http://vimeo.com/25451551
 *    - http://player.vimeo.com/video/25451551
 *  - Also supports relative URLs:
 *    - //player.vimeo.com/video/25451551
 * @param  {string} url Video url to analyse
 * @return {json}     type: 'youtube' or 'vimeo', id: 
 */
function parseVideo(url) {
    url.match(/(http:|https:|)\/\/(player.|www.)?(vimeo\.com|youtu(be\.com|\.be|be\.googleapis\.com))\/(video\/|embed\/|watch\?v=|v\/)?([A-Za-z0-9._%-]*)(\&\S+)?/);

    if (RegExp.$3.indexOf('youtu') > -1) {
        var type = 'youtube';
    } else if (RegExp.$3.indexOf('vimeo') > -1) {
        var type = 'vimeo';
    }

    return {
        type: type,
        id: RegExp.$6
    };
}