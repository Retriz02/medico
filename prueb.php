<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<input type="text" id="age" name="age" pattern="[0-9]+" oninput="this.value = this.value.replace(/[^0-9]/,'')"/> 
</body>
</html>