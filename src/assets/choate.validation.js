/**
 * Created by Choate on 16/3/8.
 */
(function ($, yii) {
    var pub = {
        idCard: function (value, messages, options) {
            if (options.skipOnEmpty && pub.isEmpty(value)) {
                return;
            }
            if (!value.match(options.pattern)) {
                pub.addMessage(messages, options.message, value);
            }
            var numbers = value.splice('');
            var parity = numbers.pop();
            var total = 0;
            for (var i = 0; i < 17; i++) {
                total += numbers[i] * options.factor[i];
            }
            if (parity !== (total % options.checksum)) {
                pub.addMessage(messages, options.message, value);
            }
        }
    };

    yii.validation = $.extend({}, pub, yii.validation);
})(jQuery, yii);
