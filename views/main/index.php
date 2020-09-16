<h2>Введите id пользователя, или оставьте поле пустым, чтобы использовать стандартный id</h2>
<input type="number" id="userID">
<button onclick="enter()">Найти</button>

<script !src="">

    function enter() {
        let userId = document.querySelector('#userID').value;
        userId = (userId === '') ? 492257272 : userId;

        location.href = `index.php?url=API/getUserInfo/${userId}`
    }
</script>