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
        <div id="articles">
            <form action="/article/create" method="post">
                <div class="form-group">
                    <input type="text" value="" name="title" class="article-title" placeholder="文章标题">
                </div>
                <div id="editor"></div>
                <div class="form-group">
                    <button type="button" class="but" id="edit-but">提交</button>
                </div>
            </form>
        </div>
    </section>
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
        function a() {

        }
        console.log(new a);
    </script>
</body>
</html>