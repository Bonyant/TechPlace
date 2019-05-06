<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    <style>
        table {
            border-collapse: collapse;
        }
        table td, table th {
            border:#666 0px solid;
            padding:5px;
        }
        tr.same-document-row {
            background-color: #FFF8D4;
        }
        .nowrap {
            white-space: nowrap;
        }
        h1 {
            text-align: center;
            font-size:20px;
        }
        .text-center {
            text-align: center;
        }
        @page Section2 {size:841.7pt 595.45pt;mso-page-orientation:landscape;margin:1.25in 1.0in 1.25in 1.0in;mso-header-margin:.5in;mso-footer-margin:.5in;mso-paper-source:0;}
        div.landscape {page:Section2;}
    </style>
</head>
<body>
<div class='landscape'>
    <?= $content ?>
</div>
</body>
</html>
<?php $this->endPage() ?>
