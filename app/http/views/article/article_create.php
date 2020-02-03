<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title><?= $data['title']?></title>
    <link href="/images/favicon.ico" rel="icon">
    <link href="/css/main.css" rel="stylesheet">
    <link href="/css/text-editor/text-editor.css" rel="stylesheet">
</head>
<body>
    <?php include __DIR__ . '/../layouts/header.php'?>
    <section class="main">
        <div id="editor"></div>
    </section>

    <div>
        https://www.jianshu.com/p/924f8823ad34
        https://caelumtian.github.io/2017/08/21/%E5%88%A9%E7%94%A8javascript%E6%90%AD%E5%BB%BA%E5%AF%8C%E6%96%87%E6%9C%AC%E7%BC%96%E8%BE%91%E5%99%A8/
    </div>
    <?php include __DIR__ . '/../layouts/footer.php'?>
    <script src="/js/main.js" type="text/javascript"></script>
    <script src="/js/text-editor/text-editor.js" type="text/javascript"></script>
    <script>
        editor.init({
            id: '#editor',
            data: [
                {title: '加粗', dataCommand: 'bold'},
                {title: '斜体', dataCommand: 'italic'},
                {title: '标题1', dataCommand: 'formatBlock', dataValue: '1'},
                {title: '标题2', dataCommand: 'formatBlock', dataValue: '2'},
                {title: '标题3', dataCommand: 'formatBlock', dataValue: '3'},
                {title: '标题4', dataCommand: 'formatBlock', dataValue: '4'},
                {title: '左', dataCommand: 'justifyLeft'},
                {title: '中', dataCommand: 'justifyCenter'},
                {title: '右', dataCommand: 'justifyRight'},
                {title: '撤销', dataCommand: 'undo'},
            ]
        });
        $.ajax({
            url: '/test',
            data: {
                user: 'snoweddy',
                pass: 'yuefei12',
                email: '714671404@qq.com',
                text: '这是一个测试的中文字符串123123，测试是否有乱码发生'
            },
            success: function (response) {
                console.log(JSON.parse(response))
            },
            fail: function (error) {
                console.log(error)
            }
        })

    </script>
</body>
</html>