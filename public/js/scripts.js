(function ($) {

    $(document).ready(function () {

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
