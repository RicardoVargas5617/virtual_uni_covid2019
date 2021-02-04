
<form action="correo_enviar.php" method="post" >
            <h2>Contactenos Ahora Mismo ...!</h2>
            <div class="user_info">
                <h4 >Nombres y Apellidos *</h4>
                <input type="text" id="names" name="nombre" required>

                <h4 for="phone">Telefono / Celular</h4>
                <input type="text" id="phone" name="telefono">

                <h4 for="email">Correo electronico *</h4>
                <input type="text" id="email" name="correo" required>

                <h4 for="mensaje">Mensaje *</h4>
                <textarea id="mensaje" name="mensaje" required></textarea>

                <a class="btn btn-general" style="color:#fff; background: #ff9800;font-size: 18px;width: 100%;"href="enviar.php"  id="btnSend">enviar</a>
                <br>
            </div>
        </form>
