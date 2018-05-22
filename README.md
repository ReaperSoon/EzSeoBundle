### EzSeoBundle

Installation
============

Step 1: Download the Bundle
---------------------------

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```bash

    $ composer require stevecohen/ezseobundle "~1.0.*"
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md) of the Composer documentation.

Step 2: Enable the Bundle
-------------------------

Then, enable the bundle by adding it to the list of registered bundles
in the ``app/AppKernel.php`` file of your project:

```php

    <?php
    // app/AppKernel.php

    // ...
    class AppKernel extends Kernel
    {
        public function registerBundles()
        {
            $bundles = array(
                // ...

                new SteveCohen\EzSeoBundle\SteveCohenEzSeoBundle(),
            );

            // ...
        }

        // ...
    }
```

Step 3: Create your own provider
--------------------------------

**app/config.yml**
```
smile_ez_seo:
    providers:
        article:
            class: Smile\Gs1Bundle\SEO\Providers\ArticleProvider
```

**Provider example:**

```
<?php

namespace ACME\ACMEBundle\SEO\Providers;

use Smile\EzSeoBundle\SEO\Providers\AbstractProvider;

class ArticleProvider extends AbstractProvider
{
    function getMetaTitle()
    {
        /* Get first defined attribute */
        $metaTitle = $this->array_find([
            $this->content->getFieldValue('meta_title'),
            $this->content->getFieldValue('title')
        ], function($elem) {
            return $elem != null && $elem != '';
        });

        return $metaTitle;
    }

    function getMetaDescription()
    {
        /* Get first defined attribute */
        $metaDesc = $this->array_find([
            $this->content->getFieldValue('meta_description'),
            $this->content->getFieldValue('intro')->xml->textContent,
            $this->content->getFieldValue('catcher')->xml->textContent
        ], function($elem) {
           return $elem != null && $elem != '';
        });
        return $metaDesc;
    }

    function getClassName()
    {
        return "article";
    }
    
    /**
    * Return the first item that match the user provided callback
    */
    private function array_find($xs, $f) {
        foreach ($xs as $x) {
            if (call_user_func($f, $x) === true)
                return $x;
        }
        return null;
    }

}

```

Documentation in progress...
