!function (e, t) {
    "use strict";
    window.$ = t(e.document);
} ('undefined' != typeof window ? window : this, function (e) {
    "use strict";
    var obj;

    obj = {
        get_dom: function (id) {
            return e.querySelector(id);
        },
        createEl: function (el) {
            return document.createElement(el);
        },
        ajax: function (options) {
            /*
                url: 请求地址
                type: 请求类型
                data: 请求参数
                dataType: 请求返回这
                async: 是否开启异步
                success: 请求成功执行方法
                fail: 请求失败执行

                ajax({
                    url: 'article/create,
                    type: 'get',
                    data: {
                        user: 'snoweddy'
                    },
                    seccess: function (123) {

                    }
                });
             */
            var xhr, params;

            options = options || {}; // 默认对象
            options.type = (options.type || 'GET').toLowerCase(); // 默认get请求
            options.dataType = options.dataType || 'json'; // 默认返回数据json类型
            options.async = options.async || true; // 默认设置异步请求
            params = getParams(options.data);

            if (window.XMLHttpRequest) {
                // 非ie
                xhr = new XMLHttpRequest()
            } else {
                // ie
                xhr = new ActiveXObject('Microsoft.XMLHttp')
            }
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    var status = xhr.status;
                    if (status >= 200 && status < 300) {
                        options.success(xhr.responseText || xhr.responseXML)
                    } else {
                        options.fail(status)
                    }
                }
            };

            if (options.type === 'get') {
                xhr.open('GET', options.url + '?' + params, options.async);
                xhr.send(null);
            } else if (options.type === 'post') {
                xhr.open('POST', options.url, options.async);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.send(params);
            }


            function getParams(data) {
                var arr = [];
                for (var param in data){
                    arr.push(encodeURIComponent(param) + '=' +encodeURIComponent(data[param]));
                }
                return arr.join('&');
            }
        }
    };
    return e.$ = obj;
});