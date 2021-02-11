require('./bootstrap');
$(document).ready(function() {

    var numberOfImageToShow = 0;
    var arrayOfImages = [];
    $(document).on('click', '.img-to-show-modal', function(e) {
        $('#shadow').removeClass('d-none').addClass('d-block');
        $('#modalWithImages').show();
        $('#modalWithImages').find('img').attr('src', e.target.src);
        $('#modalWithImages').find('img').attr('title', $('h2').text());
        arrayOfImages = $('.div-img-modal-show').find('img');
        numberOfImageToShow = getNumberOfChosenImage(arrayOfImages);
    });

    $(document).on('click', '#shadow', function(e) {
        $('#shadow').removeClass('d-block').addClass('d-none');
        $('#modalWithImages').hide();
        $('#imagesGalleryInfo').text('');
    });

    $(document).on('click', '#closePopupSymbol', function(e) {
        $('#shadow').removeClass('d-block').addClass('d-none');
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
        for(let i = 0; i < arrayOfImages.length; i++) {
            if ($(arrayOfImages[i]).attr('src').indexOf(getNameOfCurrentImage()) >= 0) {
                return i;
            }
        }
    }

    function getNameOfCurrentImage() {
        let currentImg = $('#modalWithImages').find('img');
        let src = $(currentImg).attr('src');
        let tempArray = src.split('/');
        let nameOfCurrentImage = tempArray[tempArray.length-1];
        return nameOfCurrentImage;
    }

    function showSlide() {
        if(numberOfImageToShow == arrayOfImages.length){
            numberOfImageToShow=0;
        } else if(numberOfImageToShow == -1) {
            numberOfImageToShow = arrayOfImages.length-1;
        }

        $('#modalWithImages').find('img').attr('src', $(arrayOfImages[numberOfImageToShow]).attr('src'));
        $('#imagesGalleryInfo').text('Image ' + (numberOfImageToShow+1) + ' from ' + arrayOfImages.length);
    }

    $('.accordion-content').slideUp(1);

    $(document).on('click', '.accordion-header', function(e) {
        $('.accordion-content').slideUp(200);
        $('.accordion-content-categories').slideUp(200);
        if(!$(this).next().is(":visible")){
            $(this).next().slideDown(200);
        }
    });

    $(document).on('click', '#btnAdderCategoryToList', function (e) {
        let alreadyExistCategories = $('#divWithCategoriesList').find('div');
        let isExist = false;

        $( alreadyExistCategories ).each(function( ) {
            if ($(this).attr('id') === $('#categoriesToAdd option:selected').val()) {
                isExist = true;
            }
        });

        if(isExist) {
            alert(this.getAttribute('data-confirm'));
        } else {
            let htmlToAdd = '<div id="' + $('#categoriesToAdd option:selected').val() + '"><i class="fa fa-minus-circle class-cursor-pointer i-deleter" title="Delete this category"></i><span> ' + $('#categoriesToAdd option:selected').text() + '</span>\n' +
                '<input type="hidden" name="categories[]" value="' + $('#categoriesToAdd option:selected').val() + '">\n' +
                '</div>'
            $('#divWithCategoriesList').append(htmlToAdd);
        }
    });

    $(document).on('click', '#btnToAddLocaleToStoreDiv' ,function (e) {
        let tbWithLocales = $('#tbodyWithLocales').find('tr');
        let isExist = false;

        $( tbWithLocales ).each(function( ) {
            if ($(this).attr('id') === $('#selectToAddLocaleToStoreDiv option:selected').val()) {
                isExist = true;
            }
        });

        if(isExist) {
            alert(this.getAttribute('data-confirm'));
        } else {
            let str = createHtmlToAdd($('#selectToAddLocaleToStoreDiv option:selected').text(), $('#selectToAddLocaleToStoreDiv option:selected').val(), 'locales');
            $('#tbodyWithLocales').append(str);
        }
    });

    $(document).on('click', '#btnToAddDeliveryToStoreDiv', function (e){
        let tbWithDeliveries = $('#tbodyWithDeliveries').find('tr');
        let isExist = false;

        $( tbWithDeliveries ).each(function( ) {
            if ($(this).attr('id') === $('#selectToAddDeliveryToStoreDiv option:selected').val()) {
                isExist = true;
            }
        });

        if(isExist) {
            alert(this.getAttribute('data-confirm'));
        } else {
            let str = createHtmlToAddDelivery($('#selectToAddDeliveryToStoreDiv option:selected').text(), $('#selectToAddDeliveryToStoreDiv option:selected').val(), 'deliveries');
            $('#tbodyWithDeliveries').append(str);
        }
    });

    function createHtmlToAddDelivery(delivery_name, delivery_id, input_name) {
        let htmlValue = '<tr id="' + delivery_id + '">\n' +
            '<td class="text-left pt-3"><p>' + delivery_name + '</p></td>\n' +
            '<td class="text-center"><i class="fa fa-minus-circle class-cursor-pointer i-tr-deleter" title="Delete this delivery" aria-hidden="true"></i>' +
            '<input type="hidden" name="'+ input_name +'[]" value="' + delivery_id + '"></td>\n' +
            '</tr>';
        return htmlValue;
    }

    function createHtmlToAdd(locale_name, locale_id, input_name) {
        let htmlVal = '<tr id="' + locale_id + '">\n' +
            '<td class="text-left pt-3"><p>' + locale_name + '</p></td>\n' +
            '<td class="text-center">\n' +
            '<input class="d-none" name="default" id="radio' + locale_id + '" type="radio" value="' + locale_id + '">\n' +
            '<label class="for-locale btn" for="radio' + locale_id + '">Default</label>\n' +
            '<input type="hidden" name="'+ input_name +'[]" value="' + locale_id + '">\n' +
            '</td>\n' +
            '<td class="text-center"><i class="fa fa-minus-circle class-cursor-pointer i-tr-deleter" title="{{__(\'Delete this locale\')}}"></i></td>\n' +
            '</tr>';
        return htmlVal;
    }

    $(document).on('click', '#btnToAddCurrencyToStoreDiv' ,function (e) {
        let tbWithCurrency = $('#tbodyWithCurrency').find('tr');
        let isExist = false;

        $( tbWithCurrency ).each(function( ) {
            if ($(this).attr('id') === $('#selectToAddCurrencyToStoreDiv option:selected').val()) {
                isExist = true;
            }
        });

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
        return divElementForRootCatgoryLink = '<a class="url-no-decoration" href="/product/category/' + id + '"><div class="col-lg-12 popup-root-categories-item">' +
            '' + name + '' +
            '</div></a>';
    }

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

    $(document).on('click', '#shadowPhones', function(e) {
        $('#shadowPhones').hide();
        $('#modalFormAddPhone').hide();
    });

    $(document).on('click', '#closePopupSymbol', function(e) {
        $('#shadowPhones').hide();
        $('#modalFormAddPhone').hide();
    });

    $(document).on('click', '.for-locale', function(e) {
        $('.for-locale').removeClass('btn-success');
        $(this).addClass('btn-success');
    });

    $(document).on('click', '#btnToAddPromoCode', function(e) {
        $('.promocode-usage').toggle();
    });

    $(document).on('click', '.btnToDeletePhone, .btn-delete-promocode', function(e) {
        event.preventDefault();

        let choice = confirm(this.getAttribute('data-confirm'));

        if (choice) {
            window.location.href = this.getAttribute('href');
        }
    });

    $( window ).scroll(function() {
        $( '.to-top-button' ).show();
        if ($('html, body').scrollTop() == 0) {
            $( '.to-top-button' ).hide();
        }
    });

    CKEDITOR.replace( 'summary-ckeditor' );

});
