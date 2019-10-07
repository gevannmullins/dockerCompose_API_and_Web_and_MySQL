<?php


?>

<!-- popup container -->
<div class="popup_wrapper">
    <div class="popup_content">

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-11">Header</div>
                <div class="col-md-1 text-center">
                    <a class="close_popup">X</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">display content</div>
            </div>
            <div class="row">
                <div class="col-md-6 text-left">Cancel</div>
                <div class="col-md-6 text-right">Save</div>
            </div>
        </div>
    </div>
</div>
<!--/ popup container -->

<script>
    $(document).ready(function(){

        $("#close_popup").on("click", function(e){
            e.preventDefault();
            $(".popup_wrapper").fadeOut();
        });

    });
</script>
