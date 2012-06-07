# INITIAL CONFIGURATION
set :application, "tecnocenter.bloomweb.co"
set :export, :remote_cache
set :keep_releases, 5
set :cakephp_app_path, "app"
set :cakephp_core_path, "cake"
#default_run_options[:pty] = true # Para pedir la contraseña de la llave publica de github via consola, sino sale error de llave publica.

# DEPLOYMENT DIRECTORY STRUCTURE
set :deploy_to, "/home/embalao/tecnocenter.bloomweb.co"

# USER & PASSWORD
set :user, 'embalao'
set :password, 'rr40r900343'

# ROLES
role :app, "tecnocenter.bloomweb.co"
role :web, "tecnocenter.bloomweb.co"
role :db, "tecnocenter.bloomweb.co", :primary => true

# VERSION TRACKER INFORMATION
set :scm, :git
set :use_sudo, false
set :repository,  "git@github.com:bloomtec/tecnocenter.git"
set :branch, "master"

# TASKS
namespace :deploy do
  
  task :start do ; end
  
  task :stop do ; end
  
  task :restart, :roles => :app, :except => { :no_release => true } do
    run "cp /home/embalao/tecnocenter.bloomweb.co/current/. /home/embalao/tecnocenter.bloomweb.co/ -R"
    run "chmod 666 /home/embalao/tecnocenter.bloomweb.co/app/config/database.php"
    run "cp /home/embalao/tecnocenter.bloomweb.co/app/config/database.php.srvr /home/embalao/tecnocenter.bloomweb.co/app/config/database.php"
    run "chmod 777 /home/embalao/tecnocenter.bloomweb.co/app/tmp/ -R"
    run "chmod 777 /home/embalao/tecnocenter.bloomweb.co/app/webroot/img/ -R"
    run "chmod 777 /home/embalao/tecnocenter.bloomweb.co/app/webroot/files/ -R"
  end
  
end