function showImage(src, target) {
    var fr = new FileReader();
    fr.onload = function () {
        target.src = fr.result;
    }
    fr.readAsDataURL(src.files[0]);
}

function putImage(src, target) {
    let imagesrc = src.getAttribute('id')
    //var src = document.getElementById(imagesrc);
    var target = document.getElementById(target);
    target.style.width = '120px';
    target.style.height = '80px';
    showImage(src, target);
}