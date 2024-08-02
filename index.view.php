<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>name</title>
</head>
<body>
    <table style="text-align: center">
        <tr>
            <td>Title</td>
            <td>Rate</td>
            <td>Content</td>

        </tr>
        <?php foreach ($answer as $review): ?>
            <tr >
                <td><?= $review['title'] ?></td>
                <td><?= $review['rate'] ?></td>
                <td style="text-align: left"><?= $review['content'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>