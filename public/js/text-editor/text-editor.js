!function () {
    var
        editor = {},
        actions = document.querySelector('#toolbar').querySelectorAll('button'),
        edit_content = document.querySelector('#edit-content'),
        edit_but = document.querySelector('#edit-but');

    function init()
    {
        for (var i in actions) {
            actions[i].onclick = function() {
                switch (this.title) {
                    case 'formatBlock':
                        exec(this.title, '<h' + this.name + '>');
                        break
                    case 'createLink':
                        exec(this.title, '/');
                        break
                    default:
                        exec(this.title)
                }
            }
        }
    }

    function exec(command, value)
    {
        return document.execCommand(command, false, value);
    }

    editor.init = init;
    window.editor = editor
} ();