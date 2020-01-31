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
                    <button type="button" title="bold">加粗</button>
                    <button type="button" title="italic">斜体</button>
                    <button type="button" title="formatBlock" name="1">标题1</button>
                    <button type="button" title="formatBlock" name="2">标题2</button>
                    <button type="button" title="formatBlock" name="3">标题3</button>
                    <button type="button" title="createLink">链接</button>
                    <button type="button" title="=">图片上传</button>
                    <button type="button" title="justifyLeft">左</button>
                    <button type="button" title="justifyCenter">中</button>
                    <button type="button" title="justifyRight">右</button>
                    <button type="button" title="=">撤销</button>
                    <button type="button" title="=">全选</button>
                </div>
            </div>
            <div id="edit-content"
                 class="form-group"
                 contenteditable="true"
            ></div>
            <div class="form-group">
                <button type="button" class="but" id="edit-but">提交</button>
            </div>
        </div>
    </section>
    <?php include __DIR__ . '/../layouts/footer.php'?>
    <script src="/js/main.js" type="text/javascript"></script>
    <script src="/js/text-editor/text-editor.js" type="text/javascript"></script>
    <script>
        editor.init();
    </script>
</body>
</html>