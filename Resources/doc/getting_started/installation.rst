Installation
============

Step 1. Download the Bundle
---------------------------

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

.. code-block:: bash

    $ composer require admin-project/admin-bundle

Step 2: Enable the Bundle
-------------------------

.. code-block:: php

    // app/AppKernel.php

    // ...
    class AppKernel extends Kernel
    {
        public function registerBundles()
        {
            $bundles = array(
                // ...
                new AdminProject\AdminBundle\AdminProjectAdminBundle(),
            );

            // ...
        }

        // ...
    }

Step 3: Configure the Installed Bundles
---------------------------------------


.. code-block:: yaml

    # app/config/config.yml
    admin_bundle:

Step 4: Import Routing Configuration
------------------------------------

.. code-block:: yaml

    # app/config/routing.yml

    admin_project_admin:
        resource: "@AdminProjectAdminBundle/Resources/config/routing.yml"
        prefix:   /admin/

