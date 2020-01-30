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
        <div id="text-editor">
            <div id="toolbar" class="form-group">
                <div class="toolbar-but">
                    <button type="button">加粗</button>
                    <button type="button">斜体</button>
                    <button type="button">标题1</button>
                    <button type="button">标题2</button>
                    <button type="button">标题3</button>
                    <button type="button">标题4</button>
                    <button type="button">链接</button>
                    <button type="button">图片上传</button>
                    <button type="button">左</button>
                    <button type="button">中</button>
                    <button type="button">右</button>
                    <button type="button">撤销</button>
                    <button type="button">全选</button>
                </div>
            </div>
            <div id="edit"
                 class="form-group"
                 contenteditable="true"
            ></div>
            <div class="form-group">
                <button type="button" class="but">提交</button>
            </div>
        </div>
    </section>
    <?php include __DIR__ . '/../layouts/footer.php'?>
    <script src="/js/main.js" type="text/javascript"></script>
    <script src="/js/text-editor/text-editor.js" type="text/javascript"></script>
</body>
</html>