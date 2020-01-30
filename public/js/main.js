!function (e, t) {
    "use strict";
    window.$ = t(e.document);
} ('undefined' != typeof window ? window : this, function (e) {
    "use strict";
    var obj = {
        get_dom: function (id) {
            return e.querySelector(id);
        },
        createEl: function (el) {
            return document.createElement(el);
        }
    };
    return e.$ = obj;
});