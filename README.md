### EzSeoBundle

Installation
============

Step 1: Download the Bundle
---------------------------

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```bash

    $ composer require stevecohenfr/ezseobundle
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md) of the Composer documentation.

Step 2: Enable the Bundle
-------------------------

Then, enable the bundle by adding it to the list of registered bundles
in the ``app/AppKernel.php`` file of your project:

```php
    // app/AppKernel.php

    // ...
    class AppKernel extends Kernel
    {
        public function registerBundles()
        {
            $bundles = array(
                // ...

                new SteveCohenFR\EzSeoBundle\SteveCohenFREzSeoBundle(),
            );

            // ...
        }

        // ...
    }
```

Step 3: Create your own provider
--------------------------------

**app/config.yml**
```yml
steve_cohen_fr_ez_seo:
    providers:
        article:
            class: ACME\ACMEBundle\SEO\Providers\ArticleProvider
```

**Provider example:**

```php
<?php

namespace ACME\ACMEBundle\SEO\Providers;

use SteveCohenFR\EzSeoBundle\SEO\Providers\AbstractProvider;

class ArticleProvider extends AbstractProvider
{
    /**
    * @override
    */
    function getMetaTitle()
    {
        /* Get first defined attribute */
        $metaTitle = $this->array_find([
            $this->getContent()->getFieldValue('meta_title'),
            $this->getContent()->getFieldValue('title')
        ], function($elem) {
            return $elem != null && $elem != '';
        });

        return $metaTitle;
    }

    /**
    * @override
    */
    function getMetaDescription()
    {
        /* Get first defined attribute */
        $metaDesc = $this->array_find([
            $this->getContent()->getFieldValue('meta_description'),
            $this->getContent()->getFieldValue('intro')->xml->textContent,
            $this->getContent()->getFieldValue('catcher')->xml->textContent
        ], function($elem) {
           return $elem != null && $elem != '';
        });
        return $metaDesc;
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

Step 4: Include SEO in your pagelayout
--------------------------------------

In your pagelayout.html.twig add this line between <head> tags

```twig
<!--  SEO -->
    {{ render( controller( 'SteveCohenFREzSeoBundle:Seo:showMetaSeo', {
        content: content,
        prefix: "",
        suffix: " | ACME"
    } )) }}
```

* content (required): Your current *content* (eZ\Publish\API\Repository\Values\Content)
* prefix: A prefix for your Meta Title
* suffix: A suffix for your Meta Title

Availables variables
--------------------------------

You can access useful variables in your SEO Provider, like eZ Platform Repository, Container and Content

```php
/**
 * Get the current content
 * @var \eZ\Publish\API\Repository\Values\Content\Content $content
 */
$content = $this->getContent();

/**
 * Get eZ Platform Repository
 * @var \eZ\Publish\Core\SignalSlot\Repository $repository
 */
$repository = $this->getRepository();

/**
 * Get symfony Container
 * @var \Symfony\Component\DependencyInjection\Container $container
 */
$container = $this->getContainer();

/**
 * Get a service
 * @var ACME\ACMEBundle\Services\MyService
 */
$myService = $container->get('my.service');

/**
 * Get a parameter from ParametersBag
 * @var string $myParam
 */
$myParam = $container->getParameter('my.parameter');
```