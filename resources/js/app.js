require('./bootstrap');
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

    let inputContentToAdd = "<div class=\"form-group row\">"+
        "<label for=\"images\" class=\"col-md-4 col-form-label text-md-right\">Additional image</label>"+
        "<div class=\"col-md-6\">" +
        "<input type=\"file\" name=\"images[]\" title=\"Upload one or few pictures\">" +
        "</div>" +
        "</div>";

    $(document).on('click', '#btnToAddInput', function(e) {
        $('#divForAdditionalImageInputs').append(inputContentToAdd);
        e.stopPropagation();
    });


    $('.accordion_content').slideUp(1);

    $(document).on('click', '.accordion_header', function(e) {
        $('.accordion_content').slideUp(200);
        $('.accordion_content_categories').slideUp(200);
        if(!$(this).next().is(":visible")){
            $(this).next().slideDown(200);
        }
    });

    $(document).on('click', '#btnAdderCategoryToList', function (e) {
        let alreadyExistCategories = $('#divWithCategoriesList').find('div');
        let isExist = false;
        for(let i = 0; i < alreadyExistCategories.length; i++) {
            if($(alreadyExistCategories[i]).attr('id')===$('#categoriesToAdd option:selected').val()) {
                isExist = true;
            }
        }
        if(isExist) {
            alert('Category already chosen');
        } else {
            let htmlToAdd = '<div id="' + $('#categoriesToAdd option:selected').val() + '"><i class="fa fa-minus-circle my-cursor-pointer i-deleter" title="Delete this category"></i><span> ' + $('#categoriesToAdd option:selected').text() + '</span>\n' +
                '<input type="hidden" name="categories[]" value="' + $('#categoriesToAdd option:selected').val() + '">\n' +
                '</div>'
            $('#divWithCategoriesList').append(htmlToAdd);
        }
    });

    $(document).on('click', '.i-deleter', function (e){
        $(this).parent().remove();
        e.stopPropagation();
    });

    $(document).on('click', '#btnShowModalToEditImages', function(e) {
        $('#shadowEdit').show();
        $('#modalWindowToManageProductImages').show();
    });

    $(document).on('click', '#shadowEdit', function(e) {
        $('#shadowEdit').hide();
        $('#modalWindowToManageProductImages').hide();
    });

    $(document).on('click', '.btn_add_to_cart', function(e) {
        alert('Product ID=' + $(this).attr('id'));
    });

    $( '.div-item-main-container' ).mouseover(function() {
        $(this).find('.hide').css('display', 'block');
        // $(this).css('box-shadow', '0px 2px 1px #888');
        // $(this).find('.hide').css('box-shadow', '0px 2px 1px #888, -2px 0px 1px #d8d8d8, 2px 0px 1px #d8d8d8');

        $(this).css('box-shadow', '0 -3px 3px rgba(0,0,0,0.5)');
        $(this).find('.hide').css('box-shadow', '0 3px 3px rgba(0,0,0,0.5)');
    });

    $( '.div-item-main-container' ).mouseout(function() {
        $(this).find('.hide').css('display', 'none');
        $(this).css('box-shadow', 'none');
    });

    $(document).on('click', '#btn-show-parent-categories', function(e) {
        if(!$('.root-menu-container').is(":visible")) {
            $.get( "/categories/root/list", function( data ) {
                $.each(data, function( index, value ) {
                    if(index < data.length/2) {
                        $( "#divToShowRootCategories1" )
                            .append(createDivElementForRootCatgoryLink(value['id'], value['category_name']))
                    } else {
                        $( "#divToShowRootCategories2" )
                            .append(createDivElementForRootCatgoryLink(value['id'], value['category_name']))
                    }
                });
            }, "json" );
        } else {
            $( "#divToShowRootCategories1" ).empty();
            $( "#divToShowRootCategories2" ).empty();
        }

        $('.root-menu-container').fadeToggle( "slow", "linear" );
    });

    function createDivElementForRootCatgoryLink(id, name)
    {
        return divElementForRootCatgoryLink = '<div class="col-lg-12 popup-root-categories-item">' +
            '<a href="/product/category/' + id + '">' + name + '</a>' +
            '</div>';
    }

    $(document).on('click', '#btnButtonCardShower', function(e) {
        alert('Cart is empty now');
    });


    $( "#paginationQuantity" ).change(function() {
        console.log('paginationQuantity');
        console.log($(location).attr('href'));
        $(location).attr('href',$('#paginationQuantity option:selected').val());
    });

    $( "#sortBySelect" ).change(function() {
        console.log('sortBySelect');
        $(location).attr('href',$('#sortBySelect option:selected').val());
    });

});




