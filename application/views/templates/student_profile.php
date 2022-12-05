<div class="unique-info">
    <h2>Личные данные</h2>
    <p>Студент: <?php echo $data["user"]["name"] ?></p>
    <p>Шифр: <?php echo $data["user"]["code"] ?></p>
    <p>Вы принадлежите к группе: <?php echo $data["request"]["sql1"]['group']; ?></p>
    <p>Направление подготовки: <?php echo $data["request"]["sql1"]['spec']; ?></p>
</div>