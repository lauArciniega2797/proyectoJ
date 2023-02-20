<?php
session_start();
if(isset($_SESSION['usuario'])){
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión | COPESMAR</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;1,100;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="assets/images/favicon.ico" type="image/x-icon">
</head>
<body>
    <section id="app_login">
        <div v-if="!login_success">
            <figure>
                <img src="assets/images/copesmar.png" alt="" width="100%">
            </figure>
            <!-- <h1>Inicia sesión</h1> -->
            <p id="message_login" v-if="message_login" class="is-text-center">{{ message_login }}</p>
            <form>
                <fieldset>
                    <label for="">Usuario</label>
                    <input type="text" name="user" id="user" v-model="user">
                </fieldset>
                <fieldset>
                    <label for="">Contraseña</label>
                    <input type="password" name="password" id="password" v-model="pass">
                </fieldset>
                <button @click="login">Iniciar sesión</button>
                <!-- <a>¿Olvidaste la contraseña?</a> -->
            </form>
        </div>
        <div v-else id="success">
            <h1>¡Bienvenido {{ user }}!</h1>
            <p>Redireccionando...</p>
            <div id="charger"></div>
        </div>
    </section>

    <script src="assets/js/vue.js"></script>
    <script src="assets/js/jquery.js"></script>
    <script>
        let app = new Vue({
            el: '#app_login',
            data: {
                user: '',
                pass: '',
                login_success: false,
                message_login: ''
            },
            methods: {
                login: function(e) {
                    e.preventDefault()
                    let app = this;
                    $.post("assets/api/api_login.php?action=login",
                    {
                        usuario: app.user,
                        password: app.pass
                    },
                    function(data, status){
                        if (status == 'success') {
                            let datos = JSON.parse(data)
                            
                            if (datos.login_access) {
                                app.login_success = true
                                setTimeout(() => {
                                    window.location = 'index.php'
                                }, 4000);
                            } else {
                                app.message_login = 'Las claves son incorrectas'
                            }
                        }
                    });
                }
            }
        })
    </script>
</body>
</html>