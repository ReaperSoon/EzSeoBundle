<?php

namespace SteveCohenFR\EzSeoBundle\Controller;

use eZ\Publish\API\Repository\Values\Content\Content;
use SteveCohenFR\EzSeoBundle\SEO\Providers\DefaultProvider;
use SteveCohenFR\EzSeoBundle\Services\ConfigService;
use SteveCohenFR\EzSeoBundle\Services\SteveCohenFRSeoProvider;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class SeoController extends Controller
{
    public function showMetaSeoAction( $content, $prefix = "", $suffix = "" )
    {
        /** @var SteveCohenFRSeoProvider $seoService */
        $seoService = $this->get('stevecohenfr.ez_seo.seo_provider');
        /** @var ConfigService $seoConfig */
        $seoConfig = $this->get('stevecohenfr.ez_seo.config');

        if ($content instanceof Content) {
            $seo = $seoService->getSEO($content, $prefix, $suffix);
        }else {
            $seo = $seoService->getRouteSEO($content, $prefix, $suffix);
        }
        $config = $seoConfig->getConfig();

        if ($seo === null) {
            $seo = new DefaultProvider(null, null, $config);
        }

        $response = new Response();
        if ($seo != null) {
            $response = $this->render("SteveCohenFREzSeoBundle:seo:seo.html.twig", [
                'seo'       => $seo,
                'config'    => $config
            ]);
        }
        return $response;
    }
}