

$(document).ready(function() {

    var numberOfImageToShow = 0;
    var arrayOfImages = [];
    $(document).on('click', '.img-to-show-modal', function(e) {
        $('#shadow').show();
        $('#modal-with-images').show();
        $('#modal-with-images').find('img').attr('src', e.target.src);
        $('#modal-with-images').find('img').attr('title', $('h2').text());
        arrayOfImages = $('.div-img-modal-show').find('img');
        numberOfImageToShow = getNumberOfChosenImage(arrayOfImages);
    });

    $(document).on('click', '#shadow', function(e) {
        $('#shadow').hide();
        $('#modal-with-images').hide();
        $('#images-gallery-info').text('');
    });

    $(document).on('click', '#close-popup-symbol', function(e) {
        $('#shadow').hide();
        $('#modal-with-images').hide();
        $('#images-gallery-info').text('');
    });

    $(document).on('click', '.step-back', function(e) {
        e.stopPropagation();
        showSlide(numberOfImageToShow--);
    });

    $(document).on('click', '.step-forward', function(e) {
        e.stopPropagation();
        showSlide(numberOfImageToShow++);
    });

    function getNumberOfChosenImage(arrayOfImages) {
        let currentImage = $('#modal-with-images').find('img').attr('src');
        for(let i = 0; i < arrayOfImages.length; i++) {
            if ($(arrayOfImages[i]).attr('src').indexOf(getNameOfCurrentImage()) >= 0) {
                return i;
            }
        }
    }

    function getNameOfCurrentImage() {
        let currentImg = $('#modal-with-images').find('img');
        let src = $(currentImg).attr('src'); // "static/images/banner/blue.jpg"
        let tarr = src.split('/');      // ["static","images","banner","blue.jpg"]
        let nameOfCurrentImage = tarr[tarr.length-1];
        return nameOfCurrentImage;
    }


    function showSlide() {
    if(numberOfImageToShow==arrayOfImages.length){
        numberOfImageToShow=0;
    } else if(numberOfImageToShow==-1) {
        numberOfImageToShow=arrayOfImages.length-1;
    }

        $('#modal-with-images').find('img').attr('src', $(arrayOfImages[numberOfImageToShow]).attr('src'));
        $('#images-gallery-info').text('Image ' + (numberOfImageToShow+1) + ' from ' + arrayOfImages.length);
    }

});
