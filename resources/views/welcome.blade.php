<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<script>
    let i = 0;
    let swing = true
    let data = 'Welcome to Fashion Shop';
    setInterval(() => {
        if (swing) {
            document.getElementById('welcome').innerHTML += data[i]
            i++;
        } 
        if (i > data.length) {
            document.getElementById('welcome').innerHTML = '';
            i = 0;
        }
    }, 100);
</script>
<body>
    <p id="welcome"></p>
</body>
</html>