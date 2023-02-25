(function ($) {
        $.fn.emoji = function (params) {
            var defaults = {
                button: '&#x1F642;',
                place: 'before',
                emojis: ['&#x1f600;', '&#x1f62c;', '&#x1f601;', '&#x1f602;', '&#x1f603;', '&#x1f604;', '&#x1f605;', '&#x1f606;', '&#x1f607;', '&#x1f609;', '&#x1f60a;', '&#x1f642;', '&#x1f60c;', '&#x1f60d;', '&#x1f913;', '&#x1f60e;', '&#x1f917;', '&#x1f636;', '&#x1f610;', '&#x1f612;', '&#x1f914;', '&#x1f61e;', '&#x1f62e;', '&#x1f64c;', '&#x1f44f;', '&#x1f44d;', '&#x1f44e;', '&#x1f44c;', '&#x1f440;', '&#x1f478;', '&#x1f339;', '&#x1f337;', '&#x1f490;', '&#x1f370;', '&#x1f36c;', '&#x1f387;', '&#x1f386;', '&#x1f308;', '&#x1f54c;', '&#x1f54b;', '&#x1f6cd;', '&#x1f381;', '&#x1f388;', '&#x1f38a;', '&#x1f389;', '&#x2764;', '&#x1f49b;', '&#x1f49a;', '&#x1f499;', '&#x1f49c;', '&#x1f494;', '&#x1f495;', '&#x1f49e;', '&#x1f493;', '&#x1f497;', '&#x1f496;', '&#x1f498;', '&#x1f49d;', '&#x1f49f;'],
                fontSize: '22px',
                listCSS: {
                    position: 'absolute',
                    border: '1px solid gray',
                    'background-color': '#fff',
                    display: 'none',
                    margin: '34px',
                    width: '78%'
                },
                rowSize: 12,
            };
            var settings = {};
            if (!params) {
                settings = defaults;
            } else {
                for (var n in defaults) {
                    settings[n] = params[n] ? params[n] : defaults[n];
                }
            }

            this.each(function (n, input) {
                var $input = $(input);

                function showEmoji() {
                    $list.show();
                    $input.focus();
                    setTimeout(function () {
                        $(document).on('click', closeEmoji);
                    }, 1);
                }

                function closeEmoji() {
                    $list.hide();
                    $(document).off('click', closeEmoji);
                }

                function clickEmoji(ev) {
                    if (input.selectionStart || input.selectionStart == '0') {
                        var startPos = input.selectionStart;
                        var endPos = input.selectionEnd;
                        input.value = input.value.substring(0, startPos)
                            + ev.currentTarget.innerHTML
                            + input.value.substring(endPos, input.value.length);
                    } else {
                        input.value += ev.currentTarget.innerHTML;
                    }

                    closeEmoji();
                    $input.focus();
                    input.selectionStart = startPos + 2;
                    input.selectionEnd = endPos + 2;
                }

                var $button = $("<span>").html(settings.button).css({
                    cursor: 'pointer',
                    'font-size': settings.fontSize
                }).on('click', showEmoji);
                var $list = $('<div>').css(defaults.listCSS).css(settings.listCSS);
                for (var n in settings.emojis) {
                    if (n > 0 && n % settings.rowSize == 0) {
                        $("<br>").appendTo($list);
                    }
                    $("<span>").html(settings.emojis[n]).css({
                        cursor: 'pointer',
                        'font-size': settings.fontSize
                    }).on('click', clickEmoji).appendTo($list);
                }

                if (settings.place === 'before') {
                    $button.insertBefore(this);
                } else {
                    $button.insertAfter(this);
                }
                $list.insertAfter($input);
            });
            return this;
        };
    }
)(jQuery);
