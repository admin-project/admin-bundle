Installation
============

Download the Bundle
-------------------

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

.. code-block:: bash

    $ composer require admin-project/admin-bundle

Enable the Bundle
-----------------

.. code-block:: php

    // app/AppKernel.php

    // ...
    class AppKernel extends Kernel
    {
        public function registerBundles()
        {
            $bundles = array(
                // ...
                new Knp\Bundle\MenuBundle\KnpMenuBundle(),
                new AdminProject\AdminBundle\AdminProjectAdminBundle(),
            );

            // ...
        }

        // ...
    }

Configure the Installed Bundles
-------------------------------


.. code-block:: yaml

    # app/config/config.yml
    admin_bundle:

Import Routing Configuration
----------------------------

.. code-block:: yaml

    # app/config/routing.yml

    admin_project_admin:
        resource: "@AdminProjectAdminBundle/Resources/config/routing.yml"
        prefix:   /admin/

