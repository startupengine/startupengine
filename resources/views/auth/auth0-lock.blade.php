<section>
    <div class="wrap">
        <h4 style="width:100%;text-align:center;"><?php echo Lang::get('app.sign_in_message'); ?></h4>
        <div id="root" style="width: 320px; margin: 40px auto; padding: 10px; border-style: none; border-width: 1px; box-sizing: border-box;">
            embedded area
        </div>
        <?php $redirecturl = \Config::get('app.url').'/auth0/callback'; ?>
        <script src="https://cdn.auth0.com/js/lock/10.17/lock.min.js"></script>
        <script>
            var lock = new Auth0Lock('<?php echo \Config::get('laravel-auth0.client_id') ?>', '<?php echo \Config::get('laravel-auth0.domain') ?>', {
                container: 'root',
                auth: {
                    redirectUrl: '<?php echo $redirecturl; ?>',
                    responseType: 'code',
                    params: {
                        scope: 'openid email' // Learn about scopes: https://auth0.com/docs/scopes
                    }
                },
                rememberLastLogin: false
            });
            lock.show();
        </script>
        <div align="center">
            <a href="/" class="button" style="color: #222; text-shadow: none; background: #fff;border: none;" ><?php echo Lang::get('app.go_back'); ?></a>
        </div>
    </div>
</section>