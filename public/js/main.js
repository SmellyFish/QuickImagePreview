$(document).ready(function()
{
    $("#drop-area").bind('dragenter', function (e){
        e.preventDefault();
        $(this).addClass('dragging-over');
    });

    $("#drop-area").bind('dragover', function (e){
        e.preventDefault();
    });

    $("#drop-area").bind('dragleave', function (e){
        e.preventDefault();
        $(this).removeClass('dragging-over');
    });

    $("#drop-area").bind('drop', function (e){
        e.preventDefault();
        $(this).removeClass('dragging-over');
        var image = e.originalEvent.dataTransfer.files;
        createFormData(image);
    });
});

function createFormData(image)
{
    var formImage = new FormData();
    formImage.append('userImage', image[0]);
    uploadFormData(formImage);
}

function uploadFormData(formData)
{
    $.ajax({
        url: "upload_image.php",
        type: "POST",
        data: formData,
        contentType:false,
        processData: false,
        success: function(data){
            var response = JSON.parse(data);
            
            $('#processed-files-container').addClass('revealed');
            
            if (response.status == 'success') {
                handleUploadSuccess(response);
            } else {
                handleUploadFailure(response);
            }
        }});
}

function handleUploadSuccess(response)
{
    $('#uploaded-list').prepend('<div class="list-group-item"><img class="image-preview" src="' + response.imageUrl  + '"></div>');
    $('#uploaded-list').prepend('<a href="' + response.imageUrl + '" class="list-group-item list-group-item-success"><span class="badge alert-success pull-right">Success</span>' + response.imageName + '</a>');
}

function handleUploadFailure(response)
{
    $('#uploaded-list').prepend('<div class="list-group-item list-group-item-danger"><span class="badge alert-danger pull-right">Error</span>' + response.message + '</div>');
}

