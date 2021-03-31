function goto($website){
    window.location = $website;
}
function loadExternalFile($selector, $attribute, e){
    $selector.attr($attribute, e.target.result);
}
function previewImage(file){
    if (file.files && file.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah')
                .attr('src', e.target.result);
        };

        reader.readAsDataURL(file.files[0]);
    }
}
