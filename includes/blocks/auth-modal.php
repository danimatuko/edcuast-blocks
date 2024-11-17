<?php

function educast_auth_modal_render_cb($atts)
{
    if (is_user_logged_in()) return;

    $showRegister = $atts['showRegister'];
    ob_start();
?>

    <div class="wp-block-udemy-plus-auth-modal">
        <div class="modal-container">
            <div class="modal-overlay"></div>
            <span class="modal-trick">&#8203;</span>

            <div class="modal-content">
                <button class="modal-btn-close" type="button">
                    <i class="bi bi-x"></i>
                </button>

                <!-- Tabs -->
                <ul class="tabs">
                    <li><a href="#signin-tab" class="active-tab"><i class="bi bi-key"></i>Sign in</a></li>
                    <?php if ($showRegister) : ?>
                        <li><a href="#signup-tab"><i class="bi bi-person-plus-fill"></i>Sign up</a></li>
                    <?php endif; ?>
                </ul>

                <div id="auth-status"></div>
                <div class="modal-body">
                    <!-- Login Form -->
                    <form id="signin-tab" style="display: block;" method="POST">
                        <fieldset>
                            <label for="si-email">Name/Email</label>
                            <input type="text" id="si-email" name="email" placeholder="johndoe@example.com" required />

                            <label for="si-password">Password</label>
                            <input type="password" id="si-password" name="password" required placeholder=" " />

                            <button type="submit">Sign in</button>
                        </fieldset>
                    </form>

                    <?php if ($showRegister) : ?>
                        <!-- Register Form -->
                        <form id="signup-tab" method="POST">
                            <fieldset>
                                <label for="su-name">Full name</label>
                                <input type="text" id="su-name" name="name" placeholder="John Doe" required />

                                <label for="su-email">Email address</label>
                                <input type="email" id="su-email" name="email" placeholder="johndoe@example.com" required />

                                <label for="su-password">Password</label>
                                <input type="password" id="su-password" name="password" minlength="6" required placeholder=" " />

                                <button type="submit">Sign up</button>
                            </fieldset>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

<?php
    return ob_get_clean();
}
?>
