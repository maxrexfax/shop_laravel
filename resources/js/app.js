require('./bootstrap');
$(document).ready(function() {

    //$('#summernote').summernote();

    var numberOfImageToShow = 0;
    var arrayOfImages = [];
    $(document).on('click', '.img-to-show-modal', function(e) {
        $('#shadow').show();
        $('#modalWithImages').show();
        $('#modalWithImages').find('img').attr('src', e.target.src);
        $('#modalWithImages').find('img').attr('title', $('h2').text());
        arrayOfImages = $('.div-img-modal-show').find('img');
        numberOfImageToShow = getNumberOfChosenImage(arrayOfImages);
    });

    $(document).on('click', '#shadow', function(e) {
        $('#shadow').hide();
        $('#modalWithImages').hide();
        $('#modalFormAddPhone').hide();//phones editing
        $('#imagesGalleryInfo').text('');
    });

    $(document).on('click', '#closePopupSymbol', function(e) {
        $('#shadow').hide();
        $('#modalWithImages').hide();
        $('#imagesGalleryInfo').text('');
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
        let currentImage = $('#modalWithImages').find('img').attr('src');
        for(let i = 0; i < arrayOfImages.length; i++) {
            if ($(arrayOfImages[i]).attr('src').indexOf(getNameOfCurrentImage()) >= 0) {
                return i;
            }
        }
    }

    function getNameOfCurrentImage() {
        let currentImg = $('#modalWithImages').find('img');
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

        $('#modalWithImages').find('img').attr('src', $(arrayOfImages[numberOfImageToShow]).attr('src'));
        $('#imagesGalleryInfo').text('Image ' + (numberOfImageToShow+1) + ' from ' + arrayOfImages.length);
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
            alert(this.getAttribute('data-confirm'));
        } else {
            let htmlToAdd = '<div id="' + $('#categoriesToAdd option:selected').val() + '"><i class="fa fa-minus-circle my-cursor-pointer i-deleter" title="Delete this category"></i><span> ' + $('#categoriesToAdd option:selected').text() + '</span>\n' +
                '<input type="hidden" name="categories[]" value="' + $('#categoriesToAdd option:selected').val() + '">\n' +
                '</div>'
            $('#divWithCategoriesList').append(htmlToAdd);
        }
    });

    $(document).on('click', '#btnToAddLocaleToStoreDiv' ,function (e) {
        let tbWithLocales = $('#tbodyWithLocales').find('tr');
        let isExist = false;
        for(let i = 0; i < tbWithLocales.length; i++) {
            if($(tbWithLocales[i]).attr('id')===$('#selectToAddLocaleToStoreDiv option:selected').val()) {
                isExist = true;
            }
        }
        if(isExist) {
            alert(this.getAttribute('data-confirm'));
        } else {
            let str = createHtmlToAdd($('#selectToAddLocaleToStoreDiv option:selected').text(), $('#selectToAddLocaleToStoreDiv option:selected').val(), 'locales');
            $('#tbodyWithLocales').append(str);
        }
    });

    function createHtmlToAdd(locale_name, locale_id, input_name) {
        let htmlVal = '<tr id="' + locale_id + '">\n' +
            '<td class="text-left pt-3"><p>' + locale_name + '</p></td>\n' +
            '<td class="text-center">\n' +
            '<input class="d-none" name="default" id="radio' + locale_id + '" type="radio" value="' + locale_id + '">\n' +
            '<label class="for-locale btn" for="radio' + locale_id + '">Default</label>\n' +
            '<input type="hidden" name="'+ input_name +'[]" value="' + locale_id + '">\n' +
            '</td>\n' +
            '<td class="text-center"><i class="fa fa-minus-circle my-cursor-pointer i-tr-deleter" title="{{__(\'Delete this locale\')}}"></i></td>\n' +
            '</tr>';
        return htmlVal;
    }

    $(document).on('click', '#btnToAddCurrencyToStoreDiv' ,function (e) {
        let tbWithCurrency = $('#tbodyWithCurrency').find('tr');
        let isExist = false;
        for(let i = 0; i < tbWithCurrency.length; i++) {
            if($(tbWithCurrency[i]).attr('id')===$('#selectToAddCurrencyToStoreDiv option:selected').val()) {
                isExist = true;
            }
        }
        if(isExist) {
            alert(this.getAttribute('data-confirm'));
        } else {
            let str = createHtmlToAdd($('#selectToAddCurrencyToStoreDiv option:selected').text(), $('#selectToAddCurrencyToStoreDiv option:selected').val(), 'currencies');
            $('#tbodyWithCurrency').append(str);
        }
    });

    $(document).on('click', '.i-deleter', function (e){
        $(this).parent().remove();
        e.stopPropagation();
    });

    $(document).on('click', '.i-tr-deleter', function (e){
        $(this).closest('tr').remove();
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

        $(this).css('box-shadow', '0 -3px 3px rgba(0,0,0,0.5)');
        $(this).find('.hide').css('box-shadow', '0 3px 3px rgba(0,0,0,0.5)');
    });

    $( '.div-item-main-container' ).mouseout(function() {
        $(this).find('.hide').css('display', 'none');
        $(this).css('box-shadow', 'none');
    });

    $(document).on('click', '#btnShowParentCategories', function(e) {
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
        return divElementForRootCatgoryLink = '<a class="url_no_decoration" href="/product/category/' + id + '"><div class="col-lg-12 popup-root-categories-item">' +
            '' + name + '' +
            '</div></a>';
    }

    $(document).on('click', '#btnButtonCardShower', function(e) {
        alert('Cart is empty now');
    });


    $( "#paginateQuantity" ).change(function() {
        createUrlToRedirect();
    });

    $( "#sortBySelect" ).change(function() {
        createUrlToRedirect();
    });

    function getUrl() {
        let url = $(location).attr('href');
        if(url.indexOf('?')!=-1) {
            url = url.substring(0, url.indexOf("?"));
        }
        return url;
    }

    function createUrlToRedirect() {
        let url = getUrl();
        url=url+'?paginateQuantity=' + $('#paginateQuantity option:selected').val() + '&sortType=' + $('#sortBySelect option:selected').val();
        $(location).attr('href', url);
    }

    $('.accordion_content_phones').slideUp(1);
    $(document).on('click', '#btnAddPhone', function(e) {
        $('.accordion_content_phones').show();
    });

    $(document).on('click', '#shadowPhones', function(e) {
        $('#shadowPhones').hide();
        $('#modalFormAddPhone').hide();
    });

    $(document).on('click', '#closePopupSymbol', function(e) {
        $('#shadowPhones').hide();
        $('#modalFormAddPhone').hide();
    });

    $(document).on('click', '#btnSavePhoneAsync', function(e) {

    });

    $(document).on('click', '.for-locale', function(e) {
        $('.for-locale').removeClass('btn-success');
        $(this).addClass('btn-success');
    });

    $(document).on('click', '.btnToDeletePhone', function(e) {
        event.preventDefault();

        let choice = confirm(this.getAttribute('data-confirm'));

        if (choice) {
            window.location.href = this.getAttribute('href');
        }
    });

    CKEDITOR.replace( 'summary-ckeditor' );

});
// $('#divInFormToAddProduct').ready(function() {
//     console.log('divInFormToAddProduct summernote');
//     $('#summernote').summernote();
// });
// $(document).ready(function() {
//     $('#summernote').summernote();
// });
