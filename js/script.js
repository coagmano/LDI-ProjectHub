// Tooltips
// $('.tooltipLink').tooltip();

// Loading
$(".loading").click(function() {
    var $btn = $(this);
    $btn.button('loading');
    // simulating a timeout
    setTimeout(function () {
        $btn.button('reset');
    }, 1000);
});