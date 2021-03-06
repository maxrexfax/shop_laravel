const TIME_TO_RECHECK_CART = 3000;
const TIME_TO_SHOW_MESSAGE = 2000;
const TIME_TO_SLIDE_UP = 200;

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
        $('#imagesGalleryInfo').text('Image ' + (numberOfImageToShow+1) + ' from ' + arrayOfImages.length);
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
        return tempArray[tempArray.length-1];
    }

    function showSlide() {
        if(numberOfImageToShow === arrayOfImages.length){
            numberOfImageToShow=0;
        } else if(numberOfImageToShow === -1) {
            numberOfImageToShow = arrayOfImages.length-1;
        }

        $('#modalWithImages').find('img').attr('src', $(arrayOfImages[numberOfImageToShow]).attr('src'));
        $('#imagesGalleryInfo').text('Image ' + (numberOfImageToShow+1) + ' from ' + arrayOfImages.length);
    }

    $('.accordion-content').slideUp(1);

    $(document).on('click', '.accordion-header', function(e) {
        $('.accordion-content').slideUp(TIME_TO_SLIDE_UP);
        $('.accordion-content-categories').slideUp(TIME_TO_SLIDE_UP);
        if(!$(this).next().is(":visible")){
            $(this).next().slideDown(TIME_TO_SLIDE_UP);
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
            let htmlToAdd = '<div id="' + $('#categoriesToAdd option:selected').val() + '"><i class="fa fa-minus-circle class-cursor-pointer i-deleter" title="' + this.getAttribute('data-title') + '"></i><span> ' + $('#categoriesToAdd option:selected').text() + '</span>\n' +
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
            let str = createHtmlToAdd($('#selectToAddLocaleToStoreDiv option:selected').text(),
                $('#selectToAddLocaleToStoreDiv option:selected').val(),
                'locales',
                this.getAttribute('data-title'),
                this.getAttribute('data-default'));
            $('#tbodyWithLocales').append(str);
        }
    });

    $(document).on('click', '#btnToAddDeliveryToStoreDiv', function (e) {
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
            let str = createHtmlToAddDelivery($('#selectToAddDeliveryToStoreDiv option:selected').text(), $('#selectToAddDeliveryToStoreDiv option:selected').val(), 'deliveries', this.getAttribute('data-title'));
            $('#tbodyWithDeliveries').append(str);
        }
    });

    function createHtmlToAddDelivery(delivery_name, delivery_id, input_name, title) {
        let htmlValue = '<tr id="' + delivery_id + '">\n' +
            '<td class="text-left pt-3"><p>' + delivery_name + '</p></td>\n' +
            '<td class="text-center"><i class="fa fa-minus-circle class-cursor-pointer i-tr-deleter" title="' +title + '" aria-hidden="true"></i>' +
            '<input type="hidden" name="'+ input_name +'[]" value="' + delivery_id + '"></td>\n' +
            '</tr>';
        return htmlValue;
    }

    function createHtmlToAdd(locale_name, locale_id, input_name, title, text) {
        let htmlVal = '<tr id="' + locale_id + '">\n' +
            '<td class="text-left pt-3"><p>' + locale_name + '</p></td>\n' +
            '<td class="text-center">\n' +
            '<input class="d-none" name="default" id="radio' + locale_id + '" type="radio" value="' + locale_id + '">\n' +
            '<label class="for-locale btn" for="radio' + locale_id + '">' + text + '</label>\n' +
            '<input type="hidden" name="'+ input_name +'[]" value="' + locale_id + '">\n' +
            '</td>\n' +
            '<td class="text-center"><i class="fa fa-minus-circle class-cursor-pointer i-tr-deleter" title="' + title + '"></i></td>\n' +
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
            let str = createHtmlToAdd($('#selectToAddCurrencyToStoreDiv option:selected').text(),
                $('#selectToAddCurrencyToStoreDiv option:selected').val(),
                'currencies',
                this.getAttribute('data-title'),
                this.getAttribute('data-default'));
            $('#tbodyWithCurrency').append(str);
        }
    });

    $(document).on('click', '.i-deleter', function (e) {
        $(this).parent().remove();
        e.stopPropagation();
    });

    $(document).on('click', '.i-tr-deleter, .btn-delete-product-from-order', function (e) {
        $(this).closest('tr').remove();
        e.stopPropagation();
    });

    $(document).on('click', '#btnAddProductToCart', function (e) {
        let tbWithProducts = $('.tbody-for-order-products').find('tr');
        let isExist = false;
        let selectedProductId = $('#selectForProductsFromCategory option:selected').val();

        $( tbWithProducts ).each(function( ) {
            if ($(this).attr('id') === selectedProductId) {
                isExist = true;
            }
        });

        if (isExist) {
            let parentTr = $('#' + selectedProductId);
            let quantity = parseInt($(parentTr).find('.input-quantity').val());
            $(parentTr).find('.input-quantity').val(++quantity);
        } else {
            $.get( "/product/info/" + $('#selectForProductsFromCategory option:selected').val(), function( data ) {
                $('.tbody-for-order-products').append(createTableRowWithProduct(data));
            }, "json" );
        }
    });

    function createTableRowWithProduct(product) {
        return '<tr class="tr" id="' + product["id"] + '"><td>' + product["id"] + '</td>\n' +
    '<td>' + product["product_name"] + '</td>\n' +
    '<td>' + product["price"] + '$</td>\n' +
    '<td><input type="number" class="input-quantity" value="1"  name="quantity[]"></td>\n' +
    '<td>' + product["price"]+ '$</td>\n' +
    '<td>\n' +
    '<span title="{{__(\'text.delete\')}}" class="float-right btn-delete-product-from-order cursor-pointer">\n' +
    '<span><i class="fa fa-trash fa-lg" aria-hidden="true"></i></span>\n' +
    '</span>\n' +
    '</td>' +
    '<input type="hidden" value="' + product["id"] + '" name="products[]"></tr>';
    }

    $(document).on('click', '#btnShowParentCategories', function(e) {
        if(!$('.root-menu-container').is(":visible")) {
            $.get( "/category/root/list", function( data ) {
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

    $(document).on('click', '.py-4', function (e) {
        hideCategoriesMenu();
    });

    function hideCategoriesMenu() {
        $( "#divToShowRootCategories1" ).empty();
        $( "#divToShowRootCategories2" ).empty();
        $('.root-menu-container').hide();
    }

    function createDivElementForRootCatgoryLink(id, name) {
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

    $('#selectPaymentMethodsInOrder').change(function () {
        let path = $('#selectPaymentMethodsInOrder option:selected').val();
        $('.details-for-payment-method').empty();
        $.get( "/cart/paymentdetails/" + path)
            .done(function( data ) {
            $('.details-for-payment-method').append(data.toString());
        }, "json" );
    });

    $( "#selectTypeOfDeliveryInCart" ).change(function() {
        $.post( "/cart/changedelivery", { "_token": $('meta[name="csrf-token"]').attr('content'), delivery_id: $('#selectTypeOfDeliveryInCart option:selected').val() })
            .done(function( data ) {
                $('#spanWithTotalPrice').html(data['totalAmount'] + data['currency_symbol']);
            });
    });

    $( "#selectCategoryOfProduct" ).change(function() {
        $.get( "/product/productsList/" + $(this).val(), function( data ) {
            $( "#selectForProductsFromCategory" ).empty();
            if (data != 0) {
                $.each(data, function( index, value ) {
                    $( "#selectForProductsFromCategory" )
                        .append(createOptionElementWithProducts(value['id'], value['product_name'], value['price']))
                });
            }
        }, "json" );
    });

    function createOptionElementWithProducts(product_id, product_name, price) {
        return '<option value="' + product_id + '">' + product_name + ' - ' + price + '$' + '</option>';
    }

    $( ".select-type-of-delivery-in-cart" ).change(function() {
        $.post( "/cart/changedelivery", { "_token": $('meta[name="csrf-token"]').attr('content'), delivery_id: $(this).val() })
            .done(function( data ) {
                $('#spanWithTotalPrice').html(data['totalAmount'] + data['currency_symbol']);
            });
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
        e.preventDefault();

        let choice = confirm(this.getAttribute('data-confirm'));

        if (choice) {
            window.location.href = this.getAttribute('href');
        }
    });

    $(document).on('click', '.delete-from-cart', function(e) {
        e.preventDefault();

        let choice = confirm(this.getAttribute('data-confirm'));

        if (choice) {
            let id = this.getAttribute('data-id');
            $.get( "/cart/delete/" + this.getAttribute('data-id'))
                .done(function( data ) {
                    if (data['productRowsCount'] === 0 ) {
                        $('#cartInviteToBuy').addClass('d-block').removeClass('d-none');
                        $('.item-to-hide-in-empty-cart').removeClass('d-block').addClass('d-none');
                    }
                    $('#tr-' + id).remove();
                    $('#spanWithTotalProductsPrice').html(data['totalProducts'] + data['currencySymbol']);
                    $('#spanWithTotalPrice').html(data['totalAmount'] + data['currencySymbol']);
            });
        }
    });

    $(document).on('click', '.btn-adder-to-cart', function(e) {
        let buttonClicked = this;
        let message = this.getAttribute('data-message');
        let text = $(this).text();
        let urlToSendRequest = "/cart/add/" + this.getAttribute('data-id');
        console.log("urlToSendRequest:" + urlToSendRequest);
        $('#cartInviteToBuy').removeClass('d-block').addClass('d-none');
        $('.item-to-hide-in-empty-cart').addClass('d-block').removeClass('d-none');
        $.get(urlToSendRequest)
            .done(function( data ) {
                restoreText(buttonClicked, text, message);
        });
    });

    $(document).on('click', '.payment-methods-select', function (e) {
        $('.details-for-payment-method').empty();
        let name = $(this).val();
        let id = $(this).parent().attr('id');

        if (name != 0) {
            $.get( "/cart/paymentdetails/" + name)
                .done(function( data ) {
                    $('#content' + id).append(data.toString());
                })
        }
    });

    restoreText = function(target, oldText, newText) {
        $(target).html(newText);
        $(target).removeClass('btn-secondary').addClass('btn-success');
        setTimeout(function() {
            $(target).html(oldText);
            $(target).removeClass('btn-success').addClass('btn-secondary');
        }, 1000);
    }

    $( ".input-product-quantity-cart" ).change(function() {
        let inputChanged = $(this);
        let parentId = $(this).closest('.tr').attr('id');
        let productId = parentId.substring(3);
        $.post( "/cart/edit", { "_token": $('meta[name="csrf-token"]').attr('content'), productId: productId, productQuantity: $(this).val() })
            .done(function( data ) {
                let tdWithPrice = $(inputChanged).closest('.tr').find('.row-price-holder');
                $(tdWithPrice).html(data['newRowPrice'] + data['currencySymbol']);
                $('#spanWithTotalProductsPrice').html(data['totalProducts'] + data['currencySymbol']);
                $('#spanWithTotalPrice').html(data['totalAmount'] + data['currencySymbol']);
            });

    });

    $(document).on('click', '.minus-product', function (e) {
        let parentId = $(this).closest('.tr').attr('id');
        let idDigit = parentId.substring(3);
        let currentQuantity = $('.input'+idDigit).val();
        currentQuantity--;

        if (currentQuantity === 0) {
            currentQuantity = 1;
        }

        $('.input'+idDigit).val(currentQuantity);
        recalculateCart(idDigit, currentQuantity)
    });

    $(document).on('click', '.plus-product', function (e) {
        let parentId = $(this).closest('.tr').attr('id');
        let idDigit = parentId.substring(3);
        let currentQuantity = $('.input'+idDigit).val();
        $('.input'+idDigit).val(++currentQuantity);
        recalculateCart(idDigit, currentQuantity)
    });

    function recalculateCart(productId, productQuantity) {
        $.post( "/cart/edit", { "_token": $('meta[name="csrf-token"]').attr('content'), productId: productId, productQuantity: productQuantity })
            .done(function( data ) {
                let rowPriceHolder = $('.row-price-' + productId);
                $(rowPriceHolder).html(data['newRowPrice'] + data['currencySymbol']);
                $('#spanWithTotalProductsPrice').html(data['totalProducts'] + data['currencySymbol']);
                $('#spanWithTotalPrice').html(data['totalAmount'] + data['currencySymbol']);
            });
    }

    $(document).on('click', '#btnCheckout', function(e) {
        let btnText = this.getAttribute('data-info');
        $.get( "/cart/data")
            .done(function( data ) {
                alert(btnText + ': ' + data['totalAmount'] + data['currencySymbol']);
            });
    });

    $(document).on('click', '#btnUsePromocode', function(e) {
        $.post( "/cart/addpromo", { "_token": $('meta[name="csrf-token"]').attr('content'), promo_text: $('#promoCodeInput').val() })
            .done(function( data ) {
            });
    });

    let divWithAdditionalProductsInCart = $('.div-products-category-container');

    if ($('.div-products-category-container').length) {
        checkProductsContainer();
    }

    function checkProductsContainer() {
        if ($(divWithAdditionalProductsInCart)[0].offsetWidth < $(divWithAdditionalProductsInCart)[0].scrollWidth) {
            $('.scroll-product-control').show();
        } else {
            $('.scroll-product-control').hide();
        }
    }

    let divWithImages = $('.div-icons-container');

    if ($('.div-icons-container').length) {
        checkImagesContainer();
    }

    $( window ).resize(function() {
        if ($('.div-icons-container').length) {
            checkImagesContainer();
        }
        if ($('.div-products-category-container').length) {
            checkProductsContainer();
        }
    });

    function checkImagesContainer() {
        if ($(divWithImages)[0].offsetWidth < $(divWithImages)[0].scrollWidth) {
            showScrollControl();
        } else {
            hideScrollControl();
        }
    }

    function showScrollControl() {
        $('.scroll-control').show();
    }

    function hideScrollControl() {
        $('.scroll-control').hide();
    }

    $(document).on('click', '#leftScroll', function (e) {
        $('.div-icons-container').animate( { scrollLeft: '-=120' }, 600);
    });

    $(document).on('click', '#rightScroll', function (e) {
        $('.div-icons-container').animate( { scrollLeft: '+=120' }, 600);
    });

    $(document).on('click', '.scroll-left-btn', function (e) {
        let parentClassName = this.getAttribute('data-scroll');
        $('.' + parentClassName).animate( { scrollLeft: '-=600' }, 600);
        if ($('.' + parentClassName)[0].scrollLeft == 0) {
            $(this).hide();
        }
        let RB = $(this).parent().find('.scroll-right-btn');
        $(RB).show();
        checkEndOfScroll($('.' + parentClassName), this, RB, e);
    });

    $(document).on('click', '.scroll-right-btn', function (e) {
        let parentClassName = this.getAttribute('data-scroll');
        $('.' + parentClassName).animate( { scrollLeft: '+=600' }, 600);
        let LB = $(this).parent().find('.scroll-left-btn');
        $(LB).show();
        checkEndOfScroll($('.' + parentClassName), LB, this, e);
    });

    function checkEndOfScroll(scrollable, leftButton, rightButton, e) {
        if (scrollable[0].offsetWidth + $(scrollable)[0].scrollLeft >= scrollable[0].scrollWidth) {
            $(rightButton).hide();
        } else {
        }
    }

    $( window ).scroll(function() {
        $( '.to-top-button' ).show();
        if ($('html, body').scrollTop() === 0) {
            $( '.to-top-button' ).hide();
        }
    });

    setInterval(function(){ checkProductsInCart(); }, TIME_TO_RECHECK_CART);

    function checkProductsInCart() {
        $.get( "/cart/productquantity")
            .done(function( data ) {
                if($('#divCartElement').length === 1 && ($('.div-with-one-product').length != data)) {
                    window.location.reload();
                }
                setCartDigit(data);
            });
    }

    function setCartDigit(number) {
        $('.div-button-card-shower-right').html(number);
    }

    checkProductsInCart();

    let ckeditor = document.getElementById('summary-ckeditor');
    if(ckeditor) {
        CKEDITOR.replace( 'summary-ckeditor' );
    }

});
