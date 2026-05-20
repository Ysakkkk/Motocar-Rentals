<!-- ==========================================
     FOOTER
     ========================================== -->
<footer class="mc-footer">
    <div class="mc-container">
        <div class="mc-footer__grid">
            <div class="mc-footer__col">
                <div class="mc-footer__brand-row">
                    <p class="mc-footer__tagline">MotoCar Rentals</p>
                    <div class="mc-footer__brand">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-footer.png" alt="MotoCar Rentals">
                    </div>
                </div>
            </div>
            <div class="mc-footer__col">
                <h4 data-i18n="footer_servicios">Servicios 24/7</h4>
                <ul>
                    <li><a href="tel:+573202161156" style="color:inherit;text-decoration:none;"><i class="fas fa-phone"></i> +57 320 216 1156</a></li>
                    <li><a href="mailto:motocarrentals@gmail.com" style="color:inherit;text-decoration:none;"><i class="fas fa-envelope"></i> motocarrentals@gmail.com</a></li>
                </ul>
            </div>
            <div class="mc-footer__col">
                <h4 data-i18n="footer_contactanos">Contáctanos</h4>
                <a href="https://www.google.com/maps/place/MotoCar+Rentals/@6.1762,-75.435,1576m/data=!3m1!1e3!4m6!3m5!1s0x8e469d8d8761cbb1:0xcf88fa157645f16d!8m2!3d6.1755508!4d-75.4348712!16s%2Fg%2F11y2tz0l_5" target="_blank" class="mc-footer__location-link">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>Mall Terranova</span>
                </a>
                <div class="mc-footer__social">
                    <a href="https://www.facebook.com/p/MotoCar-Rentals-61558707917054/" target="_blank" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://www.instagram.com/motocar_rentals/" target="_blank" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="https://wa.me/573202161156" target="_blank" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                    <a href="https://www.tiktok.com/@motocar.rentals" target="_blank" aria-label="TikTok"><i class="fab fa-tiktok"></i></a>
                </div>
            </div>
            <div class="mc-footer__col">
                <h4 data-i18n="footer_contactar_title">¿Quieres que te contactemos?</h4>
                <form class="mc-footer__form" id="footerContactForm">
                    <input type="text" id="footerContactInput" placeholder="Tu correo electrónico o número de teléfono" data-i18n-placeholder="footer_email_placeholder" required>
                    <button type="submit" class="mc-btn mc-btn--primary mc-btn--sm" data-i18n="footer_enviar">Enviar</button>
                    <p class="mc-footer__form-msg" id="footerContactMsg" style="display:none;font-size:0.85rem;margin-top:6px;"></p>
                </form>
            </div>
        </div>
        <div class="mc-footer__bottom">
            <p>&copy; <?php echo date('Y'); ?> MotoCar Rentals. <span data-i18n="footer_derechos">Todos los derechos reservados.</span></p>
        </div>
    </div>
</footer>

<!-- WhatsApp Float Button -->
<div class="mc-whatsapp-wrap">
    <span class="mc-whatsapp-cta">¿Tienes dudas? ¡Contáctanos!</span>
    <a href="https://wa.me/573202161156?text=Hola%20MotoCar%20Rentals!%20Quiero%20información%20sobre%20alquiler%20de%20vehículos" class="mc-whatsapp-float" target="_blank" aria-label="WhatsApp">
        <i class="fab fa-whatsapp"></i>
    </a>
</div>

<?php wp_footer(); ?>
</body>
</html>
