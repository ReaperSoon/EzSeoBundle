<?php

namespace SteveCohenFR\EzSeoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class SeoController extends Controller
{
    public function showMetaSeoAction( $content, $prefix = "", $suffix = "" )
    {
        $seoService = $this->get('stevecohenfr.ez_seo.seo_provider');
        $seoConfig = $this->get('stevecohenfr.ez_seo.config');

        $seo = $seoService->getSEO($content, $prefix, $suffix);
        $config = $seoConfig->getConfig();

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