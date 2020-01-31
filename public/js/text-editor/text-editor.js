const editor = {
    init: function() {
        const $this = this;
        const actions = document.querySelector('#toolbar').querySelectorAll('button');
        actions.forEach(function (action) {
           action.onclick = function () {
               $this.exec(this.title)
           }
        });
        document.querySelector('#edit-but').onclick = function () {
            console.log(document.querySelector('#edit').innerHTML)
        }
    },
    exec: function(command, value = null) {
        document.execCommand(command, false, value);
    }
};
