<? require_once 'bloques/_config.php'; ?>
<? include 'bloques/_header.php'; ?>

<h1>¿Quieres contactar con nosotros?</h1>
<p>Si tienes alguna duda o consulta sobre alguno de los eventos publicados u otra consulta, ponte en contacto con nosotros</p>

<form action="form.php" method="POST">
    <label for="name">Nombre:</label>
    <input type="text" id="name" name="name" required>

    <label for="email">Correo Electrónico:</label>
    <input type="email" id="email" name="email" required>

    <label for="subject">Asunto:</label>
    <input type="text" id="subject" name="subject" required>

    <label for="message">Mensaje:</label>
    <textarea id="message" name="message" required></textarea>

    <button type="submit">Enviar</button>
</form>
<br>

<p>Correo electrónico: enterate@enterate.com</p>
<p>Teléfono de contacto: 600-00-00-00</p>
<ul class="social">
    <li><a href="https://www.facebook.com" target="_blank"><i class="fab fa-facebook"></i> Facebook</a></li>
    <li><a href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i> Twitter</a></li>
    <li><a href="https://www.instagram.com" target="_blank"><i class="fab fa-instagram"></i> Instagram</a></li>
</ul>
<br>

    <br>
<p>Dirección: Avenida de la Costa Nº55, 33205 Gijón</p>
<div class="map-container">
        
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2029.940540183378!2d-5.6573624171746655!3d43.537695123456416!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd367c62c407b231%3A0x351bbafb788c9db1!2sAv.%20de%20la%20Costa%2C%2055%2C%20Centro%2C%2033201%20Gij%C3%B3n%2C%20Asturias!5e1!3m2!1ses!2ses!4v1742476324760!5m2!1ses!2ses" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
   
  </div>









<? include 'bloques/_footer.php'; ?>