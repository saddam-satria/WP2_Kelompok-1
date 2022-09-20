<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : "web programming 2" ; ?></title>
</head>
<body>
    <div>
        <?= $this->renderSection("content");?>
    </div>
</body>
</html>