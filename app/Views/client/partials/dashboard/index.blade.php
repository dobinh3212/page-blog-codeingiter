@include('client.partials.dashboard.banner')
@include('client.partials.dashboard.recentPost')
@include('client.partials.dashboard.featuredWork.index')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    $('#switchViewGrid').click(function() {
        $('.activeGrid').css({
            'display': 'block',
        });
        $('.activeList').css({
            'display': 'none',
        });
    });

    $('#switchViewStyle').click(function() {
        $('.activeGrid').css({
            'display': 'none',
        });
        $('.activeStyle').css({
            'display': 'block',
        });
    });

    $('#switchViewList').click(function() {
        $('.activeStyle').css({
            'display': 'none',
        });
        $('.activeList').css({
            'display': 'block',
        });
    });

    //add css loa page
    document.addEventListener("DOMContentLoaded", function () {
        var elementToModify = document.getElementById("isActive");
        if (elementToModify) {
            elementToModify.classList.add("isActive");
        }
    });
</script>
