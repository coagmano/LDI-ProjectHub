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

document.getElementById("uploadBtn").onchange = function () {
      document.getElementById("uploadFile").value = this.value;
      document.getElementById("uploadFile").value = this.value.replace("C:\\fakepath\\", "");
  };