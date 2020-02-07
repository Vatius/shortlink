$("button").click(function() {
    $.ajax({
        url: 'php/some.php',
        data: 'l=' + $("#full-link").val(),
        success: function(data) {
            $("#result").html('<a href="' + data + '" target="_blank">' + data + '</a>');
            $("#result").fadeIn();
        }
    });
});