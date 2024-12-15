jQuery(document).ready(function () {

    $("#upload-button_pic").pekeUpload({
        theme: "bootstrap",
        btnText: "Change Image",
        url: "/profile-pic.php",
        allowed_number_of_uploads: 900,
        allowedExtensions: "jpeg|jpg|png|gif",
        onFileSuccess: function (file, response) {
            var data = JSON.parse(response);
            var upload_response = data;
            var filename = data.file_name;
            var filepath = "/profile_pic/";

            var pic_name = filepath + filename;

            $("#prev_upload").append('<div id="' + data.image_id + '" class="property_image pull-left col-md-3"><input type="hidden" name="profile_pic" value="' + pic_name + '" /></div> ');
            $("#profile_pic").attr("src", "" + pic_name);
            //console.log(upload_response.file_name);
            var token = $("#token").val();

            $.ajax({
                type: "POST",
                url: "/updateprofile",
                data: "_token=" + token + "&img=" + upload_response.file_name,
            });

            $(".file").remove();
        }
    });
});

function remove_div(div_id)
{
    $("#" + div_id).remove();
}

                      