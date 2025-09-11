
Fancybox.bind('[data-fancybox="gallery"]', {
    //
});




function menuToggle() {
    const toggleMenu = document.querySelector('.menu');
    const toggleMenuicon = document.querySelector('.menu-accord-ico');
    toggleMenu.classList.toggle('active');
    toggleMenuicon.classList.toggle('open');
}


(function ($) {


    $(".js-delete-stage-file").on('click', function(e) {
        e.preventDefault();
        var item = $(this);
        var id = item.attr('data-id');



        $.ajax({
            url: "/cabinet/delete-stage-file/" + id,
            type: 'get',
            success: function () {
                item.closest('.uploaded-file').remove();

            },
            error: function (err) {
                console.log(err);
            }
        });

    });



    $(".js-delete-purchase-file").on('click', function(e) {
        e.preventDefault();
        var item = $(this);
        var id = item.attr('data-id');



        $.ajax({
            url: "/cabinet/delete-purchase-file/" + id,
            type: 'get',
            success: function () {
                item.closest('.uploaded-file').remove();

            },
            error: function (err) {
                console.log(err);
            }
        });

    });








    $(document).ready(function () {




        $(document).on('click', '.sort-active', function () {
           const sortToggleMenu = $(this).find('.menu');
            sortToggleMenu.toggleClass('active');
            $(this).toggleClass('open');

        });





        // on page load...
        moveProgressBar();
        // on browser resize...
        $(window).resize(function() {
            moveProgressBar();
        });

        // SIGNATURE PROGRESS
        function moveProgressBar() {
            console.log("moveProgressBar");
            var getPercent = ($('.progress-wrap-m').data('progress-percent') / 100);
            var getProgressWrapWidth = $('.progress-wrap-m').width();
            var progressTotal = getPercent * getProgressWrapWidth;
            var animationLength = 0;

            // on page load, animate percentage bar to data percentage length
            // .stop() used to prevent animation queueing
            $('.progress-bar-m').stop().animate({
                left: progressTotal
            }, animationLength);
        }



            $.datepicker.setDefaults( $.datepicker.regional[ "ru" ] );
            $( "#datepicker1" ).datepicker();
            $( ".datepicker" ).datepicker();



        $(document).on('change', '.fl_inp', function () {

            var filesMainWrap = $(this).parents('.files-main-wrap');

            $(this).parents('.inp-val-wrap').find('.invalid-feedback').removeClass('visible');
            var filename = $(this).val().replace(/.*\\/, "");

            $(this).parents(".file-form-wrap").find(".file-name").html(filename);
//$(this).parents('.my-btn').css('backgroundColor', '#008000');

            // filesMainWrap.find('.file-form-wrap').first().clone(true, true).appendTo(filesMainWrap);
            // filesMainWrap.find('.file-form-wrap').last().find(".file-name").html('');
            // filesMainWrap.find('.file-form-wrap').last().find(".fl_inp ").val('');
        });


        $(document).on('change', '.fl_inp_multi', function () {

            var filesMainWrap = $(this).parents('.files-main-wrap');


            filesMainWrap.find('.file-form-wrap').first().clone(true, true).appendTo(filesMainWrap);
            filesMainWrap.find('.file-form-wrap').last().find(".file-name").html('');
            filesMainWrap.find('.file-form-wrap').last().find(".fl_inp ").val('');
        });



        function setChecked(target) {

            var checked = $(target).find("input[type='checkbox']:checked").closest('label').html();

            if (checked) {
                $(target).find('select option:first').html(checked);
            } else {
                $(target).find('select option:first').html('---');
            }
        }

        $.fn.checkselect = function() {


            this.wrapInner('<div class="checkselect-popup"></div>');
            this.prepend(
                '<div class="checkselect-control">' +
                '<span class="accord-ico"></span>' +
                '<select class="form-control" ><option></option></select>' +
                '<div class="checkselect-over"></div>' +
                '</div>'
            );

            this.each(function(){

                setChecked(this);
            });


            this.find('input[type="checkbox"]').click(function(){

                //var checkselect = $(this).closest('checkselect').find('label').removeClass('js-active');
                $(this).closest('.checkselect').find('label').removeClass('js-active');

                $(this).closest('label').addClass('js-active');

                var checkbox = $(this);
                var name = checkbox.prop('name');
                if (checkbox.is(':checked')) {
                    $(':checkbox[name="' + name + '"]').not($(this)).prop({
                        'checked': false,
                        'required': false
                    });
                }
                $(this).closest('.checkselect').find('.checkselect-popup').css('display', 'none');
                $(this).closest('.checkselect').find('.checkselect-control').removeClass('js-active');

                setChecked($(this).parents('.checkselect'));

            });

            this.parent().find('.checkselect-control').on('click', function(){

                $checkselect = $(this).closest('.checkselect');

                if(!$checkselect.hasClass("disabled")) {
                    $(this).addClass('js-active');
                    $popup = $(this).next();
                    $('.checkselect-popup').not($popup).css('display', 'none');
                    if ($popup.is(':hidden')) {
                        $popup.css('display', 'block');
                        $(this).find('select').focus();
                    } else {
                        $popup.css('display', 'none');
                        $(this).removeClass('js-active');
                    }


                }


            });

            $('html, body').on('click', function(e){

                if ($(e.target).closest('.checkselect').length == 0){
                    $('.checkselect-control').removeClass('js-active');
                    $('.checkselect-popup').css('display', 'none');
                }
            });
        };

        $('.checkselect-js').checkselect();






        var accordions = document.getElementsByClassName("accordion");

        for (var i = 0; i < accordions.length; i++) {
            accordions[i].onclick = function () {
                this.classList.toggle('is-open');

                var content = this.nextElementSibling;
                if (content.style.maxHeight) {
                    // accordion is currently open, so close it
                    content.style.maxHeight = null;
                } else {
                    // accordion is currently closed, so open it
                    content.style.maxHeight = content.scrollHeight + "px";
                }
            }
        }








        function validateEmail(email) {
            var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        };


        $(document).on('click', '.js--form-submit', function () {


            var btn = $(this);
            var form = btn.closest('.main-form');
            var errors = false;

            $(form).find('.required').each(function () {
                var inp = $(this);
                var val = inp.prop('value');
                if (val == '' || val == '0') {
                    inp.addClass('error');
                    $(this).siblings('.error-p').addClass('visible');
                    errors = true;
                } else {
                    if (inp.hasClass('inp-mail')) {
                        if (validateEmail(val) == false) {
                            inp.addClass('error');
                            $(this).siblings('.error-p').addClass('visible');
                            errors = true;

                        }
                    }
                    if (inp.hasClass('inp-phone')) {
                        if (val.length < 6) {
                            inp.addClass('error');
                            $(this).siblings('.error-p').addClass('visible');
                            errors = true;
                        }
                    }
                }
            });

            if (errors == false) {


                var button_value = btn.val();
                btn.val('Отправляем...');

                var method = form.attr('method');
                var data = form.serialize();

                var form_id = form.children('.form-id').val();

                var formData = new FormData(form[0]);

                $.ajax({
                    type: method,
                    url: "mail.php",
                    data: formData,
                    contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                    processData: false,
                    success: function (data) {
                        console.log(data);
                        window.location.href = "thanks.html";


                        $("form").trigger('reset');


                    },
                    error: function (data) {
                        btn.val('Ошибка');
                        setTimeout(function () {
                            btn.val(button_value);
                        }, 2000);
                    }
                });

            }

            return false;
        });

        $('.inp').focus(function () {
            $(this).removeClass('error');
            $(this).siblings('.error-p').removeClass('visible');
        });



    });


})(jQuery);

if(document.getElementById('sort-list')!= null) {
    document.getElementById('sort-list').addEventListener('click', function (event) {
        // Проверяем, что был клик именно по li
        if (event.target.tagName === 'LI') {
            const sortValue = event.target.dataset.sort; // Получаем значение из data-sort
            const currentUrl = window.location.pathname; // Получаем текущий путь страницы
            window.location.href = `${currentUrl}?sort=${sortValue}`; // Переходим на новый URL
        }
    });
}
