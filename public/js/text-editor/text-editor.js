!function () {
    var
        editor = {},
        edit_content;

    function init(params)
    {
        /*
            params格式：
                id: '#editor',
                data: [
                    {title: '内容', dataCommand: '命令', dataValue: '指令参数'}
                ]
         */
        editor.root = document.querySelector(params.id);
        editor.root.style.width = !params.width ? '100%' : params.width;
        var template = "" +
            "<div id=\"text-editor\">\n\t" +
            "   <div id=\"toolbar\" class=\"form-group\">\n\t" +
            "       <div class=\"toolbar-but\">" +
            "       </div>\n\t" +
            "   </div>\n\t" +
            "   <div id=\"edit-content\" class=\"form-group\" contenteditable=\"true\"></div>\n\t" +
            "   <div class=\"form-group\">\n\t" +
            "       <button type=\"button\" class=\"but\" id=\"edit-but\">提交</button>\n\t" +
            "   </div>\n\t" +
            "</div>\n\t";
        var data = params.data,
            toolbar;
        editor.root.innerHTML = template;
        toolbar = editor.root.querySelector('#toolbar');
        for (var v in data) {
            var button = createEl('button');
            button.title = data[v].title;
            button.innerHTML = data[v].title;
            button.type = 'button';
            button.setAttribute('data-command', data[v].dataCommand);
            if (data[v].dataValue) {
                button.setAttribute('data-value', data[v].dataValue);
            }
            toolbar.querySelector('.toolbar-but').appendChild(button);
        }
        var actions = editor.root.querySelectorAll('#toolbar .toolbar-but button');
        for (var i in actions) {
            actions[i].onclick = function() {
                var
                    dataCommand = this.getAttribute('data-command'),
                    dataValue = this.getAttribute('data-value');
                switch (dataCommand) {
                    case 'formatBlock':
                        exec(dataCommand, '<h' + dataValue + '>');
                        break
                    case 'createLink':
                        exec(dataCommand, '/');
                        break
                    default:
                        exec(dataCommand)
                }
            }
        }

        editor.root.querySelector('#text-editor #edit-content').addEventListener('keydown', function (event) {
            if (event.which == 13) {
                if (window.getSelection) {
                    var selection = window.getSelection(),
                        range = selection.getRangeAt(0),
                        p = createEl('p');
                    range.insertNode(p);
                    console.log(range);
                    return false;
                }
            }
        })
    }

    // 获取连接

    // 创建元素
    function createEl(el)
    {
        return document.createElement(el);
    }

    // 执行命令
    function exec(command, value)
    {
        return document.execCommand(command, false, value);
    }
    editor.init = init;
    window.editor = editor
} ();