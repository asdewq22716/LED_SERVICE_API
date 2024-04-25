<html translate="no">
<style>
    .text-alert {
        color: red;
        text-align: center;

    }
    .text-center {
        text-align: center;

    }
</style>
<head>
    <title>แจ้งเตือน</title>
    <meta name="google" content="notranslate">
</head>


<body>
    <div class="text-alert"><?php echo $_GET['message']; ?></div>
    <div class="text-center"><br><button onclick="window.close()">ตกลง</button></div>
</body>

</html>