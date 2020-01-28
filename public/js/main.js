!function (e, t) {
    "use strict";
    window.$ = t(e.document);
} ('undefined' != typeof window ? window : this, function (e) {
    "use strict";
    var obj = {
        get_id: function (id) {
            return e.getElementById(id);
        }
    };
    return e.$ = obj;
});