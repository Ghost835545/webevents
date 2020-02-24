$(document).ready(function(){
    function setEqualHeight1(columns) {
        var tallestcolumn = 0;
        h1 = $('#content').height();
        h2 = $('#sidebar').height();
        if (h1 > h2)
        {
            $('#sidebar').height(h1);
        }
        if (h1<h2)
        {
            $('#sidebar').height(h1);
        }

    }

    //setEqualHeight1($("#content,#sidebar"));


});