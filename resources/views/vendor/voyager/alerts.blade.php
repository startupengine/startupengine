<div class="alerts">
    @foreach ($alerts as $alert)
        <?php if( env('APP_PLATFORM') == 'heroku' && $alert->name == "missing-storage-symlink") { } else { ?>
                <div class="alert alert-{{ $alert->type }} alert-name-{{ $alert->name }}">
                    @foreach($alert->components as $component)
                        <?php echo $component->render(); ?>
                    @endforeach
                </div>
    <?php } ?>
    @endforeach
</div>