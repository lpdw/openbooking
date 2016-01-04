openbooking (DEV)
=================

(Projet 1 - Equipe 2) Plugin WordPress Open Source de réservation/inscription à un événement

## Installation

Copier le dossier `openbooking` dans `wp-content\plugins` et activer le plugin.

## Dev

Pour mettre à jour les submodules : `git submodule update --init --recursive`

## Installation d'un environment de test (TODO: traduction/reformulation en fr + vérifier que ça fonctionne une fois le plugin créé)

Want to test out the plugin and work on it? Here's how you can set up your own
testing environment in a few easy steps:

1. Install [Vagrant](http://vagrantup.com/) and [VirtualBox](https://www.virtualbox.org/).
2. Clone [Chassis](https://github.com/Chassis/Chassis):

   ```bash
   git clone --recursive git@github.com:Chassis/Chassis.git test
   ```
   
   If you're getting a `permission denied` error, it probably means you need to set up your [GitHub SSH Key](https://help.github.com/articles/generating-ssh-keys/).
   
   Or use https : 
   
   ```bash
   git clone --recursive https://github.com/Chassis/Chassis.git test
   ```

3. Grab a copy of the plugin:

   ```bash
   cd test
   mkdir -p content/plugins content/themes
   cp -r wp/wp-content/themes/* content/themes
   git clone -b dev https://github.com/lpdw/openbooking.git openbooking
   ```

4. Start the virtual machine:

   ```bash
   vagrant up
   ```

5. Create a symlink and activate the plugin:

   ```bash
   vagrant ssh -c 'cd /vagrant && ln -s /vagrant/openbooking/openbooking /vagrant/content/plugins/openbooking && wp plugin activate openbooking'
   ```

You're done! You should now have a WordPress site available at
http://vagrant.local.

To access the admin interface, visit http://vagrant.local/wp/wp-admin and log
in with the credentials below:

   ```
   Username: admin
   Password: password
   ```

<!-- ### Testing

For testing, you'll need a little bit more:

1. Clone the [Tester extension](https://github.com/Chassis/Tester) for Chassis:

   ```bash
   # From your base directory, api-tester if following the steps from before
   git clone --recursive https://github.com/Chassis/Tester.git extensions/tester
   ```

2. Run the provisioner:

   ```
   vagrant provision
   ```

3. Log in to the virtual machine and run the testing suite:

   ```bash
   vagrant ssh
   cd /vagrant/content/plugins/openbooking
   phpunit
   ```

   You can also execute the tests in the context of the VM without SSHing
   into the virtual machine (this is equivalent to the above):

   ```bash
   vagrant ssh -c 'cd /vagrant/content/plugins/openbooking && phpunit'
   ``` -->
