<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>菜鸟日记</title>
    <link href="/images/favicon.ico" rel="icon" type="image/ico">
    <link href="/css/main.css" rel="stylesheet" type="text/css">
    <link href="/css/text-editor/text-editor.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="app">
    <?php include __DIR__ . '/../layouts/header.php' ?>
    <section class="main">
        <div class="text-editor">
            <form action="/article" method="post">


                <div id="text-editor-main-body" contenteditable="true"></div>

                <button type="submit">submit</button>
            </form>

        </div>
    </section>
    <?php include __DIR__ . '/../layouts/footer.php'?>
</div>
<script src="/js/main.js" type="text/javascript"></script>
<script src="/js/text-editor/text-editor.js" type="text/javascript"></script>
</body>
</html>