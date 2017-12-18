@servers(['web' => 'worker@95.85.32.232'])
@setup
    $repository = 'git@gitlab.fullystudios.se:fullystudios/thelotterymachine';
    $releases_dir = '/var/www/thelotterymachine/releases';
    $app_dir = '/var/www/thelotterymachine';
    $release = date('YmdHis');
    $new_release_dir = $releases_dir .'/'. $release;
@endsetup

@story('deploy')
    clone_repository
    run_composer
    run_npm
    update_symlinks
    update_migrations
@endstory

@task('clone_repository')
    echo 'Cloning repository'
    [ -d {{ $releases_dir }} ] || mkdir {{ $releases_dir }}
    git clone --depth 1 {{ $repository }} {{ $new_release_dir }}
@endtask

@task('run_npm')
    echo "Running front end production scripts"
    cd {{ $new_release_dir }}
    npm install
    npm run production
@endtask

@task('run_composer')
    echo "Running composer in ({{ $release }})"
    cd {{ $new_release_dir }}
    composer install --prefer-dist --no-scripts -q -o
@endtask

@task('update_migrations')
    echo "Migrating database"
    cd {{ $new_release_dir }}
    php artisan migrate --force
@endtask

@task('update_symlinks')
    echo "Linking storage directory"
    rm -rf {{ $new_release_dir }}/storage
    ln -nfs {{ $app_dir }}/storage {{ $new_release_dir }}/storage

    echo 'Linking .env file'
    ln -nfs {{ $app_dir }}/.env {{ $new_release_dir }}/.env

    echo 'Linking current release'
    ln -nfs {{ $new_release_dir }} {{ $app_dir }}/current
@endtask