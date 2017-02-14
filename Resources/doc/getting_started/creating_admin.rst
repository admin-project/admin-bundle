Creating an admin service
=========================

Create an admin class
---------------------

The easist way to start with is a new class extending from ``\AdminProject\AdminBundle\Admin\AbstractAdmin``:

.. code-block:: php

    <?php

    namespace AppBundle\Admin;

    class ProductAdmin extends AbstractAdmin
    {

    }

Register your admin class
-------------------------

Admin classes are registered by service tags. You must now create a service and tag it with ``adminproject.adminservice``:

.. code-block:: yaml

    # app/config/services.yml

    services:
      product.admin:
        class: AppBundle\Admin\ProductAdmin
        tags:
          - { name: adminproject.adminservice }

Create a group
--------------

Admin Classes are always displayed by groups. A admin class can not be standalone. Lets create a new group:

.. code-block:: yaml

    # app/config/config.yml

    admin_project_admin:
      groups:
        group1:
          icon: cog
          label: base
          translation_domain: my_translation_domain
        group2:
          icon: info
          label: info_label
          translation_domain: my_other_translation_domain

Now you can assign the group within the service configuration of your admin class:

.. code-block:: yaml

    # app/config/services.yml

    services:
      product.admin:
        class: AppBundle\Admin\ProductAdmin
        tags:
          - { name: adminproject.adminservice, group: group1 }

If you want to assign this class to multiple groups:

.. code-block:: yaml

      - { name: adminproject.adminservice, group: group1 }
      - { name: adminproject.adminservice, group: group2 }

You can also specify the translation domain or label in service configuration:

.. code-block:: yaml

      - { name: adminproject.adminservice, group: group1, label: "The translation label" }
      - { name: adminproject.adminservice, group: group2, translation_domain: "the_custom_translation_domain" }




