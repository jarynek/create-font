<!DOCTYPE html>
<html>
<head>
    <title>Homepage</title>
    <link rel="stylesheet" type="text/css" href="icons/style.css">
    <style>
        .icon {
            font-size: 24px;
        }
    </style>
</head>
<body>

<h1>Homepage</h1>

<form action="" method="post" enctype="multipart/form-data">
    <label for="dir">
        <select name="dir" id="dir">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="jarek">jarek</option>
            <option value="parek">parek</option>
            <option value="21574anna">21574anna</option>
            <option value="212665">212665</option>
        </select>
    </label>
    <label for="files"><input id="files" name="files[]" type="file" multiple=""></label>
    <input type="submit">
</form>

</body>
</html>