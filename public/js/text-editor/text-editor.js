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
        exec('defaultParagraphSeparator', 'p');
        editor.root = document.querySelector(params.id);
        editor.root.style.width = !params.width ? '100%' : params.width;
        var template = "" +
            "<div id=\"text-editor\">\n\t" +
            "   <div id=\"toolbar\" class=\"form-group\">\n\t" +
            "       <div class=\"toolbar-but\">" +
            "       </div>\n\t" +
            "   </div>\n\t" +
            "   <div id=\"edit-content\" name='test' class=\"form-group\" contenteditable=\"true\"></div>\n\t" +
            "   <input type='hidden' name='text' value=''>" +
            "</div>\n\t";
        var data = params.data,
            toolbar,
            edit_content;
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
                    default:
                        exec(dataCommand)
                }
            }
        }
        edit_content = editor.root.querySelector('#edit-content');
        edit_content.innerHTML = '<p><br></p>';
        edit_content.addEventListener('keydown', function(e) {
            if (e.which == 8) {
                if (!this.innerHTML) {
                    this.innerHTML = '<p><br></p>';
                }
            }
        });
        edit_content.addEventListener('input', function () {
            editor.root.querySelector('#text-editor input').value = this.innerHTML
        });
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